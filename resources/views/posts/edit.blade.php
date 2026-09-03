@extends('layouts.admin')

@section('title', 'Edit Konten')

@section('content')

    <div class="mx-auto max-w-5xl">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="mb-6">

            <div class="flex items-start gap-4">

                {{-- Icon --}}
                <div
                    class="
                        hidden h-12 w-12 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-blue-50
                        text-blue-600
                        sm:flex
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
                            d="M12 20h9"
                        />

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
                        Edit Konten
                    </h1>

                    <p class="mt-1.5 text-sm text-gray-500">
                        Perbarui informasi konten yang telah tersimpan.
                    </p>

                </div>

            </div>

        </div>


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            <div class="p-5 sm:p-6 lg:p-7">

                @include('posts._form', [
                    'post' => $post,
                    'formAction' => route('posts.update', $post),
                    'formMethod' => 'PUT',
                    'submitLabel' => 'Simpan Perubahan',
                    'formId' => 'post-edit-form',
                ])

            </div>


            {{-- =====================================================
                ACTION FOOTER
            ===================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    gap-3
                    border-t
                    border-gray-100
                    px-5
                    py-5
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                    sm:px-6
                "
                >

                


                {{-- Action kanan --}}

                <div
                    class="
                        mt-6
                        flex
                        w-full
                        flex-col
                        gap-4
                        border-t
                        border-gray-200
                        pt-6

                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                    >

                    {{-- =====================================================
                        KEMBALI KE DETAIL KONTEN
                    ====================================================== --}}

                    <a
                        href="{{ route('posts.show', $post) }}"
                        class="
                            order-2

                            inline-flex
                            w-full
                            items-center
                            justify-center
                            rounded-lg
                            bg-red-500
                            px-5
                            py-2.5
                            text-sm
                            font-semibold
                            text-white
                            shadow-sm
                            transition

                            hover:bg-red-600

                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30

                            sm:order-1
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
                            Kembali ke Detail Konten
                        </span>
                    </a>


                    {{-- =====================================================
                        ACTION FORM
                    ====================================================== --}}

                    <div
                        class="
                            order-1

                            flex
                            w-full
                            flex-col
                            gap-3

                            sm:order-2
                            sm:w-auto
                            sm:flex-row
                            sm:items-center
                        "
                        >

                        {{-- BATAL / RESET --}}
                        <button
                            type="button"
                            id="reset-post-form"
                            class="
                                inline-flex
                                w-full
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

                                sm:w-auto
                            "
                        >
                            Batal
                        </button>


                        {{-- SIMPAN --}}
                        <button
                            type="submit"
                            form="post-edit-form"
                            class="
                                inline-flex
                                w-full
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
                                        d="m5 12.5 4.5 4.5L19 7.5"
                                    />
                            </svg>

                            Simpan Perubahan

                        </button>

                    </div>

                </div> 
            </div>                

        </x-admin.card>

    </div>

    {{-- =====================================================
        MODAL KONFIRMASI BATAL EDIT
    ===================================================== --}}

    <div
        id="cancel-edit-modal"
        class="
            fixed inset-0 z-50 hidden
            items-center justify-center
            bg-gray-900/50
            px-4
            backdrop-blur-sm
        "
        role="dialog"
        aria-modal="true"
        aria-labelledby="cancel-edit-modal-title"
    >

        <div
            id="cancel-edit-modal-panel"
            class="
                w-full
                max-w-md
                scale-95
                rounded-2xl
                bg-white
                p-6
                opacity-0
                shadow-xl
                transition
                duration-200
            "
        >

            {{-- HEADER ICON --}}
            <div class="flex items-start gap-4">

                <div
                    class="
                        flex
                        h-11
                        w-11
                        shrink-0
                        items-center
                        justify-center
                        rounded-full
                        bg-amber-50
                        text-amber-600
                    "
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
                            d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3Z"
                        />
                    </svg>

                </div>


                <div>

                    <h3
                        id="cancel-edit-modal-title"
                        class="
                            text-base
                            font-semibold
                            text-gray-900
                        "
                    >
                        Batalkan perubahan?
                    </h3>


                    <p class="mt-1.5 text-sm leading-6 text-gray-500">
                        Semua perubahan yang belum disimpan akan dihapus dan
                        data akan dikembalikan ke kondisi sebelumnya.
                    </p>

                </div>

            </div>


            {{-- ACTION --}}
            <div
                class="
                    mt-6
                    flex
                    flex-col-reverse
                    gap-3
                    sm:flex-row
                    sm:justify-end
                "
            >

                {{-- TETAP EDIT --}}
                <button
                    type="button"
                    id="close-cancel-edit-modal"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        rounded-lg
                        border
                        border-gray-300
                        bg-white
                        px-4
                        py-2.5
                        text-sm
                        font-medium
                        text-gray-700
                        transition

                        hover:bg-gray-50

                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
                    "
                >
                    Tetap Edit
                </button>


                {{-- YA, BATALKAN --}}
                <button
                    type="button"
                    id="confirm-reset-post-form"
                    class="
                        inline-flex
                        items-center
                        justify-center
                        rounded-lg
                        bg-red-600
                        px-4
                        py-2.5
                        text-sm
                        font-semibold
                        text-white
                        shadow-sm
                        transition

                        hover:bg-red-700

                        focus:outline-none
                        focus:ring-2
                        focus:ring-red-500/30
                    "
                >
                    Ya, Batalkan
                </button>

            </div>

        </div>

    </div>

@endsection