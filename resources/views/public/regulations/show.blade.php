@extends('layouts.public')

@section('title', $post->title)

@push('styles')
    <style>

        /* =========================================================
        PAGE
        ========================================================== */

        .public-regulation-show-page {
            width: 100%;
            background: #f4f6f9;
        }

        .public-regulation-show-container {
            width: min(100% - 32px, 1200px);
            margin: 0 auto;
        }


        /* =========================================================
        PAGE HEADER
        ========================================================== */

        .public-regulation-show-header {
            padding: 28px 0 18px;
        }

        .public-section-heading {
            display: flex;
            align-items: center;
            gap: 11px;
        }

        .public-section-heading-line {
            width: 5px;
            height: 30px;
            flex-shrink: 0;
            background: #d4af37;
        }

        .public-section-heading-title {
            margin: 0;
            color: #0b2f64;
            font-size: 28px;
            font-weight: 500;
            line-height: 1.3;
        }


        /* =========================================================
        LAYOUT
        ========================================================== */

        .public-regulation-show-content {
            padding: 10px 0 55px;
        }

        .public-regulation-layout {
            display: grid;
            grid-template-columns: minmax(280px, 360px) minmax(0, 1fr);
            gap: 24px;
            align-items: start;
        }

        .public-regulation-sidebar {
            display: flex;
            min-width: 0;
            flex-direction: column;
            gap: 20px;
        }


        /* =========================================================
        GENERIC CARD HEADER
        ========================================================== */

        .public-regulation-card-header {
            padding: 17px 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        .public-regulation-card-header h2 {
            margin: 0;
            color: #0b2f64;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.4;
        }

        .public-regulation-card-header p {
            margin: 4px 0 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }


        /* =========================================================
        INFORMATION CARD
        ========================================================== */

        .public-regulation-info-card,
        .public-regulation-relation-card,
        .public-regulation-document-card,
        .public-regulation-description-card {
            overflow: hidden;
            border: 1px solid #dfe5ec;
            border-radius: 11px;
            background: #ffffff;
            box-shadow: 0 3px 10px rgba(15, 23, 42, 0.045);
        }

        .public-regulation-info-list {
            display: flex;
            flex-direction: column;
        }

        .public-regulation-info-item {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 18px;
            padding: 14px 18px;
            border-bottom: 1px solid #edf1f5;
        }

        .public-regulation-info-item:last-child {
            border-bottom: 0;
        }

        .public-regulation-info-label {
            flex-shrink: 0;
            color: #64748b;
            font-size: 12px;
            line-height: 1.5;
        }

        .public-regulation-info-value {
            min-width: 0;
            color: #1f2937;
            font-size: 13px;
            font-weight: 700;
            line-height: 1.5;
            text-align: right;
            overflow-wrap: anywhere;
        }


        /* =========================================================
        STATUS
        ========================================================== */

        .public-regulation-status {
            display: inline-flex;
            align-items: center;
            border-radius: 4px;
            padding: 5px 9px;
            font-size: 12px;
            font-weight: 700;
            line-height: 1;
        }

        .public-regulation-status.berlaku {
            background: #dcfce7;
            color: #16a34a;
        }

        .public-regulation-status.tidak-berlaku {
            background: #e5e7eb;
            color: #374151;
        }

        .public-regulation-status.mencabut,
        .public-regulation-status.dicabut {
            background: #fee2e2;
            color: #b91c1c;
        }

        .public-regulation-status.mengubah,
        .public-regulation-status.diubah {
            background: #fef3c7;
            color: #a16207;
        }

        .public-regulation-status.default {
            background: #f3f4f6;
            color: #374151;
        }


        /* =========================================================
        DOWNLOAD
        ========================================================== */

        .public-regulation-info-download {
            padding: 16px 18px 18px;
        }

        .public-regulation-download-button {
            display: flex;
            width: 100%;
            min-height: 44px;
            align-items: center;
            justify-content: center;
            gap: 7px;
            box-sizing: border-box;
            border-radius: 7px;
            padding: 0 15px;
            background: #d4af37;
            color: #0b2f64;
            font-size: 14px;
            font-weight: 700;
            line-height: 1;
            text-decoration: none;
            transition:
                background-color 200ms ease,
                transform 200ms ease;
        }

        .public-regulation-download-button svg {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .public-regulation-download-button:hover {
            background: #c5a12f;
            color: #0b2f64;
            transform: translateY(-1px);
        }


        /* =========================================================
        RELATION CARD
        ========================================================== */

        .public-regulation-relation-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px;
        }

        .public-regulation-relation-item {
            padding: 13px;
            border: 1px solid;
            border-radius: 9px;
        }

        .relation-amend {
            border-color: #f4d98a;
            background: #fffbea;
        }

        .relation-repeal {
            border-color: #fecaca;
            background: #fff7f7;
        }

        .public-regulation-relation-label {
            display: block;
            margin-bottom: 6px;
            font-size: 10px;
            font-weight: 800;
            line-height: 1.3;
            text-transform: uppercase;
            letter-spacing: 0.04em;
        }

        .relation-amend .public-regulation-relation-label {
            color: #a16207;
        }

        .relation-repeal .public-regulation-relation-label {
            color: #b91c1c;
        }

        .public-regulation-relation-title {
            display: block;
            color: #174ea6;
            font-size: 13px;
            font-weight: 500;
            line-height: 1.5;
            text-decoration: none;
            overflow-wrap: anywhere;
        }

        .public-regulation-relation-title:hover {
            color: #123d82;
            text-decoration: underline;
            text-underline-offset: 2px;
        }

        .public-regulation-relation-number {
            display: block;
            margin-top: 5px;
            color: #64748b;
            font-size: 11px;
            line-height: 1.4;
        }


        /* =========================================================
        DOCUMENT
        ========================================================== */

        .public-regulation-document-column {
            min-width: 0;
        }

        .public-regulation-document-card {
            min-width: 0;
        }

        .public-regulation-document-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 18px;
            padding: 15px 18px;
            border-bottom: 1px solid #e5e7eb;
        }

        .public-regulation-document-heading {
            min-width: 0;
        }

        .public-regulation-document-heading h2 {
            margin: 0;
            color: #0b2f64;
            font-size: 16px;
            font-weight: 700;
            line-height: 1.4;
        }

        .public-regulation-document-heading p {
            max-width: 560px;
            margin: 3px 0 0;
            overflow: hidden;
            color: #64748b;
            font-size: 11px;
            line-height: 1.5;
            text-overflow: ellipsis;
            white-space: nowrap;
        }

        .public-regulation-document-download {
            display: inline-flex;
            min-height: 38px;
            flex-shrink: 0;
            align-items: center;
            justify-content: center;
            gap: 6px;
            border-radius: 7px;
            padding: 0 14px;
            background: #174ea6;
            color: #ffffff;
            font-size: 13px;
            font-weight: 600;
            line-height: 1;
            text-decoration: none;
            transition:
                background-color 200ms ease,
                transform 200ms ease;
        }

        .public-regulation-document-download svg {
            width: 16px;
            height: 16px;
        }

        .public-regulation-document-download:hover {
            background: #123d82;
            color: #ffffff;
            transform: translateY(-1px);
        }


        /* =========================================================
        PDF
        ========================================================== */

        .public-regulation-pdf-wrapper {
            width: 100%;
            padding: 10px;
            box-sizing: border-box;
            background: #f1f3f5;
        }

        .public-regulation-pdf {
            display: block;
            width: 100%;
            height: 760px;
            border: 1px solid #d1d5db;
            border-radius: 7px;
            background: #ffffff;
        }


        /* =========================================================
        DOCUMENT EMPTY / NON PDF
        ========================================================== */

        .public-regulation-document-unavailable {
            display: flex;
            min-height: 300px;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 40px 24px;
            box-sizing: border-box;
            text-align: center;
        }

        .public-regulation-document-icon {
            display: flex;
            width: 56px;
            height: 56px;
            align-items: center;
            justify-content: center;
            margin-bottom: 14px;
            border-radius: 50%;
            background: #f1f5f9;
            color: #64748b;
        }

        .public-regulation-document-icon svg {
            width: 27px;
            height: 27px;
        }

        .public-regulation-document-unavailable h3 {
            margin: 0;
            color: #1f2937;
            font-size: 15px;
            font-weight: 700;
        }

        .public-regulation-document-unavailable p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 13px;
            line-height: 1.5;
        }


        /* =========================================================
        DESCRIPTION
        ========================================================== */

        .public-regulation-description-card {
            margin-top: 20px;
        }

        .public-regulation-description {
            padding: 18px;
            color: #374151;
            font-size: 14px;
            line-height: 1.8;
            overflow-wrap: anywhere;
        }


        /* =========================================================
        BACK
        ========================================================== */

        .public-regulation-back {
            margin-top: 22px;
        }

        .public-regulation-back-link {
        display: inline-flex;
        min-height: 40px;
        align-items: center;
        gap: 7px;
        border-radius: 7px;
        padding: 0 14px;
        background: #dc2626;
        color: #ffffff;
        font-size: 13px;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;
        transition:
            background-color 200ms ease,
            transform 200ms ease;
    }

    .public-regulation-back-link svg {
        width: 17px;
        height: 17px;
        flex-shrink: 0;
    }

    .public-regulation-back-link:hover {
        background: #b91c1c;
        color: #ffffff;
        transform: translateY(-1px);
    }


        /* =========================================================
        PUBLICATION
        ========================================================== */

        .public-regulation-published {
            margin: 12px 0 0;
            color: #94a3b8;
            font-size: 11px;
            line-height: 1.5;
        }


        /* =========================================================
        TABLET
        ========================================================== */

        @media (max-width: 992px) {

            .public-regulation-layout {
                grid-template-columns: 300px minmax(0, 1fr);
                gap: 18px;
            }

            .public-regulation-document-header {
                align-items: flex-start;
                flex-direction: column;
            }

            .public-regulation-document-download {
                width: 100%;
            }

            .public-regulation-pdf {
                height: 650px;
            }

        }


        /* =========================================================
        MOBILE
        ========================================================== */

        @media (max-width: 768px) {

            .public-regulation-show-container {
                width: min(100% - 28px, 1200px);
            }

            .public-regulation-show-header {
                padding: 24px 0 16px;
            }

            .public-section-heading {
                gap: 10px;
            }

            .public-section-heading-line {
                width: 4px;
                height: 28px;
            }

            .public-section-heading-title {
                font-size: 25px;
            }

            .public-regulation-show-content {
                padding-top: 8px;
            }

            .public-regulation-layout {
                grid-template-columns: 1fr;
                gap: 18px;
            }

            .public-regulation-sidebar {
                gap: 18px;
            }

            .public-regulation-document-column {
                order: 2;
            }

            .public-regulation-sidebar {
                order: 1;
            }

            .public-regulation-pdf {
                height: 600px;
            }

        }


        /* =========================================================
        SMALL MOBILE
        ========================================================== */

        @media (max-width: 480px) {

            .public-regulation-show-container {
                width: calc(100% - 24px);
            }

            .public-regulation-show-header {
                padding: 20px 0 14px;
            }

            .public-section-heading {
                gap: 9px;
            }

            .public-section-heading-line {
                width: 4px;
                height: 25px;
            }

            .public-section-heading-title {
                font-size: 23px;
            }

            .public-regulation-card-header {
                padding: 15px 16px;
            }

            .public-regulation-info-item {
                gap: 12px;
                padding: 13px 16px;
            }

            .public-regulation-info-label {
                font-size: 11px;
            }

            .public-regulation-info-value {
                font-size: 12px;
            }

            .public-regulation-info-download {
                padding: 14px 16px 16px;
            }

            .public-regulation-relation-list {
                padding: 14px;
            }

            .public-regulation-relation-item {
                padding: 12px;
            }

            .public-regulation-document-header {
                padding: 14px 16px;
            }

            .public-regulation-document-heading h2 {
                font-size: 15px;
            }

            .public-regulation-document-heading p {
                max-width: 100%;
            }

            .public-regulation-pdf-wrapper {
                padding: 6px;
            }

            .public-regulation-pdf {
                height: 520px;
                border-radius: 5px;
            }

            .public-regulation-description {
                padding: 16px;
                font-size: 13px;
                line-height: 1.75;
            }

            .public-regulation-back-link {
                width: 100%;
                justify-content: center;
                box-sizing: border-box;
            }

        }


        /* =========================================================
        VERY SMALL
        ========================================================== */

        @media (max-width: 360px) {

            .public-regulation-show-container {
                width: calc(100% - 20px);
            }

            .public-section-heading-title {
                font-size: 21px;
            }

            .public-regulation-pdf {
                height: 460px;
            }

        }

    </style>
