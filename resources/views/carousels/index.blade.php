@extends('layouts.admin')

@section('title', 'Carousel')

@section('content')

<x-admin.page
    title="Carousel"
    description="Kelola banner yang ditampilkan pada halaman utama."
>

    <x-slot:actions>

        @if (auth()->user()?->hasPermission('carousels.create'))

            <a
                href="{{ route('carousels.create') }}"
                class="
                    inline-flex
                    w-full
                    items-center
                    justify-center
                    rounded-lg
                    bg-blue-600
                    px-4
                    py-2
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

                Tambah Carousel

            </a>

        @endif

    </x-slot:actions>


    {{-- Flash message --}}
    @if (session('success'))

        <div
            class="
                mb-6
                rounded-lg
                border
                border-green-200
                bg-green-50
                px-4
                py-3
            "
        >

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
            action="{{ route('carousels.index') }}"
            class="space-y-4"
        >

            <div
                class="
                    grid
                    grid-cols-1
                    gap-4
                    md:grid-cols-2
                    lg:grid-cols-[2fr_1fr_1fr_42px]
                    items-end
                "
            >

                {{-- Pencarian --}}
                <div>

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
                        placeholder="Judul konten..."
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


                {{-- Caption --}}
                <div>

                    <label
                        for="caption_type"
                        class="
                            mb-1.5
                            block
                            text-sm
                            font-medium
                            text-gray-700
                        "
                    >
                        Caption
                    </label>

                    <select
                        id="caption_type"
                        name="caption_type"
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
                            Semua Caption
                        </option>

                        <option
                            value="auto"
                            @selected(request('caption_type') === 'auto')
                        >
                            Otomatis
                        </option>

                        <option
                            value="custom"
                            @selected(request('caption_type') === 'custom')
                        >
                            Custom
                        </option>

                        <option
                            value="none"
                            @selected(request('caption_type') === 'none')
                        >
                            Tanpa Caption
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
                            value="active"
                            @selected(request('status') === 'active')
                        >
                            Aktif
                        </option>

                        <option
                            value="inactive"
                            @selected(request('status') === 'inactive')
                        >
                            Tidak Aktif
                        </option>

                    </select>

                </div>


                {{-- Search --}}
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
                        >
                            <circle
                                cx="11"
                                cy="11"
                                r="7"
                            />

                            <path
                                stroke-linecap="round"
                                d="M20 20l-4-4"
                            />
                        </svg>

                        <span class="sm:hidden">
                            Cari
                        </span>

                    </button>

                </div>

            </div>

        </form>

    </x-admin.card>


    {{-- =====================================================
        CAROUSEL LIST
    ====================================================== --}}

    <x-admin.card>

        @if ($carousels->count())

            {{-- =================================================
                DESKTOP / TABLET
            ================================================== --}}

            <div class="hidden overflow-x-auto md:block">

                <table class="min-w-full">

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
                                class="
                                    px-4
                                    py-3
                                    text-left
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Banner
                            </th>

                            <th
                                class="
                                    px-4
                                    py-3
                                    text-left
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Konten
                            </th>

                            <th
                                class="
                                    px-4
                                    py-3
                                    text-left
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Caption
                            </th>

                            <th
                                class="
                                    px-4
                                    py-3
                                    text-center
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Urutan
                            </th>

                            <th
                                class="
                                    px-4
                                    py-3
                                    text-left
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Status
                            </th>

                            <th
                                class="
                                    px-4
                                    py-3
                                    text-left
                                    text-xs
                                    font-semibold
                                    uppercase
                                    tracking-wider
                                    text-gray-500
                                "
                            >
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody class="divide-y divide-gray-200">

                        @foreach ($carousels as $carousel)

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
                                        {{ $carousels->firstItem() + $loop->index }}
                                </td>

                                {{-- Banner --}}
                                <td class="px-4 py-4">

                                    <img
                                        src="{{ asset('storage/' . $carousel->banner) }}"
                                        alt="Banner {{ $carousel->post?->title }}"
                                        class="
                                            h-20
                                            w-36
                                            rounded-lg
                                            object-cover
                                            shadow-sm
                                        "
                                    >

                                </td>


                                {{-- Konten --}}
                                <td class="px-4 py-4">

                                    @if ($carousel->post)

                                        <div class="max-w-xs">

                                            <div
                                                class="
                                                    font-medium
                                                    text-gray-900
                                                "
                                            >
                                                {{ $carousel->post->title }}
                                            </div>

                                            @php
                                                $typeLabel = match ($carousel->post->type) {
                                                    'news' => 'Berita',
                                                    'announcement' => 'Pengumuman',
                                                    'regulation' => 'Regulasi',
                                                    default => ucfirst($carousel->post->type),
                                                };
                                            @endphp

                                            <div class="mt-1">

                                                <span
                                                    class="
                                                        inline-flex
                                                        rounded-full
                                                        bg-gray-100
                                                        px-2
                                                        py-0.5
                                                        text-xs
                                                        font-medium
                                                        text-gray-600
                                                    "
                                                >
                                                    {{ $typeLabel }}
                                                </span>

                                            </div>

                                        </div>

                                    @else

                                        <span class="text-sm text-red-600">
                                            Konten tidak ditemukan
                                        </span>

                                    @endif

                                </td>


                                {{-- Caption --}}
                                <td class="px-4 py-4">

                                    @switch($carousel->caption_type)

                                        @case('auto')

                                            <span
                                                class="
                                                    inline-flex
                                                    rounded-full
                                                    bg-blue-100
                                                    px-2.5
                                                    py-1
                                                    text-xs
                                                    font-medium
                                                    text-blue-700
                                                "
                                            >
                                                Otomatis
                                            </span>

                                            @break

                                        @case('custom')

                                            <span
                                                class="
                                                    inline-flex
                                                    rounded-full
                                                    bg-purple-100
                                                    px-2.5
                                                    py-1
                                                    text-xs
                                                    font-medium
                                                    text-purple-700
                                                "
                                            >
                                                Custom
                                            </span>

                                            @break

                                        @default

                                            <span
                                                class="
                                                    inline-flex
                                                    rounded-full
                                                    bg-gray-100
                                                    px-2.5
                                                    py-1
                                                    text-xs
                                                    font-medium
                                                    text-gray-600
                                                "
                                            >
                                                Tanpa Caption
                                            </span>

                                    @endswitch


                                    @if ($carousel->show_button)

                                        <div
                                            class="
                                                mt-1
                                                text-xs
                                                text-gray-500
                                            "
                                        >
                                            Tombol:
                                            {{ $carousel->button_text }}
                                        </div>

                                    @else

                                        <div
                                            class="
                                                mt-1
                                                text-xs
                                                text-gray-400
                                            "
                                        >
                                            Tanpa tombol
                                        </div>

                                    @endif

                                </td>


                                {{-- Urutan --}}
                                <td class="px-4 py-4 text-center">

                                    <span
                                        class="
                                            inline-flex
                                            h-8
                                            min-w-8
                                            items-center
                                            justify-center
                                            rounded-full
                                            bg-gray-100
                                            px-2
                                            text-sm
                                            font-semibold
                                            text-gray-700
                                        "
                                    >
                                        {{ $carousel->sort_order }}
                                    </span>

                                </td>


                                {{-- Status --}}
                                <td class="px-4 py-4 text-center">

                                    @if ($carousel->isCurrentlyActive())

                                        <span
                                            class="
                                                inline-flex
                                                rounded-full
                                                bg-green-100
                                                px-2.5
                                                py-1
                                                text-xs
                                                font-medium
                                                text-green-700
                                            "
                                        >
                                            Aktif
                                        </span>

                                    @else

                                        <span
                                            class="
                                                inline-flex
                                                rounded-full
                                                bg-gray-100
                                                px-2.5
                                                py-1
                                                text-xs
                                                font-medium
                                                text-gray-600
                                            "
                                        >
                                            Tidak Aktif
                                        </span>

                                    @endif

                                </td>


                                {{-- Aksi --}}
                                <td class="whitespace-nowrap px-4 py-4 text-left">

                                    <div class="flex items-center justify-end gap-1.5">

                                        @if (auth()->user()->hasPermission('carousels.update'))

                                            <a
                                                href="{{ route('carousels.edit', $carousel) }}"
                                                title="Edit"
                                                aria-label="Edit Carousel"
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
                                                        d="m4 16 9.5-9.5a2.1 2.1 0 0 1 3 3L7 21H3v-4l1-1Z"
                                                    />
                                                    <path
                                                        stroke-linecap="round"
                                                        d="m13.5 7.5 3 3"
                                                    />
                                                </svg>

                                            </a>

                                        @endif


                                        @if (auth()->user()->hasPermission('carousels.delete'))

                                            <form
                                                action="{{ route('carousels.destroy', $carousel) }}"
                                                method="POST"
                                                onsubmit="return confirm('Apakah Anda yakin ingin menghapus Carousel ini?')"
                                            >

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    type="submit"
                                                    title="Hapus"
                                                    aria-label="Hapus Carousel"
                                                    class="
                                                        inline-flex h-9 w-9 items-center justify-center
                                                        rounded-lg
                                                        text-red-500
                                                        transition
                                                        hover:bg-red-50
                                                        hover:text-red-700
                                                        focus:outline-none
                                                        focus:ring-2
                                                        focus:ring-red-500/30
                                                    "
                                                    >

                                                    <svg
                                                        class="h-5 w-5"
                                                        fill="none"
                                                        stroke="currentColor"
                                                        stroke-width="2"
                                                        viewBox="0 0 24 24"
                                                    >
                                                        <path
                                                            stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 012-2h2a1 1 0 012 2v3m-9 0h12"
                                                        />
                                                    </svg>

                                                </button>

                                            </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            {{-- =================================================
                MOBILE
            ================================================== --}}

            <div class="space-y-4 md:hidden">

                @foreach ($carousels as $carousel)

                    <div
                        class="
                            overflow-hidden
                            rounded-xl
                            border
                            border-gray-200
                            bg-white
                            shadow-sm
                        "
                    >

                        <img
                            src="{{ asset('storage/' . $carousel->banner) }}"
                            alt="Banner {{ $carousel->post?->title }}"
                            class="
                                h-auto
                                max-h-52
                                w-full
                                object-cover
                            "
                        >


                        <div class="space-y-3 p-4">

                            <div>

                                <h3
                                    class="
                                        font-semibold
                                        text-gray-900
                                    "
                                >
                                    {{ $carousel->post?->title ?? 'Konten tidak ditemukan' }}
                                </h3>

                                @if ($carousel->post)

                                    @php
                                        $typeLabel = match ($carousel->post->type) {
                                            'news' => 'Berita',
                                            'announcement' => 'Pengumuman',
                                            'regulation' => 'Regulasi',
                                            default => ucfirst($carousel->post->type),
                                        };
                                    @endphp

                                    <span
                                        class="
                                            mt-1
                                            inline-flex
                                            rounded-full
                                            bg-gray-100
                                            px-2
                                            py-0.5
                                            text-xs
                                            font-medium
                                            text-gray-600
                                        "
                                    >
                                        {{ $typeLabel }}
                                    </span>

                                @endif

                            </div>


                            <div class="flex flex-wrap gap-2">

                                @switch($carousel->caption_type)

                                    @case('auto')

                                        <span
                                            class="
                                                rounded-full
                                                bg-blue-100
                                                px-2.5
                                                py-1
                                                text-xs
                                                font-medium
                                                text-blue-700
                                            "
                                        >
                                            Caption Otomatis
                                        </span>

                                        @break

                                    @case('custom')

                                        <span
                                            class="
                                                rounded-full
                                                bg-purple-100
                                                px-2.5
                                                py-1
                                                text-xs
                                                font-medium
                                                text-purple-700
                                            "
                                        >
                                            Caption Custom
                                        </span>

                                        @break

                                    @default

                                        <span
                                            class="
                                                rounded-full
                                                bg-gray-100
                                                px-2.5
                                                py-1
                                                text-xs
                                                font-medium
                                                text-gray-600
                                            "
                                        >
                                            Tanpa Caption
                                        </span>

                                @endswitch


                                @if ($carousel->show_button)

                                    <span
                                        class="
                                            rounded-full
                                            bg-indigo-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-indigo-700
                                        "
                                    >
                                        Tombol: {{ $carousel->button_text }}
                                    </span>

                                @else

                                    <span
                                        class="
                                            rounded-full
                                            bg-gray-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-gray-500
                                        "
                                    >
                                        Tanpa Tombol
                                    </span>

                                @endif

                            </div>


                            <div class="flex items-center justify-between">

                                <div class="text-sm text-gray-500">

                                    Urutan:

                                    <span class="font-semibold text-gray-700">
                                        {{ $carousel->sort_order }}
                                    </span>

                                </div>


                                @if ($carousel->isCurrentlyActive())

                                    <span
                                        class="
                                            rounded-full
                                            bg-green-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-green-700
                                        "
                                    >
                                        Aktif
                                    </span>

                                @else

                                    <span
                                        class="
                                            rounded-full
                                            bg-gray-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-gray-600
                                        "
                                    >
                                        Tidak Aktif
                                    </span>

                                @endif

                            </div>


                            <div
                                class="
                                    flex
                                    gap-2
                                    border-t
                                    border-gray-100
                                    pt-3
                                "
                            >

                                @if (auth()->user()->hasPermission('carousels.update'))

                                    <a
                                        href="{{ route('carousels.edit', $carousel) }}"
                                        title="Edit"
                                        aria-label="Edit Carousel"
                                        class="
                                            flex
                                            flex-1
                                            items-center
                                            justify-center
                                            rounded-lg
                                            border
                                            border-gray-200
                                            px-3
                                            py-2
                                            text-gray-500
                                            transition
                                            hover:border-blue-200
                                            hover:bg-blue-50
                                            hover:text-blue-600
                                            focus:outline-none
                                            focus:ring-2
                                            focus:ring-blue-500/30
                                        "
                                    >

                                        <svg
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                            viewBox="0 0 24 24"
                                        >
                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13l-3.14.942.942-3.14a4.5 4.5 0 01-1.897 1.13l-3.14.942.942-3.14a4.5 4.5 0 011.13-1.897L16.862 4.487z"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M19.5 7.125L16.875 4.5"
                                            />
                                        </svg>

                                    </a>

                                @endif


                                @if (auth()->user()->hasPermission('carousels.delete'))

                                    <form
                                        action="{{ route('carousels.destroy', $carousel) }}"
                                        method="POST"
                                        class="flex-1"
                                        onsubmit="return confirm('Apakah Anda yakin ingin menghapus Carousel ini?')"
                                    >

                                        @csrf
                                        @method('DELETE')

                                        <button
                                            type="submit"
                                            title="Hapus"
                                            aria-label="Hapus Carousel"
                                            class="
                                                flex
                                                w-full
                                                items-center
                                                justify-center
                                                rounded-lg
                                                border
                                                border-gray-200
                                                px-3
                                                py-2
                                                text-gray-500
                                                transition
                                                hover:border-red-200
                                                hover:bg-red-50
                                                hover:text-red-600
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-red-500/30
                                            "
                                        >

                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="2"
                                                viewBox="0 0 24 24"
                                            >
                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6M9 7V4a1 1 0 012-2h2a1 1 0 012 2v3m-9 0h12"
                                                />
                                            </svg>

                                        </button>

                                    </form>

                                @endif

                            </div>

                        </div>

                    </div>

                @endforeach

            </div>

        @else

            {{-- Empty State --}}
            <div class="py-12 text-center">

                <div
                    class="
                        mx-auto
                        flex
                        h-14
                        w-14
                        items-center
                        justify-center
                        rounded-full
                        bg-gray-100
                        text-gray-400
                    "
                >

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <rect
                            width="18"
                            height="14"
                            x="3"
                            y="5"
                            rx="2"
                        />

                        <path
                            stroke-linecap="round"
                            d="M3 16l5-5 4 4 3-3 6 6"
                        />
                    </svg>

                </div>

                <h3 class="mt-4 text-base font-semibold text-gray-800">
                    Belum ada Carousel
                </h3>

                <p class="mx-auto mt-1 max-w-md text-sm text-gray-500">
                    Tambahkan banner dari konten yang sudah dipublikasikan
                    untuk ditampilkan pada halaman utama.
                </p>

                @if (auth()->user()->hasPermission('carousels.create'))

                    <a
                        href="{{ route('carousels.create') }}"
                        class="
                            mt-5
                            inline-flex
                            items-center
                            gap-2
                            rounded-lg
                            bg-blue-600
                            px-4
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
                        "
                    >
                        Tambah Carousel
                    </a>

                @endif

            </div>

        @endif


                {{-- Desktop / Tablet --}}
        <div class="hidden overflow-x-auto md:block">
            <table>
                ...
            </table>
        </div>


        {{-- Mobile --}}
        <div class="space-y-4 md:hidden">
            ...
        </div>


        {{-- Empty State --}}
        @if (!$carousels->count())
            ...
        @endif


        {{-- Pagination --}}
        <div class="border-t border-gray-200 px-6 py-4">

            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                <form
                    method="GET"
                    action="{{ route('carousels.index') }}"
                    class="flex items-center justify-center gap-2 self-center sm:self-auto"
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
                        class="
                            w-16
                            rounded-md
                            border border-gray-300
                            bg-white
                            px-3 py-2
                            text-sm
                            text-gray-700
                            focus:border-indigo-500
                            focus:ring-indigo-500
                        "
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

                <x-admin.pagination
                    :paginator="$carousels"
                    label="carousel"
                />

            </div>

        </div>

    </x-admin.card>

</x-admin.page>

@endsection