@extends('layouts.app')

@section('content')
    <div class="container content-section">
      <h3 class="section-title">Profil BPBJ Kabupaten Mesuji</h3>

        <div class="profile-content">
        <!-- Visi & Misi -->
            <div class="profile-card">
                <h4>Visi</h4>
                <p class="visi-text">
                    "Terwujudnya Pengadaan Barang/Jasa Pemerintah yang Kredibel,
                    Transparan, dan Akuntabel Berbasis Kinerja di Lingkungan Pemerintah
                    Kabupaten Mesuji."
                </p>

                <h4 style="margin-top: 30px">Misi</h4>
                <ol class="misi-list">
                    <li>
                    Meningkatkan kualitas dan kapasitas sumber daya manusia di bidang
                    pengadaan barang/jasa.
                    </li>
                    <li>
                    Mengoptimalkan pemanfaatan sistem pengadaan secara elektronik
                    (SPSE) untuk meningkatkan transparansi dan efisiensi.
                    </li>
                    <li>
                    Memperkuat sistem monitoring, evaluasi, dan pelaporan proses
                    pengadaan barang/jasa.
                    </li>
                    <li>
                    Memberikan pembinaan dan layanan konsultasi pengadaan barang/jasa
                    kepada seluruh Perangkat Daerah.
                    </li>
                </ol>
            </div>

            <!-- Struktur Organisasi -->
            <div class="profile-card">
                <h4>Struktur Organisasi</h4>
                <p>
                    Berikut adalah bagan struktur organisasi Bagian Pengadaan Barang dan
                    Jasa Sekretariat Daerah Kabupaten Mesuji.
                </p>
                <img
                    src="https://via.placeholder.com/800x500.png?text=Bagan+Struktur+Organisasi"
                    alt="Struktur Organisasi BPBJ Mesuji"
                    class="struktur-img"
                />
            </div>

            <!-- Tugas Pokok dan Fungsi -->
            <div class="profile-card">
                <h4>Tugas Pokok dan Fungsi</h4>
                <h5>Tugas Pokok</h5>
                <p>
                    Melaksanakan penyiapan perumusan kebijakan daerah, pengoordinasian
                    pelaksanaan tugas Perangkat Daerah, pemantauan dan evaluasi di
                    bidang pengelolaan pengadaan barang/jasa, pengelolaan layanan
                    pengadaan secara elektronik, serta pembinaan dan advokasi pengadaan
                    barang/jasa.
                </p>

                <h5>Fungsi</h5>
                <ol class="misi-list">
                    <li>
                    Penyiapan bahan perumusan kebijakan daerah di bidang pengelolaan,
                    layanan, pembinaan, dan advokasi pengadaan barang/jasa.
                    </li>
                    <li>
                    Penyiapan bahan pengoordinasian pelaksanaan tugas Perangkat Daerah
                    di bidang terkait.
                    </li>
                    <li>
                    Penyiapan bahan pemantauan dan evaluasi pelaksanaan kebijakan
                    daerah terkait pengadaan barang/jasa.
                    </li>
                    <li>Pelaksanaan fungsi lain yang diberikan oleh Asisten.</li>
                </ol>
            </div>
        </div>
    </div>
@endsection