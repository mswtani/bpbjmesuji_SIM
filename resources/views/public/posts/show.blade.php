@extends('layouts.public')

@section('title', $post->title)

@section('content')

@php
    /*
    |--------------------------------------------------------------------------
    | BASIC DATA
    |--------------------------------------------------------------------------
    */

    $isAnnouncement = $post->type === 'announcement';

    $typeLabel = $isAnnouncement
        ? 'Pengumuman'
        : 'Berita';

    $typeClasses = $isAnnouncement
        ? 'public-post-type-announcement'
        : 'public-post-type-news';

    $backRoute = route('public.news');


    /*
    |--------------------------------------------------------------------------
    | FEATURED IMAGE
    |--------------------------------------------------------------------------
    */

    $hasFeaturedImage =
        $post->featured_image &&
        \Illuminate\Support\Facades\Storage::disk('public')->exists(
            $post->featured_image
        );


    /*
    |--------------------------------------------------------------------------
    | CONTENT
    |--------------------------------------------------------------------------
    */

    $content = html_entity_decode(
        $post->content ?? '',
        ENT_QUOTES | ENT_HTML5,
        'UTF-8'
    );


    /*
    |--------------------------------------------------------------------------
    | INFORMASI LAINNYA
    |--------------------------------------------------------------------------
    |
    | Berita dan pengumuman terbaru selain post yang sedang dibaca.
    |
    */

    $relatedPosts = \App\Models\Post::query()
        ->whereIn('type', ['news', 'announcement'])
        ->where('status', 'published')
        ->whereNotNull('published_at')
        ->where('id', '!=', $post->id)
        ->latest('published_at')
        ->take(4)
        ->get();
@endphp

