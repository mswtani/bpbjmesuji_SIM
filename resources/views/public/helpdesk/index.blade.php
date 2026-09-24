@extends('layouts.public')

@section('title', 'Helpdesk - BPBJ Kabupaten Mesuji')

@push('styles')
<style>
    /* =========================================================
       PUBLIC HELPDESK
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
       HELPDESK HEADER
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
       HELPDESK SERVICES
    ========================================================= */

    .public-helpdesk-services {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 45px;
    }

    .public-helpdesk-card {
        display: flex;
        flex-direction: column;
        min-height: 280px;
        padding: 25px;
        background-color: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        color: #333;
        text-decoration: none;
        transition:
            transform 0.3s ease,
            box-shadow 0.3s ease,
            border-color 0.3s ease;
    }

    .public-helpdesk-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        border-color: #cbd5e1;
        color: #0b2f64;
    }


    /* =========================================================
       HELPDESK ICON
    ========================================================= */

    .public-helpdesk-icon {
        display: flex;
        align-items: center;
        justify-content: center;
        align-self: center;

        width: 64px;
        height: 64px;
        margin-bottom: 20px;

        background-color: #0b2f64;
        color: #ffffff;

        border-radius: 14px;

        transition:
            background-color 0.3s ease,
            color 0.3s ease,
            transform 0.3s ease,
            box-shadow 0.3s ease;
    }

    .public-helpdesk-icon-gold {
        background-color: #d4af37;
    }

    .public-helpdesk-icon svg {
        width: 31px;
        height: 31px;
    }

    /* =========================================================
       HELPDESK CARD CONTENT
    ========================================================= */

    .public-helpdesk-card-title {
        margin: 0 0 8px;
        color: #0b2f64;
        font-size: 18px;
        font-weight: 600;
        line-height: 1.4;
    }

    .public-helpdesk-card-description {
        margin: 0;
        color: #475569;
        font-size: 14px;
        line-height: 1.6;
    }

    .public-helpdesk-card-action {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;

        margin-top: auto;
        padding-top: 20px;

        color: #174ea6;
        font-size: 14px;
        font-weight: 600;
    }

    .public-helpdesk-card-action-text {
        line-height: 1;
    }

    .public-helpdesk-card-action-arrow {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 42px;
        height: 42px;

        border-radius: 50%;

        background-color: #eef3f9;
        color: #174ea6;

        transition:
            background-color 0.3s ease,
            color 0.3s ease,
            transform 0.3s ease;
    }

    .public-helpdesk-card-action-arrow svg {
        width: 20px;
        height: 20px;
    }

    .public-helpdesk-card:hover .public-helpdesk-card-action {
        color: #0b2f64;
    }

    .public-helpdesk-card:hover .public-helpdesk-card-action-arrow {
        background-color: #174ea6;
        color: #ffffff;
        transform: translateX(3px);
    }


    /* =========================================================
       HOW TO USE
    ========================================================= */

    .public-helpdesk-guide {
        padding: 35px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .public-helpdesk-guide-title {
        margin: 0 0 25px;
        color: #0b2f64;
        font-size: 21px;
        font-weight: 700;
        text-align: center;
    }

    .public-helpdesk-guide-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }

    .public-helpdesk-guide-item {
        display: flex;
        align-items: flex-start;
        gap: 15px;
    }

    .public-helpdesk-guide-number {
        display: flex;
        align-items: center;
        justify-content: center;
        flex: 0 0 auto;
        width: 36px;
        height: 36px;
        background-color: #d4af37;
        color: #0b2f64;
        border-radius: 50%;
        font-size: 15px;
        font-weight: 700;
    }

    .public-helpdesk-guide-content {
        flex: 1;
    }

    .public-helpdesk-guide-content strong {
        display: block;
        margin-bottom: 5px;
        color: #0b2f64;
        font-size: 15px;
        font-weight: 600;
    }

    .public-helpdesk-guide-content p {
        margin: 0;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }


    /* =========================================================
       EMPTY STATE
    ========================================================= */

    .public-helpdesk-empty {
        grid-column: 1 / -1;
        padding: 35px 25px;
        background-color: #fffbeb;
        border: 1px solid #fde68a;
        border-radius: 8px;
        text-align: center;
    }

    .public-helpdesk-empty p {
        margin: 0;
        color: #92400e;
        font-size: 15px;
        font-weight: 600;
    }

    /* =========================================================
    LACAK TIKET
    ========================================================= */

    .public-helpdesk-lookup {
        margin-top: 20px;
        padding: 35px;
        background-color: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
    }

    .public-helpdesk-lookup-header {
        margin-bottom: 25px;
        text-align: center;
    }

    .public-helpdesk-lookup-title {
        margin: 0 0 8px;
        color: #0b2f64;
        font-size: 21px;
        font-weight: 700;
        line-height: 1.4;
    }

    .public-helpdesk-lookup-description {
        max-width: 700px;
        margin: 0 auto;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }

    .public-helpdesk-lookup-form {
        display: grid;
        grid-template-columns: 1fr 1fr auto;
        gap: 15px;
        align-items: end;
    }

    .public-helpdesk-lookup-field {
        display: flex;
        flex-direction: column;
    }

    .public-helpdesk-lookup-label {
        margin-bottom: 7px;
        color: #334155;
        font-size: 14px;
        font-weight: 600;
    }

    .public-helpdesk-lookup-input {
        width: 100%;
        min-height: 44px;
        padding: 10px 13px;
        background-color: #ffffff;
        border: 1px solid #cbd5e1;
        border-radius: 6px;
        color: #334155;
        font-family: inherit;
        font-size: 14px;
        box-sizing: border-box;
        outline: none;
        transition:
            border-color 0.2s ease,
            box-shadow 0.2s ease;
    }

    .public-helpdesk-lookup-input:focus {
        border-color: #174ea6;
        box-shadow: 0 0 0 3px rgba(23, 78, 166, 0.10);
    }

    .public-helpdesk-lookup-input::placeholder {
        color: #94a3b8;
    }

    .public-helpdesk-lookup-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 9px;
        min-height: 44px;
        padding: 10px 20px;
        border: 0;
        border-radius: 6px;
        background-color: #174ea6;
        color: #ffffff;
        font-family: inherit;
        font-size: 14px;
        font-weight: 600;
        cursor: pointer;
        transition:
            background-color 0.2s ease,
            transform 0.2s ease;
    }

    .public-helpdesk-lookup-button:hover {
        background-color: #0b2f64;
        transform: translateY(-1px);
    }

    .public-helpdesk-lookup-button svg {
        width: 18px;
        height: 18px;
    }

    .public-helpdesk-lookup-note {
        margin: 15px 0 0;
        color: #64748b;
        font-size: 13px;
        line-height: 1.6;
        text-align: center;
    }

    .public-helpdesk-lookup-error {
        margin: 18px 0 0;
        padding: 12px 15px;
        background-color: #fef2f2;
        border: 1px solid #fecaca;
        border-radius: 6px;
        color: #b91c1c;
        font-size: 14px;
        line-height: 1.5;
    }


    /* =========================================================
       RESPONSIVE
    ========================================================= */

    @media (max-width: 768px) {

        .public-helpdesk-page {
            padding: 35px 0 45px;
        }

        .public-helpdesk-container {
            width: 90%;
        }

        .public-helpdesk-header {
            margin-bottom: 30px;
        }

        .public-helpdesk-title {
            font-size: 28px;
        }

        .public-helpdesk-description {
            font-size: 15px;
            line-height: 1.6;
        }

        .public-helpdesk-services {
            grid-template-columns: 1fr;
            gap: 16px;
            margin-bottom: 35px;
        }

        .public-helpdesk-card {
            min-height: 0;
            padding: 22px;
        }

        .public-helpdesk-guide {
            padding: 25px 20px;
        }

        .public-helpdesk-guide-grid {
            grid-template-columns: 1fr;
            gap: 22px;
        }

        .public-helpdesk-guide-title {
            font-size: 19px;
            text-align: left;
        }

        /* =========================================================
        LACAK TIKET
        ========================================================= */
        .public-helpdesk-lookup {
            padding: 25px 20px;
        }

        .public-helpdesk-lookup-form {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .public-helpdesk-lookup-button {
            width: 100%;
        }

        .public-helpdesk-lookup-header {
            text-align: left;
        }

        .public-helpdesk-lookup-description {
            margin-left: 0;
        }

        .public-helpdesk-lookup-note {
            text-align: left;
        }
    }


    @media (max-width: 480px) {

        .public-helpdesk-page {
            padding: 30px 0 40px;
        }

        .public-helpdesk-container {
            width: 90%;
        }

        .public-helpdesk-badge {
            padding: 6px 14px;
            font-size: 12px;
        }

        .public-helpdesk-title {
            margin-top: 13px;
            font-size: 24px;
        }

        .public-helpdesk-description {
            font-size: 14px;
        }

        .public-helpdesk-card {
            padding: 20px;
        }

        .public-helpdesk-card-title {
            font-size: 17px;
        }

        .public-helpdesk-card-description,
        .public-helpdesk-card-action {
            font-size: 13px;
        }

        .public-helpdesk-guide {
            padding: 22px 18px;
        }

        .public-helpdesk-guide-title {
            font-size: 18px;
        }

        .public-helpdesk-guide-number {
            width: 34px;
            height: 34px;
            font-size: 14px;
        }

        .public-helpdesk-guide-content strong {
            font-size: 14px;
        }

        .public-helpdesk-guide-content p {
            font-size: 13px;
        }

        /* =========================================================
        LACAK TIKET
        ========================================================= */
        .public-helpdesk-lookup {
            padding: 22px 18px;
        }

        .public-helpdesk-lookup-title {
            font-size: 18px;
        }

        .public-helpdesk-lookup-description {
            font-size: 13px;
        }

        .public-helpdesk-lookup-input,
        .public-helpdesk-lookup-button {
            min-height: 42px;
            font-size: 13px;
        }

        .public-helpdesk-lookup-label {
            font-size: 13px;
        }
    }


    @media (max-width: 360px) {

        .public-helpdesk-title {
            font-size: 22px;
        }

        .public-helpdesk-description {
            font-size: 13px;
        }

        .public-helpdesk-card {
            padding: 18px;
        }
    }

    /* =========================================================
   LACAK TIKET
========================================================= */

.public-helpdesk-lookup {
    margin-top: 20px;
    padding: 35px;
    background-color: #ffffff;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
}

.public-helpdesk-lookup-header {
    margin-bottom: 25px;
    text-align: center;
}

.public-helpdesk-lookup-title {
    margin: 0 0 8px;
    color: #0b2f64;
    font-size: 21px;
    font-weight: 700;
    line-height: 1.4;
}

.public-helpdesk-lookup-description {
    max-width: 700px;
    margin: 0 auto;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
}

.public-helpdesk-lookup-content {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    gap: 18px;
    max-width: 760px;
    margin: 0 auto;
    padding: 20px;
    background-color: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 8px;
}

.public-helpdesk-lookup-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    flex: 0 0 auto;
    width: 52px;
    height: 52px;
    background-color: #174ea6;
    color: #ffffff;
    border-radius: 12px;
}

