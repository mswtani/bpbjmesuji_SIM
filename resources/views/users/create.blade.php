@extends('layouts.admin')

@section('title', 'Tambah User')

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
                        d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                    />

                    <circle
                        cx="9"
                        cy="7"
                        r="4"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M19 8v6M16 11h6"
                    />
                </svg>
            </div>


            {{-- Title --}}
            <div class="min-w-0">

                <h1
                    class="
                        text-2xl
                        font-bold
                        tracking-tight
                        text-gray-900
                        sm:text-3xl
                    "
                >
                    Tambah User
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Tambahkan pengguna baru ke dalam sistem BPBJ Mesuji.
                </p>

            </div>

        </div>


        {{-- =====================================================
             VALIDATION ERROR
        ====================================================== --}}

        @if ($errors->any())

            <div
                class="
                    rounded-lg
                    border border-red-200
                    bg-red-50
                    px-4 py-4
                "
            >

                <div class="font-medium text-red-800">
                    Data belum dapat disimpan.
                </div>

                <ul class="mt-2 list-disc space-y-1 pl-5 text-sm text-red-700">

                    @foreach ($errors->all() as $error)

                        <li>
                            {{ $error }}
                        </li>

                    @endforeach

                </ul>

            </div>

        @endif


        {{-- =====================================================
             FORM CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            <div class="p-5 sm:p-6 lg:p-7">

                <form
                    id="user-create-form"
                    method="POST"
                    action="{{ route('users.store') }}"
                    class="space-y-6"
                >

                    @csrf

                    @include('users._form')

                </form>

            </div>


            {{-- =================================================
                 ACTION FOOTER
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col
                    gap-4
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

                {{-- Kembali ke daftar --}}
                <a
                    href="{{ route('users.index') }}"
                    class="
                        order-3

                        inline-flex
                        w-full
                        items-center
                        justify-center
                        gap-2
                        rounded-lg
                        bg-red-500
                        px-4
                        py-2.5
                        text-sm
                        font-medium
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
                        Kembali ke daftar user
                    </span>

                </a>


                {{-- Action kanan --}}
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

                    {{-- Batal --}}
                    <a
                        href="{{ route('users.index') }}"
                        class="
                            order-2

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
                            hover:text-gray-900

                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-500/20

                            sm:order-1
                            sm:w-auto
                        "
                    >
                        Batal
                    </a>


                    {{-- Simpan --}}
                    <button
                        type="submit"
                        form="user-create-form"
                        class="
                            order-1

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

                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500/30

                            sm:order-2
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
                            Simpan User
                        </span>

                    </button>

                </div>

            </div>

        </x-admin.card>

    </div>

@endsection