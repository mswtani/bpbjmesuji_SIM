@extends('layouts.admin')

@section('title', 'Jenis Regulasi')

@section('content')

    <div class="space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div
            class="
                flex
                flex-col
                gap-4
                sm:flex-row
                sm:items-center
                sm:justify-between
            "
            >

            <div>

                <h1
                    class="
                        text-2xl
                        font-bold
                        tracking-tight
                        text-gray-900
                    "
                >
                    Jenis Regulasi
                </h1>

                <p class="mt-1 text-sm text-gray-500">
                    Kelola jenis regulasi yang digunakan pada konten regulasi.
                </p>

            </div>


            @if(
                auth()->user()?->hasPermission(
                    'regulation-types.create'
                )
            )

                <a
                    href="{{ route('regulation-types.create') }}"
                    class="
                        inline-flex
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
                            d="M12 4v16m8-8H4"
                        />
                    </svg>

                    Tambah Jenis Regulasi

                </a>

            @endif

        </div>


        {{-- FILTER & SEARCH --}}

        <x-admin.card>

            <form
                method="GET"
                action="{{ route('regulation-types.index') }}"
                class="space-y-4"
                >

                {{-- Filter fields --}}
                <div
                    class="
                        grid
                        grid-cols-1
                        gap-4
                        md:grid-cols-2
                        lg:grid-cols-[2fr_1fr_42px]
                        lg:items-end
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
                            type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama atau deskripsi..."
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
                                value="1"
                                @selected(request('status') === '1')
                            >
                                Aktif
                            </option>

                            <option
                                value="0"
                                @selected(request('status') === '0')
                            >
                                Tidak Aktif
                            </option>

                        </select>

                    </div>


                    {{-- Button Search --}}
                    <div class="w-full lg:w-[42px]">

                        <button
                            type="submit"
                            class="
                                inline-flex
                                h-[42px]
                                w-full
                                items-center
                                justify-center
                                rounded-lg
                                bg-blue-600
                                text-white
                                shadow-sm
                                transition
                                hover:bg-blue-700
                                focus:outline-none
                                focus:ring-2
                                focus:ring-blue-500/30
                                lg:w-[42px]
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

                        </button>

                    </div>

                </div>


                {{-- Reset Filter --}}
                @if (request('search') || request('status'))

                    <div>

                        <a
                            href="{{ route('regulation-types.index') }}"
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


        {{-- TABEL--}}
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
                            Jenis Regulasi
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
                                uppercase tracking-wide
                                text-gray-500
                            ">
                            Deskripsi
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
                            Urutan
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

                    @forelse($regulationTypes as $regulationType)

                        <tr
                            class="
                            odd:bg-white
                            even:bg-gray-100/70
                            hover:bg-blue-50
                            transition-colors duration-150
                            ">

                            {{-- Nomor --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-center
                                    text-sm
                                    font-medium
                                    text-gray-500
                                ">
                                {{
                                    $regulationTypes->firstItem()
                                    + $loop->index
                                }}
                            </td>


                            {{-- Nama --}}
                            <td class="px-4 py-4">
                                <a href="{{ route('regulation-types.show', $regulationType) }}">

                                    <div
                                        class="
                                        post-excerpt
                                            mt-1
                                            max-w-xl
                                            truncate
                                            text-sm
                                            text-gray-900
                                            hover:text-indigo-600
                                        "
                                        >
                                        {{ $regulationType->name }}
                                    </div>

                                    <div
                                        class="
                                            mt-1
                                            text-xs
                                            text-gray-400
                                        "
                                        >
                                        {{ $regulationType->slug }}
                                    </div>

                                </a>

                            </td>


                            {{-- Deskripsi --}}
                            <td
                                class="
                                    max-w-md
                                    px-4 py-4
                                    text-sm
                                    text-gray-600
                                "
                            >

                                @if($regulationType->description)

                                    <div class="line-clamp-2">

                                        {{
                                            $regulationType->description
                                        }}

                                    </div>

                                @else

                                    <span class="text-gray-400">
                                        —
                                    </span>

                                @endif

                            </td>


                            {{-- Status --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-center
                                "
                            >

                                @if($regulationType->is_active)

                                    <span
                                        class="
                                            inline-flex
                                            items-center
                                            rounded-full
                                            bg-green-50
                                            px-2.5 py-1
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
                                            items-center
                                            rounded-full
                                            bg-gray-100
                                            px-2.5 py-1
                                            text-xs
                                            font-medium
                                            text-gray-600
                                        "
                                    >
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>


                            {{-- Urutan --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4 py-4
                                    text-center
                                    text-sm
                                    font-medium
                                    text-gray-700
                                "
                            >
                                {{ $regulationType->sort_order }}
                            </td>


                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-4 py-4 text-right">
                                <div class="flex items-center justify-end gap-1.5">


                                    {{-- Detail --}}
                                    @if(
                                        auth()->user()?->hasPermission(
                                            'regulation-types.view'
                                        )
                                    )

                                        <a
                                            href="{{ route(
                                                'regulation-types.show',
                                                $regulationType
                                            ) }}"
                                            class="
                                                inline-flex
                                                h-9
                                                w-9
                                                items-center
                                                justify-center
                                                rounded-lg
                                                text-blue-600
                                                transition
                                                hover:bg-blue-50
                                                hover:text-blue-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-blue-500/30
                                            "
                                            title="Lihat Detail"
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

                                    @endif

                                    {{-- Edit --}}
                                    @if(
                                        auth()->user()?->hasPermission(
                                            'regulation-types.update'
                                        )
                                    )

                                        <a
                                            href="{{ route('regulation-types.edit', $regulationType) }}"
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


                                    {{-- Hapus --}}
                                    @if(
                                        auth()->user()?->hasPermission(
                                            'regulation-types.delete'
                                        )
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('regulation-types.destroy', $regulationType) }}"
                                            class="inline"
                                        >

                                            @csrf

                                            @method('DELETE')

                                            <button
                                                type="button"
                                                    class="
                                                        delete-regulation-type
                                                        inline-flex h-9 w-9
                                                        items-center justify-center
                                                        rounded-lg
                                                        text-red-600
                                                        transition
                                                        hover:bg-red-50
                                                        hover:text-red-700
                                                        focus:outline-none
                                                        focus:ring-2
                                                        focus:ring-red-500/30
                                                    "
                                                    data-delete-url="{{ route('regulation-types.destroy', $regulationType) }}"
                                                    data-regulation-type-name="{{ $regulationType->name }}"
                                                    title="Hapus"
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
                                                            d="M4 7h16M10 11v6M14 11v6M6 7l1 13h10l1-13M9 7V4h6v3"
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
                                colspan="6"
                                class="
                                    px-6 py-16
                                    text-center
                                "
                            >

                                <div
                                    class="
                                        mx-auto
                                        max-w-sm
                                        space-y-2
                                    "
                                >

                                    <div
                                        class="
                                            text-base
                                            font-semibold
                                            text-gray-700
                                        "
                                    >
                                        Belum ada jenis regulasi
                                    </div>

                                    <p
                                        class="
                                            text-sm
                                            text-gray-500
                                        "
                                    >
                                        Tambahkan jenis regulasi untuk digunakan
                                        saat membuat konten regulasi.
                                    </p>

                                    @if(
                                        auth()->user()?->hasPermission(
                                            'regulation-types.create'
                                        )
                                    )

                                        <div class="pt-3">

                                            <a
                                                href="{{ route('regulation-types.create') }}"
                                                class="
                                                    inline-flex
                                                    items-center
                                                    justify-center
                                                    rounded-lg
                                                    bg-blue-600
                                                    px-4 py-2.5
                                                    text-sm
                                                    font-medium
                                                    text-white
                                                    hover:bg-blue-700
                                                "
                                            >
                                                Tambah Jenis Regulasi
                                            </a>

                                        </div>

                                    @endif

                                </div>

                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </x-admin.table>

        </x-admin.card>

        {{-- =====================================================
            PAGINATION
        ====================================================== --}}

        <div class="border-t border-gray-200 px-6 py-4">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">

                {{-- Jumlah data --}}
                <form
                    method="GET"
                    action={{  route('regulation-types.index') }}
                    class="flex items-center justify-center gap-2 self-center sm:self-auto">
                    
                    <label for="per_page"
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

                    <span>
                        data
                    </span>

                </form>

                {{-- Pagination --}}
                <x-admin.pagination
                    :paginator="$regulationTypes"
                    label="Jenis Regulasi"
                />

            </div>
        </div>
    
    </div>

     {{-- =====================================================
        DELETE CONFIRMATION MODAL
    ====================================================== --}}

    <div
        id="delete-regulation-type-modal"
        class="
            fixed
            inset-0
            z-50
            hidden
            items-center
            justify-center
            bg-gray-900/50
            px-4
            backdrop-blur-sm
        "
    >

        <div
            class="
                relative
                w-full
                max-w-lg
                overflow-hidden
                rounded-2xl
                bg-white
                shadow-2xl
            "
            role="dialog"
            aria-modal="true"
            aria-labelledby="delete-regulation-type-title"
            >

            {{-- Tombol Tutup --}}
            <button
                type="button"
                id="close-delete-regulation-type-modal"
                class="
                    absolute
                    right-4
                    top-4
                    z-10
                    inline-flex
                    h-9
                    w-9
                    items-center
                    justify-center
                    rounded-lg
                    text-gray-400
                    transition
                    hover:bg-gray-100
                    hover:text-gray-700
                    focus:outline-none
                    focus:ring-2
                    focus:ring-gray-500/20
                "
                aria-label="Tutup modal"
                title="Tutup"
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
                        d="M6 18 18 6M6 6l12 12"
                    />
                </svg>

            </button>

            {{-- =================================================
                CONTENT
            ================================================== --}}

            <div
                class="
                    px-6
                    py-7
                    text-center
                    sm:px-8
                "
            >

                {{-- Icon --}}

                <div
                    class="
                        mx-auto
                        flex
                        h-14
                        w-14
                        items-center
                        justify-center
                        rounded-2xl
                        bg-red-50
                        text-red-600
                    "
                >

                    <svg
                        class="h-7 w-7"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M3 6h18"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M8 6V4h8v2"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 6l-1 14H6L5 6"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M10 11v6"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M14 11v6"
                        />
                    </svg>

                </div>


                {{-- Title --}}

                <h3
                    id="delete-regulation-type-title"
                    class="
                        mt-5
                        text-xl
                        font-semibold
                        text-gray-900
                    "
                >
                    Hapus jenis regulasi?
                </h3>


                {{-- Description --}}

                <p
                    class="
                        mx-auto
                        mt-3
                        max-w-md
                        text-sm
                        leading-6
                        text-gray-600
                    "
                >
                    Anda akan menghapus jenis regulasi berikut:
                </p>


                {{-- Regulation Type Name --}}

                <div
                    class="
                        mx-auto
                        mt-4
                        max-w-md
                        rounded-xl
                        border
                        border-red-200
                        bg-red-50
                        px-4
                        py-3
                    "
                >

                    <p
                        id="delete-regulation-type-name"
                        class="
                            text-sm
                            font-semibold
                            text-red-800
                        "
                    ></p>

                </div>


                {{-- Warning --}}

                <p
                    class="
                        mx-auto
                        mt-5
                        max-w-md
                        text-sm
                        leading-6
                        text-gray-500
                    "
                >
                    Tindakan ini tidak dapat dibatalkan.
                </p>

            </div>


            {{-- =================================================
                ACTION
            ================================================== --}}

            <div
                class="
                    flex
                    flex-col-reverse
                    gap-3
                    border-t
                    border-gray-100
                    bg-gray-50
                    px-6
                    py-4
                    sm:flex-row
                    sm:items-center
                    sm:justify-center
                    sm:px-8
                "
            >

                {{-- Batal --}}

                <button
                    type="button"
                    id="cancel-delete-regulation-type"
                    class="
                        inline-flex
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
                        hover:text-gray-900
                        focus:outline-none
                        focus:ring-2
                        focus:ring-gray-500/20
                    "
                >
                    Batal
                </button>


                {{-- Confirm Delete --}}

                <form
                    id="delete-regulation-type-form"
                    method="POST"
                >

                    @csrf

                    @method('DELETE')


                    <button
                        type="submit"
                        class="
                            inline-flex
                            items-center
                            justify-center
                            gap-2
                            rounded-lg
                            bg-red-600
                            px-5
                            py-2.5
                            text-sm
                            font-semibold
                            text-white
                            shadow-sm
                            transition
                            hover:bg-red-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-red-500/30
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
                                d="M3 6h18"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M8 6V4h8v2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M19 6l-1 14H6L5 6"
                            />
                        </svg>

                        Ya, Hapus

                    </button>

                </form>

            </div>

        </div>

    </div>

    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const deleteButtons = document.querySelectorAll(
                '.delete-regulation-type'
            );

            const deleteModal = document.getElementById(
                'delete-regulation-type-modal'
            );

            const closeDeleteModalButton = document.getElementById(
            'close-delete-regulation-type-modal' 
            );

            const cancelDeleteButton = document.getElementById(
                'cancel-delete-regulation-type'
            );

            const deleteForm = document.getElementById(
                'delete-regulation-type-form'
            );

            const regulationTypeName = document.getElementById(
                'delete-regulation-type-name'
            );


            /*
            |--------------------------------------------------------------------------
            | Buka Modal Delete
            |--------------------------------------------------------------------------
            */

            deleteButtons.forEach(function (button) {

                button.addEventListener('click', function () {

                    const deleteUrl = this.dataset.deleteUrl;

                    const name = this.dataset.regulationTypeName;


                    /*
                    |--------------------------------------------------------------------------
                    | Isi Nama Jenis Regulasi
                    |--------------------------------------------------------------------------
                    */

                    regulationTypeName.textContent = name;


                    /*
                    |--------------------------------------------------------------------------
                    | Set Action Form Delete
                    |--------------------------------------------------------------------------
                    */

                    deleteForm.action = deleteUrl;


                    /*
                    |--------------------------------------------------------------------------
                    | Tampilkan Modal
                    |--------------------------------------------------------------------------
                    */

                    deleteModal.classList.remove('hidden');

                    deleteModal.classList.add('flex');


                    /*
                    |--------------------------------------------------------------------------
                    | Lock Scroll Body
                    |--------------------------------------------------------------------------
                    */

                    document.body.classList.add('overflow-hidden');

                });

            });


            /*
            |--------------------------------------------------------------------------
            | Tutup Modal
            |--------------------------------------------------------------------------
            */

            function closeDeleteModal() {

                deleteModal.classList.add('hidden');

                deleteModal.classList.remove('flex');

                document.body.classList.remove('overflow-hidden');

            }

            if (closeDeleteModalButton) {

                closeDeleteModalButton.addEventListener(
                    'click',
                    closeDeleteModal
                );

            }


            /*
            |--------------------------------------------------------------------------
            | Tombol Batal
            |--------------------------------------------------------------------------
            */

            cancelDeleteButton.addEventListener(
                'click',
                closeDeleteModal
            );


            /*
            |--------------------------------------------------------------------------
            | Klik Overlay
            |--------------------------------------------------------------------------
            */

            deleteModal.addEventListener(
                'click',
                function (event) {

                    if (event.target === deleteModal) {

                        closeDeleteModal();

                    }

                }
            );


            /*
            |--------------------------------------------------------------------------
            | Tombol Escape
            |--------------------------------------------------------------------------
            */

            document.addEventListener(
                'keydown',
                function (event) {

                    if (
                        event.key === 'Escape' &&
                        !deleteModal.classList.contains('hidden')
                    ) {

                        closeDeleteModal();

                    }

                }
            );

        });
    </script>

@endsection