@push('styles')
<style>
    /*
    |--------------------------------------------------------------------------
    | PUBLIC POST DETAIL
    |--------------------------------------------------------------------------
    */

    .public-post-show {
        width: 100%;
        min-width: 0;
        padding: 40px 0 60px;
        background: #f4f6f9;
        overflow-x: hidden;
    }


    .public-post-show *,
    .public-post-show *::before,
    .public-post-show *::after {
        box-sizing: border-box;
        min-width: 0;
    }


    .public-post-show-container {
        width: min(1200px, calc(100% - 32px));
        margin: 0 auto;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN LAYOUT
    |--------------------------------------------------------------------------
    */

    .public-post-layout {
        display: grid;
        grid-template-columns: minmax(0, 2fr) minmax(280px, 1fr);
        gap: 30px;
        align-items: start;
    }


    /*
    |--------------------------------------------------------------------------
    | MAIN ARTICLE CARD
    |--------------------------------------------------------------------------
    */

    .public-post-main-card {
        min-width: 0;
        overflow: hidden;
        border: 1px solid #e5e7eb;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 16px rgba(15, 23, 42, 0.06);
    }


    /*
    |--------------------------------------------------------------------------
    | HEADER
    |--------------------------------------------------------------------------
    */

    .public-post-header {
        padding: 32px 32px 24px;
    }


    .public-post-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-bottom: 16px;
    }


    .public-post-type {
        display: inline-flex;
        align-items: center;
        min-height: 27px;
        padding: 5px 12px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
    }


    .public-post-type-news {
        background: #e8f0ff;
        color: #174ea6;
    }


    .public-post-type-announcement {
        background: #fff3d6;
        color: #9a6700;
    }


    .public-post-date {
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }


    .public-post-title {
        max-width: 900px;
        margin: 0;
        padding-left: 10px;
        border-left: 5px solid #d4af37;
        box-sizing: border-box;

        color: #0b2f64;
        font-size: 28px;
        font-weight: 500;
        line-height: 1.3;
        letter-spacing: 0;
        overflow-wrap: anywhere;
    }


    .public-post-author {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 5px;
        margin-top: 15px;
        color: #64748b;
        font-size: 14px;
        line-height: 1.5;
    }


    .public-post-author-name {
        color: #374151;
        font-weight: 600;
    }


    /*
    |--------------------------------------------------------------------------
    | FEATURED IMAGE
    |--------------------------------------------------------------------------
    */

    .public-post-featured-image {
        width: 100%;
        margin: 0;
        overflow: hidden;
        background: #f8fafc;
    }


    .public-post-featured-image img {
        display: block;
        width: 100%;
        max-width: 100%;
        height: auto;
        max-height: 560px;
        margin: 0 auto;
        object-fit: contain;
    }


    /*
    |--------------------------------------------------------------------------
    | EXCERPT / RINGKASAN
    |--------------------------------------------------------------------------
    */

    .public-post-excerpt {
        margin: 28px 32px 30px;
        padding: 4px 0 4px 18px;
        border-left: 4px solid #caa73e;
        color: #374151;
        font-size: 16px;
        line-height: 1.8;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    .public-post-excerpt p {
        margin: 0 0 10px;
    }


    .public-post-excerpt p:last-child {
        margin-bottom: 0;
    }


    .public-post-excerpt strong,
    .public-post-excerpt b {
        font-weight: 700;
    }


    .public-post-excerpt em,
    .public-post-excerpt i {
        font-style: italic;
    }


    .public-post-excerpt u {
        text-decoration: underline;
    }


    .public-post-excerpt a {
        color: #2563eb;
        text-decoration: none;
        transition:
            color 200ms ease,
            text-decoration-color 200ms ease;
    }


    .public-post-excerpt a:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }


    /*
    |--------------------------------------------------------------------------
    | ARTICLE CONTENT
    |--------------------------------------------------------------------------
    */

    .public-post-content {
        width: 100%;
        padding: 0 32px;
        color: #374151;
        font-size: 16px;
        line-height: 1.85;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    .public-post-content > * {
        max-width: 100%;
    }


    .public-post-content p {
        margin: 0 0 1.25rem;
    }


    .public-post-content h1,
    .public-post-content h2,
    .public-post-content h3,
    .public-post-content h4,
    .public-post-content h5,
    .public-post-content h6 {
        margin: 2rem 0 1rem;
        color: #0b2f64;
        font-weight: 700;
        line-height: 1.3;
        overflow-wrap: anywhere;
    }


    .public-post-content h1 {
        font-size: 2rem;
    }


    .public-post-content h2 {
        font-size: 1.65rem;
    }


    .public-post-content h3 {
        font-size: 1.4rem;
    }


    .public-post-content h4 {
        font-size: 1.2rem;
    }


    .public-post-content ul,
    .public-post-content ol {
        margin: 0 0 1.25rem;
        padding-left: 1.5rem;
    }


    .public-post-content ul {
        list-style: disc;
    }


    .public-post-content ol {
        list-style: decimal;
    }


    .public-post-content li {
        margin-bottom: 0.4rem;
    }


    .public-post-content strong,
    .public-post-content b {
        font-weight: 700;
    }


    .public-post-content em,
    .public-post-content i {
        font-style: italic;
    }


    .public-post-content u {
        text-decoration: underline;
    }


    /*
    |--------------------------------------------------------------------------
    | ARTICLE LINKS
    |--------------------------------------------------------------------------
    */

    .public-post-content a {
        display: inline-block;
        color: #2563eb;
        text-decoration: none;
        transform: scale(1);
        transform-origin: center;
        transition:
            color 200ms ease,
            text-decoration-color 200ms ease,
            transform 200ms ease;
    }


    .public-post-content a:hover {
        color: #1d4ed8;
        text-decoration: underline;
        transform: scale(1.05);
    }


    /*
    |--------------------------------------------------------------------------
    | BLOCKQUOTE
    |--------------------------------------------------------------------------
    */

    .public-post-content blockquote {
        margin: 1.5rem 0;
        padding: 1rem 1.25rem;
        border-left: 4px solid #caa73e;
        background: #f8fafc;
        color: #475569;
        font-style: italic;
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGES / MEDIA
    |--------------------------------------------------------------------------
    */

    .public-post-content img {
        display: block;
        max-width: 100%;
        height: auto;
        margin: 1.5rem auto;
    }


    .public-post-content iframe,
    .public-post-content video,
    .public-post-content embed,
    .public-post-content object {
        display: block;
        max-width: 100%;
    }


    .public-post-content iframe {
        width: 100%;
        min-height: 400px;
    }


    .public-post-content video {
        height: auto;
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    .public-post-content table {
        display: block;
        width: 100%;
        max-width: 100%;
        margin: 1.5rem 0;
        overflow-x: auto;
        border-collapse: collapse;
        -webkit-overflow-scrolling: touch;
    }


    .public-post-content th,
    .public-post-content td {
        padding: 8px 12px;
        border: 1px solid #d1d5db;
        text-align: left;
    }


    .public-post-content th {
        background: #f8fafc;
        font-weight: 700;
    }


    /*
    |--------------------------------------------------------------------------
    | PRE / CODE
    |--------------------------------------------------------------------------
    */

    .public-post-content pre,
    .public-post-content code {
        max-width: 100%;
        white-space: pre-wrap;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    .public-post-content pre {
        margin: 1.5rem 0;
        padding: 1rem;
        overflow-x: auto;
        border-radius: 8px;
        background: #f8fafc;
    }


    /*
    |--------------------------------------------------------------------------
    | BACK BUTTON
    |--------------------------------------------------------------------------
    */

    .public-post-back {
        padding: 28px 32px 32px;
    }


    .public-post-back-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        min-height: 42px;
        padding: 0 18px;
        border-radius: 8px;
        background: #dc2626;
        color: #fff;
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;
        transition:
            background-color 200ms ease,
            transform 200ms ease,
            box-shadow 200ms ease;
    }


    .public-post-back-link:hover {
        background: #b91c1c;
        color: #fff;
        transform: translateY(-1px);
        box-shadow: 0 4px 10px rgba(185, 28, 28, 0.18);
    }


    .public-post-back-icon {
        font-size: 18px;
        line-height: 1;
    }


    /*
    |--------------------------------------------------------------------------
    | SIDEBAR
    |--------------------------------------------------------------------------
    */

    .public-post-sidebar {
        min-width: 0;
    }


    .public-post-sidebar-heading {
        display: flex;
        align-items: center;
        gap: 10px;
        margin: 0 0 18px;
    }


    .public-post-sidebar-heading-bar {
        display: block;
        width: 4px;
        height: 24px;
        flex-shrink: 0;
        border-radius: 2px;
        background: #caa73e;
    }


    .public-post-sidebar-heading h2 {
        margin: 0;
        color: #0b2f64;
        font-size: 20px;
        font-weight: 600;
        line-height: 1.3;
    }


    .public-post-related-list {
        display: flex;
        flex-direction: column;
        gap: 18px;
    }


    .public-post-related-card {
        min-width: 0;
        padding: 18px 20px;
        border-radius: 10px;
        background: #fff;
        box-shadow: 0 4px 14px rgba(15, 23, 42, 0.07);
    }

    .public-post-related-image-link {
    display: block;
    width: 100%;
    aspect-ratio: 16 / 9;
    margin-bottom: 8px;
    overflow: hidden;
    border-radius: 8px;
    background: #f1f5f9;
}


.public-post-related-image {
    display: block;
    width: 100%;
    height: 100%;
    object-fit: cover;
}


.public-post-related-image-link:hover .public-post-related-image {
    transform: scale(1.03);
}


.public-post-related-placeholder {
    display: flex;
    width: 100%;
    aspect-ratio: 16 / 9;
    align-items: center;
    justify-content: center;
    color: #94a3b8;
    background: #f1f5f9;
}


.public-post-related-placeholder svg {
    width: 32px;
    height: 32px;
}


    .public-post-related-meta {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 6px;
        margin-bottom: 9px;
        color: #64748b;
        font-size: 12px;
        line-height: 1.5;
    }


    .public-post-related-meta-separator {
        color: #cbd5e1;
    }


    .public-post-related-title {
        display: block;
        color: #2563eb;
        font-size: 17px;
        font-weight: 500;
        line-height: 1.35;
        text-decoration: none;
        overflow-wrap: anywhere;
        word-break: break-word;
        transition:
            color 200ms ease,
            text-decoration-color 200ms ease;
    }


    .public-post-related-title:hover {
        color: #1d4ed8;
        text-decoration: underline;
    }


    /*
    |--------------------------------------------------------------------------
    | NO RELATED POSTS
    |--------------------------------------------------------------------------
    */

    .public-post-related-empty {
        padding: 20px;
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #fff;
        color: #64748b;
        font-size: 14px;
        line-height: 1.6;
    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE TABLET
    |--------------------------------------------------------------------------
    */

    @media (max-width: 900px) {

        .public-post-layout {
            grid-template-columns: minmax(0, 1fr) 280px;
            gap: 22px;
        }


        .public-post-header {
            padding: 28px 24px 22px;
        }


        .public-post-content {
            padding-right: 24px;
            padding-left: 24px;
        }


        .public-post-excerpt {
            margin-right: 24px;
            margin-left: 24px;
        }


        .public-post-back {
            padding-right: 24px;
            padding-left: 24px;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | RESPONSIVE MOBILE
    |--------------------------------------------------------------------------
    */

    @media (max-width: 768px) {

        .public-post-show {
            padding: 24px 0 40px;
        }


        .public-post-show-container {
            width: min(100% - 24px, 720px);
        }


        .public-post-layout {
            grid-template-columns: 1fr;
            gap: 28px;
        }


        .public-post-main-card {
            border-radius: 12px;
        }


        .public-post-header {
            padding: 24px 20px 20px;
        }


        .public-post-title {
            padding-left: 9px;
            border-left-width: 4px;
            font-size: 24px;
            line-height: 1.3;
        }


        .public-post-author {
            font-size: 13px;
        }


        .public-post-featured-image img {
            max-height: 460px;
        }


        .public-post-excerpt {
            margin: 24px 20px 26px;
            padding-left: 14px;
            font-size: 15px;
            line-height: 1.75;
        }


        .public-post-content {
            padding-right: 20px;
            padding-left: 20px;
            font-size: 15px;
            line-height: 1.8;
        }


        .public-post-content iframe {
            min-height: 300px;
        }


        .public-post-back {
            padding: 24px 20px 20px;
        }


        .public-post-back-link {
            width: 100%;
        }


        .public-post-sidebar {
            width: 100%;
        }


        .public-post-sidebar-heading {
            margin-bottom: 14px;
        }


        .public-post-related-list {
            gap: 14px;
        }


        .public-post-related-card {
            padding: 16px 18px;
        }


        .public-post-related-title {
            font-size: 16px;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE EXTRA SMALL
    |--------------------------------------------------------------------------
    */

    @media (max-width: 480px) {

        .public-post-show-container {
            width: calc(100% - 20px);
        }


        .public-post-header {
            padding: 20px 16px 18px;
        }


        .public-post-title {
            padding-left: 8px;
            border-left-width: 4px;
            font-size: 23px;
            line-height: 1.3;
        }

        .public-post-title::before {
            width: 4px;
            height: 25px;
        }


        .public-post-meta {
            gap: 7px;
        }


        .public-post-type {
            padding: 5px 10px;
            font-size: 11px;
        }


        .public-post-date {
            font-size: 12px;
        }


        .public-post-excerpt {
            margin-right: 16px;
            margin-left: 16px;
            padding-left: 12px;
            font-size: 14px;
        }


        .public-post-content {
            padding-right: 16px;
            padding-left: 16px;
            font-size: 14px;
        }


        .public-post-back {
            padding: 20px 16px 16px;
        }


        .public-post-related-card {
            padding: 15px 16px;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE VERY SMALL
    |--------------------------------------------------------------------------
    */

        @media (max-width: 360px) {

        .public-post-show-container {
            width: calc(100% - 16px);
        }

        .public-post-title {
            font-size: 1.4rem;
        }

        .public-post-content {
            font-size: 14px;
        }

        .public-post-back-link {
            padding-right: 12px;
            padding-left: 12px;
            font-size: 13px;
        }

    }
</style>
@endpush



<main class="public-post-show">

    <div class="public-post-show-container">

        <div class="public-post-layout">


            {{-- =====================================================
                 MAIN ARTICLE
            ====================================================== --}}

            <article class="public-post-main-card">


                {{-- =================================================
                     HEADER
                ================================================== --}}

                <header class="public-post-header">

                    <div class="public-post-meta">

                        <span class="public-post-type {{ $typeClasses }}">
                            {{ $typeLabel }}
                        </span>

                        @if ($post->published_at)

                            <span class="public-post-date">
                                {{ $post->published_at->format('d M Y') }}
                            </span>

                        @endif

                    </div>


                    <h1 class="public-post-title">
                        {{ $post->title }}
                    </h1>


                    @if ($post->author)

                        <div class="public-post-author">

                            <span class="public-post-author-label">
                                Dipublikasikan oleh
                            </span>

                            <span class="public-post-author-name">
                                {{ $post->author->name }}
                            </span>

                        </div>

                    @endif

                </header>


                {{-- =================================================
                     FEATURED IMAGE
                ================================================== --}}

                @if ($hasFeaturedImage)

                    <figure class="public-post-featured-image">

                        <img
                            src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->title }}"
                            loading="eager"
                        >

                    </figure>

                @endif


                {{-- =================================================
                     EXCERPT / RINGKASAN
                ================================================== --}}

                @if ($post->excerpt)

                    @php
                        $excerpt = html_entity_decode(
                            $post->excerpt,
                            ENT_QUOTES | ENT_HTML5,
                            'UTF-8'
                        );
                    @endphp

                    <div class="public-post-excerpt">
                        {!! $excerpt !!}
                    </div>

                @endif


                {{-- =================================================
                     CONTENT
                ================================================== --}}

                <article class="public-post-content">
                    {!! $content !!}
                </article>


                {{-- =================================================
                     BACK BUTTON
                ================================================== --}}

                <div class="public-post-back">

                    <a
                        href="{{ $backRoute }}"
                        class="public-post-back-link"
                    >

                        <span
                            aria-hidden="true"
                            class="public-post-back-icon"
                        >
                            ←
                        </span>

                        <span>
                            Kembali ke Berita & Pengumuman
                        </span>

                    </a>

                </div>


            </article>


            {{-- =====================================================
                 SIDEBAR
            ====================================================== --}}

            <aside class="public-post-sidebar">

                <div class="public-post-sidebar-heading">

                    <span
                        class="public-post-sidebar-heading-bar"
                        aria-hidden="true"
                    ></span>

                    <h2>
                        Informasi Lainnya
                    </h2>

                </div>


                <div class="public-post-related-list">

                    @forelse ($relatedPosts as $relatedPost)

                        @php

                            // $relatedIsAnnouncement =
                            //     $relatedPost->type === 'announcement';

                            // $relatedRoute = $relatedIsAnnouncement
                            //     ? route(
                            //         'public.announcements.show',
                            //         $relatedPost->slug
                            //     )
                            //     : route(
                            //         'public.news.show',
                            //         $relatedPost->slug
                            //     );

                            $relatedTypeLabel = $relatedPost->type === 'announcement'
                                ? 'Pengumuman'
                                : 'Berita';

                            $relatedRoute = route(
                                'public.news.show',
                                $relatedPost->slug
                            );

                        @endphp


                        <article class="public-post-related-card">

                            <a
                                href="{{ $relatedRoute }}"
                                class="public-post-related-image-link"
                                aria-label="{{ $relatedPost->title }}"
                            >

                                @if (
                                    $relatedPost->featured_image &&
                                    \Illuminate\Support\Facades\Storage::disk('public')->exists(
                                        $relatedPost->featured_image
                                    )
                                )

                                    <img
                                        src="{{ asset('storage/' . $relatedPost->featured_image) }}"
                                        alt="{{ $relatedPost->title }}"
                                        class="public-post-related-image"
                                        loading="lazy"
                                    >

                                @else

                                    <div class="public-post-related-placeholder">
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

                                            <path d="m21 15-5-5L5 21" />
                                        </svg>
                                    </div>

                                @endif

                            </a>


                            <div class="public-post-related-body">

                                <div class="public-post-related-meta">

                                    @if ($relatedPost->published_at)

                                        <span>
                                            {{ $relatedPost->published_at->format('d M Y') }}
                                        </span>

                                    @endif

                                    <span
                                        class="public-post-related-meta-separator"
                                        aria-hidden="true"
                                    >
                                        |
                                    </span>

                                    <span>
                                        {{ $relatedTypeLabel }}
                                    </span>

                                </div>


                                <a
                                    href="{{ $relatedRoute }}"
                                    class="public-post-related-title"
                                >
                                    {{ $relatedPost->title }}
                                </a>

                            </div>

                        </article>

                    @empty

                        <div class="public-post-related-empty">
                            Belum ada informasi lainnya.
                        </div>

                    @endforelse

                </div>

            </aside>


        </div>

    </div>

</main>

@endsection