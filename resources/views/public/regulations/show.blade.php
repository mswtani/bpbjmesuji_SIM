@extends('layouts.public')

@section('title', $post->title)

@section('content')

<div class="bg-gray-50">

    {{-- Header --}}
    <section class="border-b border-gray-200 bg-white">

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="mb-4">
                <a
                    href="{{ route('public.regulations') }}"
                    class="inline-flex items-center text-sm font-medium text-indigo-600 hover:text-indigo-800"
                >
                    ← Kembali ke Regulasi
                </a>
            </div>


            {{-- Jenis + Status --}}
            <div class="flex flex-wrap items-center gap-2">

                @if ($post->regulationType)

                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-800">
                        {{ $post->regulationType->name }}
                    </span>

                @endif


                @if ($post->legal_status === 'berlaku')

                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                        Berlaku
                    </span>

                @elseif ($post->legal_status === 'tidak_berlaku')

                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                        Tidak Berlaku
                    </span>

                @elseif ($post->legal_status === 'dicabut')

                    <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                        Dicabut
                    </span>

                @elseif ($post->legal_status === 'diubah')

                    <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                        Diubah
                    </span>

                @endif

            </div>


            <h1 class="mt-4 max-w-4xl text-2xl font-bold leading-tight tracking-tight text-gray-900 sm:text-3xl lg:text-4xl">
                {{ $post->title }}
            </h1>


            @if ($post->excerpt)

                <p class="mt-4 max-w-4xl text-base leading-7 text-gray-600">
                    {{ $post->excerpt }}
                </p>

            @endif

        </div>

    </section>


    {{-- Main Content --}}
    <section>

        <div class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">

            <div class="grid gap-8 lg:grid-cols-3">


                {{-- =====================================================
                    INFORMASI REGULASI
                ====================================================== --}}

                <aside class="space-y-6 lg:col-span-1">

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                        <div class="border-b border-gray-200 px-5 py-4">

                            <h2 class="font-semibold text-gray-900">
                                Informasi Regulasi
                            </h2>

                        </div>


                        <div class="divide-y divide-gray-100">


                            {{-- Jenis --}}
                            @if ($post->regulationType)

                                <div class="px-5 py-4">

                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Jenis Regulasi
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $post->regulationType->name }}
                                    </p>

                                </div>

                            @endif


                            {{-- Nomor --}}
                            @if ($post->regulation_number)

                                <div class="px-5 py-4">

                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Nomor
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $post->regulation_number }}
                                    </p>

                                </div>

                            @endif


                            {{-- Tahun --}}
                            @if ($post->regulation_year)

                                <div class="px-5 py-4">

                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Tahun
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $post->regulation_year }}
                                    </p>

                                </div>

                            @endif


                            {{-- Tanggal --}}
                            @if ($post->regulation_date)

                                <div class="px-5 py-4">

                                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                        Tanggal Regulasi
                                    </p>

                                    <p class="mt-1 text-sm font-medium text-gray-900">
                                        {{ $post->regulation_date->format('d F Y') }}
                                    </p>

                                </div>

                            @endif


                            {{-- Status --}}
                            <div class="px-5 py-4">

                                <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                                    Status Hukum
                                </p>

                                <div class="mt-2">

                                    @if ($post->legal_status === 'berlaku')

                                        <span class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-800">
                                            Berlaku
                                        </span>

                                    @elseif ($post->legal_status === 'tidak_berlaku')

                                        <span class="inline-flex rounded-full bg-gray-100 px-3 py-1 text-xs font-semibold text-gray-700">
                                            Tidak Berlaku
                                        </span>

                                    @elseif ($post->legal_status === 'dicabut')

                                        <span class="inline-flex rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-800">
                                            Dicabut
                                        </span>

                                    @elseif ($post->legal_status === 'diubah')

                                        <span class="inline-flex rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-800">
                                            Diubah
                                        </span>

                                    @else

                                        <span class="text-sm text-gray-500">
                                            Belum ditentukan
                                        </span>

                                    @endif

                                </div>

                            </div>


                        </div>

                    </div>


                    {{-- =====================================================
                        HUBUNGAN REGULASI
                    ====================================================== --}}

                    @php
                        $amendments = $post->amendments
                            ->filter(fn ($relation) => $relation->relatedPost);

                        $repeals = $post->repeals
                            ->filter(fn ($relation) => $relation->relatedPost);

                        $amendedBy = $post->amendedBy
                            ->filter(fn ($relation) => $relation->post);

                        $repealedBy = $post->repealedBy
                            ->filter(fn ($relation) => $relation->post);
                    @endphp


                    @if (
                        $amendments->isNotEmpty() ||
                        $repeals->isNotEmpty() ||
                        $amendedBy->isNotEmpty() ||
                        $repealedBy->isNotEmpty()
                    )

                        <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-200 px-5 py-4">

                                <h2 class="font-semibold text-gray-900">
                                    Hubungan Regulasi
                                </h2>

                                <p class="mt-1 text-xs text-gray-500">
                                    Riwayat perubahan dan pencabutan regulasi.
                                </p>

                            </div>


                            <div class="space-y-4 p-5">


                                {{-- =================================================
                                    REGULASI INI MENGUBAH REGULASI LAIN
                                ================================================== --}}

                                @foreach ($amendments as $relation)

                                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-yellow-800">
                                            Mengubah
                                        </p>

                                        <a
                                            href="{{ route('public.regulations.show', $relation->relatedPost->slug) }}"
                                            class="mt-2 block text-sm font-medium text-indigo-700 hover:text-indigo-900 hover:underline"
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>

                                        @if ($relation->relatedPost->regulation_number)

                                            <p class="mt-1 text-xs text-gray-600">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                    REGULASI INI MENCABUT REGULASI LAIN
                                ================================================== --}}

                                @foreach ($repeals as $relation)

                                    <div class="rounded-lg border border-red-200 bg-red-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-red-800">
                                            Mencabut
                                        </p>

                                        <a
                                            href="{{ route('public.regulations.show', $relation->relatedPost->slug) }}"
                                            class="mt-2 block text-sm font-medium text-indigo-700 hover:text-indigo-900 hover:underline"
                                        >
                                            {{ $relation->relatedPost->title }}
                                        </a>

                                        @if ($relation->relatedPost->regulation_number)

                                            <p class="mt-1 text-xs text-gray-600">
                                                {{ $relation->relatedPost->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                    REGULASI INI DIUBAH OLEH REGULASI LAIN
                                ================================================== --}}

                                @foreach ($amendedBy as $relation)

                                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-yellow-800">
                                            Diubah Dengan
                                        </p>

                                        <a
                                            href="{{ route('public.regulations.show', $relation->post->slug) }}"
                                            class="mt-2 block text-sm font-medium text-indigo-700 hover:text-indigo-900 hover:underline"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)

                                            <p class="mt-1 text-xs text-gray-600">
                                                {{ $relation->post->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                                {{-- =================================================
                                    REGULASI INI DICABUT OLEH REGULASI LAIN
                                ================================================== --}}

                                @foreach ($repealedBy as $relation)

                                    <div class="rounded-lg border border-red-200 bg-red-50 p-4">

                                        <p class="text-xs font-semibold uppercase tracking-wide text-red-800">
                                            Dicabut Dengan
                                        </p>

                                        <a
                                            href="{{ route('public.regulations.show', $relation->post->slug) }}"
                                            class="mt-2 block text-sm font-medium text-indigo-700 hover:text-indigo-900 hover:underline"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)

                                            <p class="mt-1 text-xs text-gray-600">
                                                {{ $relation->post->regulation_number }}
                                            </p>

                                        @endif

                                    </div>

                                @endforeach


                            </div>

                        </div>

                    @endif

                </aside>


                {{-- =====================================================
                    DOKUMEN PDF
                ====================================================== --}}

                <main class="lg:col-span-2">

                    <div class="overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                        {{-- Header PDF --}}
                        <div class="flex flex-col gap-4 border-b border-gray-200 px-5 py-4 sm:flex-row sm:items-center sm:justify-between">

                            <div>

                                <h2 class="font-semibold text-gray-900">
                                    Dokumen Regulasi
                                </h2>

                                @if ($post->document_original_name)

                                    <p class="mt-1 max-w-xl truncate text-xs text-gray-500">
                                        {{ $post->document_original_name }}
                                    </p>

                                @endif

                            </div>


                            @if ($post->document_path)

                                <a
                                    href="{{ asset('storage/' . $post->document_path) }}"
                                    download
                                    class="inline-flex shrink-0 items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                                >
                                    Download PDF
                                </a>

                            @endif

                        </div>


                        {{-- PDF Preview --}}
                        @if (
                            $post->document_path &&
                            \Illuminate\Support\Facades\Storage::disk('public')->exists($post->document_path)
                        )

                            <div class="bg-gray-100 p-2 sm:p-4">

                                <iframe
                                    src="{{ asset('storage/' . $post->document_path) }}"
                                    title="Preview {{ $post->title }}"
                                    class="h-[700px] w-full rounded-lg border border-gray-300 bg-white"
                                ></iframe>

                            </div>

                        @else

                            <div class="flex min-h-[300px] items-center justify-center p-8 text-center">

                                <div>

                                    <p class="font-medium text-gray-900">
                                        Dokumen PDF belum tersedia
                                    </p>

                                    <p class="mt-1 text-sm text-gray-500">
                                        Dokumen regulasi belum diunggah.
                                    </p>

                                </div>

                            </div>

                        @endif

                    </div>


                    {{-- Ringkasan / Keterangan --}}
                    @if ($post->content)

                        <div class="mt-6 overflow-hidden rounded-xl border border-gray-200 bg-white shadow-sm">

                            <div class="border-b border-gray-200 px-5 py-4">

                                <h2 class="font-semibold text-gray-900">
                                    Keterangan
                                </h2>

                            </div>

                            <div class="p-5">

                                <div class="prose max-w-none text-sm leading-7 text-gray-700">
                                    {!! nl2br(e($post->content)) !!}
                                </div>

                            </div>

                        </div>

                    @endif


                    {{-- Informasi publikasi --}}
                    <div class="mt-6 text-xs text-gray-500">

                        @if ($post->published_at)

                            Dipublikasikan
                            {{ $post->published_at->format('d F Y H:i') }}

                        @endif

                    </div>

                </main>

            </div>

        </div>

    </section>

</div>

@endsection