@extends('layouts.public')

@section('title', 'BPBJ Kabupaten Mesuji - Pengadaan Barang & Jasa')

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