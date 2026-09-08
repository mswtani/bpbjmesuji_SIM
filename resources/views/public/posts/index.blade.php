@extends('layouts.public')

@section('title', $pageTitle)

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