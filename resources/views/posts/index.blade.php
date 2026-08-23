@extends('layouts.admin')

@section('title', 'Konten')

@section('content')

<div class="mx-auto max-w-8xl">

    {{-- Header --}}
    <div class="mb-6">

        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Konten
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Kelola berita, pengumuman, dan konten lainnya.
                </p>
            </div>


            @if (auth()->user()?->hasPermission('posts.create'))

                <a
                    href="{{ route('posts.create') }}"
                    class="inline-flex items-center justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-indigo-700"
                >
                    + Tambah Konten
                </a>

            @endif

        </div>

    </div>


    {{-- Flash message --}}
    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">

            <p class="text-sm font-medium text-green-800">
                {{ session('success') }}
            </p>

        </div>

    @endif

    {{-- Search & FIlter --}}
    <div class="mb-6 rounded-lg border border-gray-200 bg-white p-4 shadow-sm">

        <form
            method="GET"
            action="{{ route('posts.index') }}"
            class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-5"
        >

            {{-- Search --}}
            <div class="lg:col-span-2">
                <label
                    for="search"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Pencarian
                </label>

                <input
                    type="search"
                    id="search"
                    name="search"
                    value="{{ $search }}"
                    placeholder="Judul, slug, atau nomor regulasi..."
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 text-sm text-gray-900 placeholder-gray-400 focus:border-indigo-500 focus:ring-indigo-500"
                >
            </div>


            {{-- Jenis --}}
            <div>
                <label
                    for="type"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Jenis
                </label>

                <select
                    id="type"
                    name="type"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 pr-8 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Semua Jenis</option>

                    <option
                        value="news"
                        @selected($type === 'news')
                    >
                        Berita
                    </option>

                    <option
                        value="announcement"
                        @selected($type === 'announcement')
                    >
                        Pengumuman
                    </option>

                    <option
                        value="regulation"
                        @selected($type === 'regulation')
                    >
                        Regulasi
                    </option>
                </select>
            </div>


            {{-- Status --}}
            <div>
                <label
                    for="status"
                    class="mb-1.5 block text-sm font-medium text-gray-700"
                >
                    Status
                </label>

                <select
                    id="status"
                    name="status"
                    class="block w-full rounded-md border border-gray-300 bg-white px-3 py-2.5 pr-8 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                >
                    <option value="">Semua Status</option>

                    <option
                        value="draft"
                        @selected($status === 'draft')
                    >
                        Draft
                    </option>

                    <option
                        value="published"
                        @selected($status === 'published')
                    >
                        Published
                    </option>

                    <option
                        value="archived"
                        @selected($status === 'archived')
                    >
                        Archived
                    </option>
                </select>
            </div>


            {{-- Tombol --}}
            <div class="flex items-end gap-2">

                <button
                    type="submit"
                    class="inline-flex flex-1 items-center justify-center rounded-md bg-indigo-600 px-4 py-2.5 text-sm font-medium text-white hover:bg-indigo-700"
                >
                    Cari
                </button>

                @if ($search !== '' || $type !== null || $status !== null)

                    <a
                        href="{{ route('posts.index') }}"
                        class="inline-flex items-center justify-center rounded-md border border-gray-300 bg-white px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                    >
                        Reset
                    </a>

                @endif

            </div>

        </form>

    </div>


    
    {{-- Table --}}
    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">

        <div class="overflow-x-auto">

            <table class="min-w-full divide-y divide-gray-200">

                <thead class="bg-gray-50">

                    <tr>
                        <th
                            scope="col"
                            class="w-16 px-6 py-3 text-center text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            No.
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Konten
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Jenis
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Penulis
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Tanggal
                        </th>

                        <th
                            scope="col"
                            class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                   @forelse ($posts as $post)

                        <tr class="hover:bg-gray-50">

                            {{-- Nomor --}}
                            <td class="whitespace-nowrap px-6 py-4 text-center text-sm text-gray-500">
                                {{ $posts->firstItem() + $loop->index }}
                            </td>

                            {{-- Konten --}}
                            <td class="px-6 py-4">

                                <div class="flex items-center gap-4">

                                    @if (
                                        $post->featured_image &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($post->featured_image)
                                    )

                                        <img
                                            src="{{ asset('storage/' . $post->featured_image) }}"
                                            alt="{{ $post->title }}"
                                            class="h-14 w-20 rounded-md border border-gray-200 object-cover"
                                        >

                                    @else

                                        <div class="flex h-14 w-20 items-center justify-center rounded-md bg-gray-100 text-xs text-gray-400">
                                            No Image
                                        </div>

                                    @endif


                                    <div class="min-w-0">

                                        <a
                                            href="{{ route('posts.show', $post) }}"
                                            class="font-medium text-gray-900 hover:text-indigo-600"
                                        >
                                            {{ $post->title }}
                                        </a>

                                        @if ($post->excerpt)

                                            <p class="mt-1 max-w-xl truncate text-sm text-gray-500">
                                                {{ $post->excerpt }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </td>


                            {{-- Jenis --}}
                            <td class="whitespace-nowrap px-6 py-4">

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

                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

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

                                @else

                                    <span class="rounded-full bg-gray-100 px-3 py-1 text-xs font-medium text-gray-700">
                                        {{ ucfirst($post->status) }}
                                    </span>

                                @endif

                            </td>


                            {{-- Author --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                {{ $post->author?->name ?? '-' }}

                            </td>


                            {{-- Date --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">

                                {{ $post->created_at?->format('d M Y') }}

                            </td>


                            {{-- Action --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex flex-wrap justify-end gap-2">

                                    {{-- Lihat --}}
                                    <a
                                        href="{{ route('posts.show', $post) }}"
                                        class="rounded-md border border-gray-300 bg-white px-3 py-1.5 text-sm font-medium text-gray-700 hover:bg-gray-50"
                                    >
                                        Lihat
                                    </a>


                                    {{-- Edit --}}
                                    @if (auth()->user()?->hasPermission('posts.update'))

                                        <a
                                            href="{{ route('posts.edit', $post) }}"
                                            class="rounded-md bg-indigo-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-indigo-700"
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
                                            class="inline"
                                            onsubmit="return confirm('Publikasikan konten ini?');"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="rounded-md bg-green-600 px-3 py-1.5 text-sm font-medium text-white hover:bg-green-700"
                                            >
                                                Publish
                                            </button>

                                        </form>

                                    @endif


                                    {{-- Archive --}}
                                    @if (
                                        $post->status === 'published' &&
                                        auth()->user()?->hasPermission('posts.publish')
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('posts.archive', $post) }}"
                                            class="inline"
                                            onsubmit="return confirm('Arsipkan konten ini?');"
                                        >

                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                class="rounded-md bg-orange-500 px-3 py-1.5 text-sm font-medium text-white hover:bg-orange-600"
                                            >
                                                Arsipkan
                                            </button>

                                        </form>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>

                            <td
                                colspan="6"
                                class="px-6 py-12 text-center"
                            >

                                <p class="text-sm font-medium text-gray-900">
                                    Belum ada konten.
                                </p>

                                <p class="mt-1 text-sm text-gray-500">
                                    Silakan tambahkan berita atau pengumuman baru.
                                </p>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- Pagination --}}
        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Jumlah data --}}
                <form
                    method="GET"
                    action="{{ route('posts.index') }}"
                    class="flex items-center gap-2"
                >
                    <label
                        for="per_page"
                        class="text-sm text-gray-600"
                    >
                        Tampilkan
                    </label>

                    <select
                        id="per_page"
                        name="per_page"
                        onchange="this.form.submit()"
                        class="w-16 rounded-md border border-gray-300 bg-white px-3 py-2 text-sm text-gray-700 focus:border-indigo-500 focus:ring-indigo-500"
                    >
                        @foreach ([10, 25, 50, 100] as $option)
                            <option
                                value="{{ $option }}"
                                @selected($perPage === $option)
                            >
                                {{ $option }}
                            </option>
                        @endforeach
                    </select>

                    <span class="text-sm text-gray-600">
                        data
                    </span>
                </form>


                {{-- Informasi data --}}
                <p class="text-sm text-gray-600">
                    Menampilkan
                    <span class="font-medium text-gray-900">
                        {{ $posts->firstItem() ?? 0 }}
                    </span>
                    –
                    <span class="font-medium text-gray-900">
                        {{ $posts->lastItem() ?? 0 }}
                    </span>
                    dari
                    <span class="font-medium text-gray-900">
                        {{ $posts->total() }}
                    </span>
                    konten
                </p>


                {{-- Navigation --}}
                @if ($posts->hasPages())
                    <div>
                        {{ $posts->links() }}
                    </div>
                @endif

            </div>

        </div>

    </div>

</div>

@endsection