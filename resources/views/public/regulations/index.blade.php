@extends('layouts.public')

@section('title', 'Regulasi')

@section('content')

<div class="public-regulations-page">

    {{-- =========================================================
        HEADER
    ========================================================== --}}

    <section class="public-regulations-header">

        <div class="public-regulations-container">

            <div class="public-section-heading">

                <span
                    class="public-section-heading-line"
                    aria-hidden="true"
                ></span>

                <h1 class="public-section-heading-title">
                    Regulasi Pengadaan Barang/Jasa
                </h1>

            </div>

        </div>

    </section>


    {{-- =========================================================
        CONTENT
    ========================================================== --}}

    <section class="public-regulations-content">

        <div class="public-regulations-container">


            {{-- =================================================
                SEARCH & FILTER
            ================================================== --}}

            <form
                method="GET"
                action="{{ route('public.regulations') }}"
                class="public-regulations-toolbar"
            >

                {{-- Search --}}

                <div class="public-regulations-search-row">

                    <div class="public-regulations-search-field">

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
                            id="q"
                            name="q"
                            type="search"
                            value="{{ request('q') }}"
                            placeholder="Cari berdasarkan judul, nomor regulasi, atau kata kunci..."
                        >

                    </div>


                    <button
                        type="submit"
                        class="public-regulations-search-button"
                    >
                        Cari
                    </button>

                </div>


                {{-- Filters --}}

                <div class="public-regulations-filters">


                    {{-- Jenis Regulasi --}}

                    <div class="public-regulations-filter-field">

                        <label for="regulation_type">
                            Jenis Regulasi
                        </label>

                        <select
                            id="regulation_type"
                            name="regulation_type"
                        >

                            <option value="">
                                Semua Jenis
                            </option>

                            @foreach ($regulationTypes as $regulationType)

                                <option
                                    value="{{ $regulationType->id }}"
                                    @selected(
                                        (string) request('regulation_type')
                                        ===
                                        (string) $regulationType->id
                                    )
                                >
                                    {{ $regulationType->name }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                    {{-- Tahun --}}

                    <div class="public-regulations-filter-field">

                        <label for="year">
                            Tahun
                        </label>

                        <select
                            id="year"
                            name="year"
                        >

                            <option value="">
                                Semua Tahun
                            </option>

                            @foreach ($years as $yearOption)

                                <option
                                    value="{{ $yearOption }}"
                                    @selected(
                                        (string) request('year')
                                        ===
                                        (string) $yearOption
                                    )
                                >
                                    {{ $yearOption }}
                                </option>

                            @endforeach

                        </select>

                    </div>


                </div>


                {{-- Filter Actions --}}

                <div class="public-regulations-filter-actions">

                    <button
                        type="submit"
                        class="public-regulations-apply-button"
                    >
                        Terapkan Filter
                    </button>


                    @if (
                        request()->filled('q') ||
                        request()->filled('regulation_type') ||
                        request()->filled('year')

                    )

                        <a
                            href="{{ route('public.regulations') }}"
                            class="public-regulations-reset-button"
                        >
                            Reset Filter
                        </a>

                    @endif

                </div>

            </form>


            {{-- =================================================
                RESULT HEADER
            ================================================== --}}

            <div class="public-regulations-result-header">

                <div>

                    <h2 class="public-regulations-result-title">
                        Daftar Regulasi
                    </h2>

                    @if ($posts->total())

                        <p class="public-regulations-result-info">

                            Menampilkan
                            {{ $posts->firstItem() }}
                            –
                            {{ $posts->lastItem() }}
                            dari
                            {{ $posts->total() }}
                            regulasi.

                        </p>

                    @endif

                </div>

            </div>


            {{-- =================================================
                REGULATION LIST
            ================================================== --}}

            @if ($posts->count())

                <div class="public-regulations-list">

                    @foreach ($posts as $post)

                        <article
                            class="public-regulation-card"
                        >

                            {{-- Main Content --}}

                            <div class="public-regulation-main">

                                @if ($post->regulationType)

                                    <span class="public-regulation-type">
                                        {{ $post->regulationType->name }}
                                    </span>

                                @endif


                                <h3 class="public-regulation-title">
                                    {{ $post->title }}
                                </h3>

                            </div>


                            {{-- Status Hukum --}}

                            @if ($post->legal_status)

                                <div class="public-regulation-status">

                                    @if ($post->legal_status === 'berlaku')

                                        <span class="public-regulation-status-badge berlaku">
                                            Berlaku
                                        </span>

                                    @elseif ($post->legal_status === 'mengubah')

                                        <span class="public-regulation-status-badge diubah">
                                            Mengubah
                                        </span>

                                    @elseif ($post->legal_status === 'dicabut')

                                        <span class="public-regulation-status-badge dicabut">
                                            Dicabut
                                        </span>

                                    @elseif ($post->legal_status === 'mencabut')

                                        <span class="public-regulation-status-badge mencabut">
                                            Mencabut
                                        </span>

                                    @elseif ($post->legal_status === 'diubah')

                                        <span class="public-regulation-status-badge diubah">
                                            Diubah
                                        </span>

                                    @elseif ($post->legal_status === 'tidak_berlaku')

                                        <span class="public-regulation-status-badge tidak-berlaku">
                                            Tidak Berlaku
                                        </span>

                                    @else

                                        <span class="public-regulation-status-badge">
                                            {{ ucfirst(
                                                str_replace(
                                                    '_',
                                                    ' ',
                                                    $post->legal_status
                                                )
                                            ) }}
                                        </span>

                                    @endif

                                </div>

                            @endif


                            {{-- Footer / Button --}}

                            <div class="public-regulation-footer">

                                <a
                                    href="{{ route('public.regulations.show', ['slug' => $post->slug]) }}"
                                    class="public-regulation-link"
                                    aria-label="Lihat detail {{ $post->title }}"
                                >

                                    <span>
                                        Lihat
                                    </span>

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
                                            d="M9 5l7 7-7 7"
                                        />
                                    </svg>

                                </a>

                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- =================================================
                    PAGINATION
                ================================================== --}}

                <div class="public-posts-pagination">

                    <x-public.pagination
                        :paginator="$posts"
                        label="regulasi"
                    />

                </div>


            @else

                {{-- =================================================
                    EMPTY STATE
                ================================================== --}}

                <div class="public-regulations-empty">

                    <h2>
                        Regulasi tidak ditemukan
                    </h2>

                    <p>
                        Tidak ada regulasi yang sesuai dengan
                        pencarian atau filter Anda.
                    </p>

                    <a
                        href="{{ route('public.regulations') }}"
                    >
                        Tampilkan Semua Regulasi
                    </a>

                </div>

            @endif

        </div>

    </section>

