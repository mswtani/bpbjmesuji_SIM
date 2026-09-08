<header
    id="admin-topbar"
    class="sticky top-0 z-30 flex h-[72px] items-center border-b border-gray-200 bg-white"
>

    <div class="flex h-full w-full items-center justify-between px-4 sm:px-6">

        {{-- LEFT --}}

        <div class="flex min-w-0 items-center">

            {{-- Hamburger --}}

            <button
                id="admin-sidebar-toggle"
                type="button"
                class="
                    inline-flex h-10 w-10 shrink-0 items-center
                    justify-center rounded-lg
                    border border-gray-200 bg-white
                    text-gray-600
                    shadow-sm
                    transition
                    hover:bg-gray-50 hover:text-blue-600
                    focus:outline-none focus:ring-2 focus:ring-blue-500/30
                "
                aria-label="Buka atau kecilkan sidebar"
                aria-expanded="true"
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
                        d="M4 6h16M4 12h16M4 18h16"
                    />
                </svg>

            </button>


            {{-- Brand ketika sidebar collapsed --}}

            <a
                id="admin-topbar-brand"
                href="{{ route('dashboard') }}"
                class="ml-4 hidden min-w-0 items-center gap-3"
            >
                
                <div class="min-w-0">

                    <div class="truncate text-base font-bold leading-tight text-gray-900">
                        SIM BPBJ
                    </div>

                    <div class="truncate text-xs font-medium text-gray-500">
                        Kabupaten Mesuji
                    </div>

                </div>
            </a>

        </div>


        {{-- RIGHT --}}

        <div class="flex items-center gap-3">

            {{-- Notification --}}

            <button
                type="button"
                class="
                    relative inline-flex h-10 w-10
                    items-center justify-center
                    rounded-lg text-gray-500
                    transition hover:bg-gray-50 hover:text-blue-600
                "
                title="Notifikasi"
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
                        d="M15 17H9m10-2V11a7 7 0 1 0-14 0v4l-2 2h18l-2-2Z"
                    />
                </svg>

                {{-- Placeholder notifikasi --}}

                <span
                    class="
                        absolute right-1 top-1
                        hidden h-2 w-2 rounded-full
                        bg-red-500
                    "
                ></span>

            </button>


            {{-- User --}}

            <div class="relative">

                <button
                    id="admin-user-menu-button"
                    type="button"
                    class="
                        flex items-center gap-3 rounded-lg px-2 py-1.5
                        transition hover:bg-gray-50
                    "
                    aria-expanded="false"
                >

                    {{-- Avatar --}}

                    @if (auth()->user()->avatar)

                        <img
                            src="{{ asset('storage/' . auth()->user()->avatar) }}"
                            alt="Foto {{ auth()->user()->name }}"
                            class="
                                h-10 w-10
                                shrink-0
                                rounded-full
                                object-cover
                            "
                        >

                    @else

                       @auth
                            @if (auth()->user()->avatar)
                                <img
                                    src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                    alt="Foto {{ auth()->user()->name }}"
                                    class="h-10 w-10 shrink-0 rounded-full object-cover"
                                >
                            @else
                                <div
                                    class="
                                        flex h-10 w-10 shrink-0
                                        items-center justify-center
                                        rounded-full bg-blue-100
                                        text-sm font-semibold text-blue-700
                                    "
                                >
                                    {{ strtoupper(substr(auth()->user()->name ?? 'U', 0, 1)) }}
                                </div>
                            @endif
                        @endauth

                    @endif

                    <div class="hidden text-left sm:block">

                        <div class="max-w-[160px] truncate text-sm font-semibold text-gray-900">
                            {{ auth()->user()->name }}
                        </div>

                        <div class="max-w-[160px] truncate text-xs text-gray-500">
                            {{ auth()->user()->role?->name ?? 'Pengguna' }}
                        </div>

                    </div>

                    <svg
                        class="hidden h-4 w-4 text-gray-400 sm:block"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                        viewBox="0 0 24 24"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="m6 9 6 6 6-6"
                        />
                    </svg>

                </button>


                {{-- Dropdown --}}

                <div
                    id="admin-user-menu"
                    class="
                        absolute right-0 top-full z-50 mt-2
                        hidden w-56
                        overflow-hidden rounded-xl
                        border border-gray-200
                        bg-white
                        shadow-lg
                    "
                >

                    <div class="border-b border-gray-100 px-4 py-3">

                        <p class="truncate text-sm font-semibold text-gray-900">
                            {{ auth()->user()->name }}
                        </p>

                        <p class="truncate text-xs text-gray-500">
                            {{ auth()->user()->email }}
                        </p>

                    </div>


                    <div class="p-1">

                        <a
                            href="{{ route('profile.edit') }}"
                            class="
                                flex items-center gap-3 rounded-lg px-3 py-2
                                text-sm text-gray-700
                                hover:bg-gray-50
                            "
                        >

                            <span class="text-cyan-500">●</span>

                            Profil Saya

                        </a>


                        <form
                            method="POST"
                            action="{{ route('logout') }}"
                        >

                            @csrf

                            <button
                                type="submit"
                                class="
                                    flex w-full items-center gap-3
                                    rounded-lg px-3 py-2
                                    text-left text-sm text-red-600
                                    hover:bg-red-50
                                "
                            >

                                <span class="text-red-500">→</span>

                                Keluar

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>