@extends('layouts.public')

@section('title', $pageTitle)

@push('styles')
    <style>
        /* =========================================================
        PUBLIC POSTS INDEX
        ========================================================= */

        .public-posts-page {
            width: 100%;
            padding: 48px 0 60px;
            background: #f4f6f9;
        }

        .public-posts-container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* HEADER */

        .public-posts-header {
            margin-bottom: 28px;
        }

        .public-posts-title {
            display: flex;
            align-items: center;
            gap: 10px;
            margin: 0 0 10px;
            color: #0b2f64;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.3;
        }

        .public-posts-title::before {
            content: "";
            display: block;
            width: 5px;
            height: 30px;
            flex-shrink: 0;
            background: #d4af37;
        }

        .public-posts-description {
            margin: 10px 0 0;
            color: #64748b;
            font-size: 15px;
            line-height: 1.6;
        }

        /* TOOLBAR */

        .public-posts-toolbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        /* SEARCH */

        .public-posts-search {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 10px;
            flex: 1;
            min-width: 0;
        }

        .public-posts-search-field {
            position: relative;
            min-width: 0;
        }

        .public-posts-search-field svg {
            position: absolute;
            top: 50%;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #94a3b8;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .public-posts-search-field input {
            display: block;
            width: 100%;
            min-width: 0;
            height: 44px;
            padding: 0 14px 0 42px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            color: #1f2937;
            font-size: 14px;
            outline: none;
            transition:
                border-color 0.2s,
                box-shadow 0.2s;
        }

        .public-posts-search-field input::placeholder {
            color: #9ca3af;
        }

        .public-posts-search-field input:focus {
            border-color: #1a4a8d;
            box-shadow: 0 0 0 3px rgba(26, 74, 141, 0.1);
        }

        .public-posts-search-button {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 78px;
            height: 44px;
            padding: 0 18px;
            border: 1px solid #0b2f64;
            border-radius: 8px;
            background: #0b2f64;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition:
                background 0.2s,
                border-color 0.2s,
                transform 0.2s;
        }

        .public-posts-search-button:hover {
            background: #1a4a8d;
            border-color: #1a4a8d;
        }

        /* FILTER */

        .public-posts-filter {
            display: flex;
            flex-shrink: 0;
            align-items: center;
            gap: 6px;
            padding: 4px;
            border: 1px solid #e2e8f0;
            border-radius: 9px;
            background: #fff;
        }

        .public-posts-filter a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-height: 36px;
            padding: 0 14px;
            border-radius: 6px;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition:
                background 0.2s,
                color 0.2s;
        }

        .public-posts-filter a:hover {
            background: #f1f5f9;
            color: #0b2f64;
        }

        .public-posts-filter a.active {
            background: #0b2f64;
            color: #fff;
        }

        /* RESET */

        .public-posts-reset-button {
            display: inline-flex;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 44px;
            padding: 0 15px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            color: #64748b;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            white-space: nowrap;
            transition:
                background 0.2s,
                border-color 0.2s,
                color 0.2s;
        }

        .public-posts-reset-button svg {
            width: 16px;
            height: 16px;
        }

        .public-posts-reset-button:hover {
            border-color: #cbd5e1;
            background: #f8fafc;
            color: #0b2f64;
        }

        /* RESULT INFO */

        .public-posts-result-info {
            margin: -8px 0 20px;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }

        .public-posts-result-info strong {
            color: #334155;
        }

        /* GRID */

        .public-posts-grid {
            display: grid;
            grid-template-columns: repeat(3, minmax(0, 1fr));
            gap: 24px;
        }

        /* CARD */

        .public-post-card {
            display: flex;
            min-width: 0;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            transition:
                transform 0.25s ease,
                box-shadow 0.25s ease;
        }

        .public-post-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.09);
        }

        /* IMAGE */

        .public-post-card-image-link {
            display: block;
            overflow: hidden;
            background: #f8fafc;
            text-decoration: none;
        }

        .public-post-card-image {
            display: block;
            width: 100%;
            height: 210px;
            object-fit: cover;
            transition: transform 0.35s ease;
        }

        .public-post-card:hover .public-post-card-image {
            transform: scale(1.025);
        }

        .public-post-card-placeholder {
            display: flex;
            height: 210px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: #f1f5f9;
            color: #94a3b8;
        }

        .public-post-card-placeholder svg {
            width: 34px;
            height: 34px;
        }

        .public-post-card-placeholder span {
            font-size: 12px;
        }

        /* BODY */

        .public-post-card-body {
            display: flex;
            min-width: 0;
            flex: 1;
            flex-direction: column;
            padding: 20px;
        }

        /* META */

        .public-post-card-meta {
            display: flex;
            min-width: 0;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            margin-bottom: 11px;
            color: #64748b;
            font-size: 12px;
        }

        .public-post-card-type {
            display: inline-flex;
            align-items: center;
            max-width: 100%;
            padding: 4px 9px;
            border-radius: 5px;
            font-size: 11px;
            font-weight: 700;
            line-height: 1.2;
            white-space: nowrap;
        }

        .public-post-card-type.news {
            background: #e8f0fb;
            color: #1a4a8d;
        }

        .public-post-card-type.announcement {
            background: #fff4d6;
            color: #8a6800;
        }

        /* TITLE */

        .public-post-card-title {
            display: -webkit-box;
            min-width: 0;
            margin: 0;
            overflow: hidden;
            color: #0b2f64;
            font-size: 19px;
            font-weight: 650;
            line-height: 1.4;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        .public-post-card-title a {
            color: inherit;
            text-decoration: none;
        }

        .public-post-card-title a:hover {
            color: #1a4a8d;
        }

        /* EXCERPT */

        .public-post-card-excerpt {
            display: -webkit-box;
            margin: 12px 0 0;
            overflow: hidden;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
        }

        /* FOOTER / LINK */

        .public-post-card-footer {
            margin-top: auto;
            padding-top: 18px;
        }

        .public-post-card-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            color: #1a4a8d;
            font-size: 13px;
            font-weight: 700;
            text-decoration: none;
        }

        .public-post-card-link:hover {
            color: #0b2f64;
        }

        .public-post-card-link span {
            transition: transform 0.2s ease;
        }

        .public-post-card-link:hover span {
            transform: translateX(3px);
        }

        /* EMPTY STATE */

        .public-posts-empty {
            grid-column: 1 / -1;
            display: flex;
            min-height: 300px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 20px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            background: #fff;
            text-align: center;
        }

        .public-posts-empty svg {
            width: 44px;
            height: 44px;
            margin-bottom: 14px;
            color: #94a3b8;
        }

        .public-posts-empty h2 {
            margin: 0;
            color: #334155;
            font-size: 18px;
            font-weight: 700;
        }

        .public-posts-empty p {
            max-width: 500px;
            margin: 8px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }

        .public-posts-reset {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-top: 18px;
            min-height: 40px;
            padding: 0 16px;
            border-radius: 7px;
            background: #0b2f64;
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
        }

        .public-posts-reset:hover {
            background: #1a4a8d;
        }

        /* =========================================================
        PAGINATION
        ========================================================== */

        .public-posts-pagination {
            margin-top: 28px;
        }

        .public-pagination-wrapper {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 20px;
            margin-top: 28px;
        }

        .public-pagination-info {
            margin: 0;
            color: #6b7280;
            font-size: 13px;
            line-height: 1.5;
        }

        .public-pagination-nav {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 6px;
        }

        .public-pagination-page,
        .public-pagination-arrow {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 36px;
            height: 36px;
            box-sizing: border-box;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: #ffffff;
            color: #374151;
            font-size: 13px;
            font-weight: 500;
            line-height: 1;
            text-decoration: none;
        }

        .public-pagination-page-link,
        .public-pagination-arrow-link {
            transition:
                background-color 200ms ease,
                border-color 200ms ease,
                color 200ms ease;
        }

        .public-pagination-page-link:hover,
        .public-pagination-arrow-link:hover {
            border-color: #174ea6;
            background: #174ea6;
            color: #ffffff;
        }

        .public-pagination-page-active {
            border-color: #174ea6;
            background: #174ea6;
            color: #ffffff;
        }

        .public-pagination-arrow {
            font-size: 20px;
        }

        .public-pagination-arrow-disabled {
            background: #f8fafc;
            color: #cbd5e1;
            cursor: default;
        }

        .public-pagination-ellipsis {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            min-width: 28px;
            height: 36px;
            color: #6b7280;
            font-size: 14px;
            line-height: 1;
        }

        /* =========================================================
PUBLIC POSTS - TABLET
========================================================= */

