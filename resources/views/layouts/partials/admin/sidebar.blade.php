<aside
    id="admin-sidebar"
    class="fixed inset-y-0 left-0 z-50 flex w-64 -translate-x-full flex-col border-r border-gray-200 bg-white transition-all duration-300 lg:translate-x-0"
>

    {{-- =========================================================
         BRAND
    ========================================================== --}}

    <div
        class="
            flex h-[72px] shrink-0
            items-center
            justify-between
            border-b border-gray-200
            px-3
        ">

        {{-- BRAND --}}
        <a
            href="{{ route('dashboard') }}"
            class="flex min-w-0 items-center gap-3"
            title="SIM BPBJ Kabupaten Mesuji"
        >

            <img
                src="{{ asset('assets/images/logo-sim-bpbj.png') }}"
                alt="SIM BPBJ Kabupaten Mesuji"
                class="h-11 w-11 shrink-0 object-contain"
            >

            <div
                class="admin-sidebar-brand min-w-0"
            >

                <div class="truncate text-base font-bold leading-tight text-gray-900">
                    SIM BPBJ
                </div>

                <div class="truncate text-xs font-medium text-gray-500">
                    Kabupaten Mesuji
                </div>

            </div>

        </a>


        {{-- CLOSE MOBILE SIDEBAR --}}
        <button
            type="button"
            id="admin-sidebar-close"
            aria-label="Tutup menu"
            title="Tutup menu"
            class="
                inline-flex h-10 w-10
                shrink-0
                items-center justify-center
                rounded-lg
                text-gray-500
                bg-transparent
                transition
                hover:bg-gray-100
                hover:text-gray-900
                focus:outline-none
                focus:ring-2
                focus:ring-blue-500/30
                lg:hidden
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
                    d="M6 6l12 12M18 6 6 18"
                />
            </svg>

        </button>

    </div>


    {{-- =========================================================
         NAVIGATION
    ========================================================== --}}

    <nav class="flex-1 overflow-y-auto px-3 py-5">

        {{-- Dashboard --}}

        <a
            href="{{ route('dashboard') }}"
            class="
                mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                text-sm font-medium transition
                {{ request()->routeIs('dashboard')
                    ? 'bg-blue-50 text-blue-700'
                    : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' }}
            "
            title="Dashboard"
        >

            <svg
                class="h-5 w-5 shrink-0 text-blue-500"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                viewBox="0 0 24 24"
            >
                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M3 10.5 12 3l9 7.5M5 9v11h14V9M9 20v-6h6v6"
                />
            </svg>

            <span class="admin-sidebar-label whitespace-nowrap">
                Dashboard
            </span>

        </a>


        {{-- =====================================================
             KONTEN
        ====================================================== --}}

        @if (auth()->user()?->hasPermission('posts.view'))

            <a
                href="{{ route('posts.index') }}"
                class="
                    mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                    text-sm font-medium transition
                    {{ request()->routeIs('posts.*')
                        ? 'bg-blue-50 text-blue-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-blue-600' }}
                "
                title="Konten"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-indigo-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M6 3h9l3 3v15H6V3Z"
                    />

                    <path
                        stroke-linecap="round"
                        d="M14 3v4h4M9 12h6M9 16h6"
                    />
                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Konten
                </span>

            </a>

        @endif

        
        {{-- =====================================================
             HELPDESK
        ====================================================== --}}

        @if (auth()->user()?->hasPermission('helpdesk.view'))

            <a
                href="{{ route('helpdesk.admin.index') }}"
                class="
                    mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                    text-sm font-medium transition
                    {{ request()->routeIs('helpdesk.*')
                        ? 'bg-emerald-50 text-emerald-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-emerald-600' }}
                "
                title="Helpdesk"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-emerald-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 12a8 8 0 0 1 16 0v5a2 2 0 0 1-2 2h-3"
                    />

                    <path
                        stroke-linecap="round"
                        d="M4 14H3a2 2 0 0 0 0 4h1v-4ZM20 14h1a2 2 0 0 1 0 4h-1v-4Z"
                    />

                    <path
                        stroke-linecap="round"
                        d="M12 19h3"
                    />
                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Helpdesk
                </span>

            </a>

        @endif


        {{-- =====================================================
             MANAJEMEN PENGGUNA
        ====================================================== --}}

        @if (auth()->user()?->hasPermission('users.view'))

            <a
                href="{{ route('users.index') }}"
                class="
                    mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                    text-sm font-medium transition
                    {{ request()->routeIs('users.*')
                        ? 'bg-amber-50 text-amber-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-amber-600' }}
                "
                title="Pengguna"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-amber-500"
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
                        d="M22 21v-2a4 4 0 0 0-3-3.87M16 3.13a4 4 0 0 1 0 7.75"
                    />
                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Pengguna
                </span>

            </a>

        @endif


        {{-- =====================================================
             ROLE & PERMISSION
        ====================================================== --}}

        @if (auth()->user()?->hasPermission('roles.view'))

            <a
                href="{{ route('roles.index') }}"
                class="
                    mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                    text-sm font-medium transition
                    {{ request()->routeIs('roles.*')
                        ? 'bg-violet-50 text-violet-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-violet-600' }}
                "
                title="Role & Permission"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-violet-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M12 3l8 4v5c0 5-3.5 8-8 9-4.5-1-8-4-8-9V7l8-4Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="m9 12 2 2 4-4"
                    />
                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Role & Permission
                </span>

            </a>

        @endif

        {{-- =====================================================
            JENIS REGULASI
        ===================================================== --}}

        {{-- @if (auth()->user()?->hasPermission('regulation-types.view'))

            <a
                href="{{ route('regulation-types.index') }}"
                class="
                    mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                    text-sm font-medium transition
                    {{ request()->routeIs('regulation-types.*')
                        ? 'bg-sky-50 text-sky-700'
                        : 'text-gray-600 hover:bg-gray-50 hover:text-sky-600' }}
                "
                title="Jenis Regulasi"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-sky-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M4 5a2 2 0 0 1 2-2h10l4 4v12a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V5Z"
                    />

                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M14 3v5h5"
                    />

                    <path
                        stroke-linecap="round"
                        d="M8 12h8M8 16h8"
                    />

                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Jenis Regulasi
                </span>

            </a>

        @endif --}}


    </nav>


    {{-- =========================================================
         BOTTOM MENU
    ========================================================== --}}

    <div class="shrink-0 border-t border-gray-200 px-3 py-4">

        {{-- =====================================================
            LIHAT WEBSITE PUBLIK
        ===================================================== --}}

        <a
            href="{{ url('/') }}"
            target="_blank"
            rel="noopener noreferrer"
            class="
                mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                text-sm font-medium text-gray-600
                transition
                hover:bg-blue-50
                hover:text-blue-600
            "
            title="Lihat Website"
        >

            <svg
                class="h-5 w-5 shrink-0 text-blue-500"
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
                    d="M3 12h18"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3a14.5 14.5 0 0 1 0 18"
                />

                <path
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    d="M12 3a14.5 14.5 0 0 0 0 18"
                />

            </svg>

            <span class="admin-sidebar-label whitespace-nowrap">
                Lihat Website
            </span>

        </a>

        <a
            href="{{ route('profile.edit') }}"
            class="
                mb-2 flex h-11 items-center gap-3 rounded-lg px-3
                text-sm font-medium text-gray-600
                transition hover:bg-gray-50 hover:text-blue-600
            "
            title="Profil Saya"
        >

            <svg
                class="h-5 w-5 shrink-0 text-cyan-500"
                fill="none"
                stroke="currentColor"
                stroke-width="1.8"
                viewBox="0 0 24 24"
            >
                <circle
                    cx="12"
                    cy="8"
                    r="4"
                />

                <path
                    stroke-linecap="round"
                    d="M4 21a8 8 0 0 1 16 0"
                />
            </svg>

            <span class="admin-sidebar-label whitespace-nowrap">
                Profil Saya
            </span>

        </a>


        <form
            method="POST"
            action="{{ route('logout') }}"
        >

            @csrf

            <button
                type="submit"
                class="
                    flex h-11 w-full items-center gap-3 rounded-lg px-3
                    text-left text-sm font-medium text-gray-600
                    transition hover:bg-red-50 hover:text-red-600
                "
                title="Keluar"
            >

                <svg
                    class="h-5 w-5 shrink-0 text-red-500"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                    viewBox="0 0 24 24"
                >
                    <path
                        stroke-linecap="round"
                        d="M9 5H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h4"
                    />

                    <path
                        stroke-linecap="round"
                        d="m16 8 4 4-4 4M20 12H9"
                    />
                </svg>

                <span class="admin-sidebar-label whitespace-nowrap">
                    Keluar
                </span>

            </button>

        </form>

    </div>

</aside>