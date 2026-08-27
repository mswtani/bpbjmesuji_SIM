@extends('layouts.admin')

@section('title', 'Manajemen User')

@section('content')

    {{-- Header --}}
    <div class="mb-6 flex items-center justify-between">

        <div>
            <h1 class="text-2xl font-semibold text-gray-900">
                Manajemen User
            </h1>
        </div>


        {{-- Tambah User --}}
        @if (auth()->user()->hasPermission('users.create'))

            <a
                href="{{ route('users.create') }}"
                class="rounded-md bg-indigo-600 px-4 py-2 text-sm font-medium text-white hover:bg-indigo-700"
            >
                + Tambah User
            </a>

        @endif

    </div>


    {{-- Flash Success --}}
    @if (session('success'))

        <div class="mb-6 rounded-lg border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
            {{ session('success') }}
        </div>

    @endif


    {{-- Flash Error --}}
    @if (session('error'))

        <div class="mb-6 rounded-lg border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
            {{ session('error') }}
        </div>

    @endif


    {{-- Daftar User --}}
    <x-admin.card :padding="false"
            class="overflow-hidden"
        >

        <div class="border-b border-gray-200 p-4 sm:p-5">

            <form
                method="GET"
                action="{{ route('users.index') }}"
                class="flex w-full items-center justify-center gap-2"  >

                <div class="relative w-full max-w-md">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        placeholder="Cari nama, NIP, atau email..."
                        class="
                            block w-full rounded-lg
                            border border-gray-300
                            bg-white
                            px-3 py-2.5
                            pr-10
                            text-sm text-gray-900
                            placeholder:text-gray-400
                            focus:border-blue-500
                            focus:ring-blue-500
                        "
                    >

                    @if (request('search'))

                        <a
                            href="{{ route('users.index') }}"
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


                {{-- Search button --}}

                <button
                    type="submit"
                    aria-label="Cari pengguna"
                    title="Cari"
                    class="
                        inline-flex
                        h-10 w-10
                        shrink-0
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
                            d="m20 20-4-4"
                        />
                    </svg>

                </button>

            </form>

        </div>

        <div class="overflow-x-auto">

            <x-admin.table>

                {{-- Header Tabel --}}
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">

                    <tr>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            No
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            NIP
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Nama
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Email
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Role
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Jabatan
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-left text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Status
                        </th>

                        <th
                            scope="col"
                            class="whitespace-nowrap px-6 py-3 text-right text-xs font-medium uppercase tracking-wider text-gray-500"
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                {{-- Isi Tabel --}}
                <tbody class="divide-y divide-gray-200">

                    @forelse ($users as $user)

                        <tr class="
                                odd:bg-white
                                even:bg-gray-100/70
                                hover:bg-blue-50
                                transition-colors duration-150
                            ">

                            {{-- No --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-500">
                                {{ $loop->iteration }}
                            </td>


                            {{-- NIP --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm font-medium text-gray-900">
                                {{ $user->nip }}
                            </td>


                            {{-- Nama --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-900">
                                {{ $user->name }}
                            </td>


                            {{-- Email --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->role?->name ?? '-' }}
                            </td>


                            {{-- Jabatan --}}
                            <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-600">
                                {{ $user->position?->name ?? '-' }}
                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($user->is_active)

                                    <span class="rounded-full bg-green-100 px-2.5 py-1 text-xs font-medium text-green-800">
                                        Aktif
                                    </span>

                                @else

                                    <span class="rounded-full bg-red-100 px-2.5 py-1 text-xs font-medium text-red-800">
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>


                           {{-- Aksi --}}
                            <td class="whitespace-nowrap px-4 py-4 text-right">

                                <div class="flex items-center justify-end gap-1.5">

                                    {{-- =====================================================
                                        LIHAT
                                    ====================================================== --}}

                                    @if (auth()->user()->hasPermission('users.view'))

                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            aria-label="Lihat {{ $user->name }}"
                                            title="Lihat"
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

                                    @endif


                                    {{-- =====================================================
                                        EDIT
                                    ====================================================== --}}

                                    @if (auth()->user()->hasPermission('users.update'))

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            aria-label="Edit {{ $user->name }}"
                                            title="Edit"
                                            class="
                                                inline-flex h-9 w-9
                                                items-center justify-center
                                                rounded-lg
                                                text-gray-600
                                                transition
                                                hover:bg-gray-100
                                                hover:text-gray-900
                                                focus:outline-none
                                                focus:ring-2
                                                focus:ring-gray-400/30
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
                                                    d="m14.7 6.3 3 3"
                                                />

                                                <path
                                                    stroke-linecap="round"
                                                    stroke-linejoin="round"
                                                    d="M4 20l4.5-1 10.2-10.2a2.1 2.1 0 0 0-3-3L5.5 16 4 20Z"
                                                />
                                            </svg>

                                        </a>

                                    @endif


                                    {{-- =====================================================
                                        AKTIFKAN / NONAKTIFKAN
                                    ====================================================== --}}

                                    @if ($user->id !== auth()->id())

                                        @if ($user->is_active)

                                            @if (auth()->user()->hasPermission('users.deactivate'))

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.deactivate', $user) }}"
                                                    class="inline"
                                                    data-confirm="  Apakah anda yakin akan menonaktifkan user ini?"
                                                    data-confirm-action="deactivate"
                                                    data-confirm-button="Nonaktifkan">
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        aria-label="Nonaktifkan {{ $user->name }}"
                                                        title="Nonaktifkan"
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
                                                                d="M8 6h8M9 6v12m6-12v12M5 6h14M7 6l1 14h8l1-14"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                d="M10 3h4l1 3H9l1-3Z"
                                                            />
                                                        </svg>

                                                    </button>

                                                </form>

                                            @endif

                                        @else

                                            @if (auth()->user()->hasPermission('users.activate'))

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.activate', $user) }}"
                                                    class="inline"
                                                    data-confirm="Aktifkan user ini?"
                                                    data-confirm-action="activate"
                                                    data-confirm-button="Aktifkan"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        aria-label="Aktifkan {{ $user->name }}"
                                                        title="Aktifkan"
                                                        class="
                                                            inline-flex h-9 w-9
                                                            items-center justify-center
                                                            rounded-lg
                                                            text-emerald-600
                                                            transition
                                                            hover:bg-emerald-50
                                                            hover:text-emerald-700
                                                            focus:outline-none
                                                            focus:ring-2
                                                            focus:ring-emerald-500/30
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
                                                                d="M12 3a9 9 0 1 0 9 9"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="m9 12 2 2 5-5"
                                                            />
                                                        </svg>

                                                    </button>

                                                </form>

                                            @endif

                                        @endif

                                    @endif


                                    {{-- =====================================================
                                        RESET PASSWORD
                                    ====================================================== --}}

                                    @if (
                                        $user->id !== auth()->id()
                                        && auth()->user()->hasPermission('users.reset-password')
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('users.reset-password', $user) }}"
                                            class="inline"
                                            data-confirm="Apakah anda yakin akan mereset password user ini?"
                                            data-confirm-action="reset-password"
                                            data-confirm-button="Reset Password">
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                aria-label="Reset password {{ $user->name }}"
                                                title="Reset Password"
                                                class="
                                                    inline-flex h-9 w-9
                                                    items-center justify-center
                                                    rounded-lg
                                                    text-orange-600
                                                    transition
                                                    hover:bg-orange-50
                                                    hover:text-orange-700
                                                    focus:outline-none
                                                    focus:ring-2
                                                    focus:ring-orange-500/30
                                                ">

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
                                                        d="M4 12a8 8 0 1 0 2.34-5.66"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        d="M4 5v5h5"
                                                    />

                                                    <path
                                                        stroke-linecap="round"
                                                        d="M12 9v3l2 2"
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
                                colspan="8"
                                class="px-6 py-10 text-center text-sm text-gray-500"
                            >
                                Belum ada user.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </x-admin.table>

        </div>

        <x-admin.pagination :paginator="$users" label="pengguna" />

    </x-admin.card>

    {{-- =====================================================
     USER SUCCESS MODAL
    ====================================================== --}}

    @if (session('success') && session('success_action'))

        <div
            id="user-success-modal"
            data-success-action="{{ session('success_action') }}"
            class="fixed inset-0 z-[100] flex items-center justify-center p-4"
            aria-hidden="false"
            >

            {{-- Overlay --}}
            <div
                class="
                    absolute inset-0
                    bg-gray-900/40
                    backdrop-blur-[1px]
                "
            ></div>


            {{-- Modal --}}
            <div
                class="
                    relative z-10
                    w-full max-w-md
                    overflow-hidden
                    rounded-2xl
                    border border-gray-200
                    bg-white
                    shadow-2xl
                "
            >

                {{-- Close --}}
                <div class="flex justify-end px-4 pt-4">

                    <button
                        type="button"
                        id="user-success-close"
                        title="Tutup"
                        aria-label="Tutup"
                        class="
                            inline-flex
                            h-9 w-9
                            items-center justify-center
                            rounded-lg
                            text-gray-400
                            transition
                            hover:bg-gray-100
                            hover:text-gray-700
                            focus:outline-none
                            focus:ring-2
                            focus:ring-gray-500/20
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
                                d="M6 6l12 12M18 6 6 18"
                            />
                        </svg>

                    </button>

                </div>


                {{-- Icon --}}
                <div class="flex justify-center px-5 pt-1">

                    <div
                        id="user-success-icon"
                        class="
                            flex h-16 w-16
                            items-center justify-center
                            rounded-2xl
                        "
                    >

                        {{-- Activate --}}
                        <svg
                            data-success-icon="activate"
                            class="hidden h-8 w-8"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m8 12 2.5 2.5L16 9"
                            />
                        </svg>


                        {{-- Deactivate --}}
                        <svg
                            data-success-icon="deactivate"
                            class="hidden h-8 w-8"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <circle
                                cx="12"
                                cy="12"
                                r="9"
                            />

                            <path
                                stroke-linecap="round"
                                d="M8 12h8"
                            />
                        </svg>


                        {{-- Reset Password --}}
                        <svg
                            data-success-icon="reset-password"
                            class="hidden h-8 w-8"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                            viewBox="0 0 24 24"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 12a8 8 0 1 0 3-6.2"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M4 5v5h5"
                            />

                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M12 10v4"
                            />

                            <circle
                                cx="12"
                                cy="16.5"
                                r=".5"
                                fill="currentColor"
                                stroke="none"
                            />
                        </svg>

                    </div>

                </div>


                {{-- Content --}}
                <div class="px-5 pb-6 pt-5 text-center">

                    @if (session('success_action') === 'activate')

                        <h2
                            class="
                                text-lg
                                font-bold
                                leading-7
                                text-gray-900
                                sm:text-xl
                            "
                        >
                            User berhasil diaktifkan
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            User sekarang dapat kembali menggunakan akun.
                        </p>


                    @elseif (session('success_action') === 'deactivate')

                        <h2
                            class="
                                text-lg
                                font-bold
                                leading-7
                                text-gray-900
                                sm:text-xl
                            "
                        >
                            User berhasil dinonaktifkan
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            User tidak dapat menggunakan akun sampai diaktifkan kembali.
                        </p>


                    @elseif (session('success_action') === 'reset-password')

                        <h2
                            class="
                                text-lg
                                font-bold
                                leading-7
                                text-gray-900
                                sm:text-xl
                            "
                        >
                            Password berhasil direset
                        </h2>

                        <p class="mt-2 text-sm text-gray-500">
                            Password sementara telah dibuat untuk user ini.
                        </p>


                        @if (session('temporary_password'))

                            <div class="mt-5 text-left">

                                <label
                                    class="
                                        mb-2 block
                                        text-xs font-semibold
                                        uppercase tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Password sementara
                                </label>

                                <div
                                    class="
                                    relative
                                    flex items-center
                                    gap-2
                                    rounded-lg
                                    border border-orange-200
                                    bg-orange-50
                                    px-3 py-2
                                    ">

                                    <code
                                        id="temporary-password"
                                        class="
                                            min-w-0
                                            flex-1
                                            break-all
                                            font-mono
                                            text-sm
                                            font-semibold
                                            text-orange-700
                                        "
                                    >
                                        {{ session('temporary_password') }}
                                    </code>

                                    <button
                                        type="button"
                                        id="copy-temporary-password"
                                        title="Salin password"
                                        aria-label="Salin password"
                                        class="
                                            inline-flex
                                            h-9 w-9
                                            shrink-0
                                            items-center
                                            justify-center
                                            rounded-lg
                                            text-orange-600
                                            transition
                                            hover:bg-orange-100
                                            hover:text-orange-700
                                            focus:outline-none
                                            focus:ring-2
                                            focus:ring-orange-500/30
                                        "
                                    >

                                        {{-- Copy icon --}}
                                        <svg
                                            id="copy-password-icon"
                                            class="h-5 w-5"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="1.8"
                                            viewBox="0 0 24 24"
                                        >
                                            <rect
                                                x="9"
                                                y="9"
                                                width="10"
                                                height="10"
                                                rx="2"
                                            />

                                            <path
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                                d="M15 9V7a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2"
                                            />
                                        </svg>

                                    </button>

                                </div>

                                <p class="mt-2 text-xs text-gray-500">
                                    Password ini harus segera diberikan kepada user.
                                </p>

                            </div>

                        @endif

                    @endif

                </div>


                {{-- Footer --}}
                <div
                    class="
                        flex
                        items-center
                        justify-center
                        border-t border-gray-100
                        px-5 py-4
                    "
                >

                    <a
                        href="{{ route('users.index') }}"
                        class="
                            inline-flex
                            min-w-[160px]
                            items-center
                            justify-center
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

                        Kembali ke Users

                    </a>

                </div>

            </div>

        </div>

    @endif

@endsection