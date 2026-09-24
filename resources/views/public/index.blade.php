@extends('layouts.public')

@section('title', 'BPBJ Kabupaten Mesuji - Pengadaan Barang & Jasa')

@push('styles')
    <style>

        .btn-primary-public {
        display: inline-block;
        background-color: #d4af37;
        color: #0b2f64;
        padding: 12px 25px;
        text-decoration: none;
        border-radius: 6px;
        font-weight: 600;
        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }

    .btn-primary-public:hover {
        background-color: #0b2f64;
        color: #fff;
        text-decoration: none;
    }
        /* =========================================================
        PUBLIC HOMEPAGE - HERO
        ========================================================= */

        .public-hero-carousel {
            position: relative;
            width: calc(100% - 16px);
            max-width: 1600px;
            margin: 16px auto 0;
            overflow: hidden;
            border-radius: 18px;
            z-index: 1;
        }

        .public-hero-carousel .carousel {
            position: relative;
            width: 100%;
            margin: 0;
            overflow: hidden;
            border-radius: 18px;
        }

        .public-hero-carousel .carousel-inner {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 18px;
        }

        .public-hero-carousel .carousel-item {
            position: relative;
            width: 100%;
            overflow: hidden;
            border-radius: 18px;
        }

        .public-hero-carousel .hero-slide-link {
            position: relative;
            display: block;
            width: 100%;
            color: inherit;
            text-decoration: none;
            cursor: pointer;
            pointer-events: auto;
        }

        .public-hero-carousel .hero-slide-link:hover {
            color: inherit;
            text-decoration: none;
        }

        .public-hero-carousel .hero-slide-image {
            display: block;
            width: 100%;
            height: auto;
            max-width: 100%;
            object-fit: cover;
            border-radius: 18px;
        }

        .public-hero-carousel .hero-slide-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0, 0, 0, 0.42);
            pointer-events: none;
        }

        .public-hero-carousel .hero-slide-overlay-desktop {
            z-index: 5;
        }

        .public-hero-carousel .hero-slide-overlay-mobile {
            display: none;
        }

        .public-hero-carousel .carousel-caption {
            position: absolute;
            top: 50%;
            right: 15%;
            bottom: auto;
            left: 15%;
            transform: translateY(-50%);
            width: auto;
            padding: 20px;
            color: #ffffff;
            text-align: center;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.8);
            pointer-events: auto;
            z-index: 10;
        }

        .public-hero-carousel .carousel-caption h2 {
            margin-bottom: 12px;
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 700;
            line-height: 1.15;
        }

        .public-hero-carousel .carousel-caption p {
            margin-bottom: 0;
            font-size: clamp(1rem, 1.8vw, 1.25rem);
            line-height: 1.5;
        }

        .public-hero-carousel .carousel-caption .hero-caption-button {
            display: inline-block;
            margin-top: 25px;
            cursor: pointer;
            pointer-events: auto;
            background-color: #caa73e;
            border-color: #caa73e;
            color: #0b2e64;
            font-weight: 600;
        }

        .public-hero-carousel .carousel-caption .hero-caption-button:hover,
        .public-hero-carousel .carousel-caption .hero-caption-button:focus {
            background-color: #b8942f;
            border-color: #b8942f;
            color: #0b2e64;
        }

        .public-hero-carousel .carousel-caption,
        .public-hero-carousel .carousel-caption h2,
        .public-hero-carousel .carousel-caption p,
        .public-hero-carousel .carousel-caption span,
        .public-hero-carousel .hero-caption-button {
            pointer-events: auto;
        }

        .public-hero-carousel .hero-mobile-caption {
            display: none;
        }

        .public-hero-carousel .carousel-indicators {
            position: absolute;
            right: 0;
            bottom: 18px;
            left: 0;
            z-index: 30;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
            list-style: none;
            pointer-events: auto;
        }

        .public-hero-carousel .carousel-indicators button {
            width: 8px;
            height: 8px;
            margin-right: 5px;
            margin-left: 5px;
            padding: 0;
            border: 2px solid #ffffff;
            border-radius: 10px;
            background-color: #0b2f63;
            opacity: 1;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.8);
        }

        .public-hero-carousel .carousel-indicators button.active {
            background-color: #d4af37;
            border-color: #ffffff;
            opacity: 1;
            box-shadow:
                0 0 0 1px rgba(11, 47, 99, 0.9),
                0 1px 5px rgba(0, 0, 0, 0.8);
        }

        .public-hero-carousel .carousel-control-prev,
        .public-hero-carousel .carousel-control-next {
            position: absolute;
            z-index: 30;
            width: 10%;
            pointer-events: auto;
        }

        .public-hero-carousel .carousel-control-prev-icon,
        .public-hero-carousel .carousel-control-next-icon {
            width: 2.5rem;
            height: 2.5rem;
            filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.9));
        }


        /* =========================================================
        PUBLIC HOMEPAGE - LAYANAN
        ========================================================= */

        .layanan-section {
            padding: 40px 0;
            background-color: #fff;
            margin-top: 0;
            position: relative;
            z-index: 2;
            border-radius: 15px 15px 0 0;
            box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.05);
        }

        .layanan-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
        }

        .layanan-item {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            padding: 25px;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .layanan-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
            color: #1a4a8d;
        }

        .layanan-item .layanan-icon {
            display: block;
            height: 50px;
            width: auto;
            margin: 0 auto 15px;
            transition: transform 0.3s ease;
        }

        .layanan-item h4 {
            font-size: 18px;
            margin-bottom: 8px;
            font-weight: 600;
        }

        .layanan-item p {
            font-size: 14px;
            line-height: 1.5;
        }


        /* =========================================================
        PUBLIC HOMEPAGE - BERITA
        ========================================================= */

        .berita-section {
            padding: 50px 0;
            background-color: #f4f6f9;
        }

        .berita-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 30px;
        }

        .berita-card {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
            display: flex;
            flex-direction: column;
        }

        .berita-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .berita-card .berita-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .featured-article .berita-img {
            height: 250px;
        }

        .berita-content {
            padding: 20px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .berita-meta {
            font-size: 12px;
            color: #666;
            margin-bottom: 10px;
        }

        .berita-content h4 {
            font-size: 18px;
            margin-bottom: 15px;
            flex-grow: 1;
        }

        .featured-title {
            font-size: 22px;
        }

        .berita-excerpt {
            font-size: 14px;
            color: #555;
            margin-bottom: 15px;
        }

        .berita-content h4 a,
        .berita-card-small h4 a {
            color: #0b2f64;
            text-decoration: none;
            transition: transform 0.3s ease;
        }

        .berita-content h4 a:hover,
        .berita-card-small h4 a:hover {
            color: #d4af37;
            text-decoration: underline;
        }

        .berita-link {
            font-weight: 600;
            color: #1a4a8d;
            text-decoration: none;
            align-self: flex-start;
        }

        .berita-link:hover {
            color: #d4af37;
        }

        .berita-sidebar {
            display: grid;
            grid-template-rows: repeat(3, minmax(0, 1fr));
            gap: 20px;
            height: 100%;
        }

        .berita-card-small {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 0;
            transition:
                transform 0.3s ease,
                box-shadow 0.3s ease;
        }

        .berita-card-small:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
        }

        .berita-card-small h4 {
            font-size: 16px;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            overflow: hidden;
        }

        .berita-content-small {
            display: flex;
            flex-direction: column;
            height: 100%;
        }


        /* =========================================================
        PUBLIC HOMEPAGE - REGULASI
        ========================================================= */

        .regulasi-section {
            padding: 50px 0;
            background-color: #fff;
        }

        .peraturan-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .peraturan-list > .peraturan-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background-color: #f8fafc;
            transition: box-shadow 0.3s ease;
        }

        .peraturan-list > .peraturan-item:hover {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.07);
        }

        .peraturan-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .peraturan-kategori {
            background-color: #1a4a8d;
            color: #fff;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
            font-weight: bold;
            flex-shrink: 0;
        }

        .peraturan-judul {
            margin: 0;
            color: #333;
        }

        .btn-lihat {
            display: inline-flex;
            min-width: 70px;
            height: 38px;
            align-items: center;
            justify-content: center;
            box-sizing: border-box;
            border-radius: 7px;
            padding: 0 14px;
            background: #d4af37;
            color: #0b2f64;
            font-size: 13px;
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            transition:
                background-color 200ms ease,
                transform 200ms ease;
        }

        .btn-lihat:hover {
            background: #c5a12f;
            color: #0b2f64;
            transform: translateY(-1px);
        }


        /* =========================================================
        HOME RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {

            .layanan-section {
                margin-top: 0;
                border-radius: 0;
                padding: 30px 0;
            }

            .berita-sidebar {
                grid-template-rows: none;
                height: auto;
            }

            .berita-grid {
                grid-template-columns: 1fr;
            }

            .peraturan-list {
                grid-template-columns: 1fr;
            }

            .peraturan-item {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 12px;
                min-height: auto;
                padding: 14px;
            }

            .peraturan-info {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .peraturan-kategori {
                align-self: flex-start;
            }

            .peraturan-judul {
                width: 100%;
                text-align: left;
            }

            .btn-lihat {
                min-width: 70px;
                height: 38px;
                padding: 0 14px;
                font-size: 13px;
                font-weight: 600;
            }
        }

        @media (max-width: 480px) {

            .peraturan-item {
                display: flex;
                flex-direction: column;
                align-items: stretch;
                gap: 11px;
                padding: 13px;
            }

            .peraturan-info {
                display: flex;
                flex-direction: column;
                align-items: flex-start;
                gap: 9px;
            }

            .peraturan-judul {
                width: 100%;
                text-align: left;
            }

            .btn-lihat {
                align-self: center;
            }
        }


        /* =========================================================
        HERO RESPONSIVE
        ========================================================= */

        @media (max-width: 768px) {

            .public-hero-carousel {
                width: 100%;
                margin: 0 auto 0;
                border-radius: 0;
                overflow: hidden;
            }

            .public-hero-carousel .carousel,
            .public-hero-carousel .carousel-inner {
                width: 100%;
                height: 390px;
                border-radius: 0;
                overflow: hidden;
            }

            .public-hero-carousel .carousel-item {
                position: relative;
                width: 100%;
                height: 390px;
                border-radius: 0;
                overflow: hidden;
            }

            .public-hero-carousel .hero-slide-link {
                position: relative;
                display: block;
                width: 100%;
                height: 100%;
            }

            .public-hero-carousel .hero-slide-image {
                display: block;
                width: 100%;
                height: 100%;
                max-width: none;
                object-fit: cover;
                object-position: center;
                border-radius: 0;
            }

            .public-hero-carousel .hero-slide-overlay {
                position: absolute;
                inset: 0;
                background: rgba(0, 0, 0, 0.42);
                z-index: 5;
                pointer-events: none;
            }

            .public-hero-carousel .hero-slide-overlay-desktop {
                display: none;
            }

            .public-hero-carousel .hero-slide-overlay-mobile {
                display: block;
                z-index: 5;
            }

            .public-hero-carousel .carousel-caption {
                position: absolute;
                top: 50%;
                right: 8%;
                bottom: auto;
                left: 8%;
                transform: translateY(-50%);
                width: auto;
                padding: 10px;
                color: #ffffff;
                text-align: center;
                z-index: 10;
                pointer-events: none;
            }

            .public-hero-carousel .carousel-caption h2 {
                margin-bottom: 8px;
                font-size: clamp(1.25rem, 5.5vw, 1.65rem);
                font-weight: 700;
                line-height: 1.2;
                text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.9);
            }

            .public-hero-carousel .carousel-caption p {
                margin-bottom: 0;
                font-size: clamp(0.8rem, 3.5vw, 0.95rem);
                line-height: 1.4;
                text-shadow: 1px 1px 4px rgba(0, 0, 0, 0.9);
            }

            .public-hero-carousel .hero-mobile-caption {
                position: absolute;
                top: 50%;
                right: 8%;
                left: 8%;
                transform: translateY(-50%);
                display: block;
                padding: 10px;
                color: #ffffff;
                text-align: center;
                z-index: 10;
                pointer-events: none;
                text-shadow: 1px 1px 5px rgba(0, 0, 0, 0.9);
            }

            .public-hero-carousel .hero-mobile-caption h2 {
                margin-bottom: 8px;
                font-size: clamp(1.25rem, 5.5vw, 1.65rem);
                font-weight: 700;
                line-height: 1.2;
            }

            .public-hero-carousel .hero-mobile-caption p {
                margin-bottom: 0;
                font-size: clamp(0.8rem, 3.5vw, 0.95rem);
                line-height: 1.4;
            }

            .public-hero-carousel .hero-mobile-caption .hero-caption-button {
                display: inline-block;
                margin-top: 14px;
                padding: 8px 18px;
                background-color: #caa73e;
                border-color: #caa73e;
                color: #0b2e64;
                font-size: 0.85rem;
                font-weight: 600;
                line-height: 1.2;
                white-space: nowrap;
                border-radius: 5px;
                pointer-events: auto;
            }

            .public-hero-carousel .carousel-caption .hero-caption-button {
                display: inline-block;
                margin-top: 14px;
                padding: 8px 18px;
                background-color: #caa73e;
                border-color: #caa73e;
                color: #0b2e64;
                font-size: 0.85rem;
                font-weight: 600;
                line-height: 1.2;
                white-space: nowrap;
                border-radius: 5px;
                cursor: pointer;
                pointer-events: auto;
            }

            .public-hero-carousel .carousel-caption .hero-caption-button:hover,
            .public-hero-carousel .carousel-caption .hero-caption-button:focus {
                background-color: #b8942f;
                border-color: #b8942f;
                color: #0b2e64;
            }

            .public-hero-carousel .carousel-indicators {
                right: 0;
                bottom: 10px;
                left: 0;
                margin: 0;
                padding: 0;
                z-index: 30;
            }

            .public-hero-carousel .carousel-indicators button {
                width: 8px;
                height: 8px;
                margin-right: 3px;
                margin-left: 3px;
                border: 1px solid #ffffff;
                border-radius: 50%px;
                background-color: #0b2e64;
                opacity: 1;
            }

            .public-hero-carousel .carousel-indicators button.active {
                background-color: #caa73e;
                border-color: #ffffff;
            }

            .public-hero-carousel .carousel-control-prev,
            .public-hero-carousel .carousel-control-next {
                width: 13%;
                z-index: 30;
            }

            .public-hero-carousel .carousel-control-prev-icon,
            .public-hero-carousel .carousel-control-next-icon {
                width: 1.7rem;
                height: 1.7rem;
                filter: drop-shadow(0 1px 3px rgba(0, 0, 0, 0.9));
            }
        }
    
        @media (max-width: 360px) {
            .section-title {
                font-size: 18px;
            }
        }
    </style>
