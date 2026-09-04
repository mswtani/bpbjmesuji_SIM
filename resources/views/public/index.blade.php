@extends('layouts.public')

@section('title', 'BPBJ Kabupaten Mesuji - Pengadaan Barang & Jasa')

@section('content')

{{-- =========================================================
    HERO
========================================================= --}}
<header
    id="heroCarousel"
    class="carousel slide"
    data-bs-ride="carousel"
>

    <div class="carousel-indicators">

        <button
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="0"
            class="active"
            aria-current="true"
            aria-label="Slide 1"
        ></button>

        <button
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="1"
            aria-label="Slide 2"
        ></button>

        <button
            type="button"
            data-bs-target="#heroCarousel"
            data-bs-slide-to="2"
            aria-label="Slide 3"
        ></button>

    </div>


    <div class="carousel-inner">

        {{-- Slide 1 --}}
        <a href="{{ url('/berita/detail') }}">

            <div
                class="carousel-item active"
                style="
                    background-image:
                        url('https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=1200&q=80');
                "
            >

                <div class="carousel-caption text-center">

                    <h2>
                        Sosialisasi E-Katalog Lokal untuk Pelaku Usaha
                    </h2>

                    <p>
                        Mendorong partisipasi UMKM dalam pengadaan barang/jasa
                        pemerintah di Kabupaten Mesuji.
                    </p>

                    <span class="btn-primary">
                        Baca Berita Selengkapnya
                    </span>

                </div>

            </div>

        </a>


        {{-- Slide 2 --}}
        <a href="{{ url('/berita/detail') }}">

            <div
                class="carousel-item"
                style="
                    background-image:
                        url('https://images.unsplash.com/photo-1556761175-b413da4baf72?auto=format&fit=crop&w=1200&q=80');
                "
            >

                <div class="carousel-caption text-center">

                    <h2>
                        Peningkatan Kapasitas PPK dan Pokja Pemilihan
                    </h2>

                    <p>
                        BPBJ Mesuji berkomitmen meningkatkan kompetensi
                        para pelaku pengadaan.
                    </p>

                    <span class="btn-primary">
                        Lihat Detail Kegiatan
                    </span>

                </div>

            </div>

        </a>


        {{-- Slide 3 --}}
        <a href="{{ url('/berita/detail') }}">

            <div
                class="carousel-item"
                style="
                    background-image:
                        url('https://images.unsplash.com/photo-1556740738-b6a63e27c4df?auto=format&fit=crop&w=1200&q=80');
                "
            >

                <div class="carousel-caption text-center">

                    <h2>
                        BPBJ Mesuji Raih Penghargaan Kepatuhan Pelaporan
                    </h2>

                    <p>
                        Sebuah bukti komitmen dalam mewujudkan transparansi
                        dan akuntabilitas pengadaan.
                    </p>

                    <span class="btn-primary">
                        Baca Selengkapnya
                    </span>

                </div>

            </div>

        </a>

    </div>


    <button
        class="carousel-control-prev"
        type="button"
        data-bs-target="#heroCarousel"
        data-bs-slide="prev"
    >
        <span
            class="carousel-control-prev-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">
            Previous
        </span>
    </button>


    <button
        class="carousel-control-next"
        type="button"
        data-bs-target="#heroCarousel"
        data-bs-slide="next"
    >
        <span
            class="carousel-control-next-icon"
            aria-hidden="true"
        ></span>

        <span class="visually-hidden">
            Next
        </span>
    </button>

</header>


{{-- =========================================================
    LAYANAN
========================================================= --}}
<section class="layanan-section">

    <div class="container">

        <div class="layanan-grid">

            <a
                href="https://spse.inaproc.id/mesujikab"
                target="_blank"
                rel="noopener noreferrer"
                class="layanan-item"
            >

                <img
                    src="{{ asset('images/public/layanan/inaproc spse.png') }}"
                    alt="SPSE"
                    class="layanan-icon"
                >

                <h4>
                    SPSE
                </h4>

                <p>
                    Akses Layanan Pengadaan Secara Elektronik
                    Kabupaten Mesuji.
                </p>

            </a>


            <a
                href="https://sirup.inaproc.id/sirup/home/rekapitulasiindex"
                target="_blank"
                rel="noopener noreferrer"
                class="layanan-item"
            >

                <img
                    src="{{ asset('images/public/layanan/SIRUP-removebg-preview.png') }}"
                    alt="SiRUP"
                    class="layanan-icon"
                >

                <h4>
                    SiRUP
                </h4>

                <p>
                    Sistem Informasi Rencana Umum Pengadaan
                    berbasis web.
                </p>

            </a>


            <a
                href="https://katalog.inaproc.id"
                target="_blank"
                rel="noopener noreferrer"
                class="layanan-item"
            >

                <img
                    src="{{ asset('images/public/layanan/logo-katalog-elektronik-v2.ab40371f.webp') }}"
                    alt="Katalog"
                    class="layanan-icon"
                >

                <h4>
                    KATALOG
                </h4>

                <p>
                    <i>e-marketplace</i>
                    pemerintah Indonesia
                </p>

            </a>


            <a
                href="{{ url('/simonpraja') }}"
                class="layanan-item"
            >

                <img
                    src="{{ asset('images/public/layanan/SIMONPRAJA-removebg-preview.png') }}"
                    alt="SIMONPRAJA"
                    class="layanan-icon"
                >

                <h4>
                    SIMONPRAJA
                </h4>

                <p>
                    Sistem Informasi Monitoring Pengadaan
                    Barang dan Jasa.
                </p>

            </a>

        </div>

    </div>

