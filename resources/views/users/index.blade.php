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
                class="
                    rounded-md
                    bg-indigo-600
                    px-4
                    py-2
                    text-sm
                    font-medium
                    text-white
                    transition
                    hover:bg-indigo-700
                "
            >
                + Tambah User
            </a>

        @endif

    </div>


    {{-- Flash Success --}}
    @if (
        session('success')
        && session('success_type') !== 'reset-password'
    )

        <div
            class="
                mb-6
                rounded-lg
                border
                border-green-200
                bg-green-50
                px-4
                py-3
                text-sm
                text-green-800
            "
        >
            {{ session('success') }}
        </div>

    @endif


    {{-- Flash Error --}}
    @if (session('error'))

        <div
            class="
                mb-6
                rounded-lg
                border
                border-red-200
                bg-red-50
                px-4
                py-3
                text-sm
                text-red-800
            "
        >
            {{ session('error') }}
        </div>

    @endif


    {{-- =====================================================
        DAFTAR USER
    ====================================================== --}}

    <x-admin.card
        :padding="false"
        class="overflow-hidden"
    >

         {{-- =====================================================
        SEARCH & FILTER
        ====================================================== --}}
        <x-admin.card class="mb-6">
            
            <form
                method="GET"
                action="{{ route('users.index') }}"
                class="space-y-4">

                {{-- Filter Fields --}}
                <div
                 class="
                    grid
                    grid-cols-1
                    gap-4
                    md:grid-cols-2

                    lg:flex
                    lg:flex-nowrap
                    lg:items-end
                "
                >
                {{-- Pencarian --}}
                    <div class="min-w-0 md:col-span-2 lg:flex-[2]">
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
                            name="search"
                            id="search"
                            value="{{ request('search') }}"
                            placeholder="Cari nama, NIP, atau Role..."
                            class="
                                block
                                w-full
                                rounded-lg
                                border
                                border-gray-300
                                bg-white
                                px-3
                                py-2.5
                                pr-10
                                text-sm
                                text-gray-900
                                placeholder:text-gray-400
                                focus:border-blue-500
                                focus:ring-blue-500
                            "
                        >
                    </div>
                    
                    {{-- Role--}}
                    <div class="min-w-0 lg:flex-1">
                        <label
                            for="role"
                            class="
                                mb-1.5
                                block
                                text-sm
                                font-medium
                                text-gray-700
                            ">
                            Role
                        </label>

                        <select
                            name="role"
                            id="role"
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
                            <option value="">Semua Role</option>
                            @foreach ($roles as $role)
                                <option
                                    value="{{ $role->id }}"
                                    {{ request('role') == $role->id ? 'selected' : '' }}
                                >
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Jabatan--}}
                    <div class="min-w-0 lg:flex-1">
                        <label
                            for="position"
                            class="
                                mb-1.5
                                block
                                text-sm
                                font-medium
                                text-gray-700
                            ">
                            Jabatan
                        </label>

                        <select
                            name="position"
                            id="position"
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
                            <option value="">Semua Jabatan</option>
                            @foreach ($positions as $position)
                                <option
                                    value="{{ $position->id }}"
                                    {{ request('position') == $position->id ? 'selected' : '' }}
                                >
                                    {{ $position->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tombol Search --}}
                    <div class="flex w-full lg:w-[42px] lg:shrink-0">

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
                    || request('role')
                    || request('position')
                    )

                    <div>

                        <a
                            href="{{ route('users.index') }}"
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
        <div class="overflow-x-auto">

            <x-admin.table>

                {{-- Header --}}
                <thead class="bg-gray-100 text-xs uppercase text-gray-600">

                    <tr>

                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            No
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Nama
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            NIP
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Email
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Role
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Jabatan
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-left
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Status
                        </th>


                        <th
                            scope="col"
                            class="
                                whitespace-nowrap
                                px-6
                                py-3
                                text-right
                                text-xs
                                font-medium
                                uppercase
                                tracking-wider
                                text-gray-500
                            "
                        >
                            Aksi
                        </th>

                    </tr>

                </thead>


                {{-- Body --}}
                <tbody class="divide-y divide-gray-200">

                    @forelse ($users as $user)

                        <tr
                            class="
                                odd:bg-white
                                even:bg-gray-100/70
                                transition-colors
                                duration-150
                                hover:bg-blue-50
                            "
                        >

                            {{-- Nomor --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    text-gray-500
                                "
                            >
                                {{ $users->firstItem() + $loop->index }}
                            </td>


                            {{-- Nama --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    text-gray-900
                                "
                                >
                                <a href="{{ route('users.show', $user) }}" class="hover:text-indigo-600">
                                    {{ $user->name }}
                                </a>
                            </td>


                            {{-- NIP --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    font-medium
                                    text-gray-900
                                "
                                >
                                {{ $user->nip ?? '-' }}
                            </td>


                            {{-- Email --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    text-gray-600
                                "
                            >
                                {{ $user->email }}
                            </td>


                            {{-- Role --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    text-gray-600
                                "
                            >
                                {{ $user->role?->name ?? '-' }}
                            </td>


                            {{-- Jabatan --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-6
                                    py-4
                                    text-sm
                                    text-gray-600
                                "
                            >
                                {{ $user->position?->name ?? '-' }}
                            </td>


                            {{-- Status --}}
                            <td class="whitespace-nowrap px-6 py-4">

                                @if ($user->is_active)

                                    <span
                                        class="
                                            rounded-full
                                            bg-green-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-green-800
                                        "
                                    >
                                        Aktif
                                    </span>

                                @else

                                    <span
                                        class="
                                            rounded-full
                                            bg-red-100
                                            px-2.5
                                            py-1
                                            text-xs
                                            font-medium
                                            text-red-800
                                        "
                                    >
                                        Tidak Aktif
                                    </span>

                                @endif

                            </td>


                            {{-- Aksi --}}
                            <td
                                class="
                                    whitespace-nowrap
                                    px-4
                                    py-4
                                    text-right
                                "
                            >

                                <div
                                    class="
                                        flex
                                        items-center
                                        justify-end
                                        gap-1.5
                                    "
                                >


                                    {{-- LIHAT --}}
                                    @if (auth()->user()->hasPermission('users.view'))

                                        <a
                                            href="{{ route('users.show', $user) }}"
                                            aria-label="Lihat {{ $user->name }}"
                                            title="Lihat"
                                            class="
                                                inline-flex
                                                h-9
                                                w-9
                                                items-center
                                                justify-center
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


                                    {{-- EDIT --}}
                                    @if (auth()->user()->hasPermission('users.update'))

                                        <a
                                            href="{{ route('users.edit', $user) }}"
                                            aria-label="Edit {{ $user->name }}"
                                            title="Edit"
                                            class="
                                                inline-flex
                                                h-9
                                                w-9
                                                items-center
                                                justify-center
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


                                    {{-- AKTIFKAN / NONAKTIFKAN --}}
                                    @if ($user->id !== auth()->id())

                                        @if ($user->is_active)

                                            @if (
                                                auth()->user()->hasPermission(
                                                    'users.deactivate'
                                                )
                                            )

                                                <form
                                                    method="POST"
                                                    action="{{ route('users.deactivate', $user) }}"
                                                    class="inline"
                                                    data-confirm="Apakah Anda yakin akan menonaktifkan user ini?"
                                                    data-confirm-action="deactivate"
                                                    data-confirm-button="Nonaktifkan"
                                                >
                                                    @csrf
                                                    @method('PATCH')

                                                    <button
                                                        type="submit"
                                                        aria-label="Nonaktifkan {{ $user->name }}"
                                                        title="Nonaktifkan"
                                                        class="
                                                            inline-flex
                                                            h-9
                                                            w-9
                                                            items-center
                                                            justify-center
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
                                                            class="h-5 w-5 shrink-0"
                                                            fill="none"
                                                            stroke="currentColor"
                                                            stroke-width="1.8"
                                                            viewBox="0 0 24 24"
                                                            >
                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M6 6l12 12"
                                                            />

                                                            <path
                                                                stroke-linecap="round"
                                                                stroke-linejoin="round"
                                                                d="M18 6 6 18"
                                                            />
                                                        </svg>

                                                    </button>

                                                </form>

                                            @endif

                                        @else

                                            @if (
                                                auth()->user()->hasPermission(
                                                    'users.activate'
                                                )
                                            )

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
                                                            inline-flex
                                                            h-9
                                                            w-9
                                                            items-center
                                                            justify-center
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


                                    {{-- RESET PASSWORD --}}
                                    @if (
                                        $user->id !== auth()->id()
                                        && auth()->user()->hasPermission(
                                            'users.reset-password'
                                        )
                                    )

                                        <form
                                            method="POST"
                                            action="{{ route('users.reset-password', $user) }}"
                                            class="inline"
                                            data-confirm="Apakah Anda yakin akan mereset password user ini?"
                                            data-confirm-action="reset-password"
                                            data-confirm-button="Reset Password"
                                        >
                                            @csrf
                                            @method('PATCH')

                                            <button
                                                type="submit"
                                                aria-label="Reset password {{ $user->name }}"
                                                title="Reset Password"
                                                class="
                                                    inline-flex
                                                    h-9
                                                    w-9
                                                    items-center
                                                    justify-center
                                                    rounded-lg
                                                    text-orange-600
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
                                class="
                                    px-6
                                    py-10
                                    text-center
                                    text-sm
                                    text-gray-500
                                "
                            >
                                Belum ada user.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </x-admin.table>

        </div>


        {{-- Pagination --}}
        <x-admin.pagination
            :paginator="$users"
            label="pengguna"
        />

    </x-admin.card>



    {{-- =====================================================
        SUCCESS MODAL
        HANYA SATU MODAL
    ====================================================== --}}

    @if (session('success') && session('success_type') === 'reset-password')

        <div
            id="user-success-modal"
            data-success-action="{{ session('success_type') }}"
            class="
                fixed
                inset-0
                z-[100]
                flex
                items-center
                justify-center
                p-4
            "
            aria-hidden="false"
            role="dialog"
            aria-modal="true"
        >

            {{-- Overlay --}}
            <div
                id="user-success-overlay"
                class="
                    absolute
                    inset-0
                    bg-gray-900/40
                    backdrop-blur-[1px]
                "
            ></div>


            {{-- Modal --}}
            <div
                class="
                    relative
                    z-10
                    w-full
                    max-w-md
                    overflow-hidden
                    rounded-2xl
                    border
                    border-gray-200
                    bg-white
                    shadow-2xl
                "
            >

                {{-- Close --}}
                <div
                    class="
                        absolute
                        right-3
                        top-3
                    "
                >

                    <button
                        type="button"
                        id="user-success-close"
                        onclick="window.closeTemporaryPasswordModal(event)"
                        title="Tutup"
                        aria-label="Tutup"
                        class="
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
                <div
                    class="
                        flex
                        justify-center
                        px-5
                        pt-8
                    "
                >

                    <div
                        id="user-success-icon"
                        class="
                            flex
                            h-16
                            w-16
                            items-center
                            justify-center
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
                <div
                    class="
                        px-5
                        pb-6
                        pt-5
                        text-center
                    "
                >

                    {{-- Activate --}}
                    @if (session('success_type') === 'activate')

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

                        <p
                            class="
                                mt-2
                                text-sm
                                text-gray-500
                            "
                        >
                            User sekarang dapat kembali menggunakan akun.
                        </p>


                    {{-- Deactivate --}}
                    @elseif (session('success_type') === 'deactivate')

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

                        <p
                            class="
                                mt-2
                                text-sm
                                text-gray-500
                            "
                        >
                            User tidak dapat menggunakan akun sampai diaktifkan kembali.
                        </p>


                    {{-- RESET PASSWORD --}}
                    @elseif (session('success_type') === 'reset-password')

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

                        <p
                            class="
                                mt-2
                                text-sm
                                leading-6
                                text-gray-500
                            "
                        >
                            Password sementara telah dibuat. Simpan password
                            berikut sebelum menutup halaman ini.
                        </p>


                        @if (session('temporary_password'))

                            <div
                                class="
                                    mt-5
                                    text-left
                                "
                            >

                                <label
                                    class="
                                        mb-2
                                        block
                                        text-xs
                                        font-semibold
                                        uppercase
                                        tracking-wide
                                        text-gray-500
                                    "
                                >
                                    Password sementara
                                </label>


                                <div
                                    class="
                                        relative
                                        flex
                                        items-center
                                        gap-2
                                        rounded-xl
                                        border
                                        border-orange-200
                                        bg-orange-50
                                        px-3
                                        py-3
                                    "
                                >

                                    <code
                                        id="temporary-password"
                                        class="
                                            min-w-0
                                            flex-1
                                            break-all
                                            font-mono
                                            text-base
                                            font-bold
                                            text-orange-700
                                        "
                                    >
                                        {{ session('temporary_password') }}
                                    </code>


                                    {{-- Copy --}}
                                    <button
                                        type="button"
                                        id="copy-temporary-password"
                                        title="Salin password"
                                        aria-label="Salin password"
                                        class="
                                            inline-flex
                                            h-10
                                            shrink-0
                                            items-center
                                            justify-center
                                            gap-2
                                            rounded-lg
                                            border
                                            border-orange-200
                                            bg-white
                                            px-3
                                            text-sm
                                            font-medium
                                            text-orange-700
                                            shadow-sm
                                            transition
                                            hover:bg-orange-100
                                            focus:outline-none
                                            focus:ring-2
                                            focus:ring-orange-500/30
                                        "
                                    >

                                        <svg
                                            id="copy-password-icon"
                                            class="h-4 w-4"
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

                                        <span
                                            id="copy-password-text"
                                        >
                                            Salin
                                        </span>

                                    </button>

                                </div>


                                {{-- Warning --}}
                                <div
                                    class="
                                        mt-4
                                        rounded-lg
                                        border
                                        border-yellow-200
                                        bg-yellow-50
                                        px-3
                                        py-3
                                    "
                                >

                                    <p
                                        class="
                                            text-xs
                                            leading-5
                                            text-yellow-800
                                        "
                                    >
                                        Password ini hanya ditampilkan sekali.
                                        Pastikan Anda sudah menyimpannya dan
                                        memberikannya kepada user terkait.
                                    </p>

                                </div>

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
                        border-t
                        border-gray-100
                        px-5
                        py-4
                    "
                >

                    <button
                        type="button"
                        id="user-success-close-button"
                        onclick="window.closeTemporaryPasswordModal(event)"
                        class="
                            inline-flex
                            min-w-[190px]
                            items-center
                            justify-center
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
                        @if (
                            session('success_type')
                            === 'reset-password'
                        )
                            Saya Sudah Menyimpan Password
                        @else
                            Tutup
                        @endif
                    </button>

                </div>

            </div>

        </div>

    @endif


    {{-- =====================================================
        FINAL RESET PASSWORD SUCCESS MODAL
    ====================================================== --}}

    @if (session('success_type') === 'reset-password')

        <div
            id="reset-password-final-modal"
            class="fixed inset-0 z-[110] hidden p-4"
            aria-hidden="true"
        >

            {{-- Overlay --}}
            <div
                class="absolute inset-0 bg-gray-900/40 backdrop-blur-[1px]"
            ></div>

            <div
                class="relative z-10 flex min-h-full items-center justify-center"
            >

                <div
                    class="w-full max-w-md overflow-hidden rounded-2xl border border-gray-200 bg-white shadow-2xl"
                    role="dialog"
                    aria-modal="true"
                    aria-labelledby="reset-password-final-title"
                >

                    {{-- Header --}}
                    <div class="flex justify-end px-4 pt-4">

                        <button
                            type="button"
                            id="reset-password-final-close"
                            onclick="window.closeFinalResetPasswordModal(event)"
                            title="Tutup"
                            aria-label="Tutup"
                            class="inline-flex h-9 w-9 items-center justify-center rounded-lg text-gray-400 transition hover:bg-gray-100 hover:text-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500/20"
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
                    <div class="flex justify-center pt-1">

                        <div
                            class="flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-50 text-blue-600"
                        >
                            <svg
                                class="h-8 w-8"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="2"
                                viewBox="0 0 24 24"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="m5 12 4 4L19 7"
                                />
                            </svg>
                        </div>

                    </div>


                    {{-- Content --}}
                    <div class="px-6 pb-6 pt-5 text-center">

                        <h2
                            id="reset-password-final-title"
                            class="text-xl font-bold text-gray-900"
                        >
                            Password berhasil direset.
                        </h2>

                    </div>


                    {{-- Footer --}}
                    <div
                        class="flex justify-center border-t border-gray-100 bg-gray-50 px-5 py-4"
                    >

                        <button
                            type="button"
                            id="reset-password-final-ok"
                            onclick="window.closeFinalResetPasswordModal(event)"
                            class="inline-flex min-w-[120px] items-center justify-center rounded-lg bg-blue-600 px-5 py-2.5 text-sm font-semibold text-white shadow-sm transition hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500/30"
                        >
                            OK
                        </button>

                    </div>

                </div>

            </div>

        </div>

    @endif


@endsection


@push('scripts')

<script>

/*
|--------------------------------------------------------------------------
| Global Modal Close Handlers
| Menangani tombol X, tombol simpan password, dan tombol final OK.
| Dibuat global agar tidak bentrok dengan script modal lain.
|--------------------------------------------------------------------------
*/
window.closeTemporaryPasswordModal = function (event) {
    event?.preventDefault();
    event?.stopPropagation();

    const modal = document.getElementById('user-success-modal');

    if (! modal) {
        return;
    }

    const successAction = modal.dataset.successAction;

    modal.remove();

    if (successAction === 'reset-password') {
        window.setTimeout(function () {
            const finalModal = document.getElementById(
                'reset-password-final-modal'
            );

            if (finalModal) {
                finalModal.classList.remove('hidden');
                finalModal.setAttribute('aria-hidden', 'false');
                document.body.classList.add('overflow-hidden');
            } else {
                document.body.classList.remove('overflow-hidden');
            }
        }, 100);

        return;
    }

    document.body.classList.remove('overflow-hidden');
};

window.closeFinalResetPasswordModal = function (event) {
    event?.preventDefault();
    event?.stopPropagation();

    const finalModal = document.getElementById(
        'reset-password-final-modal'
    );

    if (! finalModal) {
        return;
    }

    finalModal.classList.add('hidden');
    finalModal.setAttribute('aria-hidden', 'true');
    document.body.classList.remove('overflow-hidden');
};

/*
| ESC memakai capture=true supaya tidak kalah oleh listener global lain.
*/
document.addEventListener('keydown', function (event) {
    if (event.key !== 'Escape') {
        return;
    }

    const temporaryModal = document.getElementById(
        'user-success-modal'
    );

    if (temporaryModal) {
        event.preventDefault();
        event.stopImmediatePropagation();
        window.closeTemporaryPasswordModal(event);
        return;
    }

    const finalModal = document.getElementById(
        'reset-password-final-modal'
    );

    if (
        finalModal
        && ! finalModal.classList.contains('hidden')
    ) {
        event.preventDefault();
        event.stopImmediatePropagation();
        window.closeFinalResetPasswordModal(event);
    }
}, true);


document.addEventListener('DOMContentLoaded', function () {

    /*
    |--------------------------------------------------------------------------
    | User Success Modal
    |--------------------------------------------------------------------------
    */

    const modal = document.getElementById('user-success-modal');

    if (! modal) {
        return;
    }

    const closeButton = document.getElementById(
        'user-success-close'
    );

    const closeFooterButton = document.getElementById(
        'user-success-close-button'
    );

    const overlay = document.getElementById(
        'user-success-overlay'
    );

    const successAction = modal.dataset.successAction;

    const successIcon = document.getElementById(
        'user-success-icon'
    );

    const successIcons = document.querySelectorAll(
        '#user-success-icon [data-success-icon]'
    );


    /*
    |--------------------------------------------------------------------------
    | Show Icon
    |--------------------------------------------------------------------------
    */

    successIcons.forEach(function (icon) {
        icon.classList.add('hidden');
    });

    const selectedIcon = document.querySelector(
        '[data-success-icon="' + successAction + '"]'
    );

    if (selectedIcon) {
        selectedIcon.classList.remove('hidden');
    }


    /*
    |--------------------------------------------------------------------------
    | Icon Color
    |--------------------------------------------------------------------------
    */

    if (successAction === 'activate') {

        successIcon.style.backgroundColor = '#ecfdf5';
        successIcon.style.color = '#059669';

    } else if (successAction === 'deactivate') {

        successIcon.style.backgroundColor = '#fef2f2';
        successIcon.style.color = '#dc2626';

    } else if (successAction === 'reset-password') {

        successIcon.style.backgroundColor = '#fff7ed';
        successIcon.style.color = '#ea580c';

    }


    /*
    |--------------------------------------------------------------------------
    | Close Modal
    |--------------------------------------------------------------------------
    */

    let modalClosed = false;


    function openFinalResetModal() {

        const finalModal = document.getElementById(
            'reset-password-final-modal'
        );

        if (! finalModal) {
            document.body.classList.remove('overflow-hidden');
            return;
        }

        finalModal.classList.remove('hidden');

        finalModal.setAttribute(
            'aria-hidden',
            'false'
        );
    }


    function closeModal(event) {

        if (modalClosed) {
            return;
        }

        modalClosed = true;
        window.closeTemporaryPasswordModal(event);
    }


    document.body.classList.add(
        'overflow-hidden'
    );


    closeButton?.addEventListener(
        'click',
        closeModal
    );


    closeFooterButton?.addEventListener(
        'click',
        closeModal
    );


    overlay?.addEventListener(
        'click',
        closeModal
    );


    /*
    |--------------------------------------------------------------------------
    | ESC Keyboard
    |--------------------------------------------------------------------------
    */

    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
                && ! modalClosed
            ) {
                closeModal();
            }

        }
    );


    /*
    |--------------------------------------------------------------------------
    | Copy Temporary Password
    |--------------------------------------------------------------------------
    */

    const copyButton = document.getElementById(
        'copy-temporary-password'
    );

    const passwordElement = document.getElementById(
        'temporary-password'
    );

    const copyText = document.getElementById(
        'copy-password-text'
    );

    const copyIcon = document.getElementById(
        'copy-password-icon'
    );


    if (
        copyButton
        && passwordElement
    ) {

        copyButton.addEventListener(
            'click',
            async function () {

                const password = passwordElement
                    .textContent
                    .trim();


                if (! password) {
                    return;
                }


                let copied = false;


                /*
                |--------------------------------------------------------------------------
                | Modern Clipboard API
                |--------------------------------------------------------------------------
                */

                if (
                    navigator.clipboard
                    && window.isSecureContext
                ) {

                    try {

                        await navigator.clipboard.writeText(
                            password
                        );

                        copied = true;

                    } catch (error) {

                        copied = false;

                    }

                }


                /*
                |--------------------------------------------------------------------------
                | Fallback
                |--------------------------------------------------------------------------
                */

                if (! copied) {

                    const textarea =
                        document.createElement(
                            'textarea'
                        );

                    textarea.value = password;

                    textarea.setAttribute(
                        'readonly',
                        ''
                    );

                    textarea.style.position = 'fixed';

                    textarea.style.left = '-9999px';

                    textarea.style.opacity = '0';


                    document.body.appendChild(
                        textarea
                    );


                    textarea.focus();

                    textarea.select();

                    textarea.setSelectionRange(
                        0,
                        textarea.value.length
                    );


                    try {

                        copied =
                            document.execCommand(
                                'copy'
                            );

                    } catch (error) {

                        copied = false;

                    }


                    textarea.remove();

                }


                /*
                |--------------------------------------------------------------------------
                | Success UI
                |--------------------------------------------------------------------------
                */

                if (copied) {

                    copyText.textContent =
                        'Tersalin';


                    copyButton.classList.remove(
                        'border-orange-200',
                        'bg-white',
                        'text-orange-700'
                    );


                    copyButton.classList.add(
                        'border-green-200',
                        'bg-green-50',
                        'text-green-700'
                    );


                    if (copyIcon) {

                        copyIcon.innerHTML = `
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="m5 12 4 4L19 7"
                            />
                        `;

                    }


                    setTimeout(
                        function () {

                            copyText.textContent =
                                'Salin';


                            copyButton.classList.remove(
                                'border-green-200',
                                'bg-green-50',
                                'text-green-700'
                            );


                            copyButton.classList.add(
                                'border-orange-200',
                                'bg-white',
                                'text-orange-700'
                            );


                            if (copyIcon) {

                                copyIcon.innerHTML = `
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
                                        d="M15 9V7a2 2 0 0 0-2-2H7a2 2 0 0 0 2 2h2"
                                    />
                                `;

                            }

                        },
                        1800
                    );

                } else {

                    alert(
                        'Password gagal disalin. Silakan salin secara manual.'
                    );

                }

            }
        );

    }


    /*
    |--------------------------------------------------------------------------
    | Final Reset Password Modal
    |--------------------------------------------------------------------------
    */

    const finalModal = document.getElementById(
        'reset-password-final-modal'
    );

    const finalCloseButton = document.getElementById(
        'reset-password-final-close'
    );

    const finalOkButton = document.getElementById(
        'reset-password-final-ok'
    );


    function closeFinalModal(event) {
        window.closeFinalResetPasswordModal(event);
    }


    finalCloseButton?.addEventListener(
        'click',
        closeFinalModal
    );


    finalOkButton?.addEventListener(
        'click',
        closeFinalModal
    );


    document.addEventListener(
        'keydown',
        function (event) {

            if (
                event.key === 'Escape'
                && finalModal
                && ! finalModal.classList.contains('hidden')
            ) {
                closeFinalModal();
            }

        }
    );

});

</script>

@endpush