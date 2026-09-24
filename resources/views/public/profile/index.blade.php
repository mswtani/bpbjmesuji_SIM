@extends('layouts.public')

@section('title', 'Profil - BPBJ Kabupaten Mesuji')

@push('styles')
    <style>
        /* =========================================================
        PUBLIC PROFILE
        ========================================================= */

        .public-profile {
            background: #f8fafc;
            color: #334155;
        }

        /* =========================================================
        CONTAINER
        ========================================================= */

        .public-profile-container {
            width: min(1200px, calc(100% - 32px));
            margin: 0 auto;
        }

        /* =========================================================
        GENERAL SECTION
        ========================================================= */

        .public-profile-section {
            padding: 48px 0;
        }

        /* =========================================================
        MAIN TITLE
        ========================================================= */

        .public-profile-header {
            padding: 44px 0 26px;
        }

        .public-profile-title {
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

        .public-profile-description {
            max-width: 760px;
            margin: 0;
            padding-left: 15px;
            color: #64748b;
            font-size: 14px;
            line-height: 1.7;
        }

        /* =========================================================
        PROFILE CARD
        ========================================================= */

        .public-profile-card {
            padding: 28px;
            border: 1px solid #dce3ec;
            border-radius: 10px;
            background: #ffffff;
            box-shadow: 0 4px 14px rgb(15 23 42 / 4%);
        }

        .public-profile-card h2 {
            margin: 0 0 14px;

            color: #174ea6;
            font-size: 20px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-profile-card h3 {
            margin: 26px 0 12px;

            color: #174ea6;
            font-size: 17px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-profile-card p {
            margin: 0;

            color: #475569;
            font-size: 15px;
            line-height: 1.75;
        }

        .public-profile-visi {
            padding: 18px 20px;

            border-left: 4px solid #d4af37;
            border-radius: 0 6px 6px 0;

            background: #f8fafc;

            color: #334155 !important;
            font-style: italic;
        }

        .public-profile-subheading {
            margin-top: 30px !important;
        }

        /* =========================================================
        LIST
        ========================================================= */

        .public-profile-list {
            margin: 0;
            padding-left: 24px;

            color: #475569;
            font-size: 15px;
            line-height: 1.75;

            list-style-type: decimal;
            list-style-position: outside;
        }

        .public-profile-list li {
            padding-left: 6px;
        }

        .public-profile-list li + li {
            margin-top: 8px;
        }

        /* =========================================================
        ORGANIZATION SECTION
        ========================================================= */

        .public-profile-org {
            padding: 56px 0;

            background: #ffffff;
        }

        .public-profile-org-header {
            margin-bottom: 32px;
            text-align: center;
        }

        .public-profile-org-header h2 {
            margin: 0 0 8px;

            color: #0b2f64;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.3;
        }

        .public-profile-org-header p {
            margin: 0;

            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        /* =========================================================
        ORGANIZATION CARD
        ========================================================= */

        .public-profile-org-card {
            display: flex;
            align-items: center;
            gap: 14px;

            min-width: 0;
            padding: 14px;

            border: 1px solid #dce3ec;
            border-radius: 9px;

            background: #ffffff;

            box-shadow: 0 3px 12px rgb(15 23 42 / 5%);

            cursor: pointer;

            transition:
                transform 180ms ease,
                box-shadow 180ms ease,
                border-color 180ms ease;
        }

        .public-profile-org-card:hover {
            border-color: #b9c9df;

            box-shadow: 0 7px 18px rgb(15 23 42 / 9%);

            transform: translateY(-2px);
        }

        .public-profile-org-avatar {
            width: 58px;
            height: 58px;

            flex: 0 0 58px;

            border-radius: 50%;

            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

            background-color: #e2e8f0;
        }

        .public-profile-org-info {
            min-width: 0;
        }

        .public-profile-org-name {
            margin: 0 0 4px;

            color: #0b2f64;
            font-size: 14px;
            font-weight: 600;
            line-height: 1.4;

            overflow-wrap: anywhere;
        }

        .public-profile-org-title {
            margin: 0;

            color: #64748b;
            font-size: 12px;
            line-height: 1.4;

            overflow-wrap: anywhere;
        }

        /* =========================================================
        TOP & CORE
        ========================================================= */

        .public-profile-org-top {
            display: flex;
            justify-content: center;

            max-width: 500px;
            margin: 0 auto 20px;
        }

        .public-profile-org-core {
            display: flex;
            justify-content: center;

            max-width: 320px;
            margin: 0 auto;
        }

        .public-profile-org-divider {
            width: 100%;
            max-width: 700px;
            height: 1px;

            margin: 32px auto;

            background: #dce3ec;
        }

        /* =========================================================
        TABS
        ========================================================= */

        .public-profile-tabs {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 8px;

            margin-bottom: 28px;
        }

        .public-profile-tab {
            min-height: 38px;

            border: 1px solid #dce3ec;
            border-radius: 7px;

            padding: 0 16px;

            background: #ffffff;
            color: #475569;

            font-family: inherit;
            font-size: 13px;
            font-weight: 600;

            cursor: pointer;

            transition:
                background-color 180ms ease,
                color 180ms ease,
                border-color 180ms ease;
        }

        .public-profile-tab:hover {
            border-color: #174ea6;
            color: #174ea6;
        }

        .public-profile-tab.active {
            border-color: #174ea6;
            background: #174ea6;
            color: #ffffff;
        }

        /* =========================================================
        TAB CONTENT
        ========================================================= */

        .public-profile-tab-content {
            display: none;
        }

        .public-profile-tab-content.active {
            display: block;
        }

        .public-profile-tab-content > h3 {
            margin: 0 0 20px;

            color: #174ea6;

            font-size: 17px;
            font-weight: 600;
            line-height: 1.5;

            text-align: center;
        }

        /* =========================================================
        STAFF GRID
        ========================================================= */

        .public-profile-staff-grid {
            display: grid;

            grid-template-columns: repeat(3, minmax(0, 1fr));

            gap: 16px;
        }

        .public-profile-staff-grid.centered {
            grid-template-columns: repeat(3, minmax(0, 1fr));
        }

        /* =========================================================
        MODAL
        ========================================================= */

        .public-profile-modal {
            position: fixed;
            z-index: 9999;

            inset: 0;

            display: none;

            align-items: center;
            justify-content: center;

            padding: 20px;

            background: rgb(15 23 42 / 55%);
        }

        .public-profile-modal.active {
            display: flex;
        }

        .public-profile-modal-container {
            position: relative;

            width: min(420px, 100%);

            border-radius: 12px;

            background: #ffffff;

            box-shadow: 0 20px 50px rgb(15 23 42 / 20%);
        }

        .public-profile-modal-close {
            position: absolute;
            z-index: 2;

            top: 10px;
            right: 12px;

            width: 34px;
            height: 34px;

            border: 0;
            border-radius: 50%;

            background: transparent;
            color: #64748b;

            font-size: 28px;
            line-height: 1;

            cursor: pointer;
        }

        .public-profile-modal-close:hover {
            background: #f1f5f9;
            color: #0f172a;
        }

        .public-profile-modal-body {
            padding: 36px 28px 30px;

            text-align: center;
        }

        .public-profile-modal-avatar {
            width: 110px;
            height: 110px;

            margin: 0 auto 18px;

            border-radius: 50%;

            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;

            background-color: #e2e8f0;
        }

        .public-profile-modal-body h2 {
            margin: 0 0 8px;

            color: #0b2f64;
            font-size: 19px;
            font-weight: 600;
            line-height: 1.4;
        }

        .public-profile-modal-body p {
            margin: 4px 0;

            color: #64748b;
            font-size: 14px;
            line-height: 1.5;
        }

        .public-profile-modal-body p:last-child {
            color: #475569;
            font-size: 13px;
        }

        /* =========================================================
        RESPONSIVE
        ========================================================= */

        @media (max-width: 992px) {
            .public-profile-staff-grid,
            .public-profile-staff-grid.centered {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
        }

        @media (max-width: 768px) {
            .public-profile-container {
                width: min(100% - 24px, 700px);
            }

            .public-profile-section {
                padding: 36px 0;
            }

            .public-profile-title {
                padding-left: 9px;
                border-left-width: 4px;

                font-size: 24px;
            }

            .public-profile-card {
                padding: 20px;
            }

            .public-profile-org {
                padding: 42px 0;
            }

            .public-profile-org-header h2 {
                font-size: 24px;
            }

            .public-profile-tabs {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .public-profile-tab {
                width: 100%;
                padding: 0 8px;
            }

            .public-profile-staff-grid,
            .public-profile-staff-grid.centered {
                grid-template-columns: 1fr;
            }

            .public-profile-org-top,
            .public-profile-org-core {
                max-width: 100%;
            }
        }

        @media (max-width: 480px) {
            .public-profile-container {
                width: calc(100% - 20px);
            }

            .public-profile-title {
                padding-left: 8px;
                border-left-width: 4px;

                font-size: 23px;
            }

            .public-profile-card {
                padding: 17px;
            }

            .public-profile-card h2 {
                font-size: 19px;
            }

            .public-profile-card h3 {
                font-size: 16px;
            }

            .public-profile-card p,
            .public-profile-list {
                font-size: 14px;
            }

            .public-profile-tabs {
                grid-template-columns: 1fr;
            }

            .public-profile-org-card {
                padding: 12px;
            }
        }
    </style>
@endpush

@section('content')

<main class="public-profile">

    {{-- =========================
         PROFIL
    ========================== --}}
    <section class="public-profile-section">
        <div class="public-profile-container">

            <div class="public-profile-header">

                <h1 class="public-profile-title">
                    Profil BPBJ Kabupaten Mesuji
                </h1>

                <p class="public-profile-description">
                    Bagian Pengadaan Barang dan Jasa Sekretariat Daerah Kabupaten Mesuji.
                </p>

            </div>

            <div class="public-profile-card">

                <h2>Visi</h2>

                <p class="public-profile-visi">
                    "Terwujudnya Pengadaan Barang/Jasa Pemerintah yang Kredibel,
                    Transparan, dan Akuntabel Berbasis Kinerja di Lingkungan
                    Pemerintah Kabupaten Mesuji."
                </p>

                <h2 class="public-profile-subheading">
                    Misi
                </h2>

                <ol class="public-profile-list">
                    <li>
                        Meningkatkan kualitas dan kapasitas sumber daya manusia
                        di bidang pengadaan barang/jasa.
                    </li>

                    <li>
                        Mengoptimalkan pemanfaatan sistem pengadaan secara
                        elektronik (SPSE) untuk meningkatkan transparansi dan
                        efisiensi.
                    </li>

                    <li>
                        Memperkuat sistem monitoring, evaluasi, dan pelaporan
                        proses pengadaan barang/jasa.
                    </li>

                    <li>
                        Memberikan pembinaan dan layanan konsultasi pengadaan
                        barang/jasa kepada seluruh Perangkat Daerah.
                    </li>
                </ol>

            </div>

        </div>
    </section>


    {{-- =========================
         STRUKTUR ORGANISASI
    ========================== --}}
    <section class="public-profile-org">

        <div class="public-profile-container">

            <div class="public-profile-org-header">

                <h2>
                    Susunan Organisasi Pemerintahan
                </h2>

                <p>
                    Struktur kepemimpinan dan aparatur Bagian Pengadaan
                    Barang dan Jasa.
                </p>

            </div>


            {{-- LEVEL TOP --}}
            <div class="public-profile-org-top">

                <div
                    class="public-profile-org-card"
                    data-name="Drs. INDRA KUSUMA WIJAYA, M.M."
                    data-jabatan="Asisten Bidang Perekonomian dan Pembangunan"
                    data-nip="NIP. 19690818 199003 1 005"
                    data-foto="https://via.placeholder.com/150/06b6d4/ffffff?text=Foto"
                >

                    <div
                        class="public-profile-org-avatar"
                        style="background-image: url('https://via.placeholder.com/100/06b6d4/ffffff?text=Foto')"
                    ></div>

                    <div class="public-profile-org-info">

                        <p class="public-profile-org-name">
                            Drs. INDRA KUSUMA WIJAYA, M.M.
                        </p>

                        <p class="public-profile-org-title">
                            Asisten Perekonomian &amp; Pembangunan
                        </p>

                    </div>

                </div>

            </div>


            {{-- KEPALA BAGIAN --}}
            <div class="public-profile-org-core">

                <div
                    class="public-profile-org-card"
                    data-name="YOGA SALENDRA, S.T."
                    data-jabatan="Kepala Bagian Pengadaan Barang dan Jasa"
                    data-nip="NIP. 19811207 201001 1 013"
                    data-foto="https://via.placeholder.com/150/06b6d4/ffffff?text=Foto"
                >

                    <div
                        class="public-profile-org-avatar"
                        style="background-image: url('https://via.placeholder.com/100/06b6d4/ffffff?text=Foto')"
                    ></div>

                    <div class="public-profile-org-info">

                        <p class="public-profile-org-name">
                            YOGA SALENDRA, S.T.
                        </p>

                        <p class="public-profile-org-title">
                            Kepala Bagian
                        </p>

                    </div>

                </div>

            </div>


            <div class="public-profile-org-divider"></div>


            {{-- TABS --}}
            <div class="public-profile-tabs">

                <button
                    type="button"
                    class="public-profile-tab active"
                    data-tab="divisi3"
                >
                    Ahli Madya
                </button>

                <button
                    type="button"
                    class="public-profile-tab"
                    data-tab="divisi2"
                >
                    Ahli Muda
                </button>

                <button
                    type="button"
                    class="public-profile-tab"
                    data-tab="divisi1"
                >
                    Ahli Pertama
                </button>

                <button
                    type="button"
                    class="public-profile-tab"
                    data-tab="divisi4"
                >
                    Staff Pelaksana
                </button>

            </div>


            {{-- =========================
                 AHLI PERTAMA
            ========================== --}}
            <div
                id="divisi1"
                class="public-profile-tab-content"
            >

                <h3>
                    Fungsional Pengelola Pengadaan Barang/Jasa Ahli Pertama
                </h3>

                <div class="public-profile-staff-grid">

                    @php
                        $ahliPertama = [
                            [
                                'name' => 'ANDIKA MAHARDIKA, SE., M.M.',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19921123 201903 1 006',
                            ],
                            [
                                'name' => 'DWI YANTO, S.T.',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19901126 201903 1 002',
                            ],
                            [
                                'name' => 'HARI FATDRIANSYAH',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19890515 201503 1 001',
                            ],
                            [
                                'name' => 'YULIANTO KURNIAWAN, S.Kep.',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19900607 201403 1 002',
                            ],
                            [
                                'name' => 'SUMANTO, S.Ak., M.M. ',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19860701 201503 1 004',
                            ],
                            [
                                'name' => 'ANDI KURNIAWAN, S.Kep., M.M.',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19800322 201405 1 001',
                            ],
                            [
                                'name' => 'RENDRA ADHI PRADANA, S.E.',
                                'jabatan' => 'Fungsional PBJ Ahli Pertama',
                                'nip' => 'NIP. 19920515 202503 1 001',
                            ],
                        ];
                    @endphp

                    @foreach ($ahliPertama as $person)

                        <div
                            class="public-profile-org-card"
                            data-name="{{ $person['name'] }}"
                            data-jabatan="{{ $person['jabatan'] }}"
                            data-nip="{{ $person['nip'] }}"
                            data-foto="https://via.placeholder.com/150/10b981/ffffff?text=Foto"
                        >

                            <div
                                class="public-profile-org-avatar"
                                style="background-image: url('https://via.placeholder.com/100/10b981/ffffff?text=Foto')"
                            ></div>

                            <div class="public-profile-org-info">

                                <p class="public-profile-org-name">
                                    {{ $person['name'] }}
                                </p>

                                <p class="public-profile-org-title">
                                    Ahli Pertama
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =========================
                 AHLI MUDA
            ========================== --}}
            <div
                id="divisi2"
                class="public-profile-tab-content"
            >

                <h3>
                    Fungsional Pengelola Pengadaan Barang/Jasa Ahli Muda
                </h3>

                <div class="public-profile-staff-grid">

                    @php
                        $ahliMuda = [
                            [
                                'name' => 'MUHLISON, S.P., M.P.',
                                'nip' => 'NIP. 19770103 201001 1 007',
                            ],
                            [
                                'name' => 'ARIYANDA, S.H,, M.M.',
                                'nip' => 'NIP. 19800318 200701 1 007',
                            ],
                            [
                                'name' => 'SURAJI, S.Kep., M.M.',
                                'nip' => 'NIP. 19770528 199703 1 004',
                            ],
                            [
                                'name' => 'OLYS, SKM., M.Kes.Epid',
                                'nip' => 'NIP. 19770101 200003 1 005',
                            ],
                            [
                                'name' => 'WAWAN SETIAWAN, S.I.P',
                                'nip' => 'NIP. 19811011 200212 1 004',
                            ],
                            [
                                'name' => 'MERIA YULITA SAPITRI, S.H., M.H.',
                                'nip' => 'NIP. 19920710 201503 2 002',
                            ],
                            [
                                'name' => 'Ir. PRACOYO DWIJO H, ST., M.T.',
                                'nip' => 'NIP. 19860204 201001 1 006',
                            ],
                            [
                                'name' => 'AKNES YULYANTO, S.KM.',
                                'nip' => 'NIP. 19860726 201403 1 001',
                            ],
                        ];
                    @endphp

                    @foreach ($ahliMuda as $person)

                        <div
                            class="public-profile-org-card"
                            data-name="{{ $person['name'] }}"
                            data-jabatan="Fungsional PBJ Ahli Muda"
                            data-nip="{{ $person['nip'] }}"
                            data-foto="https://via.placeholder.com/150/3b82f6/ffffff?text=Foto"
                        >

                            <div
                                class="public-profile-org-avatar"
                                style="background-image: url('https://via.placeholder.com/100/3b82f6/ffffff?text=Foto')"
                            ></div>

                            <div class="public-profile-org-info">

                                <p class="public-profile-org-name">
                                    {{ $person['name'] }}
                                </p>

                                <p class="public-profile-org-title">
                                    Ahli Muda
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>


            {{-- =========================
                 AHLI MADYA
            ========================== --}}
            <div
                id="divisi3"
                class="public-profile-tab-content active"
            >

                <h3>
                    Fungsional Pengelola Pengadaan Barang/Jasa Ahli Madya
                </h3>

                <div class="public-profile-staff-grid centered">

                    <div
                        class="public-profile-org-card"
                        data-name="TURMUDI, S.KM., M.M."
                        data-jabatan="Fungsional PBJ Ahli Madya"
                        data-nip="NIP. 19800618 200501 1 008"
                        data-foto="https://via.placeholder.com/150/f97316/ffffff?text=Foto"
                    >

                        <div
                            class="public-profile-org-avatar"
                            style="background-image: url('https://via.placeholder.com/100/f97316/ffffff?text=Foto')"
                        ></div>

                        <div class="public-profile-org-info">

                            <p class="public-profile-org-name">
                                TURMUDI, S.KM., M.M.
                            </p>

                            <p class="public-profile-org-title">
                                Ahli Madya
                            </p>

                        </div>

                    </div>

                </div>

            </div>


            {{-- =========================
                 STAFF PELAKSANA
            ========================== --}}
            <div
                id="divisi4"
                class="public-profile-tab-content"
            >

                <h3>
                    Staf Pelaksana
                </h3>

                <div class="public-profile-staff-grid centered">

                    @php
                        $staff = [
                            [
                                'name' => 'NASYIATUL AISIYAH, S.Ak',
                                'jabatan' => 'Staf Pelaksana',
                                'nip' => 'NIP. 19810420 201403 2 001',
                            ],
                            [
                                'name' => 'WICHA TRIVITA, S.I.P',
                                'jabatan' => 'Bendahara Pengeluaran Pembantu',
                                'nip' => 'NIP. 19890729 201503 2 004',
                            ],
                            [
                                'name' => 'CICI ARIEZKA LASE, S.H.',
                                'jabatan' => 'Staf Pelaksana',
                                'nip' => 'NIPPPK. 19940725 202521 2 001',
                            ],
                            [
                                'name' => 'SILVIA',
                                'jabatan' => 'Staf Pelaksana',
                                'nip' => 'NIPPPK. 19920523 202521 2 003',
                            ],
                            [
                                'name' => 'SYAHFREDO, S.H.',
                                'jabatan' => 'Staf Pelaksana',
                                'nip' => 'NIPPPK. -',
                            ],
                            [
                                'name' => 'EVI FITRIANI, S.IP.',
                                'jabatan' => 'Staf Pelaksana',
                                'nip' => 'NIP. 19890729 201503 2 004',
                            ],
                        ];
                    @endphp

                    @foreach ($staff as $person)

                        <div
                            class="public-profile-org-card"
                            data-name="{{ $person['name'] }}"
                            data-jabatan="{{ $person['jabatan'] }}"
                            data-nip="{{ $person['nip'] }}"
                            data-foto="https://via.placeholder.com/150/64748b/ffffff?text=Foto"
                        >

                            <div
                                class="public-profile-org-avatar"
                                style="background-image: url('https://via.placeholder.com/100/64748b/ffffff?text=Foto')"
                            ></div>

                            <div class="public-profile-org-info">

                                <p class="public-profile-org-name">
                                    {{ $person['name'] }}
                                </p>

                                <p class="public-profile-org-title">
                                    {{ $person['jabatan'] }}
                                </p>

                            </div>

                        </div>

                    @endforeach

                </div>

            </div>

        </div>

    </section>


    {{-- =========================
         TUGAS POKOK DAN FUNGSI
    ========================== --}}
    <section class="public-profile-section">

        <div class="public-profile-container">

            <div class="public-profile-card">

                <h2>
                    Tugas Pokok dan Fungsi
                </h2>

                <h3>
                    Tugas Pokok
                </h3>

                <p>
                    Melaksanakan penyiapan perumusan kebijakan daerah,
                    pengoordinasian pelaksanaan tugas Perangkat Daerah,
                    pemantauan dan evaluasi di bidang pengelolaan pengadaan
                    barang/jasa, pengelolaan layanan pengadaan secara
                    elektronik, serta pembinaan dan advokasi pengadaan
                    barang/jasa.
                </p>

                <h3>
                    Fungsi
                </h3>

                <ol class="public-profile-list">

                    <li>
                        Penyiapan bahan perumusan kebijakan daerah di bidang
                        pengelolaan, layanan, pembinaan, dan advokasi pengadaan
                        barang/jasa.
                    </li>

                    <li>
                        Penyiapan bahan pengoordinasian pelaksanaan tugas
                        Perangkat Daerah di bidang terkait.
                    </li>

                    <li>
                        Penyiapan bahan pemantauan dan evaluasi pelaksanaan
                        kebijakan daerah terkait pengadaan barang/jasa.
                    </li>

                    <li>
                        Pelaksanaan fungsi lain yang diberikan oleh Asisten.
                    </li>

                </ol>

            </div>

        </div>

    </section>

</main>


{{-- =========================
     MODAL ORGANISASI
========================== --}}
<div
    id="public-profile-org-modal"
    class="public-profile-modal"
    aria-hidden="true"
>

    <div
        class="public-profile-modal-container"
        role="dialog"
        aria-modal="true"
        aria-labelledby="public-profile-modal-name"
    >

        <button
            type="button"
            id="public-profile-modal-close"
            class="public-profile-modal-close"
            aria-label="Tutup"
        >
            &times;
        </button>

        <div class="public-profile-modal-body">

            <div
                id="public-profile-modal-avatar"
                class="public-profile-modal-avatar"
            ></div>

            <h2 id="public-profile-modal-name"></h2>

            <p id="public-profile-modal-jabatan"></p>

            <p id="public-profile-modal-nip"></p>

        </div>

    </div>

</div>

@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () 
    {
        /*
        * =====================================================
        * TAB STRUKTUR ORGANISASI
        * =====================================================
        */

        const tabs = document.querySelectorAll(".public-profile-tab");
        const tabContents = document.querySelectorAll(
            ".public-profile-tab-content",
        );

        tabs.forEach(function (tab) {
            tab.addEventListener("click", function () {
                const targetId = tab.dataset.tab;

                tabs.forEach(function (item) {
                    item.classList.remove("active");
                });

                tabContents.forEach(function (content) {
                    content.classList.remove("active");
                });

                tab.classList.add("active");

                const target = document.getElementById(targetId);

                if (target) {
                    target.classList.add("active");
                }
            });
        });

        /*
        * =====================================================
        * MODAL ORGANISASI
        * =====================================================
        */

        const modal = document.getElementById("public-profile-org-modal");

        const modalClose = document.getElementById("public-profile-modal-close");

        const modalAvatar = document.getElementById("public-profile-modal-avatar");

        const modalName = document.getElementById("public-profile-modal-name");

        const modalJabatan = document.getElementById(
            "public-profile-modal-jabatan",
        );

        const modalNip = document.getElementById("public-profile-modal-nip");

        const orgCards = document.querySelectorAll(".public-profile-org-card");

        function openModal(card) {
            if (!modal) {
                return;
            }

            const name = card.dataset.name || "";
            const jabatan = card.dataset.jabatan || "";
            const nip = card.dataset.nip || "";
            const foto = card.dataset.foto || "";

            modalName.textContent = name;
            modalJabatan.textContent = jabatan;
            modalNip.textContent = nip;

            if (foto) {
                modalAvatar.style.backgroundImage = `url("${foto}")`;
            } else {
                modalAvatar.style.backgroundImage = "";
            }

            modal.classList.add("active");
            modal.setAttribute("aria-hidden", "false");

            document.body.style.overflow = "hidden";
        }

        function closeModal() {
            if (!modal) {
                return;
            }

            modal.classList.remove("active");
            modal.setAttribute("aria-hidden", "true");

            document.body.style.overflow = "";
        }

        orgCards.forEach(function (card) {
            card.addEventListener("click", function () {
                openModal(card);
            });
        });

        if (modalClose) {
            modalClose.addEventListener("click", closeModal);
        }

        if (modal) {
            modal.addEventListener("click", function (event) {
                if (event.target === modal) {
                    closeModal();
                }
            });
        }

        document.addEventListener("keydown", function (event) {
            if (event.key === "Escape") {
                closeModal();
            }
        });
    });

</script>
@endpush