.public-helpdesk-lookup-icon svg {
    width: 25px;
    height: 25px;
}

.public-helpdesk-lookup-text {
    flex: 1;
}

.public-helpdesk-lookup-text strong {
    display: block;
    margin-bottom: 5px;
    color: #0b2f64;
    font-size: 15px;
    font-weight: 600;
}

.public-helpdesk-lookup-text p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
    line-height: 1.6;
}

.public-helpdesk-lookup-note {
    margin: 18px 0 0;
    color: #64748b;
    font-size: 13px;
    line-height: 1.6;
    text-align: center;
}

@media (max-width: 768px) {

    .public-helpdesk-lookup {
        padding: 25px 20px;
    }

    .public-helpdesk-lookup-header {
        text-align: left;
    }

    .public-helpdesk-lookup-description {
        margin-left: 0;
    }

    .public-helpdesk-lookup-content {
        justify-content: flex-start;
    }

    .public-helpdesk-lookup-note {
        text-align: left;
    }
}

@media (max-width: 480px) {

    .public-helpdesk-lookup {
        padding: 22px 18px;
    }

    .public-helpdesk-lookup-title {
        font-size: 18px;
    }

    .public-helpdesk-lookup-description,
    .public-helpdesk-lookup-text p {
        font-size: 13px;
    }

    .public-helpdesk-lookup-content {
        gap: 14px;
        padding: 16px;
    }

    .public-helpdesk-lookup-icon {
        width: 46px;
        height: 46px;
    }

    .public-helpdesk-lookup-icon svg {
        width: 22px;
        height: 22px;
    }
}
</style>
@endpush


