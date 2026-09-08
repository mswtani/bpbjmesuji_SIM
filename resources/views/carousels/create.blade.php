@extends('layouts.admin')

@section('title', 'Tambah Carousel')

@section('content')

<div class="mx-auto w-full max-w-5xl space-y-5 sm:space-y-6">

    {{-- Header --}}
    <div class="flex items-start gap-4">

        {{-- Icon --}}
        <div
            class="
                flex
                h-12
                w-12
                shrink-0
                items-center
                justify-center
                rounded-xl
                bg-blue-50
                text-blue-600
                sm:h-12
                sm:w-12
            "
        >
            <svg
                class="h-6 w-6"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
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
                    text-xl
                    font-bold
                    tracking-tight
                    text-gray-900
                    sm:text-2xl
                "
            >
                Tambah Carousel
            </h1>

            <p
                class="
                    mt-1
                    text-xs
                    leading-5
                    text-gray-500
                    sm:text-sm
                "
            >
                Tambahkan banner dari konten yang sudah dipublikasikan.
            </p>

        </div>

    </div>


    {{-- Validation --}}
    @if ($errors->any())

        <div
            class="
                rounded-lg
                border
                border-red-200
                bg-red-50
                px-4
                py-3
            "
        >

            <p class="text-sm font-medium text-red-800">
                Terdapat kesalahan pada form:
            </p>

            <ul
                class="
                    mt-2
                    list-inside
                    list-disc
                    text-sm
                    text-red-600
                "
            >

                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach

            </ul>

        </div>

    @endif


    {{-- Form --}}
    <x-admin.card>

        <form
            action="{{ route('carousels.store') }}"
            method="POST"
            enctype="multipart/form-data"
        >

            @csrf

            @include('carousels._form')


            {{-- Action --}}
            <div
                class="
                    mt-6
                    flex
                    flex-col
                    gap-3
                    border-t
                    border-gray-100
                    pt-5

                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                {{-- Kembali --}}
                <a
                    href="{{ route('carousels.index') }}"
                    class="
                        order-3
                        inline-flex
                        w-full
                        items-center
                        justify-center
                        gap-2
                        rounded-lg
                        bg-red-500
                        px-5
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

                    Kembali ke daftar Carousel
                </a>


                {{-- Batal + Simpan --}}
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
                    "
                >

                    {{-- Batal --}}
                    <a
                        href="{{ route('carousels.index') }}"
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
                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-300/50

                            sm:w-auto
                        "
                    >
                        Batal
                    </a>


                    {{-- Simpan --}}
                    <button
                        type="submit"
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
                            font-medium
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
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 13l4 4L19 7"
                            />
                        </svg>

                        Simpan Carousel
                    </button>

                </div>

            </div>

        </form>

    </x-admin.card>

</div>

@endsection