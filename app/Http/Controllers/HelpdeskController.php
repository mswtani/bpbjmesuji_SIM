<?php

namespace App\Http\Controllers;

use App\Mail\HelpdeskReplyMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreHelpdeskMessageRequest;
use App\Models\HelpdeskMessage;
use App\Models\HelpdeskTicket;
use App\Models\HelpdeskAttachment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HelpdeskController extends Controller
{
    /**
     * Menampilkan Inbox Helpdesk.
     */
    public function index(Request $request): View
    {
        $perPage = (int) $request->query('per_page', 15);

        if (! in_array($perPage, [10, 25, 50, 100], true)) {
            $perPage = 15;
        }

        $search = trim($request->query('search', ''));

        $categoryId = $request->query('category');

        if (
            $categoryId !== null &&
            (! ctype_digit((string) $categoryId) || (int) $categoryId < 1)
        ) {
            $categoryId = null;
        }

        $status = $request->query('status');

        if (! in_array($status, [
            'baru',
            'diproses',
            'menunggu_pemohon',
            'selesai',
            'ditutup',
        ], true)) {
            $status = null;
        }

        $priority = $request->query('priority');

        if (! in_array($priority, [
            'normal',
            'tinggi',
            'mendesak',
        ], true)) {
            $priority = null;
        }

        $tickets = HelpdeskTicket::query()
            ->with([
                'category',
                'user',
            ])
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($query) use ($search) {
                    $query
                        ->where(
                            'ticket_number',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'requester_name',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'requester_email',
                            'like',
                            '%' . $search . '%'
                        )
                        ->orWhere(
                            'subject',
                            'like',
                            '%' . $search . '%'
                        );
                });
            })
            ->when($categoryId !== null, function ($query) use ($categoryId) {
                $query->where(
                    'category_id',
                    (int) $categoryId
                );
            })
            ->when($status !== null, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->when($priority !== null, function ($query) use ($priority) {
                $query->where('priority', $priority);
            })
            ->latest('last_message_at')
            ->paginate($perPage)
            ->withQueryString();

        $categories = \App\Models\HelpdeskCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get();

        return view('helpdesk.index', [
            'tickets' => $tickets,
            'categories' => $categories,
            'search' => $search,
            'categoryId' => $categoryId !== null
                ? (int) $categoryId
                : null,
            'status' => $status,
            'priority' => $priority,
            'perPage' => $perPage,
        ]);
    }

    /**
     * Menampilkan detail tiket dan percakapan.
     */
    public function show(
        string $ticketNumber
        ): View {
        $ticket = HelpdeskTicket::query()
            ->with([
                'category',
                'user',
                'messages.user',
                'messages.attachments',
            ])
            ->where(
                'ticket_number',
                $ticketNumber
            )
            ->firstOrFail();

        return view('helpdesk.show', [
            'ticket' => $ticket,
        ]);
    }

    public function viewAttachment(
        string $ticketNumber,
        int $attachment
    ) {
        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $file = HelpdeskAttachment::query()
            ->where('id', $attachment)
            ->where('ticket_id', $ticket->id)
            ->firstOrFail();

        $disk = Storage::disk('local');

        abort_unless(
            $disk->exists($file->file_path),
            404
        );

        return response()->file(
            $disk->path($file->file_path),
            [
                'Content-Type' => $file->mime_type,
                'Content-Disposition' => 'inline; filename="' .
                    addslashes($file->original_name) . '"',
            ]
        );
    }

   /**
     * Menyimpan balasan petugas.
     */
    public function reply(
        StoreHelpdeskMessageRequest $request,
        string $ticketNumber
    ): RedirectResponse {
        $ticket = HelpdeskTicket::query()
            ->where(
                'ticket_number',
                $ticketNumber
            )
            ->firstOrFail();

        $storedPaths = [];

        try {
            $message = DB::transaction(function () use (
                $request,
                $ticket,
                &$storedPaths
            ) {
                $message = HelpdeskMessage::create([
                    'ticket_id' => $ticket->id,
                    'user_id' => $request->user()->id,
                    'sender_type' => 'staff',
                    'message' => $request->validated('message'),
                ]);

                if ($request->hasFile('attachments')) {
                    foreach ($request->file('attachments') as $file) {
                        $path = $file->store(
                            'helpdesk/' . $ticket->id,
                            'local'
                        );

                        $storedPaths[] = $path;

                        HelpdeskAttachment::create([
                            'ticket_id' => $ticket->id,
                            'message_id' => $message->id,
                            'original_name' => $file->getClientOriginalName(),
                            'file_path' => $path,
                            'mime_type' => $file->getMimeType(),
                            'file_size' => $file->getSize(),
                            'uploaded_by_user_id' => $request->user()->id,
                        ]);
                    }
                }

                $ticket->update([
                    'last_message_at' => $message->created_at,
                ]);

                return $message;
            });
        } catch (\Throwable $e) {
            foreach ($storedPaths as $path) {
                Storage::disk('local')->delete($path);
            }

            throw $e;
        }

        Mail::to($ticket->requester_email)
            ->send(
                new HelpdeskReplyMail(
                    $ticket,
                    $message
                )
            );

        return redirect()
            ->route(
                'helpdesk.admin.show',
                $ticket->ticket_number
            )
            ->with(
                'success',
                'Balasan berhasil dikirim.'
            );
    }

    /**
     * Mengubah status dan prioritas tiket.
     */
    public function updateTicket(
        Request $request,
        string $ticketNumber
    ): RedirectResponse {
        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $validated = $request->validate([
            'status' => [
                'required',
                'in:baru,diproses,menunggu_pemohon,selesai,ditutup',
            ],

            'priority' => [
                'required',
                'in:normal,tinggi,mendesak',
            ],
        ], [
            'status.required' =>
                'Status tiket wajib dipilih.',

            'status.in' =>
                'Status tiket tidak valid.',

            'priority.required' =>
                'Prioritas tiket wajib dipilih.',

            'priority.in' =>
                'Prioritas tiket tidak valid.',
        ]);

        $ticket->update([
            'status' => $validated['status'],

            'priority' => $validated['priority'],

            'closed_at' => $validated['status'] === 'ditutup'
                ? now()
                : null,
        ]);

        return redirect()
            ->route(
                'helpdesk.admin.show',
                $ticket->ticket_number
            )
            ->with(
                'success',
                'Status dan prioritas tiket berhasil diperbarui.'
            );
    }
    /**
     * Method Download.
     */
    public function downloadAttachment(
        string $ticketNumber,
        int $attachment
    ) {
        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $file = HelpdeskAttachment::query()
            ->where('id', $attachment)
            ->where('ticket_id', $ticket->id)
            ->firstOrFail();

        $disk = Storage::disk('local');

        abort_unless(
            $disk->exists($file->file_path),
            404
        );

        return $disk->download(
            $file->file_path,
            $file->original_name
        );
    }


    /**
     * Mengubah pesan petugas.
     */
    public function updateMessage(
        Request $request,
        string $ticketNumber,
        int $message
    ): RedirectResponse {

        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $helpdeskMessage = HelpdeskMessage::query()
            ->where('id', $message)
            ->where('ticket_id', $ticket->id)
            ->firstOrFail();

        abort_unless(
            $helpdeskMessage->sender_type === 'staff',
            403,
            'Pesan pemohon tidak dapat dikelola oleh petugas.'
        );

        $validated = $request->validate([
            'message' => [
                'required',
                'string',
                'max:5000',
            ],
        ]);

        $helpdeskMessage->update([
            'message' => $validated['message'],
        ]);

        return redirect()
            ->route(
                'helpdesk.admin.show',
                $ticket->ticket_number
            )
            ->with(
                'success',
                'Pesan berhasil diperbarui.'
            );
    }


    /**
     * Menghapus pesan petugas.
     */
    public function deleteMessage(
        string $ticketNumber,
        int $message
    ): RedirectResponse {

        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();

        $helpdeskMessage = HelpdeskMessage::query()
            ->with('attachments')
            ->where('id', $message)
            ->where('ticket_id', $ticket->id)
            ->firstOrFail();


        abort_unless(
            $helpdeskMessage->sender_type === 'staff',
            403,
            'Pesan pemohon tidak dapat dikelola oleh petugas.'
        );
        

        $disk = Storage::disk('local');

        foreach ($helpdeskMessage->attachments as $attachment) {

            if ($disk->exists($attachment->file_path)) {
                $disk->delete($attachment->file_path);
            }
        }

        $helpdeskMessage->delete();

        $lastMessage = HelpdeskMessage::query()
            ->where('ticket_id', $ticket->id)
            ->latest('created_at')
            ->first();

        $ticket->update([
            'last_message_at' =>
                $lastMessage?->created_at ?? $ticket->created_at,
        ]);

        return redirect()
            ->route(
                'helpdesk.admin.show',
                $ticket->ticket_number
            )
            ->with(
                'success',
                'Pesan berhasil dihapus.'
            );
    }

}