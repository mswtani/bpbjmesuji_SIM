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
use App\Http\Requests\ResendHelpdeskAccessRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\HelpdeskAccessLinkMail;
use App\Models\Position;

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
     * Daftar tiket milik user yang sedang login.
     */
    public function myTickets(Request $request): View
    {
        $tickets = HelpdeskTicket::query()
            ->with([
                'category',
                'position',
            ])
            ->where('user_id', $request->user()->id)
            ->latest('last_message_at')
            ->latest('created_at')
            ->paginate(10)
            ->withQueryString();

        return view('public.helpdesk.my-tickets', [
            'tickets' => $tickets,
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

        $positions = collect();

        if ($category->slug === 'konsultasi-pengadaan') {
            $positions = Position::query()
                ->whereIn('code', [
                    'PENYEDIA',
                    'NON_PENYEDIA',
                    'PA',
                    'PPK',
                    'POKJA',
                    'PP',
                ])
                ->orderBy('id')
                ->get();
        }

        return view('public.helpdesk.create', [
            'category' => $category,
            'positions' => $positions,
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

        $allowedPositionCodes = [
            'PENYEDIA',
            'NON_PENYEDIA',
            'PA',
            'PPK',
            'POKJA',
            'PP',
        ];

        if ($category->slug === 'konsultasi-pengadaan') {
            $positionValidated = $request->validate([
                'position_id' => [
                    'required',
                    'integer',
                    'exists:positions,id',
                ],
            ], [
                'position_id.required' =>
                    'Peran pemohon wajib dipilih.',
                'position_id.exists' =>
                    'Peran pemohon tidak valid.',
            ]);

            $position = Position::query()
                ->whereIn('code', $allowedPositionCodes)
                ->whereKey($positionValidated['position_id'])
                ->first();

            abort_unless(
                $position !== null,
                422,
                'Peran pemohon tidak valid untuk Konsultasi Pengadaan.'
            );

            $validated['position_id'] = $position->id;
        } else {
            $validated['position_id'] = null;
        }

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

                'position_id' => $validated['position_id'],

                'ticket_number' => $ticketNumber,

                'access_token_hash' => hash('sha256', $accessToken),

                'access_token' => $accessToken,

                'requester_name' =>
                    $validated['requester_name'],

                'requester_email' =>
                    $validated['requester_email'],

                'requester_phone' =>
                    $validated['requester_phone'] ?? null,

                'subject' =>
                    $validated['subject'],

                'status' => 'baru',

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
     * Meminta pengiriman ulang tautan akses tiket guest.
     */
    public function resendTicketAccess(
        ResendHelpdeskAccessRequest $request
    ): RedirectResponse {
        \Log::info('Helpdesk resend access: controller reached', [
            'ticket_number' => $request->validated('ticket_number'),
            'email' => $request->validated('email'),
        ]);
        $ticketNumber = strtoupper(
            trim($request->validated('ticket_number'))
        );

        $email = strtolower(
            trim($request->validated('email'))
        );

        $ticket = HelpdeskTicket::query()
            ->where('ticket_number', $ticketNumber)
            ->where('requester_email', $email)
            ->whereNull('user_id')
            ->first();

        \Log::info('Helpdesk resend access: ticket lookup', [
            'ticket_number' => $ticketNumber,
            'found' => $ticket !== null,
        ]);

        /*
        |--------------------------------------------------------------------------
        | Jangan membocorkan apakah tiket/email ditemukan
        |--------------------------------------------------------------------------
        */
        if (! $ticket) {
            return back()->with(
                'success',
                'Jika data tiket sesuai, tautan akses akan dikirim ke email Anda.'
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Generate token baru
        |--------------------------------------------------------------------------
        */
        $accessToken = Str::random(64);

        /*
        |--------------------------------------------------------------------------
        | URL akses
        |--------------------------------------------------------------------------
        */
        $ticketUrl = route(
            'helpdesk.ticket',
            [
                'ticketNumber' => $ticket->ticket_number,
                'token' => $accessToken,
            ]
        );

        try {
                $ticket->forceFill([
                    'access_token_hash' => hash(
                        'sha256',
                        $accessToken
                    ),
                    'access_token' => $accessToken,
                ])->save();

                \Log::info('Helpdesk resend access: token saved');

                Mail::to($ticket->requester_email)
                    ->send(
                        new HelpdeskAccessLinkMail(
                            $ticket,
                            $ticketUrl
                        )
                    );

                \Log::info('Helpdesk resend access: mail sent');

            } catch (\Throwable $e) {
                \Log::error('Helpdesk resend access: mail failed', [
                    'class' => get_class($e),
                    'message' => $e->getMessage(),
                    'file' => $e->getFile(),
                    'line' => $e->getLine(),
                ]);

                report($e);

                return back()
                    ->with(
                        'mail_error',
                        'Tautan akses belum berhasil dikirim. Silakan coba kembali beberapa saat lagi.'
                    );
            }

        /*
        |--------------------------------------------------------------------------
        | Berhasil
        |--------------------------------------------------------------------------
        */
        return back()
            ->with(
                'mail_success',
                'Tautan akses berhasil dikirim. Silakan periksa inbox atau folder spam/junk email Anda.'
            );
    }
    /**
     * Menampilkan halaman untuk meminta kembali akses tiket guest.
     */
    public function ticketAccess(): View
    {
        return view('public.helpdesk.access');
    }

    /**
     * Menampilkan detail dan riwayat tiket Helpdesk.
     */
    public function showTicket(
        Request $request,
        string $ticketNumber
    ): View|RedirectResponse {
        $ticket = HelpdeskTicket::query()
            ->with([
                'category',
                'messages.attachments',
            ])
            ->where('ticket_number', $ticketNumber)
            ->firstOrFail();


        /*
        |--------------------------------------------------------------------------
        | AUTHORIZATION
        |--------------------------------------------------------------------------
        */

        if ($request->user()) {

            /*
            |--------------------------------------------------------------------------
            | User login
            |--------------------------------------------------------------------------
            */

            abort_unless(
                $ticket->user_id === $request->user()->id,
                403
            );

        } else {

            /*
            |--------------------------------------------------------------------------
            | Guest
            |--------------------------------------------------------------------------
            */

            $sessionAccess = $request->session()->get(
                'helpdesk_guest_ticket_access'
            );

            $sessionAuthorized =
                is_array($sessionAccess)
                && ($sessionAccess['ticket_id'] ?? null) === $ticket->id
                && now()->timestamp <= ($sessionAccess['expires_at'] ?? 0);


            /*
            |--------------------------------------------------------------------------
            | Jika session guest sudah valid
            |--------------------------------------------------------------------------
            */

            if (! $sessionAuthorized) {

            /*
            |--------------------------------------------------------------------------
            | Token tidak diberikan
            |--------------------------------------------------------------------------
            |
            | Session guest sudah berakhir dan URL tidak membawa token.
            | Tampilkan halaman pemulihan akses agar guest dapat meminta
            | tautan akses baru melalui email.
            |
            */
                $token = $request->query('token');

                if (! $token) {
                    return view(
                        'public.helpdesk.access-expired',
                        [
                            'ticket' => $ticket,
                        ]
                    );
                }

                /*
                |--------------------------------------------------------------------------
                | Validasi token dari link email
                |--------------------------------------------------------------------------
                */

                $tokenHash = hash(
                    'sha256',
                    $token
                );

                $tokenAuthorized = hash_equals(
                    (string) $ticket->access_token_hash,
                    $tokenHash
                );

                /*
                |--------------------------------------------------------------------------
                | Token tidak valid
                |--------------------------------------------------------------------------
                */

                abort_unless(
                    $tokenAuthorized,
                    403
                );

                /*
                |--------------------------------------------------------------------------
                | Simpan akses guest ke session
                |--------------------------------------------------------------------------
                */

                $request->session()->put(
                    'helpdesk_guest_ticket_access',
                    [
                        'ticket_id' => $ticket->id,
                        'expires_at' => now()
                            ->addHours(2)
                            ->timestamp,
                    ]
                );

                /*
                |--------------------------------------------------------------------------
                | Redirect agar token hilang dari URL
                |--------------------------------------------------------------------------
                */

                return redirect()->route(
                    'helpdesk.ticket',
                    $ticket->ticket_number
                );
            }
        }


        /*
        |--------------------------------------------------------------------------
        | Tampilkan tiket
        |--------------------------------------------------------------------------
        */

        return view(
            'public.helpdesk.ticket',
            [
                'ticket' => $ticket,
            ]
        );
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

            $sessionAccess = $request->session()->get(
                'helpdesk_guest_ticket_access'
            );

            $sessionAuthorized =
                is_array($sessionAccess)
                && ($sessionAccess['ticket_id'] ?? null) === $ticket->id
                && now()->timestamp <= ($sessionAccess['expires_at'] ?? 0);

            abort_unless(
                $sessionAuthorized,
                403
            );
        }

        /*
        |--------------------------------------------------------------------------
        | Kategori yang mendukung percakapan dua arah
        |--------------------------------------------------------------------------
        */

        abort_unless(
            in_array(
                $ticket->category->slug,
                ['aduan', 'konsultasi-pengadaan'],
                true
            ),
            403,
            'Kategori tiket ini tidak menerima balasan dari pemohon.'
        );


        /*
        |--------------------------------------------------------------------------
        | Jangan menerima pesan pada tiket yang sudah ditutup
        |--------------------------------------------------------------------------
        */

        abort_unless(
            in_array(
                $ticket->status,
                ['baru', 'menunggu_pemohon'],
                true
            ),
            403,
            'Pesan baru tidak dapat dikirim pada status tiket saat ini.'
        );



        /*
        |--------------------------------------------------------------------------
        | Simpan pesan dan lampiran
        |--------------------------------------------------------------------------
        */

        $storedPaths = [];

        try {

            $message = DB::transaction(function () use (
                $request,
                $ticket,
                &$storedPaths
            ) {

                /*
                |--------------------------------------------------------------------------
                | Simpan pesan
                |--------------------------------------------------------------------------
                */

                $message = HelpdeskMessage::create([
                    'ticket_id' => $ticket->id,

                    'user_id' => $request->user()?->id,

                    'sender_type' => 'requester',

                    'message' => $request->validated('message'),
                ]);


                /*
                |--------------------------------------------------------------------------
                | Simpan lampiran
                |--------------------------------------------------------------------------
                */

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

                            'original_name' =>
                                $file->getClientOriginalName(),

                            'file_path' => $path,

                            'mime_type' => $file->getMimeType(),

                            'file_size' => $file->getSize(),

                            'uploaded_by_user_id' =>
                                $request->user()?->id,
                        ]);
                    }
                }


                /*
                |--------------------------------------------------------------------------
                | Update aktivitas tiket
                |--------------------------------------------------------------------------
                */

                $ticket->update([
                    'last_message_at' => $message->created_at,
                ]);


                return $message;
            });

        } catch (\Throwable $e) {

            /*
            |--------------------------------------------------------------------------
            | Bersihkan file jika transaksi gagal
            |--------------------------------------------------------------------------
            */

            foreach ($storedPaths as $path) {

                Storage::disk('local')->delete($path);
            }

            throw $e;
        }


        return redirect()
        ->route(
            'helpdesk.ticket',
            [
                'ticketNumber' => $ticket->ticket_number,
            ]
        )
        ->with(
            'success',
            'Pesan berhasil dikirim.'
        );
    }


    public function viewAttachment(
        Request $request,
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

        if ($request->user()) {
            abort_unless(
                $ticket->user_id === $request->user()->id,
                403
            );
        } else {
            $sessionAccess = $request->session()->get(
                'helpdesk_guest_ticket_access'
            );

            $sessionAuthorized =
                is_array($sessionAccess)
                && ($sessionAccess['ticket_id'] ?? null) === $ticket->id
                && now()->timestamp <= ($sessionAccess['expires_at'] ?? 0);

            abort_unless($sessionAuthorized, 403);
        }

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


}