@section('content')

<section class="public-helpdesk-page">

    <div class="public-helpdesk-container">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="public-helpdesk-header">

            <h1 class="public-helpdesk-title">
                Helpdesk
            </h1>

            <p class="public-helpdesk-subtitle">
                Layanan Bantuan dan Konsultasi
            </p>

        </div>


        {{-- =====================================================
             PILIHAN LAYANAN
        ====================================================== --}}

        <div class="public-helpdesk-services">

            @forelse ($categories as $category)

                <a
                    href="{{ route('helpdesk.create', $category->slug) }}"
                    class="public-helpdesk-card"
                >

                    @if ($category->slug === 'aduan')

                        {{-- Headset / Help --}}
                        <div class="public-helpdesk-icon">
                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M4 14v-2a8 8 0 0 1 16 0v2" />
                                <path d="M4 14a2 2 0 0 0 2 2h1v-6H6a2 2 0 0 0-2 2v2Z" />
                                <path d="M20 14a2 2 0 0 1-2 2h-1v-6h1a2 2 0 0 1 2 2v2Z" />
                                <path d="M15 18h-3" />
                                <path d="M15 16v2a2 2 0 0 1-2 2h-1" />
                            </svg>
                        </div>

                    @elseif ($category->slug === 'kritik')

                        {{-- Chat --}}
                        <div class="public-helpdesk-icon public-helpdesk-icon-gold">
                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M20 11.5a7 7 0 0 1-7 7H8l-4 2v-4.5a7 7 0 1 1 16-4.5Z" />
                                <path d="M8 12h.01" />
                                <path d="M12 12h.01" />
                                <path d="M16 12h.01" />
                            </svg>
                        </div>

                    @elseif ($category->slug === 'saran')

                        {{-- Suggestion / Document --}}
                        <div class="public-helpdesk-icon">
                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M6 3h8l4 4v14H6z" />
                                <path d="M14 3v5h5" />
                                <path d="M9 12h6" />
                                <path d="M9 16h6" />
                            </svg>
                        </div>

                    @else

                        {{-- Consultation / People --}}
                        <div class="public-helpdesk-icon public-helpdesk-icon-gold">
                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <circle cx="9" cy="8" r="3" />
                                <path d="M3.5 19a5.5 5.5 0 0 1 11 0" />
                                <circle cx="17" cy="9" r="2.5" />
                                <path d="M15 14.5a4.5 4.5 0 0 1 5.5 4.5" />
                            </svg>
                        </div>

                    @endif


                    <h2 class="public-helpdesk-card-title">
                        {{ $category->name }}
                    </h2>


                    @if ($category->description)

                        <p class="public-helpdesk-card-description">
                            {{ $category->description }}
                        </p>

                    @endif


                    <div class="public-helpdesk-card-action">
                        <span class="public-helpdesk-card-action-text">
                            Ajukan
                        </span>
                        <span class="public-helpdesk-card-action-arrow">
                            <svg
                                viewBox="0 0 24 24"
                                aria-hidden="true"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            >
                                <path d="M9 18l6-6-6-6" />
                            </svg>
                        </span>

                    </div>

                </a>

            @empty

                <div class="public-helpdesk-empty">

                    <p>
                        Layanan Helpdesk belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- =====================================================
             INFORMASI CARA MENGGUNAKAN HELPDESK
        ====================================================== --}}

        <div class="public-helpdesk-guide">

            <h2 class="public-helpdesk-guide-title">
                Bagaimana cara menggunakan Helpdesk?
            </h2>


            <div class="public-helpdesk-guide-grid">

                <div class="public-helpdesk-guide-item">

                    <span class="public-helpdesk-guide-number">
                        1
                    </span>

                    <div class="public-helpdesk-guide-content">

                        <strong>
                            Pilih layanan
                        </strong>

                        <p>
                            Pilih jenis bantuan yang sesuai dengan kebutuhan Anda.
                        </p>

                    </div>

                </div>


                <div class="public-helpdesk-guide-item">

                    <span class="public-helpdesk-guide-number">
                        2
                    </span>

                    <div class="public-helpdesk-guide-content">

                        <strong>
                            Sampaikan kebutuhan
                        </strong>

                        <p>
                            Isi formulir dan jelaskan permasalahan atau konsultasi Anda.
                        </p>

                    </div>

                </div>


                <div class="public-helpdesk-guide-item">

                    <span class="public-helpdesk-guide-number">
                        3
                    </span>

                    <div class="public-helpdesk-guide-content">

                        <strong>
                            Pantau tanggapan
                        </strong>

                        <p>
                            Tanggapan petugas akan dikirim melalui email.
                            Anda dapat membuka kembali tiket melalui tautan yang diberikan
                            dalam email tersebut untuk melihat riwayat percakapan dan membalas.
                        </p>

                    </div>

                </div>

            </div>

        </div>

        {{-- =====================================================
            LACAK TIKET
        ====================================================== --}}

        <div class="public-helpdesk-lookup">

            {{-- =====================================================
                LACAK TIKET
            ====================================================== --}}

            <div class="public-helpdesk-lookup">

                <div class="public-helpdesk-lookup-header">

                    <h2 class="public-helpdesk-lookup-title">
                        Akses Tiket Anda
                    </h2>

                    <p class="public-helpdesk-lookup-description">
                        @auth
                            Buka kembali riwayat tiket Anda.
                        @else
                            Tautan akses tiket dikirim ke email yang Anda gunakan saat mengajukan layanan Helpdesk.
                        @endauth
                    </p>

                </div>

                <a
                    href="{{ auth()->check()
                        ? route('helpdesk.my-tickets')
                        : route('helpdesk.ticket.access') }}"
                    class="group mx-auto block w-full max-w-2xl rounded-xl border border-gray-200 bg-white px-6 py-5 shadow-sm transition duration-200 hover:-translate-y-0.5 hover:border-blue-200 hover:shadow-md sm:px-7"
                >
                    <div class="flex items-start gap-4">

                        {{-- Icon --}}
                        <div
                            class="flex h-11 w-11 shrink-0 items-center justify-center rounded-lg bg-blue-600 text-white transition group-hover:bg-[#0b2f64]"
                        >
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="h-5 w-5"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 6.5A2.5 2.5 0 016.5 4h11A2.5 2.5 0 0120 6.5v11a2.5 2.5 0 01-2.5 2.5h-11A2.5 2.5 0 014 17.5v-11z"
                                />
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M7 8l5 4 5-4"
                                />
                            </svg>
                        </div>

                        {{-- Content --}}
                        <div class="min-w-0 flex-1">

                            <div class="flex items-center justify-between gap-3">

                                <h2 class="text-base font-semibold text-[#0b2f64]">
                                    Akses Tiket Anda
                                </h2>

                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-5 w-5 shrink-0 text-gray-400 transition duration-200 group-hover:translate-x-1 group-hover:text-blue-600"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M9 5l7 7-7 7"
                                    />
                                </svg>

                            </div>

                            <p class="mt-1 text-sm leading-6 text-gray-600">
                                @auth
                                    Buka kembali riwayat tiket Anda.
                                @else
                                    Buka kembali riwayat tiket melalui tautan akses yang
                                    dikirim ke email Anda.
                                @endauth
                            </p>

                            {{-- Action --}}
                            <div class="mt-3 text-center sm:text-left sm:pl-8">

                                <span
                                    class="inline-flex items-center text-xs font-semibold text-blue-600 transition group-hover:text-[#0b2f64]"
                                >

                                    @auth
                                        Buka riwayat tiket
                                    @else
                                        Buka akses tiket
                                    @endauth

                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="ml-1 h-3.5 w-3.5 transition-transform group-hover:translate-x-0.5"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                </span>

                            </div>

                        </div>

                    </div>
                </a>

                @guest
                    <div class="public-helpdesk-lookup-note">
                        Jika session akses Anda telah berakhir, gunakan kembali tautan tiket dari email untuk mendapatkan akses.
                    </div>
                @endguest

            </div>

        </div>


    </div>

</section>
    
@endsection