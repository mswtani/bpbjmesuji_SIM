@extends('layouts.public')

@section('title', 'Hasil Pencarian')

@push('styles')
    <style>
        /* =========================================================
        PUBLIC SEARCH
        ========================================================= */

        .public-search-page {
            width: 100%;
            padding: 42px 0 60px;
            background: #f4f6f9;
        }

        .public-search-container {
            width: min(100% - 32px, 1200px);
            margin: 0 auto;
        }


        /* =========================================================
        HEADER
        ========================================================= */

        .public-search-header {
            margin-bottom: 24px;
        }

        .public-search-title {
            max-width: 100%;
            margin: 0;
            padding-left: 10px;
            border-left: 5px solid #d4af37;
            box-sizing: border-box;

            color: #0b2f64;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.3;
            overflow-wrap: anywhere;
        }

        .public-search-description {
            margin: 12px 0 0;
            color: #64748b;
            font-size: 14px;
            line-height: 1.6;
        }


        /* =========================================================
        SEARCH FORM
        ========================================================= */

        .public-search-form {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 10px;
            margin-bottom: 24px;
        }

        .public-search-input-wrapper {
            position: relative;
            min-width: 0;
        }

        .public-search-input-wrapper svg {
            position: absolute;
            top: 50%;
            left: 14px;
            width: 18px;
            height: 18px;
            color: #64748b;
            transform: translateY(-50%);
            pointer-events: none;
        }

        .public-search-input-wrapper input {
            width: 100%;
            min-height: 44px;
            box-sizing: border-box;
            border: 1px solid #d7dee8;
            border-radius: 7px;
            padding: 0 14px 0 42px;
            outline: none;
            background: #ffffff;
            color: #1e293b;
            font-size: 14px;
        }

        .public-search-input-wrapper input:focus {
            border-color: #174ea6;
        }

        .public-search-button {
            min-width: 80px;
            min-height: 44px;
            border: 0;
            border-radius: 7px;
            padding: 0 18px;
            background: #174ea6;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
        }


        /* =========================================================
        RESULT INFO
        ========================================================= */

        .public-search-result-info {
            margin-bottom: 14px;
            color: #64748b;
            font-size: 13px;
        }


        /* =========================================================
        RESULT LIST
        ========================================================= */

        .public-search-list {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .public-search-card {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 20px;
            align-items: center;

            min-width: 0;
            padding: 18px 20px;

            border: 1px solid #dce3ec;
            border-radius: 10px;
            background: #ffffff;

            box-shadow: 0 3px 12px rgba(15, 23, 42, .04);

            transition:
                transform 200ms ease,
                box-shadow 200ms ease;
        }

        .public-search-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(15, 23, 42, .08);
        }

        .public-search-card-content {
            min-width: 0;
        }

        .public-search-card-meta {
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
            margin-bottom: 7px;
        }

        .public-search-type {
            display: inline-flex;
            min-height: 25px;
            align-items: center;
            border-radius: 999px;
            padding: 0 10px;
            font-size: 11px;
            font-weight: 600;
            line-height: 1;
        }

        .public-search-type-news {
            background: #e8f0ff;
            color: #174ea6;
        }

        .public-search-type-announcement {
            background: #fff3d6;
            color: #9a6700;
        }

        .public-search-type-regulation {
            background: #e8f0ff;
            color: #174ea6;
        }

        .public-search-date {
            color: #64748b;
            font-size: 12px;
        }

        .public-search-card-title {
            margin: 0;
            color: #0b2f64;
            font-size: 18px;
            font-weight: 500;
            line-height: 1.45;
        }

        .public-search-card-title a {
            color: inherit;
            text-decoration: none;
        }

        .public-search-card-title a:hover {
            color: #174ea6;
        }

        .public-search-card-excerpt {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.6;
        }

        .public-search-card-link {
            display: inline-flex;
            min-width: 70px;
            height: 38px;
            align-items: center;
            justify-content: center;

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

        .public-search-card-link:hover {
            background: #c5a12f;
            color: #0b2f64;
            transform: translateY(-1px);
        }


        /* =========================================================
        EMPTY
        ========================================================= */

        .public-search-empty {
            padding: 50px 20px;
            border: 1px solid #dce3ec;
            border-radius: 10px;
            background: #ffffff;
            text-align: center;
        }

        .public-search-empty-icon {
            display: flex;
            justify-content: center;
            margin-bottom: 12px;
        }

        .public-search-empty-icon svg {
            width: 42px;
            height: 42px;
            color: #94a3b8;
        }

        .public-search-empty h2 {
            margin: 0;
            color: #0b2f64;
            font-size: 20px;
            font-weight: 500;
        }

        .public-search-empty p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 13px;
        }


        /* =========================================================
        MOBILE
        ========================================================= */

        @media (max-width: 768px) {

            .public-search-page {
                padding: 30px 0 45px;
            }

            .public-search-container {
                width: calc(100% - 28px);
            }

            .public-search-title {
                padding-left: 9px;
                border-left-width: 4px;
                font-size: 24px;
            }

            .public-search-form {
                grid-template-columns: 1fr;
            }

            .public-search-button {
                width: 100%;
            }

            .public-search-card {
                grid-template-columns: 1fr;
                gap: 14px;
                padding: 15px;
            }

            .public-search-card-link {
                width: fit-content;
                min-width: 70px;
                justify-self: center;
            }

            .public-search-card-title {
                font-size: 16px;
            }

        }

        @media (max-width: 480px) {

            .public-search-container {
                width: calc(100% - 24px);
            }

            .public-search-title {
                padding-left: 8px;
                border-left-width: 4px;
                font-size: 23px;
            }

        }

        /* =========================================================
        PAGINATION
        ========================================================= */

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