</div>


{{-- =============================================================
    PAGE STYLE
============================================================= --}}

<style>

    /* =========================================================
       PAGE
    ========================================================== */

    .public-regulations-page {
        width: 100%;
        background: #f4f6f9;
    }

    .public-regulations-container {
        width: min(100% - 32px, 1200px);
        margin: 0 auto;
    }


    /* =========================================================
       HEADER
    ========================================================== */

    .public-regulations-header {
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
       CONTENT
    ========================================================== */

    .public-regulations-content {
        padding: 10px 0 55px;
    }


    /* =========================================================
       SEARCH & FILTER
    ========================================================== */

    .public-regulations-toolbar {
        margin-bottom: 30px;
        padding: 20px;
        border: 1px solid #e5e7eb;
        border-radius: 12px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(15, 23, 42, 0.04);
    }

    .public-regulations-search-row {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        gap: 10px;
    }

    .public-regulations-search-field {
        position: relative;
        min-width: 0;
    }

    .public-regulations-search-field svg {
        position: absolute;
        top: 50%;
        left: 13px;
        width: 18px;
        height: 18px;
        color: #64748b;
        pointer-events: none;
        transform: translateY(-50%);
    }

    .public-regulations-search-field input {
        display: block;
        width: 100%;
        height: 44px;
        box-sizing: border-box;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 13px 0 40px;
        background: #ffffff;
        color: #111827;
        font-size: 14px;
        outline: none;
        transition:
            border-color 200ms ease,
            box-shadow 200ms ease;
    }

    .public-regulations-search-field input::placeholder {
        color: #9ca3af;
    }

    .public-regulations-search-field input:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }

    .public-regulations-search-button,
    .public-regulations-apply-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        border: 0;
        border-radius: 8px;
        padding: 0 18px;
        cursor: pointer;
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
        transition:
            background-color 200ms ease,
            transform 200ms ease;
    }

    .public-regulations-search-button {
        background: #174ea6;
        color: #ffffff;
    }

    .public-regulations-search-button:hover {
        background: #123d82;
        transform: translateY(-1px);
    }


    /* FILTER GRID */

    .public-regulations-filters {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 14px;
        margin-top: 18px;
    }

    .public-regulations-filter-field {
        min-width: 0;
    }

    .public-regulations-filter-field label {
        display: block;
        margin-bottom: 7px;
        color: #374151;
        font-size: 13px;
        font-weight: 600;
    }

    .public-regulations-filter-field select {
        display: block;
        width: 100%;
        height: 42px;
        box-sizing: border-box;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 36px 0 12px;
        background: #ffffff;
        color: #374151;
        font-size: 14px;
        outline: none;
        cursor: pointer;
        transition:
            border-color 200ms ease,
            box-shadow 200ms ease;
    }

    .public-regulations-filter-field select:focus {
        border-color: #2563eb;
        box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
    }


    /* FILTER ACTIONS */

    .public-regulations-filter-actions {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin-top: 18px;
    }

    .public-regulations-apply-button {
        background: #174ea6;
        color: #ffffff;
    }

    .public-regulations-apply-button:hover {
        background: #123d82;
        transform: translateY(-1px);
    }

    .public-regulations-reset-button {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-height: 44px;
        border: 1px solid #d1d5db;
        border-radius: 8px;
        padding: 0 18px;
        background: #ffffff;
        color: #374151;
        font-size: 14px;
        font-weight: 600;
        line-height: 1;
        text-decoration: none;
        transition:
            background-color 200ms ease,
            border-color 200ms ease;
    }

    .public-regulations-reset-button:hover {
        border-color: #cbd5e1;
        background: #f8fafc;
    }


    /* =========================================================
       RESULT HEADER
    ========================================================== */

    .public-regulations-result-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 14px;
    }

    .public-regulations-result-title {
        margin: 0;
        color: #111827;
        font-size: 18px;
        font-weight: 700;
        line-height: 1.4;
    }

    .public-regulations-result-info {
        margin: 4px 0 0;
        color: #6b7280;
        font-size: 13px;
        line-height: 1.5;
    }


    /* =========================================================
       REGULATION LIST
       1 COLUMN / 1 ROW
    ========================================================== */

    .public-regulations-list {
        display: flex;
        flex-direction: column;
        gap: 14px;
    }

    .public-regulation-card {
        display: grid;
        grid-template-columns: minmax(0, 1fr) auto;
        grid-template-rows: auto auto;
        column-gap: 20px;
        row-gap: 10px;
        min-width: 0;
        padding: 18px 15px;
        border: 1px solid #dce3ec;
        border-radius: 9px;
        background: #ffffff;
        box-shadow: 0 2px 7px rgba(15, 23, 42, 0.035);
        transition:
            transform 200ms ease,
            border-color 200ms ease,
            box-shadow 200ms ease;
    }

    .public-regulation-card:hover {
        border-color: #cbd8e8;
        box-shadow: 0 6px 16px rgba(15, 23, 42, 0.07);
        transform: translateY(-1px);
    }

    .public-regulation-main {
        min-width: 0;
    }

    .public-regulation-type {
        display: inline-flex;
        width: fit-content;
        align-items: center;
        border-radius: 4px;
        padding: 6px 10px;
        background: #174ea6;
        color: #ffffff;
        font-size: 12px;
        font-weight: 700;
        line-height: 1;
    }

    .public-regulation-title {
        margin: 8px 0 0;
        color: #1f2937;
        font-size: 17px;
        font-weight: 500;
        line-height: 1.5;
        overflow-wrap: anywhere;
    }


    /* STATUS */

    .public-regulation-status {
        grid-column: 2;
        grid-row: 1;
        align-self: start;
    }

    .public-regulation-status-badge {
        display: inline-flex;
        align-items: center;
        border-radius: 999px;
        padding: 5px 9px;
        background: #f3f4f6;
        color: #374151;
        font-size: 11px;
        font-weight: 600;
        line-height: 1;
    }

    .public-regulation-status-badge.berlaku {
        background: #dcfce7;
        color: #166534;
    }

    .public-regulation-status-badge.diubah {
        background: #fef3c7;
        color: #92400e;
    }

    .public-regulation-status-badge.dicabut {
        background: #fee2e2;
        color: #991b1b;
    }

    .public-regulation-status-badge.mencabut {
        background: #ffedd5;
        color: #9a3412;
    }

    .public-regulation-status-badge.tidak-berlaku {
        background: #e5e7eb;
        color: #374151;
    }


    /* FOOTER */

    .public-regulation-footer {
        grid-column: 2;
        grid-row: 2;
        display: flex;
        justify-content: flex-end;
        align-items: flex-end;
    }

    .public-regulation-link {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
        min-width: 82px;
        min-height: 41px;
        box-sizing: border-box;
        border-radius: 5px;
        padding: 0 16px;
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

    .public-regulation-link svg {
        width: 15px;
        height: 15px;
        flex-shrink: 0;
    }

    .public-regulation-link:hover {
        background: #c5a12f;
        color: #0b2f64;
        transform: translateY(-1px);
    }


    /* =========================================================
       PAGINATION
    ========================================================== */

    .public-posts-pagination {
        margin-top: 28px;
    }

    /* =========================================================
   PAGINATION COMPONENT
========================================================== */

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


    /* =========================================================
       EMPTY STATE
    ========================================================== */

    .public-regulations-empty {
        padding: 55px 24px;
        border: 1px dashed #cbd5e1;
        border-radius: 12px;
        background: #ffffff;
        text-align: center;
    }

    .public-regulations-empty h2 {
        margin: 0;
        color: #111827;
        font-size: 18px;
        font-weight: 700;
    }

    .public-regulations-empty p {
        margin: 8px 0 0;
        color: #6b7280;
        font-size: 14px;
        line-height: 1.6;
    }

    .public-regulations-empty a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-top: 18px;
        min-height: 42px;
        border-radius: 8px;
        padding: 0 16px;
        background: #174ea6;
        color: #ffffff;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
    }

    .public-regulations-empty a:hover {
        background: #123d82;
    }


    /* =========================================================
       TABLET
    ========================================================== */

    @media (max-width: 768px) {

        .public-regulations-container {
            width: min(100% - 28px, 1200px);
        }

        .public-regulations-header {
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

        .public-regulations-content {
            padding-top: 8px;
        }

        .public-regulations-filters {
            grid-template-columns: 1fr;
        }

        .public-regulation-card {
            column-gap: 15px;
            padding: 17px 14px;
        }

        .public-regulation-title {
            font-size: 16px;
        }

    }


    /* =========================================================
       MOBILE
    ========================================================== */

    @media (max-width: 480px) {

        .public-regulations-container {
            width: calc(100% - 24px);
        }

        .public-regulations-header {
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
            line-height: 1.3;
        }


        /* SEARCH */

        .public-regulations-toolbar {
            padding: 16px;
            margin-bottom: 24px;
        }

        .public-regulations-search-row {
            grid-template-columns: 1fr;
            gap: 10px;
        }

        .public-regulations-search-button {
            width: 100%;
        }


        /* FILTER */

        .public-regulations-filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .public-regulations-apply-button,
        .public-regulations-reset-button {
            width: 100%;
        }


        /* RESULT */

        .public-regulations-result-title {
            font-size: 17px;
        }

        .public-regulations-result-info {
            font-size: 12px;
        }


        /* CARD */

        .public-regulation-card {
            display: flex;
            flex-direction: column;
            gap: 12px;
            padding: 16px;
        }

        .public-regulation-title {
            font-size: 15px;
            line-height: 1.5;
        }

        .public-regulation-status {
            order: 2;
        }

        .public-regulation-footer {
            order: 3;
            width: 100%;
            justify-content: stretch;
        }

        .public-regulation-link {
            width: 100%;
        }

    }


    /* =========================================================
       VERY SMALL
    ========================================================== */

    @media (max-width: 360px) {

        .public-regulations-container {
            width: calc(100% - 20px);
        }

        .public-section-heading-title {
            font-size: 21px;
        }

        .public-regulations-toolbar {
            padding: 14px;
        }

        .public-regulation-card {
            padding: 14px;
        }

        .public-regulation-type {
            padding: 5px 8px;
            font-size: 11px;
        }

        .public-regulation-title {
            font-size: 14px;
        }

        .public-regulation-link {
            min-height: 40px;
            font-size: 13px;
        }

    }

</style>

@endsection