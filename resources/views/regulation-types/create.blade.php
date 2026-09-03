@extends('layouts.admin')

@section('title', 'Tambah Jenis Regulasi')

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
                    bg-blue-50
                    text-blue-600
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
                        d="M12 4v16m8-8H4"
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
                    Tambah Jenis Regulasi
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Tambahkan jenis regulasi yang dapat digunakan pada konten regulasi.
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
                action="{{ route('regulation-types.store') }}"
                data-check-position-url="{{ route('regulation-types.check-position') }}"
                data-ignore-id=""
                data-regulation-type-form
                >

                @csrf


                @include(
                    'regulation-types._form',
                    [
                        'regulationType' => null,
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
                                Simpan
                            </span>

                        </button>

                    </div>

                </div>

            </form>

        </x-admin.card>

    </div>

@endsection