@extends('layouts.public')

@section('title', 'Regulasi')

@section('content')

<div class="bg-gray-50">

    {{-- Header --}}
    <section class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-12 sm:px-6 lg:px-8">

            <div class="max-w-3xl">

                <p class="text-sm font-semibold uppercase tracking-wide text-indigo-600">
                    Jaringan Dokumentasi dan Informasi Hukum
                </p>

                <h1 class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                    Regulasi
                </h1>

                <p class="mt-4 text-base leading-7 text-gray-600">
                    {{ $pageDescription }}
                </p>

            </div>

        </div>

    </section>



    {{-- Daftar --}}
    <section>

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">


            {{-- =====================================================
                SEARCH & FILTER
            ====================================================== --}}

            <form
                method="GET"
                action="{{ route('public.regulations') }}"
                class="mb-10 rounded-xl border border-gray-200 bg-white p-5 shadow-sm"
            >

                {{-- Search --}}
                <div>

                    <label
                        for="q"
                        class="block text-sm font-medium text-gray-700"
                    >
                        Cari Regulasi
                    </label>

                    <div class="mt-2 flex flex-col gap-2 sm:flex-row">

                        <input
                            id="q"
                            name="q"
                            type="search"
                            value="{{ request('q') }}"
                            placeholder="Cari berdasarkan judul, nomor regulasi, atau kata kunci..."
                            class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                        <button
                            type="submit"
                            class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-indigo-700"
                        >
                            Cari
                        </button>

                    </div>

                </div>


                {{-- Filters --}}
                <div class="mt-5 grid gap-4 md:grid-cols-3">


                    {{-- Jenis --}}
                    <div>

                        <label
                            for="regulation_type"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Jenis Regulasi
                        </label>

                        <select
                            id="regulation_type"
                            name="regulation_type"
                            class="mt-2 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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
                    <div>

                        <label
                            for="year"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Tahun
                        </label>

                        <select
                            id="year"
                            name="year"
                            class="mt-2 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
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


                    {{-- Status --}}
                    <div>

                        <label
                            for="legal_status"
                            class="block text-sm font-medium text-gray-700"
                        >
                            Status Hukum
                        </label>

                        <select
                            id="legal_status"
                            name="legal_status"
                            class="mt-2 block w-full rounded-md border-gray-300 bg-white shadow-sm focus:border-indigo-500 focus:ring-indigo-500"
                        >

                            <option value="">
                                Semua Status
                            </option>

                            <option
                                value="berlaku"
                                @selected(request('legal_status') === 'berlaku')
                            >
                                Berlaku
                            </option>

                            <option
                                value="tidak_berlaku"
                                @selected(request('legal_status') === 'tidak_berlaku')
                            >
                                Tidak Berlaku
                            </option>

                            <option
                                value="dicabut"
                                @selected(request('legal_status') === 'dicabut')
                            >
                                Dicabut
                            </option>

                            <option
                                value="diubah"
                                @selected(request('legal_status') === 'diubah')
                            >
                                Diubah
                            </option>

                        </select>

                    </div>

                </div>


                {{-- Filter actions --}}
                <div class="mt-5 flex flex-wrap items-center gap-3">

                    <button
                        type="submit"
                        class="inline-flex items-center rounded-md bg-gray-900 px-4 py-2 text-sm font-medium text-white hover:bg-gray-800"
                    >
                        Terapkan Filter
                    </button>


                    @if (
                        request()->filled('q') ||
                        request()->filled('regulation_type') ||
                        request()->filled('year') ||
                        request()->filled('legal_status')
                    )

                        <a
                            href="{{ route('public.regulations') }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Reset Filter
                        </a>

                    @endif

                </div>

            </form>


            {{-- =====================================================
                HASIL
            ====================================================== --}}

            <div class="mb-5 flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">

                <div>

                    <h2 class="text-lg font-semibold text-gray-900">
                        Daftar Regulasi
                    </h2>

                    @if ($posts->total())

                        <p class="mt-1 text-sm text-gray-500">
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


            @if ($posts->count())

                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">

                    @foreach ($posts as $post)

                        <article
                            class="flex h-full flex-col overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm transition hover:-translate-y-1 hover:shadow-md"
                        >

                            {{-- Card header --}}
                            <div class="border-b border-gray-100 bg-gray-50 px-5 py-4">

                                <div class="flex flex-wrap items-center gap-2">

                                    @if ($post->regulationType)

                                        <span class="rounded-full bg-purple-100 px-2.5 py-1 text-xs font-medium text-purple-800">
                                            {{ $post->regulationType->name }}
                                        </span>

                                    @endif


                                    @if ($post->legal_status === 'berlaku')

                                        <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                            Berlaku
                                        </span>

                                    @elseif ($post->legal_status === 'tidak_berlaku')

                                        <span class="rounded-full bg-gray-100 px-2.5 py-1 text-xs font-medium text-gray-700">
                                            Tidak Berlaku
                                        </span>

                                    @elseif ($post->legal_status === 'dicabut')

                                        <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">
                                            Dicabut
                                        </span>

                                    @elseif ($post->legal_status === 'diubah')

                                        <span class="rounded-full bg-yellow-100 px-2.5 py-1 text-xs font-medium text-yellow-800">
                                            Diubah
                                        </span>

                                    @endif

                                </div>

                            </div>


                            {{-- Card body --}}
                            <div class="flex flex-1 flex-col p-5">

                                @if ($post->regulation_number)

                                    <p class="text-sm font-semibold text-gray-900">
                                        {{ $post->regulation_number }}
                                    </p>

                                @endif


                                <h3 class="mt-2 text-lg font-semibold leading-7 text-gray-900">

                                    <a
                                        href="{{ route('public.regulations.show', $post->slug) }}"
                                        class="hover:text-indigo-600"
                                    >
                                        {{ $post->title }}
                                    </a>

                                </h3>


                                <div class="mt-4 space-y-1 text-sm text-gray-500">

                                    @if ($post->regulation_year)

                                        <p>
                                            Tahun:
                                            <span class="font-medium text-gray-700">
                                                {{ $post->regulation_year }}
                                            </span>
                                        </p>

                                    @endif


                                    @if ($post->regulation_date)

                                        <p>
                                            Tanggal:
                                            <span class="font-medium text-gray-700">
                                                {{ $post->regulation_date->format('d M Y') }}
                                            </span>
                                        </p>

                                    @endif

                                </div>


                                @if ($post->excerpt)

                                    <p class="mt-4 line-clamp-3 text-sm leading-6 text-gray-600">
                                        {{ $post->excerpt }}
                                    </p>

                                @endif


                                <div class="mt-auto pt-6">

                                    <a
                                        href="{{ route('public.regulations.show', $post->slug) }}"
                                        class="inline-flex items-center text-sm font-semibold text-indigo-600 hover:text-indigo-800"
                                    >
                                        Lihat detail

                                        <svg
                                            class="ml-1 h-4 w-4"
                                            viewBox="0 0 20 20"
                                            fill="currentColor"
                                            aria-hidden="true"
                                        >
                                            <path
                                                fill-rule="evenodd"
                                                d="M7.21 14.77a.75.75 0 0 1 0-1.06L10.94 10 7.21 6.29a.75.75 0 1 1 1.06-1.06l4.24 4.24a.75.75 0 0 1 0 1.06l-4.24 4.24a.75.75 0 0 1 0 1.06Z"
                                                clip-rule="evenodd"
                                            />
                                        </svg>

                                    </a>

                                </div>

                            </div>

                        </article>

                    @endforeach

                </div>


                {{-- Pagination --}}
                @if ($posts->hasPages())

                    <div class="mt-10">
                        {{ $posts->links() }}
                    </div>

                @endif

            @else

                <div class="rounded-xl border border-dashed border-gray-300 bg-white px-6 py-16 text-center">

                    <h2 class="text-lg font-semibold text-gray-900">
                        Regulasi tidak ditemukan
                    </h2>

                    <p class="mt-2 text-sm text-gray-500">
                        Tidak ada regulasi yang sesuai dengan pencarian atau filter Anda.
                    </p>

                    <a
                        href="{{ route('public.regulations') }}"
                        class="mt-5 inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        Tampilkan Semua Regulasi
                    </a>

                </div>

            @endif

        </div>

    </section>

</div>

@endsection