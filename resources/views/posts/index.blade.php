@extends('layouts.admin')

@section('title', 'Konten')

@section('content')

<x-admin.page
    title="Konten"
    description="Kelola berita, pengumuman, dan Regulasi PBJ."
    >

    <x-slot:actions>

        @if (auth()->user()?->hasPermission('posts.create'))

            <a
                href="{{ route('posts.create') }}"
                class="
                    inline-flex items-center justify-center
                    rounded-lg
                    bg-blue-600
                    px-4 py-2
                    text-sm font-medium
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
                    class="mr-2 h-4 w-4"
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

                Tambah Konten

            </a>

        @endif

    </x-slot:actions>


    {{-- Flash message --}}
    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3">

            <p class="text-sm font-medium text-green-800">
                {{ session('success') }}
            </p>

        </div>

    @endif

    {{-- =====================================================
        SEARCH & FILTER
    ====================================================== --}}

    <x-admin.card class="mb-6">

        <form
            method="GET"
            action="{{ route('posts.index') }}"
            class="space-y-4"
        >

            {{-- Filter fields --}}
            <div
                class="
                    grid
                    grid-cols-1
                    gap-4
                    md:grid-cols-2
                    lg:grid-cols-[2fr_1fr_1fr_1fr_42px]
                    items-end
                "
                >

                {{-- Pencarian --}}
                <div class="md:col-span-2 lg:col-auto">

                    <label
                        for="search"
                        class="
                            mb-1.5
                            block
                            text-sm
                            font-medium
                            text-gray-700
                        "
                    >
                        Pencarian
                    </label>

                    <input
                        id="search"
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Judul atau ringkasan konten..."
                        class="
                            block
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            text-gray-900
                            placeholder:text-gray-400
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                </div>


                {{-- Jenis --}}
                <div>

                    <label
                        for="type"
                        class="
                            mb-1.5
                            block
                            text-sm
                            font-medium
                            text-gray-700
                        "
                    >
                        Jenis
                    </label>

                    <select
                        id="type"
                        name="type"
                        class="
                            block
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            text-gray-900
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                        <option value="">
                            Semua Jenis
                        </option>

                        <option
                            value="news"
                            @selected(request('type') === 'news')
                        >
                            Berita
                        </option>

                        <option
                            value="announcement"
                            @selected(request('type') === 'announcement')
                        >
                            Pengumuman
                        </option>

                        <option
                            value="regulation"
                            @selected(request('type') === 'regulation')
                        >
                            Regulasi
                        </option>

                    </select>

                </div>


                {{-- Status --}}
                <div>

                    <label
                        for="status"
                        class="
                            mb-1.5
                            block
                            text-sm
                            font-medium
                            text-gray-700
                        "
                    >
                        Status
                    </label>

                    <select
                        id="status"
                        name="status"
                        class="
                            block
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            text-gray-900
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                        <option value="">
                            Semua Status
                        </option>

                        <option
                            value="draft"
                            @selected(request('status') === 'draft')
                        >
                            Draft
                        </option>

                        <option
                            value="published"
                            @selected(request('status') === 'published')
                        >
                            Dipublikasikan
                        </option>

                        <option
                            value="archived"
                            @selected(request('status') === 'archived')
                        >
                            Diarsipkan
                        </option>

                    </select>

                </div>


                {{-- Penulis --}}
                <div>

                    <label
                        for="author"
                        class="
                            mb-1.5
                            block
                            text-sm
                            font-medium
                            text-gray-700
                        "
                    >
                        Penulis
                    </label>

                    <select
                        id="author"
                        name="author"
                        class="
                            block
                            w-full
                            rounded-lg
                            border
                            border-gray-300
                            bg-white
                            px-3
                            py-2.5
                            text-sm
                            text-gray-900
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                        <option value="">
                            Semua Penulis
                        </option>

                        @foreach ($authors as $author)

                            <option
                                value="{{ $author->id }}"
                                @selected(
                                    request('author') == $author->id
                                )
                            >
                                {{ $author->name }}
                            </option>

                        @endforeach

                    </select>

                </div>


                {{-- Tombol Search --}}
                <div class="flex w-full sm:w-auto">

                    <button
                        type="submit"
                        title="Cari"
                        aria-label="Cari"
                        class="
                            inline-flex
                            h-[42px]
                            w-full
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-blue-600
                            px-4
                            text-sm
                            font-medium
                            text-white
                            shadow-sm
                            transition

                            hover:bg-blue-700

                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500/30

                            sm:w-[42px]
                            sm:px-0
                        "
                    >

                        <svg
                            class="h-5 w-5"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="2"
                            viewBox="0 0 24 24"
                            aria-hidden="true"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m21 21-4.35-4.35m1.35-5.15a6.5 6.5 0 1 1-13 0 6.5 6.5 0 0 1 13 0Z"
                            />
                        </svg>

                        <span class="sm:hidden">
                            Cari
                        </span>

                    </button>

                </div>

            </div>


            {{-- Reset Filter --}}
            @if (
                request('search')
                || request('type')
                || request('status')
                || request('author')
            )

                <div>

                    <a
                        href="{{ route('posts.index') }}"
                        class="
                            inline-flex
                            items-center
                            text-sm
                            font-medium
                            text-gray-600
                            transition
                            hover:text-red-600
                        "
                    >
                        Reset Filter
                    </a>

                </div>

            @endif

        </form>

    </x-admin.card>


    
    {{-- Table --}}
    <x-admin.card
        :padding="false"
        class="overflow-hidden" >

        <x-admin.table>

            <thead class="bg-gray-100 text-xs uppercase text-gray-600">

                <tr>
                    <th
                        scope="col"
                        class="
                            w-16
                            whitespace-nowrap
                            px-4 py-3
                            text-center
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500">
                        No.
                    </th>

                    <th
                        scope="col"
                        class="
                            min-w-[420px]
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500
                        ">
                        Konten
                    </th>

                    <th
                        scope="col"
                        class="
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500
                        ">
                        Jenis
                    </th>

                    <th
                        scope="col"
                        class="
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500
                        ">
                        Status
                    </th>

                    <th
                        scope="col"
                        class="
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide<x-admin.pagination
                            :paginator="$posts"
                            label="konten"
                            :per-page="$perPage"                
                            text-gray-500">
                            Penulis
                    </th>

                    <th
                        scope="col"
                        class="
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500
                        " >
                        Tanggal
                    </th>

                    <th
                        scope="col"
                        class="
                            whitespace-nowrap
                            px-4 py-3
                            text-left
                            text-xs font-semibold
                            uppercase tracking-wide
                            text-gray-500
                        ">
                        Aksi
                    </th>

                </tr>

            </thead>


            <tbody class="divide-y divide-gray-200">

                @forelse ($posts as $post)

                    <tr class="
                            odd:bg-white
                            even:bg-gray-100/70
                            hover:bg-blue-50
                            transition-colors duration-150
                        ">

                        {{-- Nomor --}}
                        <td class="
                                whitespace-nowrap
                                px-4 py-4
                                text-center
                                text-sm
                                font-medium
                                text-gray-500
                            ">
                                {{ $posts->firstItem() + $loop->index }}
                        </td>

                        {{-- Konten --}}
                        <td class="min-w-[420px] px-4 py-4">
                            
                            <div class="flex min-w-0 items-center gap-3">

                                {{-- Thumbnail --}}
                                <div class="h-14 w-14 shrink-0 overflow-hidden rounded-lg">

                                    @if (
                                        $post->featured_image &&
                                        \Illuminate\Support\Facades\Storage::disk('public')->exists($post->featured_image)
                                    )

                                        <img
                                            src="{{ asset('storage/' . $post->featured_image) }}"
                                            alt="{{ $post->title }}"
                                            class="h-full w-full object-cover"
                                        >

                                    @else

                                        <div
                                            class="
                                                flex h-full w-full
                                                items-center justify-center
                                                bg-gray-100
                                                text-xs text-gray-400
                                            "
                                        >
                                            No Image
                                        </div>

                                    @endif

                                </div>


                                {{-- Informasi konten --}}
                                <div class="min-w-0 flex-1">

                                    <a
                                        href="{{ route('posts.show', $post) }}"
                                        class="
                                            block
                                            font-medium
                                            text-gray-900
                                            hover:text-indigo-600
                                        "
                                    >
                                        {{ $post->title }}
                                    </a>

                                    @if ($post->excerpt)

                                        <div
                                            class="
                                                post-excerpt
                                                mt-1
                                                max-w-xl
                                                truncate
                                                text-sm
                                                text-gray-500
                                            "
                                        >
                                            {!! $post->excerpt !!}
                                        </div>

                                    @endif

                                </div>

                            </div>

                        </td>


                        {{-- Jenis --}}
                        <td class="px-4 py-4">
                            <div class="flex min-w-0 items-center gap-3">

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
                            </div>
                        </td>


                        {{-- Status --}}
                        <td class="px-4 py-4">
                            <div class="flex min-w-0 items-center gap-3">

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
                            </div>
                        </td>


                        {{-- Author --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                            <div class="flex min-w-0 items-center gap-3">
                                {{ $post->author?->name ?? '-' }}
                            </div>
                        </td>


                        {{-- Date --}}
                        <td class="whitespace-nowrap px-4 py-4 text-sm text-gray-600">
                            <div class="flex min-w-0 items-center gap-3">
                                {{ $post->created_at?->format('d M Y') }}
                            </div>
                        </td>


                        {{-- Action --}}
                        <td class="whitespace-nowrap px-4 py-4 text-right">
                            <div class="flex items-center justify-end gap-1.5">

                                {{-- Lihat --}}
                                <a
                                    href="{{ route('posts.show', $post) }}"
                                    title="Lihat"
                                    aria-label="Lihat konten"
                                    class="
                                        inline-flex h-9 w-9 items-center justify-center
                                        rounded-lg
                                        text-gray-500
                                        transition
                                        text-indigo-500 hover:bg-indigo-50 hover:text-indigo-700
                                        focus:outline-none
                                        focus:ring-2 focus:ring-indigo-500/30
                                    "
                                >
                                    <svg
                                        class="h-5 w-5"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="1.8"
                                        viewBox="0 0 24 24"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M2.5 12s3.5-6 9.5-6 9.5 6 9.5 6-3.5 6-9.5 6-9.5-6-9.5-6Z"
                                        />
                                        <circle
                                            cx="12"
                                            cy="12"
                                            r="2.5"
                                        />
                                    </svg>
                                </a>


                                {{-- Edit --}}
                                @if (
                                    auth()->user()?->hasPermission('posts.update') &&
                                    $post->status !== 'archived' &&
                                    ! (
                                        $post->status === 'published' &&
                                        auth()->user()?->hasRole('OPERATOR')
                                    )
                                )

                                    <a
                                        href="{{ route('posts.edit', $post) }}"
                                        title="Edit"
                                        aria-label="Edit konten"
                                        class="
                                            inline-flex h-9 w-9 items-center justify-center
                                            rounded-lg
                                            text-gray-500
                                            transition
                                            text-amber-500 hover:bg-amber-50 hover:text-amber-700
                                            focus:outline-none
                                            focus:ring-2 focus:ring-indigo-500/30
                                        "
                                    >
                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="m4 16 9.5-9.5a2.1 2.1 0 0 1 3 3L7 21H3v-4l1-1Z"
                                            />
                                            <path
                                                stroke-linecap="round"
                                                d="m13.5 7.5 3 3"
                                            />
                                        </svg>
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
                                        data-confirm="Publikasikan konten ini?"
                                        data-confirm-action="publish"
                                        data-confirm-button="Publikasikan">
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            title="Publish"
                                            aria-label="Publish konten"
                                            class="
                                                inline-flex h-9 w-9 items-center justify-center
                                                rounded-lg
                                                text-gray-500
                                                transition
                                                text-green-500 hover:bg-emerald-50 hover:text-emerald-700
                                                focus:outline-none
                                                focus:ring-2 focus:ring-green-500/30
                                            "
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="m5 12 4 4L19 6"
                                                />
                                            </svg>
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
                                        data-confirm="Arsipkan konten ini?"
                                        data-confirm-action="archive"
                                        data-confirm-button="Arsipkan"
                                    >
                                        @csrf
                                        @method('PATCH')

                                        <button
                                            type="submit"
                                            title="Arsipkan"
                                            aria-label="Arsipkan konten"
                                            class="
                                                inline-flex h-9 w-9 items-center justify-center
                                                rounded-lg
                                                text-orange-500
                                                transition
                                                hover:bg-orange-50
                                                hover:text-orange-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-orange-500/30
                                            "
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 7h16v13H4V7Z"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M3 7l2-4h14l2 4"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M9 12h6"
                                                />
                                            </svg>
                                        </button>
                                    </form>

                                @endif

                            </div>
                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="7odd:bg-white"
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

        </x-admin.table>

        {{-- Pagination --}}
        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Jumlah data --}}
                <form
                    method="GET"
                    action="{{ route('posts.index') }}"
                    class="flex items-center justify-center gap-2 self-center sm:self-auto">
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

                {{-- Pagination --}}
                <x-admin.pagination
                    :paginator="$posts"
                    label="konten"
                />

            </div>

        </div>              

    </x-admin.card>

</x-admin.page>

@endsection