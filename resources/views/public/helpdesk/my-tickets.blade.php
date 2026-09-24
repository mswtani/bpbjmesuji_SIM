@extends('layouts.public')

@section('title', 'Tiket Saya - Helpdesk BPBJ Kabupaten Mesuji')

@push('styles')
<style>
    /* =========================================================
       PUBLIC HELPDESK - MY TICKETS
    ========================================================= */

    .public-helpdesk-page {
        background-color: #f4f6f9;
        padding: 50px 0 60px;
    }

    .public-helpdesk-container {
        width: 90%;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* =========================================================
       HEADER
    ========================================================= */

    .public-helpdesk-header {
        padding: 44px 0 26px;
    }

    .public-helpdesk-title {
        max-width: 100%;
        margin: 0 0 7px;
        padding-left: 10px;
        border-left: 5px solid #d4af37;
        box-sizing: border-box;
        color: #0b2f64;
        font-size: 28px;
        font-weight: 500;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }

    .public-helpdesk-subtitle {
        margin: 0;
        padding-left: 15px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }

    /* =========================================================
       TICKET LIST
    ========================================================= */

    .public-helpdesk-tickets {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }

    .public-helpdesk-ticket {
        display: block;
        padding: 22px 24px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        color: inherit;
        text-decoration: none;
        transition:
            transform 0.2s ease,
            box-shadow 0.2s ease,
            border-color 0.2s ease;
    }

    .public-helpdesk-ticket:hover {
        transform: translateY(-2px);
        border-color: #cbd5e1;
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
    }

    .public-helpdesk-ticket-top {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        gap: 20px;
        margin-bottom: 12px;
    }

    .public-helpdesk-ticket-number {
        margin: 0 0 5px;
        color: #0b2f64;
        font-size: 16px;
        font-weight: 700;
    }

    .public-helpdesk-ticket-subject {
        margin: 0;
        color: #334155;
        font-size: 15px;
        font-weight: 600;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }

    .public-helpdesk-ticket-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 8px;
        margin-top: 14px;
    }

    .public-helpdesk-badge {
        display: inline-flex;
        align-items: center;
        min-height: 28px;
        padding: 4px 10px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.2;
    }

    .public-helpdesk-badge-category {
        background-color: #eef3f9;
        color: #174ea6;
    }

    .public-helpdesk-badge-status {
        background-color: #f1f5f9;
        color: #475569;
    }

    .public-helpdesk-badge-status-baru {
        background-color: #eff6ff;
        color: #1d4ed8;
    }

    .public-helpdesk-badge-status-diproses {
        background-color: #fff7ed;
        color: #c2410c;
    }

    .public-helpdesk-badge-status-menunggu {
        background-color: #fefce8;
        color: #a16207;
    }

    .public-helpdesk-badge-status-selesai {
        background-color: #f0fdf4;
        color: #15803d;
    }

    .public-helpdesk-badge-status-ditutup {
        background-color: #f1f5f9;
        color: #475569;
    }

    .public-helpdesk-ticket-bottom {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 15px;
        margin-top: 17px;
        padding-top: 14px;
        border-top: 1px solid #f1f5f9;
    }

    .public-helpdesk-ticket-date {
        color: #64748b;
        font-size: 13px;
        line-height: 1.5;
    }

    .public-helpdesk-ticket-action {
        display: inline-flex;
        align-items: center;
        gap: 7px;
        color: #174ea6;
        font-size: 13px;
        font-weight: 600;
        white-space: nowrap;
    }

    .public-helpdesk-ticket-action svg {
        width: 17px;
        height: 17px;
        transition: transform 0.2s ease;
    }

    .public-helpdesk-ticket:hover .public-helpdesk-ticket-action svg {
        transform: translateX(3px);
    }

    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .public-helpdesk-empty {
        padding: 55px 30px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-align: center;
    }

    .public-helpdesk-empty-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 64px;
        height: 64px;
        margin: 0 auto 18px;
        background-color: #eef3f9;
        color: #174ea6;
        border-radius: 14px;
    }

    .public-helpdesk-empty-icon svg {
        width: 31px;
        height: 31px;
    }

    .public-helpdesk-empty-title {
        margin: 0 0 7px;
        color: #0b2f64;
        font-size: 18px;
        font-weight: 600;
    }

    .public-helpdesk-empty-text {
        max-width: 520px;
        margin: 0 auto;
        color: #64748b;
        font-size: 14px;
        line-height: 1.7;
    }

    .public-helpdesk-empty-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 22px;
        padding: 11px 18px;
        background-color: #0b2f64;
        border-radius: 6px;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: background-color 0.2s ease;
    }

    .public-helpdesk-empty-action:hover {
        background-color: #174ea6;
        color: #ffffff;
    }

    /* =========================================================
       PAGINATION
    ========================================================= */

    .public-helpdesk-pagination {
        margin-top: 25px;
    }

    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 640px) {
        .public-helpdesk-page {
            padding: 30px 0 45px;
        }

        .public-helpdesk-header {
            padding: 30px 0 20px;
        }

        .public-helpdesk-title {
            font-size: 23px;
        }

        .public-helpdesk-ticket {
            padding: 18px;
        }

        .public-helpdesk-ticket-top {
            flex-direction: column;
            gap: 8px;
        }

        .public-helpdesk-ticket-bottom {
            align-items: flex-start;
            flex-direction: column;
        }

        .public-helpdesk-ticket-action {
            align-self: flex-start;
        }
    }
