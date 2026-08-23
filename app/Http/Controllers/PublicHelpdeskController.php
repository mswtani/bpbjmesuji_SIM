<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreHelpdeskTicketRequest;
use App\Http\Requests\StoreHelpdeskMessageRequest;
use Illuminate\Http\RedirectResponse;
use App\Models\HelpdeskAttachment;
use App\Models\HelpdeskCategory;
use App\Models\HelpdeskMessage;
use App\Models\HelpdeskTicket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PublicHelpdeskController extends Controller
{
    /**
     * Halaman utama Helpdesk.
     */
    public function index(): View
    {
        $categories = HelpdeskCategory::query()
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->get();

        return view('public.helpdesk.index', [
            'categories' => $categories,
        ]);
    }

    /**
     * Form pengajuan Helpdesk.
     */
    public function create(string $slug): View
    {
        $category = HelpdeskCategory::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        return view('public.helpdesk.create', [
            'category' => $category,
        ]);
    }


    /**
     * Menyimpan pengajuan Helpdesk sebagai tiket.
     */
    public function store(
        StoreHelpdeskTicketRequest $request,
        string $slug
    ): View {
        $category = HelpdeskCategory::query()
            ->where('is_active', true)
            ->where('slug', $slug)
            ->firstOrFail();

        $validated = $request->validated();

        /*
        |--------------------------------------------------------------------------
        | User login atau Guest
        |--------------------------------------------------------------------------
        */

        $user = $request->user();

        /*
        |--------------------------------------------------------------------------
        | Generate nomor tiket
        |--------------------------------------------------------------------------
        |
        | Contoh:
        |
        | HD-20260821-0001
        |
        */

        $ticketNumber = 'HD-'
            . now()->format('Ymd')
            . '-'
            . strtoupper(Str::random(6));

        /*
        |--------------------------------------------------------------------------
        | Access token Guest
        |--------------------------------------------------------------------------
        |
        | Token asli tidak disimpan ke database.
        | Yang disimpan hanya hash-nya.
        |
        */

        $accessToken = Str::random(64);

        $ticket = DB::transaction(function () use (
            $validated,
            $category,
            $user,
            $ticketNumber,
            $accessToken,
            $request,
        ) {

            /*
            |--------------------------------------------------------------------------
            | Ticket
            |--------------------------------------------------------------------------
            */

            $ticket = HelpdeskTicket::create([
                'user_id' => $user?->id,

                'category_id' => $category->id,

                'ticket_number' => $ticketNumber,

                'access_token_hash' => hash(
                    'sha256',
                    $accessToken
                ),

                'requester_name' =>
                    $validated['requester_name'],

                'requester_email' =>
                    $validated['requester_email'],

                'requester_phone' =>
                    $validated['requester_phone'] ?? null,

                'subject' =>
                    $validated['subject'],

                'status' => 'open',

                'priority' => 'normal',

                'last_message_at' => now(),
            ]);


            /*
            |--------------------------------------------------------------------------
            | Pesan pertama
            |--------------------------------------------------------------------------
            */

            $message = HelpdeskMessage::create([
                'ticket_id' => $ticket->id,

                'user_id' => $user?->id,

                'sender_type' => 'requester',

                'message' => $validated['message'],
            ]);


            /*
            |--------------------------------------------------------------------------
            | Lampiran
            |--------------------------------------------------------------------------
            */

            if ($request->hasFile('attachments')) {

                foreach ($request->file('attachments') as $file) {

                    $path = $file->store(
                        'helpdesk/' . $ticket->id,
                        'local'
                    );

                    HelpdeskAttachment::create([
                        'ticket_id' => $ticket->id,
                        'message_id' => $message->id,
                        'original_name' => $file->getClientOriginalName(),
                        'file_path' => $path,
                        'mime_type' => $file->getMimeType(),
                        'file_size' => $file->getSize(),
                        'uploaded_by_user_id' => $user?->id,
                    ]);
                }
            }


            return $ticket;
        });

       /*
        |--------------------------------------------------------------------------
        | URL Akses Tiket
        |--------------------------------------------------------------------------
        */

        $ticketUrl = route(
            'helpdesk.ticket',
            [
                'ticketNumber' => $ticket->ticket_number,
                'token' => $accessToken,
            ]
        );

        return view('public.helpdesk.success', [
            'category' => $category,
            'ticket' => $ticket,
            'ticketUrl' => $ticketUrl,
        ]);
    }


    /**
     * Menampilkan detail tiket Helpdesk.
     */
    public function showTicket(
        Request $request,
        string $ticketNumber
    ): View {
        $ticket = HelpdeskTicket::query()
            ->with([
                'category',
                'messages.attachments',
            ])
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | USER LOGIN
        |--------------------------------------------------------------------------
        */

        if ($request->user()) {

            abort_unless(
                $ticket->user_id === $request->user()->id,
                403
            );

        }


        /*
        |--------------------------------------------------------------------------
        | GUEST
        |--------------------------------------------------------------------------
        */

        else {

            $token = $request->query('token');

            abort_unless(
                $token,
                403
            );

            $tokenHash = hash(
                'sha256',
                $token
            );

            abort_unless(
                hash_equals(
                    $ticket->access_token_hash,
                    $tokenHash
                ),
                403
            );
        }


        return view('public.helpdesk.ticket', [
            'ticket' => $ticket,
        ]);
    }

    
    /**
     * Menyimpan pesan lanjutan pada tiket Helpdesk.
     */
    public function storeMessage(
        StoreHelpdeskMessageRequest $request,
        string $ticketNumber
    ): RedirectResponse {
        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | Authorization
        |--------------------------------------------------------------------------
        |
        | User login:
        | ticket harus milik user.
        |
        | Guest:
        | token harus benar.
        |
        */

        if ($request->user()) {

            abort_unless(
                $ticket->user_id === $request->user()->id,
                403
            );

        } else {

            $token = $request->query('token');

            abort_unless(
                $token,
                403
            );

            $tokenHash = hash(
                'sha256',
                $token
            );

            abort_unless(
                hash_equals(
                    $ticket->access_token_hash,
                    $tokenHash
                ),
                403
            );
        }


        /*
        |--------------------------------------------------------------------------
        | Jangan menerima pesan pada tiket yang sudah ditutup
        |--------------------------------------------------------------------------
        */

        abort_if(
            $ticket->status === 'closed',
            403,
            'Tiket sudah ditutup.'
        );


        /*
        |--------------------------------------------------------------------------
        | Simpan pesan
        |--------------------------------------------------------------------------
        */

        HelpdeskMessage::create([
            'ticket_id' => $ticket->id,

            'user_id' => $request->user()?->id,

            'sender_type' => 'requester',

            'message' => $request->validated('message'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Update aktivitas tiket
        |--------------------------------------------------------------------------
        */

        $ticket->update([
            'last_message_at' => now(),
        ]);


        return redirect()
            ->route(
                'helpdesk.ticket',
                [
                    'ticketNumber' => $ticket->ticket_number,

                    ...(
                        $request->user()
                            ? []
                            : [
                                'token' =>
                                    $request->query('token'),
                            ]
                    ),
                ]
            )
            ->with(
                'success',
                'Pesan berhasil dikirim.'
            );
    }


}