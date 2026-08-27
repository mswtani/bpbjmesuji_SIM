@extends('layouts.admin')

@section('title', 'Manajemen Role')

@section('content')

    <div class="mb-6">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Judul --}}
            <div>
                <h1 class="text-2xl font-semibold text-gray-900">
                    Role & Permission
                </h1>

                <p class="mt-1 text-sm text-gray-600">
                    Kelola role dan hak akses pengguna.
                </p>
            </div>

            {{-- Tambah Role --}}
            <div class="flex shrink-0">
                <a
                    href="{{ route('roles.create') }}"
                    class="
                        inline-flex
                        items-center
                        gap-2
                        rounded-lg
                        bg-blue-600
                        px-4 py-2.5
                        text-sm font-semibold
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
                        class="h-5 w-5"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M12 5v14M5 12h14"
                        />
                    </svg>

                    Tambah Role
                </a>
            </div>

        </div>


        {{-- =====================================================
            SEARCH ROLE
        ====================================================== --}}

        <div class="border-b border-gray-200 p-4 sm:p-5">

            <form
                method="GET"
                action="{{ route('roles.index') }}"
                class="flex w-full items-center justify-center gap-2"
            >

                <div class="relative w-full max-w-md">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama atau kode role..."
                        class="
                            block w-full
                            rounded-lg
                            border border-gray-300
                            bg-white
                            px-3 py-2.5
                            pr-10
                            text-sm
                            text-gray-900
                            placeholder:text-gray-400
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                    {{-- Reset pencarian --}}

                    @if (request('search'))

                        <a
                            href="{{ route('roles.index') }}"
                            aria-label="Reset pencarian"
                            title="Reset pencarian"
                            class="
                                absolute right-2 top-1/2
                                inline-flex h-7 w-7
                                -translate-y-1/2
                                items-center justify-center
                                rounded-md
                                text-gray-400
                                transition
                                hover:bg-red-50
                                hover:text-red-600
                                focus:outline-none
                                focus:ring-2
                                focus:ring-red-500/30
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
                                    d="M6 6l12 12M18 6 6 18"
                                />
                            </svg>

                        </a>

                    @endif

                </div>


                {{-- Tombol Search --}}

                <button
                    type="submit"
                    aria-label="Cari role"
                    title="Cari"
                    class="
                        inline-flex
                        h-10 w-10
                        shrink-0
                        items-center justify-center
                        rounded-lg
                        bg-blue-600
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
                            d="m20 20-3.5-3.5"
                        />
                    </svg>

                </button>

            </form>

        </div>

    </div>

    {{-- Flash Success --}}
    @if (session('success'))

        <div
            class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800"
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- Flash Error --}}
    @if (session('error'))

        <div
            class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800"
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- Daftar Role --}}
    <x-admin.card>

        <div class="overflow-x-auto">

            <x-admin.table>


                <thead class="bg-gray-50">

                    <tr>

                        {{-- No --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            No
                        </th>


                        {{-- Code --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Code
                        </th>


                        {{-- Nama --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Nama
                        </th>


                        {{-- Deskripsi --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Deskripsi
                        </th>


                        {{-- Level --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Level
                        </th>


                        {{-- Jumlah User --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Jumlah User
                        </th>


                        {{-- Aksi --}}
                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                <tbody class="divide-y divide-gray-200 bg-white">

                    @forelse ($roles as $role)

                        <tr class="
                            odd:bg-white
                            even:bg-gray-100/70
                            hover:bg-blue-50
                            transition-colors
                            duration-150">

                            {{-- No --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- Code --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $role->code }}
                            </td>


                            {{-- Nama --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $role->name }}
                            </td>


                            {{-- Deskripsi --}}
                            <td class="px-6 py-4 text-sm text-gray-600">
                                {{ $role->description ?? '-' }}
                            </td>


                            {{-- Level --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $role->level }}
                            </td>


                            {{-- Jumlah User --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right text-sm text-gray-600">
                                {{ $role->users_count }}
                            </td>


                            {{-- Aksi --}}
                            <td class="whitespace-nowrap px-6 py-4 text-right">

                                <div class="flex items-center justify-end gap-1">

                                    {{-- Detail --}}
                                    {{-- @if (auth()->user()->hasPermission('roles.update'))

                                        <a
                                            href="{{ route('roles.show', $role) }}"
                                            title="Lihat"
                                            aria-label="Lihat role"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-indigo-600
                                                transition
                                                hover:bg-indigo-50
                                                hover:text-indigo-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-indigo-500/30
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
                                    @endif --}}

                                    {{-- Edit --}}
                                    @if (auth()->user()->hasPermission('roles.update'))

                                        <a
                                            href="{{ route('roles.edit', $role) }}"
                                            title="Edit"
                                            aria-label="Edit role"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-blue-600
                                                transition
                                                hover:bg-blue-50
                                                hover:text-blue-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-blue-500/30
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
                                                    d="m14.5 5.5 4 4M4 20l3.5-.8L18.5 8.2a2.1 2.1 0 0 0-3-3L4.5 16.2 4 20Z"
                                                />
                                            </svg>
                                        </a>

                                    @endif


                                    {{-- Permission --}}
                                    @if (auth()->user()->hasPermission('roles.update'))

                                        <a
                                            href="{{ route('roles.permissions', $role) }}"
                                            title="Permission"
                                            aria-label="Kelola permission"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-purple-600
                                                transition
                                                hover:bg-purple-50
                                                hover:text-purple-700
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-purple-500/30
                                            "
                                        >
                                            <svg
                                                class="h-5 w-5"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                                viewBox="0 0 24 24"
                                            >
                                                <rect
                                                    x="4"
                                                    y="4"
                                                    width="16"
                                                    height="16"
                                                    rx="3"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    d="M8 12h8M12 8v8"
                                                />
                                            </svg>
                                        </a>

                                    @endif


                                    {{-- Hapus --}}
                                    @if (auth()->user()->hasPermission('roles.delete'))

                                        <form
                                            method="POST"
                                            action="{{ route('roles.destroy', $role) }}"
                                            class="inline"
                                            data-confirm="Apakah Anda yakin ingin menghapus role ini?"
                                            data-confirm-action="delete"
                                            data-confirm-button="Hapus"
                                        >
                                            @csrf
                                            @method('DELETE')

                                            <button
                                                type="submit"
                                                title="Hapus"
                                                aria-label="Hapus role"
                                                class="
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
                                colspan="7"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Belum ada role.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </x-admin.table>
           
        </div>

        {{-- =====================================================
            PAGINATION
        ====================================================== --}}

        <div class="border-t border-gray-200 px-6 py-4">

            <div
                class="
                    flex flex-col gap-4
                    sm:flex-row
                    sm:items-center
                    sm:justify-between
                "
            >

                {{-- Jumlah data --}}

                <form
                    method="GET"
                    action="{{ route('roles.index') }}"
                    class="flex items-center gap-2"
                >

                    @foreach (request()->except(['page', 'per_page']) as $key => $value)

                        @if (is_array($value))

                            @foreach ($value as $arrayKey => $arrayValue)

                                <input
                                    type="hidden"
                                    name="{{ $key }}[{{ $arrayKey }}]"
                                    value="{{ $arrayValue }}"
                                >

                            @endforeach

                        @else

                            <input
                                type="hidden"
                                name="{{ $key }}"
                                value="{{ $value }}"
                            >

                        @endif

                    @endforeach

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
                            h-9
                            w-16
                            rounded-lg
                            border border-gray-300
                            bg-white
                            px-2
                            text-sm
                            text-gray-700
                            focus:border-blue-500
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500/20
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


                {{-- Pagination --}}

                <x-admin.pagination
                    :paginator="$roles"
                    label="role"
                />

            </div>

        </div>

    </x-admin.card>

@endsection