@media (max-width: 992px) {
    .public-posts-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .public-posts-toolbar {
        align-items: stretch;
        flex-direction: column;
    }

    .public-posts-search {
        width: 100%;
    }

    .public-posts-filter {
        align-self: flex-start;
    }
}


/* =========================================================
PUBLIC POSTS - MOBILE
========================================================= */

@media (max-width: 768px) {
    .public-posts-page {
        padding: 35px 0 45px;
    }

    .public-posts-container {
        width: 92%;
    }

    .public-posts-header {
        margin-bottom: 22px;
    }

    .public-posts-title {
        font-size: 27px;
    }

    .public-posts-description {
        margin-top: 8px;
        font-size: 14px;
    }

    .public-posts-search {
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .public-posts-search-button {
        width: 100%;
    }

    .public-posts-filter {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .public-posts-filter a {
        min-width: 0;
        width: 100%;
        padding: 0 6px;
        font-size: 12px;
    }

    .public-posts-grid {
        grid-template-columns: 1fr;
        gap: 18px;
    }

    .public-post-card-image,
    .public-post-card-placeholder {
        height: 210px;
    }

    .public-post-card-body {
        padding: 18px;
    }

    .public-post-card-title {
        font-size: 18px;
    }
}


/* =========================================================
PUBLIC POSTS - SMALL MOBILE
========================================================= */

@media (max-width: 360px) {
    .public-posts-page {
        padding-top: 28px;
        padding-bottom: 35px;
    }

    .public-posts-container {
        width: 95%;
    }

    .public-posts-title {
        font-size: 23px;
    }

    .public-posts-description {
        font-size: 13px;
        line-height: 1.5;
    }

    .public-posts-search-field input {
        height: 42px;
        padding-left: 39px;
        padding-right: 10px;
        font-size: 13px;
    }

    .public-posts-search-field svg {
        left: 12px;
        width: 17px;
        height: 17px;
    }

    .public-posts-search-button {
        height: 42px;
        min-width: 0;
        font-size: 13px;
    }

    .public-posts-filter {
        gap: 4px;
        padding: 3px;
    }

    .public-posts-filter a {
        min-height: 34px;
        padding: 0 3px;
        font-size: 11px;
    }

    .public-posts-toolbar {
        align-items: stretch;
        flex-direction: column;
        gap: 12px;
    }

    .public-posts-search {
        width: 100%;
        grid-template-columns: 1fr;
        gap: 10px;
    }

    .public-posts-search-button {
        width: 100%;
    }

    .public-posts-filter {
        width: 100%;
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
    }

    .public-posts-filter a {
        width: 100%;
        min-width: 0;
        padding-left: 5px;
        padding-right: 5px;
    }

    .public-posts-reset-button {
        width: 100%;
        min-height: 42px;
    }

    .public-posts-result-info {
        font-size: 12px;
    }

    .public-post-card-image,
    .public-post-card-placeholder {
        height: 190px;
    }

    .public-post-card-body {
        padding: 16px;
    }

    .public-post-card-meta {
        font-size: 11px;
    }

    .public-post-card-type {
        padding: 4px 7px;
        font-size: 10px;
    }

    .public-post-card-title {
        font-size: 17px;
        line-height: 1.4;
    }

    .public-post-card-excerpt {
        font-size: 13px;
        line-height: 1.55;
    }

    .public-post-card-link {
        font-size: 12px;
    }
}


/* =========================================================
PUBLIC POSTS - EXTRA SMALL
========================================================= */

@media (max-width: 320px) {
    .public-posts-container {
        width: 94%;
    }

    .public-posts-title {
        font-size: 21px;
    }

    .public-posts-filter a {
        font-size: 10px;
    }

    .public-post-card-image,
    .public-post-card-placeholder {
        height: 175px;
    }

    .public-post-card-body {
        padding: 14px;
    }

    .public-post-card-title {
        font-size: 16px;
    }

    .public-post-card-excerpt {
        font-size: 12px;
    }
}

        /* =========================================================
        PAGINATION MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .public-pagination-wrapper {
                flex-direction: column;
                align-items: center;
                gap: 12px;
            }

            .public-pagination-info {
                text-align: center;
            }

            .public-pagination-nav {
                justify-content: center;
                flex-wrap: wrap;
            }

        }

        
    </style>
@endpush

@section('content')

<div class="public-posts-page">

    <div class="public-posts-container">

        {{-- =====================================================
            HEADER
        ====================================================== --}}

        <div class="public-posts-header">

            <h1 class="public-posts-title">
                {{ $pageTitle }}
            </h1>

            <p class="public-posts-description">
                {{ $pageDescription }}
            </p>

        </div>


        {{-- =====================================================
            SEARCH & FILTER
        ====================================================== --}}

        <div class="public-posts-toolbar">

            {{-- SEARCH --}}

            <form
                method="GET"
                action="{{ route('public.news') }}"
                class="public-posts-search"
            >

                @if ($type !== 'all')
                    <input
                        type="hidden"
                        name="type"
                        value="{{ $type }}"
                    >
                @endif

                <div class="public-posts-search-field">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-3.5-3.5"></path>
                    </svg>

                    <input
                        type="search"
                        name="search"
                        value="{{ $search }}"
                        placeholder="Cari berita atau pengumuman..."
                        aria-label="Cari berita atau pengumuman"
                    >

                </div>

                <button
                    type="submit"
                    class="public-posts-search-button"
                >
                    Cari
                </button>

            </form>


            {{-- FILTER --}}

            <div class="public-posts-filter">

                <a
                    href="{{ route('public.news', array_filter([
                        'search' => $search,
                    ])) }}"
                    class="{{ $type === 'all' ? 'active' : '' }}"
                >
                    Semua
                </a>

                <a
                    href="{{ route('public.news', array_filter([
                        'type' => 'news',
                        'search' => $search,
                    ])) }}"
                    class="{{ $type === 'news' ? 'active' : '' }}"
                >
                    Berita
                </a>

                <a
                    href="{{ route('public.news', array_filter([
                        'type' => 'announcement',
                        'search' => $search,
                    ])) }}"
                    class="{{ $type === 'announcement' ? 'active' : '' }}"
                >
                    Pengumuman
                </a>

            </div>


            {{-- RESET SEARCH & FILTER --}}

            @if ($search !== '' || $type !== 'all')

                <a
                    href="{{ route('public.news') }}"
                    class="public-posts-reset-button"
                >
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        aria-hidden="true"
                    >
                        <path d="M3 12a9 9 0 1 0 3-6.7"></path>
                        <path d="M3 4v5h5"></path>
                    </svg>

                    Reset
                </a>

            @endif

        </div>


        {{-- =====================================================
            INFO HASIL
        ====================================================== --}}

        @if ($search !== '' || $type !== 'all')

            <div class="public-posts-result-info">

                Menampilkan
                <strong>{{ $posts->total() }}</strong>
                konten

                @if ($search !== '')
                    untuk pencarian
                    <strong>"{{ $search }}"</strong>
                @endif

                @if ($type === 'news')
                    dalam kategori <strong>Berita</strong>
                @elseif ($type === 'announcement')
                    dalam kategori <strong>Pengumuman</strong>
                @endif

            </div>

        @endif


        {{-- =====================================================
            POSTS GRID
        ====================================================== --}}

        <div class="public-posts-grid">

            @forelse ($posts as $post)

                @php

                    // $isAnnouncement =
                    //     $post->type === 'announcement';

                    // $detailRoute = $isAnnouncement
                    //     ? route(
                    //         'public.announcements.show',
                    //         $post->slug
                    //     )
                    //     : route(
                    //         'public.news.show',
                    //         $post->slug
                    //     );

                    // $typeLabel = $isAnnouncement
                    //     ? 'Pengumuman'
                    //     : 'Berita';


                        $detailRoute = route(
                            'public.news.show',
                            $post->slug
                        );

                        $typeLabel = $post->type === 'announcement'
                            ? 'Pengumuman'
                            : 'Berita';
                @endphp


                <article class="public-post-card">

                    {{-- IMAGE --}}

                    @if (
                        $post->featured_image &&
                        \Illuminate\Support\Facades\Storage::disk('public')
                            ->exists($post->featured_image)
                    )

                        <a
                            href="{{ $detailRoute }}"
                            class="public-post-card-image-link"
                        >

                            <img
                                src="{{ asset('storage/' . $post->featured_image) }}"
                                alt="{{ $post->title }}"
                                class="public-post-card-image"
                                loading="lazy"
                            >

                        </a>

                    @else

                        <a
                            href="{{ $detailRoute }}"
                            class="public-post-card-image-link"
                        >

                            <div class="public-post-card-placeholder">

                                <svg
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.5"
                                    aria-hidden="true"
                                >
                                    <rect
                                        x="3"
                                        y="3"
                                        width="18"
                                        height="18"
                                        rx="2"
                                    />

                                    <circle
                                        cx="8.5"
                                        cy="8.5"
                                        r="1.5"
                                    />

                                    <path
                                        d="m21 15-5-5L5 21"
                                    />
                                </svg>

                                <span>
                                    Tidak ada gambar
                                </span>

                            </div>

                        </a>

                    @endif


                    {{-- CONTENT --}}

                    <div class="public-post-card-body">
                        @php
                            $isAnnouncement = $post->type === 'announcement';

                            $typeLabel = $isAnnouncement
                                ? 'Pengumuman'
                                : 'Berita';
                        @endphp
                        
                        {{-- META --}}

                        <div class="public-post-card-meta">

                            <span
                                class="public-post-card-type {{ $isAnnouncement ? 'announcement' : 'news' }}"
                            >
                                {{ $typeLabel }}
                            </span>

                            @if ($post->published_at)

                                <time
                                    datetime="{{ $post->published_at->toIso8601String() }}"
                                >
                                    {{ $post->published_at->format('d M Y') }}
                                </time>

                            @endif

                        </div>


                        {{-- TITLE --}}

                        <h2 class="public-post-card-title">

                            <a href="{{ $detailRoute }}">
                                {{ $post->title }}
                            </a>

                        </h2>


                        {{-- EXCERPT --}}

                       @if ($post->excerpt)

                            <div class="public-post-card-excerpt">
                                {!! $post->excerpt !!}
                            </div>

                        @endif


                        {{-- LINK --}}

                        <div class="public-post-card-footer">

                            <a
                                href="{{ $detailRoute }}"
                                class="public-post-card-link"
                            >
                                Baca selengkapnya
                                <span aria-hidden="true">→</span>
                            </a>

                        </div>

                    </div>

                </article>

            @empty

                {{-- EMPTY STATE --}}

                <div class="public-posts-empty">

                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.5"
                        aria-hidden="true"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M9 13h6m-6 4h6M9 9h6"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 3h9l3 3v15H6V3Z"
                        />

                    </svg>

                    <h2>
                        Tidak ada konten
                    </h2>

                    <p>

                        @if ($search !== '')

                            Tidak ditemukan berita atau pengumuman
                            dengan kata pencarian
                            <strong>"{{ $search }}"</strong>.

                        @elseif ($type === 'news')

                            Belum ada berita yang tersedia.

                        @elseif ($type === 'announcement')

                            Belum ada pengumuman yang tersedia.

                        @else

                            Belum ada berita atau pengumuman
                            yang tersedia.

                        @endif

                    </p>

                    @if ($search !== '' || $type !== 'all')

                        <a
                            href="{{ route('public.news') }}"
                            class="public-posts-reset"
                        >
                            Tampilkan Semua
                        </a>

                    @endif

                </div>

            @endforelse

        </div>


        {{-- =====================================================
            PAGINATION
        ====================================================== --}}

        <div class="public-posts-pagination">

            <x-public.pagination
                :paginator="$posts"
                label="konten"
            />

        </div>

    </div>

</div>

@endsection