<main class="public-search-page">

    <div class="public-search-container">

        {{-- HEADER --}}
        <header class="public-search-header">

            <h1 class="public-search-title">
                Hasil Pencarian
            </h1>

            @if ($search !== '')
                <p class="public-search-description">
                    Menampilkan hasil pencarian untuk:
                    <strong>"{{ $search }}"</strong>
                </p>
            @else
                <p class="public-search-description">
                    Silakan masukkan kata kunci untuk mencari berita,
                    pengumuman, atau regulasi.
                </p>
            @endif

        </header>


        {{-- SEARCH FORM --}}
        <form
            method="GET"
            action="{{ route('public.search') }}"
            class="public-search-form"
        >

            <div class="public-search-input-wrapper">

                <svg
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    aria-hidden="true"
                >
                    <circle
                        cx="11"
                        cy="11"
                        r="7"
                    />

                    <path
                        stroke-linecap="round"
                        d="m20 20-3.5-3.5"
                    />
                </svg>

                <input
                    type="search"
                    name="q"
                    value="{{ $search }}"
                    placeholder="Cari berita, pengumuman, atau regulasi..."
                    aria-label="Cari seluruh konten"
                >

            </div>

            <button
                type="submit"
                class="public-search-button"
            >
                Cari
            </button>

        </form>


        {{-- HASIL --}}
        @if ($search !== '')

            <div class="public-search-result-info">

                <span>
                    {{ $posts->total() }}
                    hasil ditemukan
                </span>

            </div>

        @endif


        @if ($posts->count())

            <div class="public-search-list">

                @foreach ($posts as $post)

                    @php
                        $isRegulation = $post->type === 'regulation';
                        $isAnnouncement = $post->type === 'announcement';

                        $typeLabel = $isRegulation
                            ? 'Regulasi'
                            : ($isAnnouncement
                                ? 'Pengumuman'
                                : 'Berita');

                        $detailRoute = $isRegulation
                            ? route(
                                'public.regulations.show',
                                ['slug' => $post->slug]
                            )
                            : route(
                                'public.news.show',
                                ['slug' => $post->slug]
                            );
                    @endphp

                    <article class="public-search-card">

                        <div class="public-search-card-content">

                            <div class="public-search-card-meta">

                                <span
                                    class="
                                        public-search-type
                                        public-search-type-{{ $post->type }}
                                    "
                                >
                                    {{ $typeLabel }}
                                </span>

                                @if ($post->published_at)
                                    <span class="public-search-date">
                                        {{ $post->published_at->translatedFormat('d F Y') }}
                                    </span>
                                @endif

                            </div>

                            <h2 class="public-search-card-title">

                                <a href="{{ $detailRoute }}">
                                    {{ $post->title }}
                                </a>

                            </h2>

                            @if ($post->excerpt)
                                <p class="public-search-card-excerpt">
                                    {{ \Illuminate\Support\Str::limit(
                                        strip_tags($post->excerpt),
                                        180
                                    ) }}
                                </p>
                            @endif

                        </div>

                        <a
                            href="{{ $detailRoute }}"
                            class="public-search-card-link"
                        >
                            Lihat
                        </a>

                    </article>

                @endforeach

            </div>


            {{-- PAGINATION --}}
            <div class="public-posts-pagination">

                <x-public.pagination
                    :paginator="$posts"
                    label="hasil pencarian"
                />

            </div>

        @else

            <div class="public-search-empty">

                <div class="public-search-empty-icon">
                    <svg
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        aria-hidden="true"
                    >
                        <circle
                            cx="11"
                            cy="11"
                            r="7"
                        />

                        <path
                            stroke-linecap="round"
                            d="m20 20-3.5-3.5"
                        />
                    </svg>
                </div>

                <h2>
                    Tidak ada hasil pencarian
                </h2>

                <p>
                    Coba gunakan kata kunci yang berbeda.
                </p>

            </div>

        @endif

    </div>

</main>



@endsection