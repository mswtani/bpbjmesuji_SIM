@extends('layouts.admin')

@section('title', 'Tambah Konten')

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
                        d="M12 5v14M5 12h14"
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
                    Tambah Konten
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Tambahkan konten baru ke dalam sistem BPBJ Mesuji.
                </p>

            </div>

        </div>


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card>

            @include('posts._form', [
                'post' => null,
                'formAction' => route('posts.store'),
                'formMethod' => 'POST',
                'submitLabel' => 'Simpan sebagai Draft',
                'formId' => 'post-create-form',
            ])


            {{-- =================================================
                ACTION
            ================================================== --}}

            <div
                class="
                    mt-8
                    w-full
                    border-t
                    border-gray-100
                    pt-6
                "
                >

                <div
                    class="
                        flex
                        flex-col
                        gap-3

                        sm:flex-row
                        sm:items-center
                        sm:justify-between
                    "
                    >

                    {{-- =====================================================
                        KEMBALI KE DAFTAR KONTEN
                    ====================================================== --}}

                    <a
                        href="{{ route('posts.index') }}"
                        class="
                            order-2

                            inline-flex
                            w-full
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            border
                            border-red-200
                            bg-red-500
                            px-4
                            py-2.5
                            text-sm
                            font-medium
                            text-white
                            transition

                            hover:bg-red-600

                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/20

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
                            Kembali ke daftar konten
                        </span>
                    </a>


                    {{-- ACTION KANAN --}}

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

                        {{-- BATAL --}}

                        <a
                            href="{{ route('posts.index') }}"
                            class="
                                inline-flex
                                w-full
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
                                shadow-sm
                                transition

                                hover:bg-gray-50

                                sm:w-auto
                            "
                        >
                            Batal
                        </a>


                        {{-- SIMPAN --}}

                        <button
                            type="submit"
                            form="post-create-form"
                            class="
                                inline-flex
                                w-full
                                items-center
                                justify-center
                                gap-2
                                rounded-lg
                                bg-blue-600
                                px-4
                                py-2.5
                                text-sm
                                font-semibold
                                text-white
                                shadow-sm
                                transition

                                hover:bg-blue-700

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

                            <span>
                                Simpan sebagai Draft
                            </span>
                        </button>

                    </div>

                </div>

            </div>

        </x-admin.card>

    </div>

@endsection