@extends('layouts.public')

@section('title', 'Kontak - BPBJ Kabupaten Mesuji')

@push('styles')
    <style>

        /* =========================================================
        PUBLIC CONTACT
        ========================================================= */

        .public-contact {
            background: #f8fafc;
            color: #334155;
        }

        /* =========================================================
        CONTAINER
        ========================================================= */

        .public-contact-container {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
        }

        /* =========================================================
        HEADER
        ========================================================= */

        .public-contact-header {
            padding: 44px 0 26px;
        }

        .public-contact-title {
            max-width: 100%;
            margin: 0 0 10px;
            padding-left: 10px;

            border-left: 5px solid #d4af37;

            box-sizing: border-box;

            color: #0b2f64;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.3;

            overflow-wrap: anywhere;
        }

        .public-contact-description {
            max-width: 760px;
            margin: 0;
            padding-left: 15px;

            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        /* =========================================================
        CONTACT SECTION
        ========================================================= */

        .public-contact-section {
            padding: 10px 0 48px;
        }

        .public-contact-grid {
            display: grid;

            grid-template-columns: repeat(2, minmax(0, 1fr));

            gap: 22px;
        }

        /* =========================================================
        CARD
        ========================================================= */

        .public-contact-card {
            min-width: 0;

            padding: 26px;

            border: 1px solid #dce3ec;
            border-radius: 10px;

            background: #ffffff;

            box-shadow: 0 4px 14px rgb(15 23 42 / 4%);
        }

        .public-contact-card > h2 {
            margin: 0 0 24px;

            color: #0b2f64;
            font-size: 19px;
            font-weight: 600;
            line-height: 1.4;
        }

        /* =========================================================
        CONTACT ITEMS
        ========================================================= */

        .public-contact-items {
            display: flex;
            flex-direction: column;
            gap: 22px;
        }

        .public-contact-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;

            min-width: 0;
        }

        .public-contact-icon {
            display: flex;

            width: 40px;
            height: 40px;

            flex: 0 0 40px;

            align-items: center;
            justify-content: center;

            border-radius: 8px;

            background: #edf4ff;

            color: #174ea6;

            font-size: 15px;
        }

        .public-contact-item-content {
            min-width: 0;
        }

        .public-contact-item-content h3 {
            margin: 0 0 4px;

            color: #174ea6;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-contact-item-content p {
            margin: 0;

            color: #475569;
            font-size: 14px;
            line-height: 1.65;

            overflow-wrap: anywhere;
        }

        .public-contact-item-content a {
            color: #174ea6;
            font-size: 14px;
            line-height: 1.65;

            text-decoration: none;

            overflow-wrap: anywhere;

            transition:
                color 180ms ease,
                text-decoration-color 180ms ease;
        }

        .public-contact-item-content a:hover {
            color: #123d82;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        /* =========================================================
        MAP PLACEHOLDER
        ========================================================= */

        .public-contact-map {
            width: 100%;
            height: 260px;

            overflow: hidden;

            border-radius: 8px;

            background: #f1f5f9;
        }

        .public-contact-map iframe {
            display: block;

            width: 100%;
            height: 100%;

            border: 0;
        }

        .public-contact-map-icon {
            display: flex;

            width: 54px;
            height: 54px;

            margin-bottom: 14px;

            align-items: center;
            justify-content: center;

            border-radius: 50%;

            background: #edf4ff;

            color: #174ea6;

            font-size: 21px;
        }

        .public-contact-map-placeholder h3 {
            margin: 0 0 7px;

            color: #0b2f64;
            font-size: 15px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-contact-map-placeholder p {
            max-width: 330px;

            margin: 0 0 8px;

            color: #475569;
            font-size: 13px;
            line-height: 1.6;
        }

        .public-contact-map-placeholder span {
            max-width: 330px;

            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }

        /* =========================================================
        HELPDESK
        ========================================================= */

        .public-contact-helpdesk {
            padding: 0 0 56px;
        }

        .public-contact-helpdesk-card {
            display: flex;

            align-items: center;
            gap: 20px;

            padding: 24px 26px;

            border: 1px solid #cbd9ec;
            border-radius: 10px;

            background: #f1f6fd;
        }

        .public-contact-helpdesk-icon {
            display: flex;

            width: 52px;
            height: 52px;

            flex: 0 0 52px;

            align-items: center;
            justify-content: center;

            border-radius: 9px;

            background: #174ea6;

            color: #ffffff;

            font-size: 20px;
        }

        .public-contact-helpdesk-content {
            min-width: 0;
            flex: 1;
        }

        .public-contact-helpdesk-content h2 {
            margin: 0 0 5px;

            color: #0b2f64;
            font-size: 18px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-contact-helpdesk-content p {
            max-width: 760px;

            margin: 0;

            color: #475569;
            font-size: 13px;
            line-height: 1.65;
        }

        .public-contact-helpdesk-action {
            flex: 0 0 auto;
        }

        .public-contact-helpdesk-button {
            display: inline-flex;

            min-height: 38px;

            align-items: center;
            justify-content: center;

            gap: 7px;

            box-sizing: border-box;

            border-radius: 7px;

            padding: 0 15px;

            background: #174ea6;
            color: #ffffff;

            font-size: 13px;
            font-weight: 600;
            line-height: 1;

            text-decoration: none;

            transition:
                background-color 180ms ease,
                transform 180ms ease;
        }

        .public-contact-helpdesk-button:hover {
            background: #123d82;
            color: #ffffff;

            transform: translateY(-1px);
        }

        /* =========================================================
        RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {
            .public-contact-container {
                width: min(100% - 24px, 700px);
            }

            .public-contact-header {
                padding: 36px 0 22px;
            }

            .public-contact-title {
                padding-left: 9px;
                border-left-width: 4px;

                font-size: 24px;
            }

            .public-contact-description {
                padding-left: 13px;

                font-size: 13px;
            }

            .public-contact-grid {
                grid-template-columns: 1fr;
            }

            .public-contact-card {
                padding: 20px;
            }

            .public-contact-helpdesk-card {
                flex-direction: column;

                align-items: center;

                padding: 22px 20px;

                text-align: center;
            }

            .public-contact-helpdesk-content p {
                margin-right: auto;
                margin-left: auto;
            }

            .public-contact-helpdesk-action {
                width: 100%;
            }

            .public-contact-helpdesk-button {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .public-contact-container {
                width: calc(100% - 20px);
            }

            .public-contact-title {
                padding-left: 8px;

                font-size: 23px;
            }

            .public-contact-card {
                padding: 17px;
            }

            .public-contact-card > h2 {
                font-size: 18px;
            }

            .public-contact-map-placeholder {
                min-height: 230px;
                padding: 22px 15px;
            }

            .public-contact-map {
                height: 230px;
            }

            .public-contact-item {
                gap: 11px;
            }

            .public-contact-icon {
                width: 36px;
                height: 36px;

                flex-basis: 36px;

                font-size: 14px;
            }

            .public-contact-helpdesk-content h2 {
                font-size: 17px;
            }
        }


    </style>
@endpush

@section('content')

<main class="public-contact">

    {{-- =========================
         HEADER
    ========================== --}}
    <section class="public-contact-header">
        <div class="public-contact-container">

            <h1 class="public-contact-title">
                Hubungi Kami
            </h1>

            <p class="public-contact-description">
                Bagian Pengadaan Barang dan Jasa Sekretariat Daerah
                Kabupaten Mesuji siap memberikan informasi terkait
                layanan pengadaan barang dan jasa.
            </p>

        </div>
    </section>


    {{-- =========================
         INFORMASI KONTAK + LOKASI
    ========================== --}}
    <section class="public-contact-section">

        <div class="public-contact-container">

            <div class="public-contact-grid">

                {{-- INFORMASI KONTAK --}}
                <div class="public-contact-card">

                    <h2>
                        Informasi Kontak
                    </h2>

                    <div class="public-contact-items">

                        {{-- ALAMAT --}}
                        <div class="public-contact-item">

                            <div class="public-contact-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>

                            <div class="public-contact-item-content">

                                <h3>
                                    Alamat
                                </h3>

                                <p>
                                    Kompleks Perkantoran Pemkab Mesuji,
                                    Lampung
                                </p>

                            </div>

                        </div>


                        {{-- EMAIL --}}
                        <div class="public-contact-item">

                            <div class="public-contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>

                            <div class="public-contact-item-content">

                                <h3>
                                    Email
                                </h3>

                                <a
                                    href="mailto:bpbj@mesujikab.go.id"
                                >
                                    bpbj@mesujikab.go.id
                                </a>

                            </div>

                        </div>


                        {{-- JAM PELAYANAN --}}
                        <div class="public-contact-item">

                            <div class="public-contact-icon">
                                <i class="fas fa-clock"></i>
                            </div>

                            <div class="public-contact-item-content">

                                <h3>
                                    Jam Pelayanan
                                </h3>

                                <p>
                                    Senin–Jumat
                                    <br>
                                    08.00–16.00 WIB
                                </p>

                            </div>

                        </div>

                    </div>

                </div>


                {{-- LOKASI --}}
                <div class="public-contact-card">

                    <h2>
                        Lokasi Kantor
                    </h2>

                    <div class="public-contact-map">

                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.7044266046923!2d105.42526067477364!3d-3.873430396100327!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3e95979b218781%3A0x6423e935282042da!2sKantor%20Bupati%20Mesuji!5e0!3m2!1sid!2sid!4v1788768446624!5m2!1sid!2sid"
                            width="600"
                            height="450"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="strict-origin-when-cross-origin"
                            title="Lokasi Kantor Bupati Mesuji"
                        ></iframe>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
         HELPDESK CTA
    ========================== --}}
    <section class="public-contact-helpdesk">

        <div class="public-contact-container">

            <div class="public-contact-helpdesk-card">

                <div class="public-contact-helpdesk-icon">
                    <i class="fas fa-headset"></i>
                </div>

                <div class="public-contact-helpdesk-content">

                    <h2>
                        Membutuhkan Bantuan atau Informasi?
                    </h2>

                    <p>
                        Untuk konsultasi, aduan, kritik dan saran,
                        serta pertanyaan yang sering diajukan, silakan
                        gunakan layanan Helpdesk BPBJ Kabupaten Mesuji.
                    </p>

                </div>

                <div class="public-contact-helpdesk-action">

                    <a
                        href="{{ route('helpdesk.index') }}"
                        class="public-contact-helpdesk-button"
                    >
                        <i class="fas fa-arrow-right"></i>
                        <span>Buka Helpdesk</span>
                    </a>

                </div>

            </div>

        </div>

    </section>

</main>

@endsection