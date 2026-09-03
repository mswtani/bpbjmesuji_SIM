@extends('layouts.admin')

@section('title', 'Detail Jenis Regulasi')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="flex items-start justify-between gap-4">

            <div class="min-w-0">

                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Detail Jenis Regulasi
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Informasi lengkap jenis regulasi.
                </p>

            </div>


            {{-- ACTION BUTTONS --}}
            <div class="flex shrink-0 items-center gap-2">

                {{-- Edit --}}
                @if (auth()->user()?->hasPermission('regulation-types.update'))

                    <a
                        href="{{ route('regulation-types.edit', $regulationType) }}"
                        title="Edit jenis regulasi"
                        aria-label="Edit jenis regulasi"
                        class="
                            inline-flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-amber-500
                            text-white
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
                                d="M12 20h9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                            />
                        </svg>

                    </a>

                @endif


                {{-- Delete --}}
                @if (auth()->user()?->hasPermission('regulation-types.delete'))

                    <button
                        type="button"
                        id="open-delete-regulation-type-modal"
                        title="Hapus jenis regulasi"
                        aria-label="Hapus jenis regulasi"
                        class="
                            inline-flex h-10 w-10
                            items-center justify-center
                            rounded-lg
                            bg-red-600
                            text-white
                            transition
                            hover:bg-red-50
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
                                d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                            />
                        </svg>

                    </button>

                @endif

            </div>

        </div>


        {{-- =====================================================
             REGULATION TYPE CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            {{-- HEADER CARD --}}
            <div
                class="
                    flex flex-col gap-4
                    border-b border-gray-100
                    px-5 py-5
                    sm:flex-row sm:items-center
                    sm:px-6
                "
            >

                {{-- ICON --}}
                <div
                    class="
                        flex h-14 w-14 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-50
                        text-blue-600
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
                            d="M4 5h16M4 9h16M4 13h16M4 17h16"
                        />
                    </svg>

                </div>


                {{-- NAME --}}
                <div class="min-w-0 flex-1">

                    <h2
                        class="
                            truncate
                            text-lg font-semibold
                            text-gray-900
                        "
                    >
                        {{ $regulationType->name }}
                    </h2>

                    <p class="mt-1 text-sm text-gray-500">

                        @if ($regulationType->description)

                            {{ $regulationType->description }}

                        @else

                            Tidak ada deskripsi.

                        @endif

                    </p>

                </div>


                {{-- STATUS --}}
                <div class="shrink-0">

                    @if ($regulationType->is_active)

                        <span
                            class="
                                inline-flex items-center gap-1.5
                                rounded-full
                                bg-green-100
                                px-2.5 py-1
                                text-xs font-semibold
                                text-green-800
                            "
                        >
                            <span
                                class="
                                    h-1.5 w-1.5
                                    rounded-full
                                    bg-green-500
                                "
                            ></span>

                            Aktif

                        </span>

                    @else

                        <span
                            class="
                                inline-flex items-center gap-1.5
                                rounded-full
                                bg-red-100
                                px-2.5 py-1
                                text-xs font-semibold
                                text-red-800
                            "
                        >
                            <span
                                class="
                                    h-1.5 w-1.5
                                    rounded-full
                                    bg-red-500
                                "
                            ></span>

                            Tidak Aktif

                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 DETAIL
            ================================================== --}}

            <div class="px-5 py-2 sm:px-6">

                <dl class="divide-y divide-gray-100">


                    {{-- Nama --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Nama
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm font-medium
                                text-gray-900
                                sm:col-span-2
                            "
                        >
                            {{ $regulationType->name }}
                        </dd>

                    </div>


                    {{-- Slug --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Slug
                        </dt>

                        <dd class="sm:col-span-2">

                            <code
                                class="
                                    inline-flex
                                    break-all
                                    rounded-md
                                    bg-gray-100
                                    px-2 py-1
                                    text-xs
                                    text-gray-700
                                "
                            >
                                {{ $regulationType->slug }}
                            </code>

                        </dd>

                    </div>


                    {{-- Deskripsi --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-3
                            sm:grid-cols-3 sm:gap-6
                        "
                    >
                        <dt class="text-sm font-medium text-gray-500">
                            Deskripsi
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm
                                leading-6
                                text-gray-700
                                sm:col-span-2
                            "
                        >{{ $regulationType->description ?: '-' }}</dd>
                    </div>


                    {{-- Urutan --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Urutan
                        </dt>

                        <dd
                            class="
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >

                            <span
                                class="
                                    inline-flex
                                    min-w-8
                                    items-center
                                    justify-center
                                    rounded-md
                                    bg-blue-50
                                    px-2 py-1
                                    text-xs
                                    font-semibold
                                    text-blue-700
                                "
                            >
                                {{ $regulationType->sort_order }}
                            </span>

                        </dd>

                    </div>


                    {{-- Jumlah Konten --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Digunakan oleh
                        </dt>

                        <dd
                            class="
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >

                            {{ $regulationType->posts_count }}

                            {{ Str::plural('konten regulasi', $regulationType->posts_count) }}

                        </dd>

                    </div>


                    {{-- Dibuat --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Dibuat
                        </dt>

                        <dd
                            class="
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >
                            {{ $regulationType->created_at?->format('d M Y, H:i') ?? '-' }}
                        </dd>

                    </div>


                    {{-- Diperbarui --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Terakhir diperbarui
                        </dt>

                        <dd
                            class="
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >
                            {{ $regulationType->updated_at?->format('d M Y, H:i') ?? '-' }}
                        </dd>

                    </div>

                </dl>

            </div>

        </x-admin.card>


        {{-- =====================================================
             BACK
        ====================================================== --}}

        <div>

            <a
                href="{{ route('regulation-types.index') }}"
                class="
                    inline-flex
                    w-full
                    items-center
                    justify-center
                    gap-2
                    rounded-lg
                    border border-gray-200
                    bg-red-500
                    px-4 py-2.5
                    text-sm font-medium
                    text-white
                    shadow-sm
                    transition
                    hover:border-gray-300
                    hover:bg-gray-100
                    hover:text-gray-900
                    focus:outline-none
                    focus:ring-2
                    focus:ring-gray-500/20

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
                    Kembali ke daftar jenis regulasi
                </span>

            </a>

        </div>

    </div>


    {{-- =====================================================
         DELETE CONFIRMATION MODAL
    ====================================================== --}}

    @if (auth()->user()?->hasPermission('regulation-types.delete'))

        <div
            id="delete-regulation-type-modal"
            class="
                fixed inset-0 z-50
                hidden
                items-center justify-center
                bg-gray-900/50
                px-4
                backdrop-blur-sm
            "
        >

            <div
                class="
                    relative
                    w-full max-w-lg
                    overflow-hidden
                    rounded-2xl
                    bg-white
                    shadow-2xl
                "
                role="dialog"
                aria-modal="true"
                aria-labelledby="delete-regulation-type-title"
            >

                {{-- Close --}}
                <button
                    type="button"
                    id="close-delete-regulation-type-modal"
                    class="
                        absolute right-4 top-4 z-10
                        inline-flex h-9 w-9
                        items-center justify-center
                        rounded-lg
                        text-gray-400
                        transition
                        hover:bg-gray-100
                        hover:text-gray-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
                    "
                    aria-label="Tutup modal"
                >

                    <svg
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="2"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M6 18 18 6M6 6l12 12"
                        />
                    </svg>

                </button>


                {{-- CONTENT --}}
                <div class="px-6 py-7 text-center sm:px-8">

                    <div
                        class="
                            mx-auto
                            flex h-14 w-14
                            items-center justify-center
                            rounded-2xl
                            bg-red-50
                            text-red-600
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
                                d="M3 6h18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 6V4h8v2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 6l-1 14H6L5 6"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M10 11v6"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M14 11v6"
                            />
                        </svg>

                    </div>


                    <h3
                        id="delete-regulation-type-title"
                        class="
                            mt-5
                            text-xl font-semibold
                            text-gray-900
                        "
                    >
                        Hapus jenis regulasi?
                    </h3>


                    <p
                        class="
                            mx-auto mt-3
                            max-w-md
                            text-sm leading-6
                            text-gray-600
                        "
                    >
                        Anda akan menghapus jenis regulasi berikut:
                    </p>


                    <div
                        class="
                            mx-auto mt-4
                            max-w-md
                            rounded-xl
                            border border-red-200
                            bg-red-50
                            px-4 py-3
                        "
                    >

                        <p
                            class="
                                text-sm font-semibold
                                text-red-800
                            "
                        >
                            {{ $regulationType->name }}
                        </p>

                    </div>


                    <p
                        class="
                            mx-auto mt-5
                            max-w-md
                            text-sm leading-6
                            text-gray-500
                        "
                    >
                        Tindakan ini tidak dapat dibatalkan.
                    </p>

                </div>


                {{-- ACTION --}}
                <div
                    class="
                        flex flex-col-reverse gap-3
                        border-t border-gray-100
                        px-6 py-4
                        sm:flex-row sm:justify-end
                    "
                >

                    <button
                        type="button"
                        id="cancel-delete-regulation-type"
                        class="
                            inline-flex
                            items-center justify-center
                            rounded-lg
                            border border-gray-300
                            bg-white
                            px-4 py-2.5
                            text-sm font-medium
                            text-gray-700
                            transition
                            hover:bg-gray-50
                        "
                    >
                        Batal
                    </button>


                    <form
                        method="POST"
                        action="{{ route('regulation-types.destroy', $regulationType) }}"
                    >

                        @csrf
                        @method('DELETE')

                        <button
                            type="submit"
                            class="
                                inline-flex
                                w-full
                                items-center justify-center
                                gap-2
                                rounded-lg
                                bg-red-600
                                px-4 py-2.5
                                text-sm font-semibold
                                text-white
                                shadow-sm
                                transition
                                hover:bg-red-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-red-500/30
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
                                    d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
                                />
                            </svg>

                            Ya, Hapus

                        </button>

                    </form>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
         JAVASCRIPT DELETE MODAL
    ====================================================== --}}

    @if (auth()->user()?->hasPermission('regulation-types.delete'))

        <script>
            document.addEventListener('DOMContentLoaded', function () {

                const openButton = document.getElementById(
                    'open-delete-regulation-type-modal'
                );

                const deleteModal = document.getElementById(
                    'delete-regulation-type-modal'
                );

                const closeButton = document.getElementById(
                    'close-delete-regulation-type-modal'
                );

                const cancelButton = document.getElementById(
                    'cancel-delete-regulation-type'
                );


                function openDeleteModal() {

                    deleteModal.classList.remove('hidden');
                    deleteModal.classList.add('flex');

                    document.body.classList.add('overflow-hidden');

                }


                function closeDeleteModal() {

                    deleteModal.classList.add('hidden');
                    deleteModal.classList.remove('flex');

                    document.body.classList.remove('overflow-hidden');

                }


                if (openButton) {

                    openButton.addEventListener(
                        'click',
                        openDeleteModal
                    );

                }


                if (closeButton) {

                    closeButton.addEventListener(
                        'click',
                        closeDeleteModal
                    );

                }


                if (cancelButton) {

                    cancelButton.addEventListener(
                        'click',
                        closeDeleteModal
                    );

                }


                if (deleteModal) {

                    deleteModal.addEventListener(
                        'click',
                        function (event) {

                            if (event.target === deleteModal) {

                                closeDeleteModal();

                            }

                        }
                    );

                }


                document.addEventListener(
                    'keydown',
                    function (event) {

                        if (
                            event.key === 'Escape' &&
                            deleteModal &&
                            !deleteModal.classList.contains('hidden')
                        ) {

                            closeDeleteModal();

                        }

                    }
                );

            });
        </script>

    @endif

@endsection