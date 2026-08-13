@extends('layouts.admin')

@section('title', $post->title)

@section('content')

<div class="mx-auto max-w-5xl">

    {{-- Header --}}
    <div class="mb-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">

            <div>
                <div class="flex flex-wrap items-center gap-2">

                    {{-- Type --}}
                    @if ($post->type === 'news')
                        <span class="rounded-full bg-blue-100 px-3 py-1 text-xs font-medium text-blue-800">
                            Berita
                        </span>
                    @elseif ($post->type === 'announcement')
                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-800">
                            Pengumuman
                        </span>
                    @else
                        <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-medium text-purple-800">
                            Regulasi
                        </span>
                    @endif


                    {{-- Status --}}
                    @if ($post->status === 'draft')

                        <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                            Draft
                        </span>

                    @elseif ($post->status === 'published')

                        <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-medium text-green-800">
                            Published
                        </span>

                    @elseif ($post->status === 'archived')

                        <span class="rounded-full bg-red-100 px-3 py-1 text-xs font-medium text-red-800">
                            Archived
                        </span>

                    @endif

                </div>


                <h1 class="mt-3 text-2xl font-semibold text-gray-900">
                    {{ $post->title }}
                </h1>

                <p class="mt-2 text-sm text-gray-500">
                    Dibuat {{ $post->created_at?->format('d M Y H:i') }}
                    @if ($post->author)
                        oleh {{ $post->author->name }}
                    @endif
                </p>

            </div>


            {{-- Action --}}
            <div class="flex flex-wrap gap-2">

                {{-- Edit --}}
                @if (auth()->user()?->hasPermission('posts.update'))

                    <a
                        href="{{ route('posts.edit', $post) }}"
                        class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                    >
                        Edit
                    </a>

                @endif


                {{-- Publish --}}
                @if (
                    $post->status === 'draft' &&
                    auth()->user()?->hasPermission('posts.publish')
                )

                    <form
                        method="POST"
                        action="{{ route('posts.publish', $post) }}"
                        onsubmit="return confirm('Publikasikan konten ini?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md bg-green-600 px-4 py-2 text-sm font-medium text-white hover:bg-green-700"
                        >
                            Publish
                        </button>

                    </form>

                @endif


                {{-- Archive --}}
                @if (
                    $post->status === 'published' &&
                    auth()->user()?->hasPermission('posts.archive')
                )

                    <form
                        method="POST"
                        action="{{ route('posts.archive', $post) }}"
                        onsubmit="return confirm('Arsipkan konten ini?');"
                    >

                        @csrf

                        <button
                            type="submit"
                            class="inline-flex items-center rounded-md bg-gray-600 px-4 py-2 text-sm font-medium text-white hover:bg-gray-700"
                        >
                            Archive
                        </button>

                    </form>

                @endif


                {{-- Kembali --}}
                <a
                    href="{{ route('posts.index') }}"
                    class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                >
                    Kembali
                </a>

            </div>

        </div>
    </div>

    @if ($post->type === 'regulation')

        <div class="mb-6 rounded-lg border border-gray-200 bg-white shadow-sm">

            <div class="border-b border-gray-200 bg-gray-50 px-6 py-4">
                <h2 class="text-lg font-semibold text-gray-900">
                    Informasi Hukum
                </h2>
            </div>

            <div class="space-y-5 p-6">

                {{-- Status --}}
                <div>
                    <p class="text-xs font-medium uppercase tracking-wide text-gray-500">
                        Status Hukum
                    </p>

                    @if ($post->legal_status === 'berlaku')

                        <span class="mt-2 inline-flex rounded-full bg-green-100 px-3 py-1 text-sm font-medium text-green-800">
                            Berlaku
                        </span>

                    @elseif ($post->legal_status === 'tidak_berlaku')

                        <span class="mt-2 inline-flex rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-800">
                            Tidak Berlaku
                        </span>

                    @elseif ($post->legal_status === 'dicabut')

                        <span class="mt-2 inline-flex rounded-full bg-red-100 px-3 py-1 text-sm font-medium text-red-800">
                            Dicabut
                        </span>

                    @elseif ($post->legal_status === 'diubah')

                        <span class="mt-2 inline-flex rounded-full bg-yellow-100 px-3 py-1 text-sm font-medium text-yellow-800">
                            Diubah
                        </span>

                    @endif
                </div>


                {{-- Hubungan Regulasi --}}
                @if ($post->type === 'regulation')

                    @php
                        $directRelations = $post->regulationRelations
                            ->filter(fn ($relation) => $relation->relatedPost);

                        $amendedBy = $post->amendedBy
                            ->filter(fn ($relation) => $relation->post);

                        $repealedBy = $post->repealedBy
                            ->filter(fn ($relation) => $relation->post);
                    @endphp

                    @if (
                        $directRelations->isNotEmpty() ||
                        $amendedBy->isNotEmpty() ||
                        $repealedBy->isNotEmpty()
                    )

                        <div class="border-t border-gray-200 pt-5">

                            <p class="mb-4 text-xs font-medium uppercase tracking-wide text-gray-500">
                                Hubungan Regulasi
                            </p>


                            <div class="space-y-4">

                                {{-- Regulasi yang diubah --}}
                                @foreach ($directRelations->where('relation_type', 'amends') as $relation)

                                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                                        <div class="flex items-start gap-3">

                                            <div class="mt-0.5">

                                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-yellow-100 text-yellow-700">
                                                    ↔
                                                </span>

                                            </div>

                                            <div class="min-w-0">

                                                <p class="text-sm font-semibold text-yellow-900">
                                                    Mengubah Regulasi
                                                </p>

                                                <p class="mt-1 text-sm text-yellow-800">
                                                    Regulasi ini mengubah:
                                                </p>

                                                <a
                                                    href="{{ route('posts.show', $relation->relatedPost) }}"
                                                    class="mt-1 block font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                                                >
                                                    {{ $relation->relatedPost->title }}
                                                </a>

                                                @if ($relation->relatedPost->regulation_number)
                                                    <p class="mt-1 text-xs text-gray-600">
                                                        Nomor:
                                                        {{ $relation->relatedPost->regulation_number }}
                                                    </p>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @endforeach


                                {{-- Regulasi yang dicabut --}}
                                @foreach ($directRelations->where('relation_type', 'repeals') as $relation)

                                    <div class="rounded-lg border border-red-200 bg-red-50 p-4">

                                        <div class="flex items-start gap-3">

                                            <div class="mt-0.5">

                                                <span class="inline-flex h-6 w-6 items-center justify-center rounded-full bg-red-100 text-red-700">
                                                    ×
                                                </span>

                                            </div>

                                            <div class="min-w-0">

                                                <p class="text-sm font-semibold text-red-900">
                                                    Mencabut Regulasi
                                                </p>

                                                <p class="mt-1 text-sm text-red-800">
                                                    Regulasi ini mencabut:
                                                </p>

                                                <a
                                                    href="{{ route('posts.show', $relation->relatedPost) }}"
                                                    class="mt-1 block font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                                                >
                                                    {{ $relation->relatedPost->title }}
                                                </a>

                                                @if ($relation->relatedPost->regulation_number)
                                                    <p class="mt-1 text-xs text-gray-600">
                                                        Nomor:
                                                        {{ $relation->relatedPost->regulation_number }}
                                                    </p>
                                                @endif

                                            </div>

                                        </div>

                                    </div>

                                @endforeach


                                {{-- Diubah dengan regulasi lain --}}
                                @foreach ($amendedBy as $relation)

                                    <div class="rounded-lg border border-yellow-200 bg-yellow-50 p-4">

                                        <p class="text-sm font-semibold text-yellow-900">
                                            Diubah Dengan
                                        </p>

                                        <p class="mt-1 text-sm text-yellow-800">
                                            Regulasi ini diubah dengan:
                                        </p>

                                        <a
                                            href="{{ route('posts.show', $relation->post) }}"
                                            class="mt-1 block font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)
                                            <p class="mt-1 text-xs text-gray-600">
                                                Nomor:
                                                {{ $relation->post->regulation_number }}
                                            </p>
                                        @endif

                                    </div>

                                @endforeach


                                {{-- Dicabut dengan regulasi lain --}}
                                @foreach ($repealedBy as $relation)

                                    <div class="rounded-lg border border-red-200 bg-red-50 p-4">

                                        <p class="text-sm font-semibold text-red-900">
                                            Dicabut Dengan
                                        </p>

                                        <p class="mt-1 text-sm text-red-800">
                                            Regulasi ini dicabut dengan:
                                        </p>

                                        <a
                                            href="{{ route('posts.show', $relation->post) }}"
                                            class="mt-1 block font-medium text-indigo-600 hover:text-indigo-800 hover:underline"
                                        >
                                            {{ $relation->post->title }}
                                        </a>

                                        @if ($relation->post->regulation_number)
                                            <p class="mt-1 text-xs text-gray-600">
                                                Nomor:
                                                {{ $relation->post->regulation_number }}
                                            </p>
                                        @endif

                                    </div>

                                @endforeach

                            </div>

                        </div>

                    @endif

                @endif

            </div>

        </div>

    @endif


    {{-- Flash message --}}
    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">
            <p class="text-sm font-medium text-green-800">
                {{ session('success') }}
            </p>
        </div>

    @endif


    {{-- Content --}}
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

        {{-- Featured Image --}}
        @if (
            $post->featured_image &&
            \Illuminate\Support\Facades\Storage::disk('public')->exists($post->featured_image)
        )

            <div class="border-b border-gray-200 bg-gray-50">

                <img
                    src="{{ asset('storage/' . $post->featured_image) }}"
                    alt="{{ $post->title }}"
                    class="max-h-[500px] w-full object-contain"
                >

            </div>

        @endif


        <div class="p-6 sm:p-8">

            {{-- Excerpt --}}
            @if ($post->excerpt)

                <div class="mb-8 rounded-lg bg-gray-50 p-5">

                    <p class="text-base leading-7 text-gray-700">
                        {{ $post->excerpt }}
                    </p>

                </div>

            @endif

            
            {{-- Dokumen Regulasi --}}

            @if ($post->type === 'regulation' && $post->document_path)

                <div class="mt-6 rounded-lg border border-gray-200 bg-white p-5">

                    <h2 class="text-base font-semibold text-gray-900">
                        Dokumen Regulasi
                    </h2>

                    <p class="mt-1 text-sm text-gray-600">
                        {{ $post->document_original_name ?? 'Dokumen PDF' }}
                    </p>

                    <div class="mt-4 flex flex-wrap gap-3">

                        <a
                            href="{{ route('posts.document.preview', $post) }}"
                            target="_blank"
                            class="inline-flex items-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                        >
                            Preview PDF
                        </a>

                        <a
                            href="{{ route('posts.document.download', $post) }}"
                            class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50"
                        >
                            Download PDF
                        </a>

                    </div>

                </div>

            @endif

            
            {{-- Content --}}
            <div class="prose max-w-none">

                {!! nl2br(e($post->content)) !!}

            </div>

        </div>

    </div>

    {{-- Preview PDF Regulasi --}}
    @if (
        $post->type === 'regulation' &&
        $post->document_path &&
        \Illuminate\Support\Facades\Storage::disk('public')->exists($post->document_path)
    )

        <div class="mt-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

            <div class="flex flex-col gap-3 border-b border-gray-200 bg-gray-50 px-6 py-4 sm:flex-row sm:items-center sm:justify-between">

                <div>
                    <h2 class="text-lg font-semibold text-gray-900">
                        Preview Dokumen
                    </h2>

                    @if ($post->document_original_name)
                        <p class="mt-1 text-sm text-gray-500">
                            {{ $post->document_original_name }}
                        </p>
                    @endif
                </div>

                <a
                    href="{{ asset('storage/' . $post->document_path) }}"
                    target="_blank"
                    rel="noopener"
                    class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
                >
                    Buka PDF
                </a>

            </div>

            <div class="bg-gray-100 p-2 sm:p-4">

                <iframe
                    src="{{ asset('storage/' . $post->document_path) }}"
                    title="Preview {{ $post->title }}"
                    class="h-[700px] w-full rounded-md border border-gray-300 bg-white"
                ></iframe>

            </div>

        </div>

    @endif

</div>

@endsection