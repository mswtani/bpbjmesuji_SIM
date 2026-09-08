@extends('layouts.public')

@section('title', 'Profil - BPBJ Kabupaten Mesuji')

@section('content')

<main class="public-profile">

    {{-- =========================
         PROFIL
    ========================== --}}
    <section class="public-profile-section">
        <div class="public-profile-container">

            <h1 class="public-profile-title">
                Profil BPBJ Kabupaten Mesuji
            </h1>

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
                                TURMUDI, S.KM
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