</section>


{{-- =========================================================
    BERITA
========================================================= --}}
<section class="berita-section">

    <div class="container">

        <h3 class="section-title">
            Berita & Informasi Terkini
        </h3>


        <div class="berita-grid">

            {{-- Berita utama --}}
            <article class="berita-card featured-article">

                <a
                    href="{{ url('/berita/detail') }}"
                    class="berita-img-link"
                >

                    <img
                        src="https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&w=800&q=60"
                        alt="Sosialisasi E-Katalog"
                        class="berita-img"
                    >

                </a>


                <div class="berita-content">

                    <p class="berita-meta">
                        18 Juli 2024 | Pengumuman
                    </p>

                    <h4 class="featured-title">

                        <a href="{{ url('/berita/detail') }}">
                            Sosialisasi E-Katalog Lokal untuk Pelaku
                            Usaha di Mesuji
                        </a>

                    </h4>

                    <p class="berita-excerpt">
                        Dengan adanya e-katalog lokal, diharapkan
                        para pelaku usaha mikro, kecil, dan menengah
                        (UMKM) di Kabupaten Mesuji dapat lebih mudah
                        berpartisipasi...
                    </p>

                    <a
                        href="{{ url('/berita/detail') }}"
                        class="berita-link"
                    >
                        Baca Selengkapnya &rarr;
                    </a>

                </div>

            </article>


            {{-- Berita lainnya --}}
            <div class="berita-sidebar">

                <article class="berita-card-small">

                    <div class="berita-content-small">

                        <p class="berita-meta">
                            15 Juli 2024 | Kegiatan
                        </p>

                        <h4>
                            <a href="{{ url('/berita/detail') }}">
                                Peningkatan Kapasitas PPK dan Pokja
                                Pemilihan
                            </a>
                        </h4>

                        <a
                            href="{{ url('/berita/detail') }}"
                            class="berita-link"
                        >
                            Baca Selengkapnya &rarr;
                        </a>

                    </div>

                </article>


                <article class="berita-card-small">

                    <div class="berita-content-small">

                        <p class="berita-meta">
                            12 Juli 2024 | Berita
                        </p>

                        <h4>
                            <a href="{{ url('/berita/detail') }}">
                                Penandatanganan Kontrak Paket
                                Pembangunan Jembatan Wiralaga
                            </a>
                        </h4>

                        <a
                            href="{{ url('/berita/detail') }}"
                            class="berita-link"
                        >
                            Baca Selengkapnya &rarr;
                        </a>

                    </div>

                </article>


                <article class="berita-card-small">

                    <div class="berita-content-small">

                        <p class="berita-meta">
                            10 Juli 2024 | Informasi
                        </p>

                        <h4>
                            <a href="{{ url('/berita/detail') }}">
                                Update Regulasi Pengadaan Barang
                                dan Jasa Terbaru
                            </a>
                        </h4>

                        <a
                            href="{{ url('/berita/detail') }}"
                            class="berita-link"
                        >
                            Baca Selengkapnya &rarr;
                        </a>

                    </div>

                </article>

            </div>

        </div>


        <div class="text-center mt-4">

            <a
                href="{{ url('/berita') }}"
                class="btn-primary"
            >
                Lihat Semua Berita
            </a>

        </div>

    </div>

</section>


{{-- =========================================================
    REGULASI
========================================================= --}}
<section class="regulasi-section">

    <div class="container">

        <h3 class="section-title">
            Peraturan Terbaru
        </h3>


        <div class="peraturan-list">

            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        Perpres
                    </span>

                    <p class="peraturan-judul">
                        Peraturan Presiden Nomor 12 Tahun 2021
                        tentang Perubahan atas Peraturan Presiden
                        Nomor 16 Tahun 2018 tentang Pengadaan
                        Barang/Jasa Pemerintah
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>


            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        Perka LKPP
                    </span>

                    <p class="peraturan-judul">
                        Peraturan LKPP Nomor 12 Tahun 2021
                        tentang Pedoman Pelaksanaan Pengadaan
                        Barang/Jasa Pemerintah Melalui Penyedia
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>


            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        Perbup
                    </span>

                    <p class="peraturan-judul">
                        Peraturan Bupati Mesuji Nomor 8 Tahun 2022
                        tentang Tata Cara Pengadaan Barang/Jasa
                        di Desa
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>


            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        SE
                    </span>

                    <p class="peraturan-judul">
                        Surat Edaran LKPP Nomor 5 Tahun 2022
                        tentang Penggunaan Produk Dalam Negeri
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>


            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        Perka LKPP
                    </span>

                    <p class="peraturan-judul">
                        Peraturan LKPP Nomor 9 Tahun 2018
                        tentang Pedoman Perencanaan Pengadaan
                        Barang/Jasa Pemerintah
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>


            <div class="peraturan-item">

                <div class="peraturan-info">

                    <span class="peraturan-kategori">
                        Perpres
                    </span>

                    <p class="peraturan-judul">
                        Peraturan Presiden Nomor 33 Tahun 2020
                        tentang Standar Harga Satuan Regional
                    </p>

                </div>

                <a
                    href="{{ url('/regulasi/detail') }}"
                    class="btn-lihat"
                >
                    Lihat
                </a>

            </div>

        </div>


        <div class="text-center mt-4">

            <a
                href="{{ url('/regulasi') }}"
                class="btn-primary"
            >
                Lihat Semua Peraturan
            </a>

        </div>

    </div>

</section>

@endsection