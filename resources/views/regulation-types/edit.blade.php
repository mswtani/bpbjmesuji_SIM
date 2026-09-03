@extends('layouts.admin')

@section('title', 'Edit Jenis Regulasi')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="flex items-start gap-4">

            {{-- Icon --}}

            <div
                class="
                    flex h-12 w-12 shrink-0
                    items-center justify-center
                    rounded-2xl
                    bg-amber-50
                    text-amber-600
                "
            >

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
                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                    />
                </svg>

            </div>


            {{-- Title --}}

            <div class="min-w-0">

                <h1
                    class="
                        text-2xl font-bold tracking-tight
                        text-gray-900
                        sm:text-3xl
                    "
                >
                    Edit Jenis Regulasi
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Perbarui informasi jenis regulasi.
                </p>

            </div>

        </div>


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card>

            <form
                id="regulation-type-form"
                method="POST"
                action="{{ route('regulation-types.update', $regulationType) }}"
                data-check-position-url="{{ route('regulation-types.check-position') }}"
                data-regulation-type-form
                data-ignore-id="{{ $regulationType->id }}"
                >

                @csrf

                @method('PUT')


                @include(
                    'regulation-types._form',
                    [
                        'regulationType' => $regulationType,
                    ]
                )


                {{-- =================================================
                     ACTION
                ================================================== --}}

                <div
                    class="
                        mt-8
                        flex flex-col gap-4
                        border-t border-gray-100
                        pt-6
                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                >

                    {{-- Kembali --}}

                    <a
                        href="{{ route('regulation-types.index') }}"
                        class="
                            order-2
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-red-500
                            px-4 py-2.5
                            text-sm font-medium
                            text-white
                            shadow-sm
                            transition
                            hover:bg-red-600
                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30
                            sm:order-1
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


                    {{-- Action kanan --}}

                    <div
                        class="
                            order-1
                            flex
                            w-full
                            items-center
                            justify-center
                            gap-3
                            sm:order-2
                            sm:w-auto
                            sm:justify-end
                        "
                    >

                        {{-- Batal --}}

                        <button
                            type="reset"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                rounded-lg
                                border border-gray-300
                                bg-white
                                px-4 py-2.5
                                text-sm font-medium
                                text-gray-700
                                shadow-sm
                                transition
                                hover:bg-gray-50
                                hover:text-gray-900
                                focus:outline-none
                                focus:ring-2
                                focus:ring-gray-500/20
                            "
                        >
                            Batal
                        </button>


                        {{-- Simpan --}}

                        <button
                            type="submit"
                            class="
                                inline-flex
                                items-center
                                justify-center
                                gap-2
                                rounded-lg
                                bg-blue-600
                                px-4 py-2.5
                                text-sm font-semibold
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
                                    d="m5 12.5 4.5 4.5L19 7.5"
                                />
                            </svg>

                            <span>
                                Simpan Perubahan
                            </span>

                        </button>

                    </div>

                </div>

            </form>

        </x-admin.card>

        {{-- =====================================================
            EDIT CONFIRMATION MODAL
        ====================================================== --}}

        <div
            id="edit-regulation-type-modal"
            class="
                fixed
                inset-0
                z-50
                hidden
                items-center
                justify-center
                bg-gray-900/50
                px-4
                backdrop-blur-sm
            "
        >
            <div
                class="
                    relative
                    w-full
                    max-w-lg
                    overflow-hidden
                    rounded-2xl
                    bg-white
                    shadow-2xl
                "
                role="dialog"
                aria-modal="true"
                aria-labelledby="edit-regulation-type-title"
            >

                {{-- Tombol Close X --}}

                <button
                    type="button"
                    id="close-edit-regulation-type-modal"
                    class="
                        absolute
                        right-4
                        top-4
                        inline-flex
                        h-9
                        w-9
                        items-center
                        justify-center
                        rounded-lg
                        text-gray-400
                        transition
                        hover:bg-gray-100
                        hover:text-gray-600
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
                    "
                    aria-label="Tutup"
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
                            d="M6 6l12 12M6 18 18 6"
                        />
                    </svg>
                </button>


                {{-- CONTENT --}}

                <div
                    class="
                        px-6
                        py-7
                        text-center
                        sm:px-8
                    "
                >

                    {{-- Icon --}}

                    <div
                        class="
                            mx-auto
                            flex
                            h-14
                            w-14
                            items-center
                            justify-center
                            rounded-2xl
                            bg-amber-50
                            text-amber-600
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
                                d="M12 4v16m8-8H4"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 12h14"
                            />
                        </svg>

                    </div>


                    {{-- Title --}}

                    <h3
                        id="edit-regulation-type-title"
                        class="
                            mt-5
                            text-xl
                            font-semibold
                            text-gray-900
                        "
                    >
                        Simpan perubahan?
                    </h3>


                    {{-- Description --}}

                    <p
                        class="
                            mx-auto
                            mt-3
                            max-w-md
                            text-sm
                            leading-6
                            text-gray-600
                        "
                    >
                        Perubahan pada jenis regulasi akan disimpan dan digunakan
                        pada sistem.
                    </p>

                </div>


                {{-- ACTION --}}

                <div
                    class="
                        flex
                        flex-col-reverse
                        gap-3
                        border-t
                        border-gray-100
                        bg-gray-50
                        px-6
                        py-4
                        sm:flex-row
                        sm:items-center
                        sm:justify-center
                        sm:px-8
                    "
                >

                    {{-- Batal --}}

                    <button
                        type="button"
                        id="cancel-edit-regulation-type"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-5
                            py-2.5
                            text-sm
                            font-medium
                            text-gray-700
                            shadow-sm
                            transition
                            hover:bg-gray-50
                            hover:text-gray-900
                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-500/20
                        "
                    >
                        Batal
                    </button>


                    {{-- Confirm --}}

                    <button
                        type="button"
                        id="confirm-edit-regulation-type"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-blue-600
                            px-5
                            py-2.5
                            text-sm
                            font-semibold
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
                            stroke-width="2"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m5 12.5 4.5 4.5L19 7.5"
                            />
                        </svg>

                        Simpan Perubahan

                    </button>

                </div>

            </div>

        </div>


         {{-- =====================================================
            JAVASCRIPT EDIT CONFIRMATION MODAL
        ====================================================== --}}

        <script>
            document.addEventListener('DOMContentLoaded', () => {

                const form = document.getElementById(
                    'regulation-type-form'
                );

                const modal = document.getElementById(
                    'edit-regulation-type-modal'
                );

                const cancelButton = document.getElementById(
                    'cancel-edit-regulation-type'
                );

                const confirmButton = document.getElementById(
                    'confirm-edit-regulation-type'
                );

                const closeButton = document.getElementById(
                    'close-edit-regulation-type-modal'
                );


                if (
                    ! form ||
                    ! modal ||
                    ! cancelButton ||
                    ! confirmButton ||
                    ! closeButton
                ) {
                    return;
                }


                /*
                |--------------------------------------------------------------------------
                | State
                |--------------------------------------------------------------------------
                */

                let confirmed = false;


                /*
                |--------------------------------------------------------------------------
                | Open Modal
                |--------------------------------------------------------------------------
                */

                function openModal() {

                    modal.classList.remove('hidden');

                    modal.classList.add('flex');

                    document.body.classList.add('overflow-hidden');

                    confirmButton.focus();
                }


                /*
                |--------------------------------------------------------------------------
                | Close Modal
                |--------------------------------------------------------------------------
                */

                function closeModal() {

                    modal.classList.add('hidden');

                    modal.classList.remove('flex');

                    document.body.classList.remove('overflow-hidden');

                    confirmed = false;
                }


                /*
                |--------------------------------------------------------------------------
                | Form Ready To Submit
                |--------------------------------------------------------------------------
                |
                | Event ini dipanggil setelah pengecekan urutan selesai
                | dan tidak ditemukan konflik posisi.
                |--------------------------------------------------------------------------
                */

                form.addEventListener(
                    'regulation-type-ready-to-submit',
                    (event) => {

                        if (confirmed) {
                            return;
                        }

                        event.preventDefault();

                        openModal();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Cancel
                |--------------------------------------------------------------------------
                */

                cancelButton.addEventListener(
                    'click',
                    closeModal
                );


                /*
                |--------------------------------------------------------------------------
                | Close X
                |--------------------------------------------------------------------------
                */

                closeButton.addEventListener(
                    'click',
                    closeModal
                );


                /*
                |--------------------------------------------------------------------------
                | Confirm Save
                |--------------------------------------------------------------------------
                */

                confirmButton.addEventListener(
                    'click',
                    () => {

                        confirmed = true;

                        closeModal();

                        form.submit();

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Click Outside
                |--------------------------------------------------------------------------
                */

                modal.addEventListener(
                    'click',
                    (event) => {

                        if (event.target === modal) {
                            closeModal();
                        }

                    }
                );


                /*
                |--------------------------------------------------------------------------
                | Escape
                |--------------------------------------------------------------------------
                */

                document.addEventListener(
                    'keydown',
                    (event) => {

                        if (
                            event.key === 'Escape' &&
                            ! modal.classList.contains('hidden')
                        ) {
                            closeModal();
                        }

                    }
                );

            });
        </script>

    </div>

@endsection