</style>
@endpush

@section('content')

<div class="public-helpdesk-page">

    <div class="public-helpdesk-container">

        {{-- Header --}}
        <div class="public-helpdesk-header">
            <h1 class="public-helpdesk-title">
                Tiket Saya
            </h1>

            <p class="public-helpdesk-subtitle">
                Daftar pengajuan Helpdesk yang Anda buat melalui akun ini.
            </p>
        </div>

        {{-- Success message --}}
        @if (session('success'))
            <div
                style="
                    margin-bottom: 20px;
                    padding: 14px 16px;
                    background-color: #f0fdf4;
                    border: 1px solid #bbf7d0;
                    border-radius: 8px;
                    color: #166534;
                    font-size: 14px;
                    line-height: 1.6;
                "
            >
                {{ session('success') }}
            </div>
        @endif

        {{-- Ticket list --}}
        @if ($tickets->count())

            <div class="public-helpdesk-tickets">

                @foreach ($tickets as $ticket)

                    @php
                        $statusClass = match ($ticket->status) {
                            'baru' => 'public-helpdesk-badge-status-baru',
                            'diproses' => 'public-helpdesk-badge-status-diproses',
                            'menunggu_pemohon' => 'public-helpdesk-badge-status-menunggu',
                            'selesai' => 'public-helpdesk-badge-status-selesai',
                            'ditutup' => 'public-helpdesk-badge-status-ditutup',
                            default => 'public-helpdesk-badge-status',
                        };

                        $statusLabel = match ($ticket->status) {
                            'baru' => 'Baru',
                            'diproses' => 'Diproses',
                            'menunggu_pemohon' => 'Menunggu Pemohon',
                            'selesai' => 'Selesai',
                            'ditutup' => 'Ditutup',
                            default => ucfirst(str_replace('_', ' ', $ticket->status)),
                        };
                    @endphp

                    <a
                        href="{{ route('helpdesk.ticket', $ticket->ticket_number) }}"
                        class="public-helpdesk-ticket"
                    >

                        <div class="public-helpdesk-ticket-top">

                            <div>
                                <p class="public-helpdesk-ticket-number">
                                    {{ $ticket->ticket_number }}
                                </p>

                                <p class="public-helpdesk-ticket-subject">
                                    {{ $ticket->subject }}
                                </p>
                            </div>

                        </div>

                        <div class="public-helpdesk-ticket-meta">

                            @if ($ticket->category)
                                <span class="public-helpdesk-badge public-helpdesk-badge-category">
                                    {{ $ticket->category->name }}
                                </span>
                            @endif

                            <span class="public-helpdesk-badge public-helpdesk-badge-status {{ $statusClass }}">
                                {{ $statusLabel }}
                            </span>

                            @if ($ticket->position)
                                <span class="public-helpdesk-badge public-helpdesk-badge-category">
                                    {{ $ticket->position->code === 'NON_PENYEDIA'
                                        ? 'Non Penyedia Lainnya'
                                        : $ticket->position->name }}
                                </span>
                            @endif

                        </div>

                        <div class="public-helpdesk-ticket-bottom">

                            <span class="public-helpdesk-ticket-date">
                                Aktivitas terakhir:
                                {{ optional($ticket->last_message_at ?? $ticket->created_at)->translatedFormat('d F Y, H:i') }}
                            </span>

                            <span class="public-helpdesk-ticket-action">
                                Lihat Tiket

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M5 12h14"
                                        stroke-linecap="round"
                                    />
                                    <path
                                        d="m13 6 6 6-6 6"
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                    />
                                </svg>
                            </span>

                        </div>

                    </a>

                @endforeach

            </div>

            @if ($tickets->hasPages())
                <div class="public-helpdesk-pagination">
                    {{ $tickets->links() }}
                </div>
            @endif

        @else

            <div class="public-helpdesk-empty">

                <div class="public-helpdesk-empty-icon">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <path
                            d="M7 3h10a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2Z"
                        />
                        <path
                            d="M8 8h8M8 12h8M8 16h5"
                            stroke-linecap="round"
                        />
                    </svg>

                </div>

                <h2 class="public-helpdesk-empty-title">
                    Belum Ada Tiket
                </h2>

                <p class="public-helpdesk-empty-text">
                    Anda belum memiliki tiket Helpdesk dari akun ini.
                    Jika ingin menyampaikan aduan, kritik, saran, atau
                    konsultasi pengadaan, silakan membuat tiket baru.
                </p>

                <a
                    href="{{ route('helpdesk.index') }}"
                    class="public-helpdesk-empty-action"
                >
                    Buat Tiket Helpdesk
                </a>

            </div>

        @endif

    </div>

</div>

@endsection