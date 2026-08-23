@extends('layouts.public')

@section('content')

<div class="min-h-screen bg-gray-50">

    <div class="mx-auto max-w-6xl px-4 py-10 sm:px-6 lg:px-8">

        {{-- Header --}}
        <div class="mb-10 text-center">

            <span class="inline-flex items-center rounded-full bg-indigo-100 px-3 py-1 text-sm font-medium text-indigo-700">
                Helpdesk
            </span>

            <h1 class="mt-4 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">
                Layanan Bantuan dan Konsultasi
            </h1>

            <p class="mx-auto mt-3 max-w-2xl text-base leading-7 text-gray-600">
                Sampaikan aduan, kritik, saran, atau konsultasi terkait
                pengadaan barang dan jasa pemerintah.
            </p>

        </div>


        {{-- Pilihan Layanan --}}
        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">

            @forelse ($categories as $category)

                <a
                    href="{{  route('helpdesk.create', $category->slug) }}"
                    class="group rounded-xl border border-gray-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:border-indigo-300 hover:shadow-md"
                >

                    <div class="flex h-12 w-12 items-center justify-center rounded-lg bg-indigo-100 text-indigo-600">

                        @if ($category->slug === 'aduan')

                            {{-- Icon Aduan --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"
                                />
                            </svg>

                        @elseif ($category->slug === 'kritik')

                            {{-- Icon Kritik --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 10h8m-8 4h5m7-2a8 8 0 11-16 0 8 8 0 0116 0z"
                                />
                            </svg>

                        @elseif ($category->slug === 'saran')

                            {{-- Icon Saran --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 10h8m-8 4h5m3 6H8a4 4 0 01-4-4V8a4 4 0 014-4h8a4 4 0 014 4v8a4 4 0 01-4 4z"
                                />
                            </svg>

                        @else

                            {{-- Icon Konsultasi --}}
                            <svg
                                class="h-6 w-6"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    d="M8 10h8m-8 4h8m-4 6a8 8 0 100-16 8 8 0 000 16z"
                                />
                            </svg>

                        @endif

                    </div>


                    <h2 class="mt-5 text-lg font-semibold text-gray-900">
                        {{ $category->name }}
                    </h2>


                    @if ($category->description)

                        <p class="mt-2 text-sm leading-6 text-gray-600">
                            {{ $category->description }}
                        </p>

                    @endif


                    <div class="mt-5 text-sm font-medium text-indigo-600 group-hover:text-indigo-700">
                        Ajukan →
                    </div>

                </a>

            @empty

                <div class="col-span-full rounded-lg border border-yellow-200 bg-yellow-50 p-6 text-center">

                    <p class="font-medium text-yellow-800">
                        Layanan Helpdesk belum tersedia.
                    </p>

                </div>

            @endforelse

        </div>


        {{-- Informasi --}}
        <div class="mt-10 rounded-xl border border-gray-200 bg-white p-6 shadow-sm">

            <h2 class="font-semibold text-gray-900">
                Bagaimana cara menggunakan Helpdesk?
            </h2>

            <div class="mt-4 grid gap-6 text-sm text-gray-600 sm:grid-cols-3">

                <div>
                    <span class="font-semibold text-gray-900">
                        1. Pilih layanan
                    </span>

                    <p class="mt-1">
                        Pilih jenis bantuan yang sesuai dengan kebutuhan Anda.
                    </p>
                </div>

                <div>
                    <span class="font-semibold text-gray-900">
                        2. Sampaikan kebutuhan
                    </span>

                    <p class="mt-1">
                        Isi formulir dan jelaskan permasalahan atau konsultasi Anda.
                    </p>
                </div>

                <div>
                    <span class="font-semibold text-gray-900">
                        3. Pantau tanggapan
                    </span>

                    <p class="mt-1">
                        Tanggapan petugas dapat diterima melalui email dan melalui web
                        apabila Anda menggunakan akun.
                    </p>
                </div>

            </div>

        </div>

    </div>

</div>

@endsection
