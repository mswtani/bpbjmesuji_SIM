@extends('layouts.admin')

@section('title', $post->title)

@section('content')

<style>
    /*
    |--------------------------------------------------------------------------
    | ANTI HORIZONTAL OVERFLOW
    |--------------------------------------------------------------------------
    */

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }


    /*
    |--------------------------------------------------------------------------
    | HALAMAN DETAIL POST
    |--------------------------------------------------------------------------
    */

    .post-detail-page {
        width: 100%;
        max-width: 100%;
        overflow-x: hidden;
    }


    .post-detail-page * {
        min-width: 0;
    }


    /*
    |--------------------------------------------------------------------------
    | TEXT PANJANG
    |--------------------------------------------------------------------------
    */

    .post-detail-page h1,
    .post-detail-page h2,
    .post-detail-page h3,
    .post-detail-page h4,
    .post-detail-page p,
    .post-detail-page span,
    .post-detail-page a {
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    /*
    |--------------------------------------------------------------------------
    | IMAGE
    |--------------------------------------------------------------------------
    */

    .post-detail-page img {
        max-width: 100%;
        height: auto;
    }


    /*
    |--------------------------------------------------------------------------
    | CONTENT EDITOR
    |--------------------------------------------------------------------------
    */

    .post-content {
        width: 100%;
        max-width: 100%;
        overflow-wrap: anywhere;
        word-break: break-word;
    }


    .post-content img,
    .post-content iframe,
    .post-content video,
    .post-content embed,
    .post-content object {
        max-width: 100%;
        height: auto;
    }


    /*
    |--------------------------------------------------------------------------
    | PRE / CODE
    |--------------------------------------------------------------------------
    */

    .post-content pre,
    .post-content code {
        max-width: 100%;
        white-space: pre-wrap;
        word-break: break-word;
        overflow-wrap: anywhere;
    }


    /*
    |--------------------------------------------------------------------------
    | TABLE RESPONSIVE
    |--------------------------------------------------------------------------
    */

    .post-content table {
        display: block;
        width: 100%;
        max-width: 100%;
        overflow-x: auto;
        -webkit-overflow-scrolling: touch;
    }


    /*
    |--------------------------------------------------------------------------
    | ACTION BUTTON
    |--------------------------------------------------------------------------
    */

    .post-detail-actions {
        width: 100%;
        max-width: 100%;
    }


    @media (max-width: 639px) {

        .post-detail-actions {
            flex-direction: column;
            align-items: stretch;
        }


        .post-detail-actions > * {
            width: 100%;
            max-width: 100%;
        }

    }


    /*
    |--------------------------------------------------------------------------
    | MOBILE EXTRA SMALL
    |--------------------------------------------------------------------------
    */

    @media (max-width: 374px) {

        .post-detail-page {
            overflow-x: hidden;
        }

    }
</style>

    @php
        /*
        |--------------------------------------------------------------------------
        | TYPE
        |--------------------------------------------------------------------------
        */

        $typeLabel = match ($post->type) {
            'news' => 'Berita',
            'announcement' => 'Pengumuman',
            'regulation' => 'Regulasi',
            default => 'Konten',
        };

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $statusLabel = match ($post->status) {
            'draft' => 'Draft',
            'published' => 'Published',
            'archived' => 'Archived',
            default => ucfirst($post->status),
        };

        $statusClasses = match ($post->status) {
            'draft' =>
                'bg-gray-100 text-gray-700',

            'published' =>
                'bg-emerald-50 text-emerald-700',

            'archived' =>
                'bg-red-50 text-red-700',

            default =>
                'bg-gray-100 text-gray-700',
        };

        /*
        |--------------------------------------------------------------------------
        | TYPE STYLE
        |--------------------------------------------------------------------------
        */

        $typeClasses = match ($post->type) {
            'news' =>
                'bg-blue-50 text-blue-700',

            'announcement' =>
                'bg-amber-50 text-amber-700',

            'regulation' =>
                'bg-purple-50 text-purple-700',

            default =>
                'bg-gray-50 text-gray-700',
        };

        $iconClasses = match ($post->type) {
            'news' =>
                'bg-blue-50 text-blue-600',

            'announcement' =>
                'bg-amber-50 text-amber-600',

            'regulation' =>
                'bg-purple-50 text-purple-600',

            default =>
                'bg-gray-50 text-gray-600',
        };

        /*
        |--------------------------------------------------------------------------
        | REGULATION RELATIONS
        |--------------------------------------------------------------------------
        */

        $directRelations = collect();

        $amendedBy = collect();

        $repealedBy = collect();

        if ($post->type === 'regulation') {

            $directRelations = $post->regulationRelations
                ->filter(
                    fn ($relation) =>
                        $relation->relatedPost
                );

            $amendedBy = $post->amendedBy
                ->filter(
                    fn ($relation) =>
                        $relation->post
                );

            $repealedBy = $post->repealedBy
                ->filter(
                    fn ($relation) =>
                        $relation->post
                );
        }

        /*
        |--------------------------------------------------------------------------
        | DOCUMENT
        |--------------------------------------------------------------------------
        */

        $documentExtension = $post->document_path
            ? strtolower(
                pathinfo(
                    $post->document_path,
                    PATHINFO_EXTENSION
                )
            )
            : null;

        $isPdf = $documentExtension === 'pdf';

        /*
        |--------------------------------------------------------------------------
        | LEGAL STATUS
        |--------------------------------------------------------------------------
        */

        $legalStatusLabel = match ($post->legal_status) {

            'berlaku' =>
                'Berlaku',

            'tidak_berlaku' =>
                'Tidak Berlaku',

            'dicabut' =>
                'Dicabut',

            'diubah' =>
                'Diubah',

            default =>
                'Belum ditentukan',
        };

        $legalStatusClasses = match ($post->legal_status) {

            'berlaku' =>
                'bg-emerald-50 text-emerald-700',

            'tidak_berlaku' =>
                'bg-gray-100 text-gray-700',

            'dicabut' =>
                'bg-red-50 text-red-700',

            'diubah' =>
                'bg-amber-50 text-amber-700',

            default =>
                'bg-gray-100 text-gray-600',
        };
    @endphp


    {{-- =========================================================
         PAGE WRAPPER
    ========================================================== --}}

    <div class="mx-auto max-w-6xl">


        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-6">

            <div
                class="
                    flex flex-col gap-5
                    sm:flex-row
                    sm:items-start
                    sm:justify-between
                "
            >

                {{-- Header kiri --}}
                <div class="flex min-w-0 items-start gap-4">

                    {{-- Icon --}}
                    <div
                        class="
                            flex h-12 w-12 shrink-0
                            items-center justify-center
                            rounded-2xl
                            {{ $iconClasses }}
                        "
                        >

                        @if ($post->type === 'news')

                            {{-- News --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 5h16v14H4z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 9h8M8 13h5"
                                />
                            </svg>

                        @elseif ($post->type === 'announcement')

                            {{-- Announcement --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M4 11h4l8-5v12l-8-5H4v-2Z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M8 13v5"
                                />
                            </svg>

                        @else

                            {{-- Regulation --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M6 3h9l3 3v15H6z"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M15 3v4h4M9 12h6M9 16h6"
                                />
                            </svg>

                        @endif

                    </div>


                    {{-- Title --}}
                    <div class="min-w-0">

                        <div class="flex flex-wrap items-center gap-2">

                            <span
                                class="
                                    inline-flex
                                    rounded-full
                                    px-3 py-1
                                    text-xs font-medium
                                    {{ $typeClasses }}
                                "
                            >
                                {{ $typeLabel }}
                            </span>


                            <span
                                class="
                                    inline-flex
                                    rounded-full
                                    px-3 py-1
                                    text-xs font-medium
                                    {{ $statusClasses }}
                                "
                            >
                                {{ $statusLabel }}
                            </span>

                        </div>


                        <h1
                            class="
                                text-xl
                                font-bold
                                tracking-tight
                                text-gray-900

                                sm:text-2xl
                                lg:text-3xl
                            "
                            >
                            {{ $post->title }}
                        </h1>


                        <p class="mt-1.5 text-sm text-gray-500">

                            @if ($post->author)

                                Oleh
                                <span class="font-medium text-gray-700">
                                    {{ $post->author->name }}
                                </span>

                            @endif

                            <span class="mx-1 text-gray-300">
                                •
                            </span>

                            {{ $post->created_at?->format('d M Y H:i') }}

                        </p>

                    </div>

                </div>


                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div
                    class="
                        flex shrink-0
                        flex-wrap items-center gap-2
                        item-center
                        justify-center
                        lg:justify-start
                    "
                    >

                    {{-- Edit --}}
                    @if (
                        auth()->user()->hasPermission('posts.update') &&
                        (
                            $post->status === 'draft' ||
                            (
                                $post->status === 'published' &&
                                auth()->user()->hasPermission('posts.update-published')
                            )
                        )
                        )

                        <a
                            href="{{ route('posts.edit', $post) }}"
                            title="Edit konten"
                            aria-label="Edit konten"
                            class="
                                inline-flex
                                items-center justify-center
                                gap-2
                                rounded-lg
                                px-3
                                py-2
                                text-white
                                bg-amber-500
                                transition
                                hover:bg-amber-100
                                hover:text-amber-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-amber-500/30
                            "
                            >

                            <svg
                                class="h-5 w-5"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 20h9"
                                />

                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                                />
                            </svg>

                            <span class="lg:hidden text-sm font-normal">
                                Edit
                            </span>

                        </a>

                    @endif


                    {{-- Publish --}}
                    @if (
                        $post->status === 'draft' &&
                        auth()->user()?->hasPermission('posts.publish')
                        )

                        <form
                            method="POST"
                            action="{{ route('posts.publish', $post) }}"
                            data-confirm="Publikasikan konten ini?"
                            data-confirm-action="publish"
                            data-confirm-button="Publish"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                title="Publish"
                                aria-label="Publish konten"
                                class="
                                    inline-flex
                                    items-center justify-center
                                    gap-2
                                    rounded-lg
                                    px-3
                                    py-2
                                    text-white
                                    bg-emerald-600
                                    transition
                                    hover:bg-emerald-100
                                    hover:text-emerald-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-emerald-500/30
                                "
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="m5 12 4 4L19 6"
                                    />
                                </svg>

                                <span class="lg:hidden text-sm font-medium">
                                    Publish
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- Archive --}}
                    @if (
                        $post->status === 'published' &&
                        auth()->user()?->hasPermission('posts.publish')
                        )

                        <form
                            method="POST"
                            action="{{ route('posts.archive', $post) }}"
                            data-confirm="Arsipkan konten ini?"
                            data-confirm-action="archive"
                            data-confirm-button="Arsipkan"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                title="Arsipkan"
                                aria-label="Arsipkan konten"
                                class="
                                    inline-flex
                                    items-center justify-center
                                    gap-2
                                    rounded-lg
                                    px-3
                                    py-2
                                    text-white
                                    bg-orange-500
                                    transition
                                    hover:bg-orange-50
                                    hover:text-orange-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-orange-500/30
                                "
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 7h16v13H4V7Z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 7l2-4h14l2 4M9 12h6"
                                    />
                                </svg>

                                <span class="lg:hidden text-sm font-normal">
                                    Arsipkan
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- Restore --}}
                    @if (
                        $post->status === 'archived' &&
                        auth()->user()?->hasPermission('posts.restore')
                    )

                        <form
                            method="POST"
                            action="{{ route('posts.restore', $post) }}"
                            data-confirm="Kembalikan konten ini menjadi draft?"
                            data-confirm-action="restore"
                            data-confirm-button="Kembalikan"
                        >

                            @csrf
                            @method('PATCH')

                            <button
                                type="submit"
                                title="Kembalikan ke draft"
                                aria-label="Kembalikan konten ke draft"
                                class="
                                    inline-flex
                                    items-center justify-center
                                    gap-2
                                    rounded-lg
                                    px-3
                                    py-2
                                    text-white
                                    bg-amber-500
                                    transition
                                    hover:bg-amber-50
                                    hover:text-amber-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-amber-500/30
                                "
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 12a8 8 0 1 0 2.34-5.66"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 5v5h5"
                                    />
                                </svg>

                                <span class="lg:hidden text-sm font-normal">
                                    Restore
                                </span>

                            </button>

                        </form>

                    @endif


                    {{-- Delete Draft --}}
                    @if (
                        $post->status === 'draft' &&
                        auth()->user()?->hasPermission('posts.delete')
                    )

                        <form
                            method="POST"
                            action="{{ route('posts.destroy', $post) }}"
                            data-confirm="Hapus draft ini secara permanen? Tindakan ini tidak dapat dibatalkan."
                            data-confirm-action="delete"
                            data-confirm-button="Hapus Draft"
                        >

                            @csrf
                            @method('DELETE')

                            <button
                                type="submit"
                                title="Hapus draft"
                                aria-label="Hapus draft"
                                class="
                                    inline-flex
                                    items-center justify-center
                                    gap-2
                                    rounded-lg
                                    px-3
                                    py-2
                                    text-white
                                    bg-red-500
                                    transition
                                    hover:bg-red-100
                                    hover:text-red-700
                                    focus:outline-none
                                    focus:ring-2
                                    focus:ring-red-500/30
                                "
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 6h8M9 6v12m6-12v12M5 6h14M7 6l1 14h8l1-14"
                                    />
                                </svg>

                                <span class="lg:hidden text-sm font-normal">
                                    Hapus
                                </span>

                            </button>

                        </form>

                    @endif

                </div>

            </div>

        </div>


        {{-- =========================================================
             REGULATION
        ========================================================== --}}

        @if ($post->type === 'regulation')

            <div
                class="
                    grid gap-6
                    lg:grid-cols-[300px_minmax(0,1fr)]
                    lg:items-start
                "
            >

                {{-- =================================================
                     LEFT COLUMN
                ================================================== --}}

                <div class="space-y-6">


                    {{-- INFORMASI REGULASI --}}
                    <x-admin.card :padding="false">

                        <div class="border-b border-gray-200 px-5 py-4">

                            <h2 class="text-sm font-semibold text-gray-900">
                                Informasi Regulasi
                            </h2>

                            <p class="mt-1 text-xs text-gray-500">
                                Informasi dasar regulasi.
                            </p>

                        </div>


                        <div class="divide-y divide-gray-100">

                            {{-- Jenis --}}
                            <div class="px-5 py-4">

                                <p
                                    class="
                                        text-[11px]
                                        font-medium
                                        uppercase
                                        tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Jenis Regulasi
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $post->regulationType?->name ?? 'Belum ditentukan' }}
                                </p>

                            </div>


                            {{-- Nomor --}}
                            <div class="px-5 py-4">

                                <p
                                    class="
                                        text-[11px]
                                        font-medium
                                        uppercase
                                        tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Nomor
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $post->regulation_number ?? 'Belum ditentukan' }}
                                </p>

                            </div>


                            {{-- Tahun --}}
                            <div class="px-5 py-4">

                                <p
                                    class="
                                        text-[11px]
                                        font-medium
                                        uppercase
                                        tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Tahun
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-900">
                                    {{ $post->regulation_year ?? 'Belum ditentukan' }}
                                </p>

                            </div>


                            {{-- Tanggal --}}
                            <div class="px-5 py-4">

                                <p
                                    class="
                                        text-[11px]
                                        font-medium
                                        uppercase
                                        tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Tanggal Diundangkan
                                </p>

                                <p class="mt-1 text-sm font-medium text-gray-900">

                                    {{ $post->regulation_date?->format('d F Y') ?? 'Belum ditentukan' }}

                                </p>

                            </div>



                        </div>

                    </x-admin.card>


                    {{-- =================================================
                         HUBUNGAN REGULASI
                    ================================================== --}}

                    @if (
                        $directRelations->isNotEmpty() ||
                        $amendedBy->isNotEmpty() ||
                        $repealedBy->isNotEmpty()
                    )

                        <x-admin.card :padding="false">

                            <div class="border-b border-gray-200 px-5 py-4">

                                <h2 class="text-sm font-semibold text-gray-900">
                                    Hubungan Regulasi
                                </h2>

                                <p class="mt-1 text-xs text-gray-500">
                                    Riwayat perubahan dan pencabutan regulasi.
                                </p>

                            </div>


                            <div class="space-y-4 p-4">


                                {{-- =================================================
                                     MENCABUT
                                ================================================== --}}

                                @foreach (
                                    $directRelations->where('relation_type', 'repeals')
                                    as $relation
                                )

                                    <div
                                        class="
                                            rounded-xl
                                            border border-red-200
                                            bg-red-50
                                            p-4
                                        "
                                    >

                                        <p
                                            class="
                                                text-[11px]
                                                font-semibold
                                                uppercase
                                                tracking-wide
                                                text-red-700
                                            "
                                        >
                                            Mencabut
                                        </p>


                                        <a
                                            href="{{ route('posts.show', $relation->relatedPost) }}"
                                            class="
                                                mt-2
                                                block
                                                text-sm
                                                font-medium
                                                leading-5
                                                text-blue-700
                                                hover:text-blue-900
                                                hover:underline
                                            "
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>


                                        @if ($relation->relatedPost->regulation_number)

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                     MENGUBAH
                                ================================================== --}}

                                @foreach (
                                    $directRelations->where('relation_type', 'amends')
                                    as $relation
                                )

                                    <div
                                        class="
                                            rounded-xl
                                            border border-amber-200
                                            bg-amber-50
                                            p-4
                                        "
                                    >

                                        <p
                                            class="
                                                text-[11px]
                                                font-semibold
                                                uppercase
                                                tracking-wide
                                                text-amber-700
                                            "
                                        >
                                            Mengubah
                                        </p>


                                        <a
                                            href="{{ route('posts.show', $relation->relatedPost) }}"
                                            class="
                                                mt-2
                                                block
                                                text-sm
                                                font-medium
                                                leading-5
                                                text-blue-700
                                                hover:text-blue-900
                                                hover:underline
                                            "
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>


                                        @if ($relation->relatedPost->regulation_number)

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                     DIUBAH OLEH
                                ================================================== --}}

                                @foreach ($amendedBy as $relation)

                                    <div
                                        class="
                                            rounded-xl
                                            border border-amber-200
                                            bg-amber-50
                                            p-4
                                        "
                                    >

                                        <p
                                            class="
                                                text-[11px]
                                                font-semibold
                                                uppercase
                                                tracking-wide
                                                text-amber-700
                                            "
                                        >
                                            Diubah oleh
                                        </p>


                                        <a
                                            href="{{ route('posts.show', $relation->post) }}"
                                            class="
                                                mt-2
                                                block
                                                text-sm
                                                font-medium
                                                leading-5
                                                text-blue-700
                                                hover:text-blue-900
                                                hover:underline
                                            "
                                        >
                                            {{ $relation->post->title }}
                                        </a>


                                        @if ($relation->post->regulation_number)

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $relation->post->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                     DICABUT OLEH
                                ================================================== --}}

                                @foreach ($repealedBy as $relation)

                                    <div
                                        class="
                                            rounded-xl
                                            border border-red-200
                                            bg-red-50
                                            p-4
                                        "
                                    >

                                        <p
                                            class="
                                                text-[11px]
                                                font-semibold
                                                uppercase
                                                tracking-wide
                                                text-red-700
                                            "
                                        >
                                            Dicabut oleh
                                        </p>


                                        <a
                                            href="{{ route('posts.show', $relation->post) }}"
                                            class="
                                                mt-2
                                                block
                                                text-sm
                                                font-medium
                                                leading-5
                                                text-blue-700
                                                hover:text-blue-900
                                                hover:underline
                                            "
                                        >
                                            {{ $relation->post->title }}
                                        </a>


                                        @if ($relation->post->regulation_number)

                                            <p class="mt-1 text-xs text-gray-500">
                                                {{ $relation->post->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        </x-admin.card>

                    @endif

                </div>


                {{-- =================================================
                     RIGHT COLUMN
                ================================================== --}}

                <div class="space-y-6">


                    {{-- =================================================
                         DOKUMEN REGULASI
                    ================================================== --}}

                    @if (
                        $post->document_path &&
                        \Illuminate\Support\Facades\Storage::disk('public')->exists(
                            $post->document_path
                        )
                    )

                        <x-admin.card :padding="false">

                            {{-- Document Header --}}
                            <div
                                class="
                                    flex
                                    flex-col gap-3
                                    border-b border-gray-200
                                    px-5 py-4
                                    sm:flex-row
                                    sm:items-center
                                    sm:justify-between
                                "
                            >

                                <div class="min-w-0">

                                    <h2 class="text-sm font-semibold text-gray-900">
                                        Dokumen Regulasi
                                    </h2>

                                    <p
                                        class="
                                            mt-1
                                            truncate
                                            text-xs
                                            text-gray-500
                                        "
                                    >
                                        {{ $post->document_original_name ?? 'Dokumen Regulasi' }}
                                    </p>

                                </div>


                                <a
                                    href="{{ route('posts.document.download', $post) }}"
                                    class="
                                        inline-flex
                                        shrink-0
                                        items-center
                                        justify-center
                                        gap-2
                                        rounded-lg
                                        bg-blue-600
                                        px-4 py-2
                                        text-sm
                                        font-medium
                                        text-white
                                        shadow-sm
                                        transition
                                        hover:bg-blue-700
                                        focus:outline-none
                                        focus:ring-2
                                        focus:ring-blue-500/30
                                    "
                                >

                                    <svg
                                        class="h-4 w-4"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 3v12"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="m7 10 5 5 5-5"
                                        />

                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M5 21h14"
                                        />
                                    </svg>

                                    {{ $isPdf ? 'Download PDF' : 'Download Dokumen' }}

                                </a>

                            </div>


                            {{-- PDF Viewer --}}
                            @if ($isPdf)

                                <div class="p-4">

                                    <div
                                        class="
                                            overflow-hidden
                                            rounded-xl
                                            border border-gray-200
                                            bg-gray-100
                                        "
                                    >

                                        <iframe
                                            src="{{ route('posts.document.preview', $post) }}"
                                            title="Preview {{ $post->document_original_name ?? 'Dokumen Regulasi' }}"
                                            class="
                                                block
                                                h-[70vh]
                                                min-h-[620px]
                                                w-full
                                            "
                                        ></iframe>

                                    </div>

                                </div>

                            @else

                                <div class="p-8">

                                    <div
                                        class="
                                            flex flex-col
                                            items-center
                                            justify-center
                                            rounded-xl
                                            border border-dashed
                                            border-gray-300
                                            bg-gray-50
                                            px-6 py-12
                                            text-center
                                        "
                                    >

                                        <div
                                            class="
                                                flex h-14 w-14
                                                items-center justify-center
                                                rounded-2xl
                                                bg-purple-50
                                                text-purple-600
                                            "
                                        >

                                            <svg
                                                class="h-7 w-7"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M6 3h9l3 3v15H6z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M15 3v4h4"
                                                />
                                            </svg>

                                        </div>


                                        <p class="mt-4 text-sm font-medium text-gray-900">
                                            Dokumen tidak dapat ditampilkan sebagai PDF.
                                        </p>

                                        <p class="mt-1 text-xs text-gray-500">
                                            Silakan gunakan tombol Download Dokumen.
                                        </p>

                                    </div>

                                </div>

                            @endif

                        </x-admin.card>

                    @endif

                    @if ($post->excerpt)

                        <x-admin.card>

                            <h2 class="text-sm font-semibold text-gray-900">
                                Ringkasan Regulasi
                            </h2>
                            
                            <div
                                class="
                                    border-l-[3px] border-[#caa73e]
                                    px-4
                                    mt-5
                                    max-w-none
                                    text-sm
                                    leading-7
                                    text-gray-800
                                    [&_a]:font-medium
                                    [&_a]:text-blue-600
                                    [&_a]:underline
                                    [&_a:hover]:text-blue-800
                                    [&_p]:mb-4
                                    [&_ul]:mb-4
                                    [&_ul]:list-disc
                                    [&_ul]:pl-6
                                    [&_ol]:mb-4
                                    [&_ol]:list-decimal
                                    [&_ol]:pl-6
                                "
                            >
                                {!! $post->excerpt !!}
                            </div>
                        </x-admin.card>

                    @endif
                    


                    {{-- =================================================
                         ISI REGULASI
                    ================================================== --}}

                    <x-admin.card>

                        <h2 class="text-sm font-semibold text-gray-900">
                            Isi Regulasi
                        </h2>

                        <div
                            class="
                                mt-5
                                max-w-none
                                text-sm
                                leading-7
                                text-gray-800
                                [&_a]:font-medium
                                [&_a]:text-blue-600
                                [&_a]:underline
                                [&_a:hover]:text-blue-800
                                [&_p]:mb-4
                                [&_ul]:mb-4
                                [&_ul]:list-disc
                                [&_ul]:pl-6
                                [&_ol]:mb-4
                                [&_ol]:list-decimal
                                [&_ol]:pl-6
                            "
                        >
                            {!! $post->content !!}
                        </div>

                    </x-admin.card>

                </div>

            </div>


        {{-- =========================================================
             NEWS / ANNOUNCEMENT
        ========================================================== --}}

        @else

            <x-admin.card>

                {{-- Featured Image --}}
                @if (
                    $post->featured_image &&
                    \Illuminate\Support\Facades\Storage::disk('public')->exists(
                        $post->featured_image
                    )
                )

                    <div class="mb-6 overflow-hidden rounded-xl border border-gray-200 bg-gray-50">

                        <img
                            src="{{ asset('storage/' . $post->featured_image) }}"
                            alt="{{ $post->title }}"
                            class="
                                max-h-[520px]
                                w-full
                                object-contain
                            "
                        >

                    </div>

                @endif


                {{-- Announcement Highlight --}}
                @if ($post->type === 'announcement')

                    <div
                        class="
                            mb-6
                            rounded-xl
                            border border-amber-200
                            bg-amber-50
                            p-5
                        "
                    >

                        <div class="flex items-start gap-3">

                            <div
                                class="
                                    flex h-10 w-10 shrink-0
                                    items-center justify-center
                                    rounded-xl
                                    bg-amber-100
                                    text-amber-600
                                "
                            >

                                <svg
                                    class="h-5 w-5"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                    viewBox="0 0 24 24"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M4 11h4l8-5v12l-8-5H4v-2Z"
                                    />

                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M8 13v5"
                                    />
                                </svg>

                            </div>


                            <div>

                                <p class="text-sm font-semibold text-amber-900">
                                    Pengumuman
                                </p>

                                <p class="mt-1 text-sm leading-6 text-amber-800">
                                    Informasi resmi yang disampaikan melalui sistem.
                                </p>

                            </div>

                        </div>

                    </div>

                @endif


                {{-- Excerpt --}}
                @if ($post->excerpt)

                    <div
                        class="
                            my-8
                            border-l-4 border-[#caa73e]
                            pl-5
                            text-base
                            leading-7
                            text-gray-700
                        ">
                        {!! $post->excerpt !!}
                    </div>

                @endif


                {{-- Content --}}
                <div
                    class="
                        max-w-none
                        text-sm
                        leading-7
                        text-gray-800
                        [&_a]:font-medium
                        [&_a]:text-blue-600
                        [&_a]:underline
                        [&_a:hover]:text-blue-800
                        [&_p]:mb-4
                        [&_ul]:mb-4
                        [&_ul]:list-disc
                        [&_ul]:pl-6
                        [&_ol]:mb-4
                        [&_ol]:list-decimal
                        [&_ol]:pl-6
                    "
                >
                    {!! $post->content !!}
                </div>


                {{-- Metadata --}}
                <div
                    class="
                        mt-8
                        grid
                        gap-4
                        border-t border-gray-200
                        pt-6
                        sm:grid-cols-3
                    "
                >

                    <div>

                        <p
                            class="
                                text-[11px]
                                font-medium
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Penulis
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $post->author?->name ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="
                                text-[11px]
                                font-medium
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Dibuat
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $post->created_at?->format('d M Y H:i') ?? '—' }}
                        </p>

                    </div>


                    <div>

                        <p
                            class="
                                text-[11px]
                                font-medium
                                uppercase
                                tracking-wide
                                text-gray-500
                            "
                        >
                            Diperbarui
                        </p>

                        <p class="mt-1 text-sm font-medium text-gray-900">
                            {{ $post->updated_at?->format('d M Y H:i') ?? '—' }}
                        </p>

                    </div>

                </div>

            </x-admin.card>

        @endif


        {{-- =========================================================
             BACK
        ========================================================== --}}

        <div class="mt-6">

            <a
                href="{{ route('posts.index') }}"
                class="
                    inline-flex
                    w-full
                    items-center
                    justify-center
                    gap-2
                    rounded-lg
                    border
                    border-gray-300
                    bg-red-500
                    px-3
                    py-3
                    text-center
                    text-sm
                    font-medium
                    text-white
                    transition

                    hover:bg-gray-50

                    focus:outline-none
                    focus:ring-2
                    focus:ring-blue-500/30

                    sm:w-auto
                "
            >

                <svg
                    class="h-4 w-4"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 12H5"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m12 19-7-7 7-7"
                    />
                </svg>

                <span>
                    Kembali ke daftar konten
                </span>

            </a>

        </div>

    </div>

@endsection