@endpush

@section('content')

{{-- =========================================================
    HERO
========================================================= --}}
<x-public.hero-carousel :carousels="$carousels" />


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
            Berita & Pengumuman
        </h3>

        @if ($posts->isNotEmpty())

            <div class="berita-grid">

                {{-- =================================================
                   BERITA UTAMA
                ================================================== --}}
                @php
                    // $featuredPost = $posts->first();

                    // $featuredDetailRoute = $featuredPost->type === 'announcement'
                    //     ? route('public.announcements.show', $featuredPost->slug)
                    //     : route('public.news.show', $featuredPost->slug);

                     $featuredPost = $posts->first();

                    $featuredDetailRoute = route(
                        'public.news.show',
                        $featuredPost->slug
                    );
                @endphp

                <article class="berita-card featured-article">

                    @if (
                        $featuredPost->featured_image &&
                        \Illuminate\Support\Facades\Storage::disk('public')->exists(
                            $featuredPost->featured_image
                        )
                    )
                        <a
                            href="{{ $featuredDetailRoute }}"
                            class="berita-img-link"
                        >
                            <img
                                src="{{ asset('storage/' . $featuredPost->featured_image) }}"
                                alt="{{ $featuredPost->title }}"
                                class="berita-img"
                            >
                        </a>
                    @endif

                    <div class="berita-content">

                        <p class="berita-meta">
                            {{ $featuredPost->published_at?->translatedFormat('d F Y') }}
                            |
                            {{ $featuredPost->type === 'announcement'
                                ? 'Pengumuman'
                                : 'Berita'
                            }}
                        </p>

                        <h4 class="featured-title">

                            <a
                                href="{{ $featuredDetailRoute }}"
                            >
                                {{ $featuredPost->title }}
                            </a>

                        </h4>

                        @if ($featuredPost->excerpt)
                            <p class="berita-excerpt">
                                {{ \Illuminate\Support\Str::limit(strip_tags($featuredPost->excerpt), 220) }}
                            </p>
                        @endif

                        <a
                            href="{{ $featuredDetailRoute }}"
                            class="berita-link"
                        >
                            Baca Selengkapnya &rarr;
                        </a>

                    </div>

                </article>


                {{-- =================================================
                   3 BERITA BERIKUTNYA
                ================================================== --}}
                @if ($posts->count() > 1)

                    <div class="berita-sidebar">

                        @foreach ($posts->skip(1) as $post)

                            @php
                                $detailRoute = route(
                                    'public.news.show',
                                    ['slug' => $post->slug]
                                );
                            @endphp

                            <article class="berita-card-small">

                                <div class="berita-content-small">

                                    <p class="berita-meta">
                                        {{ $post->published_at?->translatedFormat('d F Y') }}
                                        |
                                        {{ $post->type === 'announcement'
                                            ? 'Pengumuman'
                                            : 'Berita'
                                        }}
                                    </p>

                                    <h4>
                                        <a href="{{ $detailRoute }}">
                                            {{ $post->title }}
                                        </a>
                                    </h4>

                                    <a
                                        href="{{ $detailRoute }}"
                                        class="berita-link"
                                    >
                                        Baca Selengkapnya &rarr;
                                    </a>

                                </div>

                            </article>

                        @endforeach

                    </div>

                @endif

            </div>

        @else

            <div class="berita-empty">
                Belum ada berita atau pengumuman yang dipublikasikan.
            </div>

        @endif


        {{-- =================================================
           SEMUA BERITA
        ================================================== --}}
        <div class="text-center mt-4">

            <a
                href="{{ route('public.news') }}"
                class="btn-primary-public"
            >
                Lihat Semua Berita & Pengumuman
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
            Regulasi PBJ Kabupaten Mesuji
        </h3>

        <div class="peraturan-list">

            @foreach ($regulations as $regulation)

                @php
                    $regulationTypeName = strtolower(
                        $regulation->regulationType?->name ?? ''
                    );

                    $regulationTypeLabel = match (true) {
                        str_contains($regulationTypeName, 'presiden')
                            => 'Perpres',

                        str_contains($regulationTypeName, 'lembaga kebijakan')
                            => 'Perka LKPP',

                        str_contains($regulationTypeName, 'bupati')
                            => 'Perbup',

                        str_contains($regulationTypeName, 'surat edaran')
                            => 'SE',

                        default
                            => $regulation->regulationType?->name ?? 'Regulasi',
                    };
                @endphp

                <div class="peraturan-item">

                    <div class="peraturan-info">

                        <span class="peraturan-kategori">
                            {{ $regulationTypeLabel }}
                        </span>

                        <p class="peraturan-judul">
                            {{ $regulation->title }}
                        </p>

                    </div>

                    <a
                        href="{{ route(
                            'public.regulations.show',
                            ['slug' => $regulation->slug]
                        ) }}"
                        class="btn-lihat"
                    >
                        Lihat
                    </a>

                </div>

            @endforeach

        </div>

        <div class="text-center mt-4">

            <a
                href="{{ route('public.regulations') }}"
                class="btn-primary-public"
            >
                Lihat Semua Peraturan
            </a>

        </div>

    </div>

</section>


@endsection