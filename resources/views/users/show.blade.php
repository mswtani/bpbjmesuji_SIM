@extends('layouts.admin')

@section('title', 'Detail User')

@section('content')

    <div class="mx-auto max-w-5xl space-y-6">

        {{-- =====================================================
             HEADER
        ====================================================== --}}

        <div class="flex items-start justify-between gap-4">

            <div class="min-w-0">

                <h1 class="text-2xl font-bold tracking-tight text-gray-900 sm:text-3xl">
                    Detail User
                </h1>

                <p class="mt-1.5 text-sm text-gray-500">
                    Informasi lengkap pengguna.
                </p>

            </div>


            {{-- Edit --}}
            @if (auth()->user()->hasPermission('users.update'))

                <a
                    href="{{ route('users.edit', $user) }}"
                    title="Edit user"
                    aria-label="Edit user"
                    class="
                        inline-flex h-10 w-10 shrink-0
                        items-center justify-center
                        rounded-lg
                        text-amber-500
                        transition
                        hover:bg-amber-50
                        hover:text-amber-700
                        focus:outline-none
                        focus:ring-2
                        focus:ring-amber-500/30
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
                            d="M12 20h9"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5Z"
                        />
                    </svg>

                </a>

            @endif

        </div>


        {{-- =====================================================
             USER PROFILE CARD
        ====================================================== --}}

        <x-admin.card :padding="false">

            {{-- Profile Header --}}
            <div
                class="
                    flex flex-col gap-4
                    border-b border-gray-100
                    px-5 py-5
                    sm:flex-row sm:items-center sm:px-6
                "
            >

                {{-- Avatar --}}
                <div
                    class="
                        flex h-14 w-14 shrink-0
                        items-center justify-center
                        rounded-2xl
                        bg-amber-50
                        text-amber-600
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
                            d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"
                        />

                        <circle
                            cx="9"
                            cy="7"
                            r="4"
                        />

                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 8v6M16 11h6"
                        />
                    </svg>

                </div>


                {{-- Name --}}
                <div class="min-w-0">

                    <h2 class="truncate text-lg font-bold text-gray-900 sm:text-xl">
                        {{ $user->name }}
                    </h2>

                    <p class="mt-0.5 truncate text-sm text-gray-500">
                        {{ $user->email }}
                    </p>

                </div>


                {{-- Status --}}
                <div class="sm:ml-auto">

                    @if ($user->is_active)

                        <span
                            class="
                                inline-flex items-center gap-1.5
                                rounded-full
                                bg-green-100
                                px-2.5 py-1
                                text-xs font-semibold
                                text-green-800
                            "
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                            Aktif
                        </span>

                    @else

                        <span
                            class="
                                inline-flex items-center gap-1.5
                                rounded-full
                                bg-red-100
                                px-2.5 py-1
                                text-xs font-semibold
                                text-red-800
                            "
                        >
                            <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                            Tidak Aktif
                        </span>

                    @endif

                </div>

            </div>


            {{-- =================================================
                 INFORMATION
            ================================================== --}}

            <div class="px-5 py-2 sm:px-6">

                <dl class="divide-y divide-gray-100">

                    {{-- NIP --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            NIP
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm font-medium
                                text-gray-900
                                sm:col-span-2
                            "
                        >
                            {{ $user->nip ?: '-' }}
                        </dd>

                    </div>


                    {{-- Nama --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Nama Lengkap
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm font-medium
                                text-gray-900
                                sm:col-span-2
                            "
                        >
                            {{ $user->name }}
                        </dd>

                    </div>


                    {{-- Email --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Email
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >
                            {{ $user->email }}
                        </dd>

                    </div>


                    {{-- Nomor HP --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Nomor HP
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >
                            {{ $user->phone ?: '-' }}
                        </dd>

                    </div>


                    {{-- Role --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Role
                        </dt>

                        <dd class="sm:col-span-2">

                            @if ($user->role)

                                <span
                                    class="
                                        inline-flex
                                        rounded-full
                                        bg-indigo-100
                                        px-2.5 py-1
                                        text-xs font-semibold
                                        text-indigo-700
                                    "
                                >
                                    {{ $user->role->name }}
                                </span>

                            @else

                                <span class="text-sm text-gray-500">
                                    -
                                </span>

                            @endif

                        </dd>

                    </div>


                    {{-- Jabatan --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Jabatan dalam PBJ
                        </dt>

                        <dd
                            class="
                                break-words
                                text-sm
                                text-gray-700
                                sm:col-span-2
                            "
                        >
                            {{ $user->position?->name ?? '-' }}
                        </dd>

                    </div>


                    {{-- Status --}}
                    <div
                        class="
                            grid grid-cols-1 gap-1
                            py-4
                            sm:grid-cols-3 sm:gap-6
                        "
                    >

                        <dt class="text-sm font-medium text-gray-500">
                            Status
                        </dt>

                        <dd class="sm:col-span-2">

                            @if ($user->is_active)

                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full
                                        bg-green-100
                                        px-2.5 py-1
                                        text-xs font-semibold
                                        text-green-800
                                    "
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-green-500"></span>
                                    Aktif
                                </span>

                            @else

                                <span
                                    class="
                                        inline-flex items-center gap-1.5
                                        rounded-full
                                        bg-red-100
                                        px-2.5 py-1
                                        text-xs font-semibold
                                        text-red-800
                                    "
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    Tidak Aktif
                                </span>

                            @endif

                        </dd>

                    </div>

                </dl>

            </div>

        </x-admin.card>


        {{-- =====================================================
             BACK
        ====================================================== --}}

        <div>

            <a
                href="{{ route('users.index') }}"
                class="
                    inline-flex
                    items-center
                    gap-2
                    rounded-lg
                    border border-gray-200
                    bg-red-500
                    px-4 py-2.5
                    text-sm font-medium
                    text-white
                    shadow-sm
                    transition
                    hover:border-gray-300
                    hover:bg-gray-100
                    hover:text-gray-900
                    focus:outline-none
                    focus:ring-2
                    focus:ring-gray-500/20
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

                <span>
                    Kembali ke daftar user
                </span>

            </a>

        </div>

    </div>

@endsection