@endpush


@section('content')

<div class="public-regulation-show-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <section class="public-regulation-show-header">

        <div class="public-regulation-show-container">

            <div class="public-section-heading">

                <span
                    class="public-section-heading-line"
                    aria-hidden="true"
                ></span>

                <h1 class="public-section-heading-title">
                    Detail Regulasi
                </h1>

            </div>

        </div>

    </section>


    {{-- =========================================================
        MAIN
    ========================================================== --}}

    <section class="public-regulation-show-content">

        <div class="public-regulation-show-container">

            <div class="public-regulation-layout">


                {{-- =================================================
                    LEFT COLUMN
                ================================================== --}}

                <aside class="public-regulation-sidebar">


                    {{-- =================================================
                        INFORMASI REGULASI
                    ================================================== --}}

                    <div class="public-regulation-info-card">

                        <div class="public-regulation-card-header">

                            <div>

                                <h2>
                                    Informasi Regulasi
                                </h2>

                                <p>
                                    Informasi dasar regulasi.
                                </p>

                            </div>

                        </div>


                        <div class="public-regulation-info-list">


                            {{-- Jenis Regulasi --}}

                            @if ($post->regulationType)

                                <div class="public-regulation-info-item">

                                    <span class="public-regulation-info-label">
                                        Jenis Regulasi
                                    </span>

                                    <span class="public-regulation-info-value">
                                        {{ $post->regulationType->name }}
                                    </span>

                                </div>

                            @endif


                            {{-- Nomor --}}

                            @if ($post->regulation_number)

                                <div class="public-regulation-info-item">

                                    <span class="public-regulation-info-label">
                                        Nomor
                                    </span>

                                    <span class="public-regulation-info-value">
                                        {{ $post->regulation_number }}
                                    </span>

                                </div>

                            @endif


                            {{-- Tahun --}}

                            @if ($post->regulation_year)

                                <div class="public-regulation-info-item">

                                    <span class="public-regulation-info-label">
                                        Tahun
                                    </span>

                                    <span class="public-regulation-info-value">
                                        {{ $post->regulation_year }}
                                    </span>

                                </div>

                            @endif


                            {{-- Tanggal Regulasi --}}

                            @if ($post->regulation_date)

                                <div class="public-regulation-info-item">

                                    <span class="public-regulation-info-label">
                                        Tanggal Ditetapkan
                                    </span>

                                    <span class="public-regulation-info-value">
                                        {{ $post->regulation_date->translatedFormat('d F Y') }}
                                    </span>

                                </div>

                            @endif


                            {{-- Status Hukum --}}

                            @if ($post->legal_status)

                                <div class="public-regulation-info-item">

                                    <span class="public-regulation-info-label">
                                        Status Hukum
                                    </span>

                                    <span class="public-regulation-info-value">

                                        @if ($post->legal_status === 'berlaku')

                                            <span class="public-regulation-status berlaku">
                                                Berlaku
                                            </span>

                                        @elseif ($post->legal_status === 'tidak_berlaku')

                                            <span class="public-regulation-status tidak-berlaku">
                                                Tidak Berlaku
                                            </span>

                                        @elseif ($post->legal_status === 'mencabut')

                                            <span class="public-regulation-status mencabut">
                                                Mencabut
                                            </span>

                                        @elseif ($post->legal_status === 'dicabut')

                                            <span class="public-regulation-status dicabut">
                                                Dicabut
                                            </span>

                                        @elseif ($post->legal_status === 'mengubah')

                                            <span class="public-regulation-status mengubah">
                                                Mengubah
                                            </span>

                                        @elseif ($post->legal_status === 'diubah')

                                            <span class="public-regulation-status diubah">
                                                Diubah
                                            </span>

                                        @else

                                            <span class="public-regulation-status default">
                                                {{ ucfirst(
                                                    str_replace(
                                                        '_',
                                                        ' ',
                                                        $post->legal_status
                                                    )
                                                ) }}
                                            </span>

                                        @endif

                                    </span>

                                </div>

                            @endif

                        </div>


                        {{-- Download Dokumen --}}

                        @if ($post->document_path)

                            @php
                                $documentExtension = strtolower(
                                    pathinfo(
                                        $post->document_path,
                                        PATHINFO_EXTENSION
                                    )
                                );

                                $downloadLabel = match ($documentExtension) {
                                    'pdf' => 'Download PDF',
                                    'zip' => 'Download ZIP',
                                    'rar' => 'Download RAR',
                                    default => 'Download Dokumen',
                                };
                            @endphp

                            <div class="public-regulation-info-download">

                                <a
                                    href="{{ route('posts.document.download', $post) }}"
                                    class="public-regulation-download-button"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0 4-4m-4 4-4-4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 21h14"
                                        />
                                    </svg>

                                    <span>
                                        {{ $downloadLabel }}
                                    </span>

                                </a>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        HUBUNGAN REGULASI
                    ================================================== --}}

                    @php
                        $amendments = $post->amendments
                            ->filter(fn ($relation) => $relation->relatedPost);

                        $repeals = $post->repeals
                            ->filter(fn ($relation) => $relation->relatedPost);

                        $amendedBy = $post->amendedBy
                            ->filter(fn ($relation) => $relation->post);

                        $repealedBy = $post->repealedBy
                            ->filter(fn ($relation) => $relation->post);
                    @endphp


                    @if (
                        $amendments->isNotEmpty() ||
                        $repeals->isNotEmpty() ||
                        $amendedBy->isNotEmpty() ||
                        $repealedBy->isNotEmpty()
                    )

                        <div class="public-regulation-relation-card">

                            <div class="public-regulation-card-header">

                                <div>

                                    <h2>
                                        Hubungan Regulasi
                                    </h2>

                                    <p>
                                        Riwayat perubahan dan pencabutan regulasi.
                                    </p>

                                </div>

                            </div>


                            <div class="public-regulation-relation-list">


                                {{-- =========================================
                                    REGULASI INI MENGUBAH REGULASI LAIN
                                ========================================== --}}

                                @foreach ($amendments as $relation)

                                    <div class="public-regulation-relation-item relation-amend">

                                        <span class="public-regulation-relation-label">
                                            Mengubah
                                        </span>

                                        <a
                                            href="{{ route(
                                                'public.regulations.show',
                                                ['slug' => $relation->relatedPost->slug]
                                            ) }}"
                                            class="public-regulation-relation-title"
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>

                                        @if ($relation->relatedPost->regulation_number)

                                            <span class="public-regulation-relation-number">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </span>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =========================================
                                    REGULASI INI MENCABUT REGULASI LAIN
                                ========================================== --}}

                                @foreach ($repeals as $relation)

                                    <div class="public-regulation-relation-item relation-repeal">

                                        <span class="public-regulation-relation-label">
                                            Mencabut
                                        </span>

                                        <a
                                            href="{{ route(
                                                'public.regulations.show',
                                                ['slug' => $relation->relatedPost->slug]
                                            ) }}"
                                            class="public-regulation-relation-title"
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>

                                        @if ($relation->relatedPost->regulation_number)

                                            <span class="public-regulation-relation-number">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </span>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =========================================
                                    REGULASI INI DIUBAH OLEH REGULASI LAIN
                                ========================================== --}}

                                @foreach ($amendedBy as $relation)

                                    <div class="public-regulation-relation-item relation-amend">

                                        <span class="public-regulation-relation-label">
                                            Diubah Oleh
                                        </span>

                                        <a
                                            href="{{ route(
                                                'public.regulations.show',
                                                ['slug' => $relation->post->slug]
                                            ) }}"
                                            class="public-regulation-relation-title"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)

                                            <span class="public-regulation-relation-number">
                                                {{ $relation->post->regulation_number }}
                                            </span>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =========================================
                                    REGULASI INI DICABUT OLEH REGULASI LAIN
                                ========================================== --}}

                                @foreach ($repealedBy as $relation)

                                    <div class="public-regulation-relation-item relation-repeal">

                                        <span class="public-regulation-relation-label">
                                            Dicabut Oleh
                                        </span>

                                        <a
                                            href="{{ route(
                                                'public.regulations.show',
                                                ['slug' => $relation->post->slug]
                                            ) }}"
                                            class="public-regulation-relation-title"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)

                                            <span class="public-regulation-relation-number">
                                                {{ $relation->post->regulation_number }}
                                            </span>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif

                </aside>


                {{-- =================================================
                    RIGHT COLUMN
                ================================================== --}}

                <main class="public-regulation-document-column">

                    <div class="public-regulation-document-card">


                        {{-- =================================================
                            DOCUMENT HEADER
                        ================================================== --}}

                        <div class="public-regulation-document-header">

                            <div class="public-regulation-document-heading">

                                <h2>
                                    Dokumen Regulasi
                                </h2>

                                @if ($post->document_original_name)

                                    <p title="{{ $post->document_original_name }}">
                                        {{ $post->document_original_name }}
                                    </p>

                                @endif

                            </div>


                            @if ($post->document_path)

                                @php
                                    $documentExtension = strtolower(
                                        pathinfo(
                                            $post->document_path,
                                            PATHINFO_EXTENSION
                                        )
                                    );

                                    $downloadLabel = match ($documentExtension) {
                                        'pdf' => 'Download PDF',
                                        'zip' => 'Download ZIP',
                                        'rar' => 'Download RAR',
                                        default => 'Download Dokumen',
                                    };
                                @endphp

                                <a
                                    href="{{ route('posts.document.download', $post) }}"
                                    class="public-regulation-document-download"
                                >

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="2"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12m0 0 4-4m-4 4-4-4"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 21h14"
                                        />
                                    </svg>

                                    {{ $downloadLabel }}

                                </a>

                            @endif

                        </div>


                        {{-- =================================================
                            PDF PREVIEW
                        ================================================== --}}

                        @if (
                            $post->document_path &&
                            \Illuminate\Support\Facades\Storage::disk('public')->exists(
                                $post->document_path
                            )
                        )

                            @php
                                $documentExtension = strtolower(
                                    pathinfo(
                                        $post->document_path,
                                        PATHINFO_EXTENSION
                                    )
                                );

                                $isPdf = $documentExtension === 'pdf';
                            @endphp


                            @if ($isPdf)

                                <div class="public-regulation-pdf-wrapper">

                                    <iframe
                                        src="{{ asset('storage/' . $post->document_path) }}"
                                        title="Preview {{ $post->title }}"
                                        class="public-regulation-pdf"
                                    ></iframe>

                                </div>

                            @else

                                <div class="public-regulation-document-unavailable">

                                    <div class="public-regulation-document-icon">

                                        <svg
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            aria-hidden="true"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M7 3h8l4 4v14H7z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 3v5h5"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M10 13h6M10 17h6"
                                            />
                                        </svg>

                                    </div>

                                    <h3>
                                        Dokumen tersedia untuk diunduh
                                    </h3>

                                    <p>
                                        Format dokumen:
                                        <strong>
                                            {{ strtoupper($documentExtension) }}
                                        </strong>
                                    </p>

                                </div>

                            @endif

                        @else

                            <div class="public-regulation-document-unavailable">

                                <div class="public-regulation-document-icon">

                                    <svg
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        aria-hidden="true"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M7 3h8l4 4v14H7z"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15 3v5h5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M10 13h6M10 17h6"
                                        />

                                    </svg>

                                </div>

                                <h3>
                                    Dokumen belum tersedia
                                </h3>

                                <p>
                                    Dokumen regulasi belum diunggah.
                                </p>

                            </div>

                        @endif

                    </div>


                    {{-- =================================================
                        KETERANGAN
                    ================================================== --}}

                    @if ($post->content)

                        <div class="public-regulation-description-card">

                            <div class="public-regulation-card-header">

                                <div>

                                    <h2>
                                        Keterangan
                                    </h2>

                                </div>

                            </div>

                            <div class="public-regulation-description">

                                {!! nl2br(e($post->content)) !!}

                            </div>

                        </div>

                    @endif


                    {{-- =================================================
                        BACK
                    ================================================== --}}

                    <div class="public-regulation-back">

                        <a
                            href="{{ route('public.regulations') }}"
                            class="public-regulation-back-link"
                        >

                            <svg
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                aria-hidden="true"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 19l-7-7 7-7"
                                />
                            </svg>

                            <span>
                                Kembali ke Regulasi
                            </span>

                        </a>

                    </div>


                    {{-- =================================================
                        PUBLICATION INFO
                    ================================================== --}}

                    @if ($post->published_at)

                        <p class="public-regulation-published">

                            Dipublikasikan
                            {{ $post->published_at->format('d F Y H:i') }}

                        </p>

                    @endif

                </main>

            </div>

        </div>

    </section>

</div>


@endsection