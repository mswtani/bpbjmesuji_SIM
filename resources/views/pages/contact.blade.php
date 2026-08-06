@extends('layouts.app')

@section('content')
    <div class="container content-section">
        <h3 class="section-title ">Hubungi Kami</h3>
        <p class="contact-intro">
            Kami siap membantu dan menerima informasi yang ingin Anda sampaikan.
            Hubungi kami melalui detail kontak yang tersedia di bawah ini atau
            kunjungi kantor kami.
        </p>

        <div class="contact-grid">
            <!-- Kolom Kiri: Info & Peta -->
            <div class="contact-info">
                <h4>Informasi Kontak</h4>
                <p>
                    <i class="fas fa-map-marker-alt"></i>
                    <strong>Alamat:</strong><br />
                    Komp. Perkantoran Pemkab Mesuji, Desa Wiralaga Mulya, Kec. Mesuji,
                    Kabupaten Mesuji, Lampung, 34699
                </p>
                <p>
                    <i class="fas fa-envelope"></i> <strong>Email:</strong><br />
                    bpbj@mesujikab.go.id
                </p>
                <p>
                    <i class="fas fa-phone"></i> <strong>Telepon:</strong><br />
                    (0726) 123-4567
                </p>

                <div class="map-container">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3980.7044266046832!2d105.42526067523431!3d-3.873430396100362!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e3e95979b218781%3A0x6423e935282042da!2sKantor%20Bupati%20Mesuji!5e0!3m2!1sen!2sid!4v1784125079644!5m2!1sen!2sid"
                        width="100%"
                        height="450"
                        allowfullscreen=""
                        loading="lazy"
                        referrerpolicy="strict-origin-when-cross-origin"
                    ></iframe>
                </div>
            </div>

            <!-- Kolom Kanan: Info Layanan -->
            <div class="contact-info">
                <h4>Layanan Online</h4>
                <p>
                    Untuk efektivitas dan kemudahan, kami menyediakan halaman khusus
                    untuk beberapa layanan:
                </p>
                <ul class="social-links-contact">
                    <li>
                        <a href="{{ url('/konsultasi') }}">
                            <i class="fas fa-comments"></i>
                            <span>Layanan Konsultasi PBJ</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('/aduan') }}">
                            <i class="fas fa-bullhorn"></i>
                            <span>Aduan, Kritik, dan Saran</span>
                        </a>
                    </li>
                </ul>

                <h4 class="mt-4">Media Sosial</h4>
                <p>
                    Ikuti kami di media sosial untuk mendapatkan informasi terbaru
                    seputar pengadaan barang dan jasa.
                </p>
                <ul class="social-cards-container">
                    <li>
                        <a href="#" target="_blank" class="social-card facebook">
                            <i class="fab fa-facebook-f"></i>
                            <span>Facebook</span>
                        </a>
                    </li>
                    <li>
                        <a href="#" target="_blank" class="social-card instagram">
                            <i class="fab fa-instagram"></i>
                            <span>Instagram</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection