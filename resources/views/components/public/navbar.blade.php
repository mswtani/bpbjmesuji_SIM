@push('styles')
    <style>
        /* CSS khusus public navbar */
        
        /* Logo utama */
        .main-header .logo {
            display: block;
            height: 65px;
            width: auto;
        }

        .main-header .logo-area .ukpbj {
            display: none;
        }

        /* Struktur logo */
        .main-header .logo-area {
            display: flex;
            align-items: center;
            text-decoration: none;
            gap: 15px;
        }

        /* =========================
           MOBILE
           ========================= */
        @media (max-width: 768px) {

            .main-header .logo-area {
                display: grid;

                grid-template-columns: auto auto;
                grid-template-rows: auto auto;

                align-items: center;
                justify-content: center;

                column-gap: 8px;

                width: 100%;
            }

            .main-header .logo.mesuji {
                grid-column: 1;
                grid-row: 1 / 3;

                width: 42px;
                height: auto;
            }

            .main-header .logo.ukpbj {
                display: block;

                grid-column: 2;
                grid-row: 1;

                width: 45px;
                height: auto;
            }

            .main-header .logo-text {
                grid-column: 2;
                grid-row: 2;
            }

            .public-navbar .mobile-logo {
                display: block;
                width: auto;
                height: 34px;
            }
        }

        /* =========================
           MOBILE 480px
           ========================= */
        @media (max-width: 480px) {

            .main-header .logo.mesuji {
                width: 38px;
            }

            .main-header .logo.ukpbj {
                width: 42px;
            }

            .public-navbar .mobile-logo {
                height: 32px;
            }
        }

        /* =========================
           MOBILE 320px
           ========================= */
        @media (max-width: 320px) {

            .main-header .logo.mesuji {
                width: 34px;
            }

            .main-header .logo.ukpbj {
                width: 38px;
            }

            .public-navbar .mobile-logo {
                height: 29px;
            }
        }
    </style>
@endpush
{{-- =========================================================
     TOP BAR
     ========================================================= --}}

<div class="top-bar">
    <div class="container">
        
        <span>
            <a
                href="https://maps.app.goo.gl/wSuGij5dFWtRk19eA"
                target="_blank"
                rel="noopener noreferrer"
            >
                <i class="fas fa-map-marker-alt"></i>
                Kompleks Perkantoran Pemkab Mesuji, Lampung
            </a>
        </span>


        {{-- USER ACCOUNT --}}

        <div
            class="public-user-dropdown"
            id="publicUserDropdown"
        >

            <button
                type="button"
                class="public-user-toggle"
                id="publicUserToggle"
                aria-expanded="false"
                aria-haspopup="true"
                >

                @auth

                    @if (auth()->user()->avatar)

                        <span class="public-user-avatar">

                            <img
                                src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
                                data-avatar-src="{{ asset('storage/' . auth()->user()->avatar) }}"
                                alt="Foto {{ auth()->user()->name }}"
                                class="public-avatar-lazy"
                                width="40"
                                height="40"
                            >

                        </span>

                    @else

                        <span class="public-user-avatar">
                            <i class="fas fa-user"></i>
                        </span>

                    @endif

                @else

                    <span class="public-user-avatar">
                        <i class="fas fa-user"></i>
                    </span>

                @endauth


                @auth

                    <span class="public-user-name">
                        {{ auth()->user()->name }}
                    </span>

                @else

                    <span class="public-user-name">
                        Login
                    </span>

                @endauth


                <span
                    class="public-user-arrow"
                    aria-hidden="true"
                ></span>

            </button>


            <div
                class="public-user-menu"
                id="publicUserMenu"
            >

                @guest

                    <a href="{{ route('login') }}">
                        Login
                    </a>

                @else

                    <a href="{{ route('public.account.edit') }}">
                        Setting Akun
                    </a>
                    
                    {{-- Dashboard Admin --}} 
                   @if (auth()->user()->role?->code !== 'PUBLIC_USER')
                        <a href="{{ route('dashboard') }}">
                            <span>Dashboard Admin</span>
                        </a>
                    @endif

                    <form
                        method="POST"
                        action="{{ route('logout') }}"
                    >
                        @csrf

                        <button type="submit">
                            Logout
                        </button>
                    </form>

                @endguest

            </div>

        </div>

    </div>
</div>



{{-- =========================================================
     MAIN HEADER
     ========================================================= --}}

<header class="main-header">

    <div class="container header-flex">

        <a
            href="{{ route('public.home') }}"
            class="logo-area"
        >

            <img
                src="{{ asset('/assets/images/logo-mesujikab.png') }}"
                alt="Logo Kabupaten Mesuji"
                class="logo mesuji"

            >


            <img
                src="{{ asset('/assets/images/logo-sim-bpbj.png') }}"
                alt="Logo UKPBJ Mesuji"
                class="logo ukpbj"

            >


            <div class="logo-text">

                <h1>
                    Bagian Pengadaan Barang dan Jasa
                </h1>

                <h2>
                    Sekretariat Daerah Kabupaten Mesuji
                </h2>

            </div>

        </a>


        {{-- SEARCH DESKTOP --}}

        <form
            action="{{ route('public.search') }}"
            method="GET"
            class="search-box"
            >
            <input
                type="search"
                name="q"
                value="{{ request('q') }}"
                placeholder="Search..."
                aria-label="Pencarian"
            >

            <button
                type="submit"
                aria-label="Cari"
            >
                <i class="fas fa-search"></i>
            </button>
        </form>

    </div>

</header>



{{-- =========================================================
     DESKTOP NAVBAR
     ========================================================= --}}

<nav class="navbar public-navbar">

    <div class="container">

        {{-- Logo hanya untuk mobile --}}

        <img
            src="{{ asset('/assets/images/logo-mesujikab.png') }}"
            alt="Logo Kabupaten Mesuji"
            class="logo mobile-logo"
            width="65"
            height="65"
        >

        <ul class="nav-links public-desktop-menu">

            <li>
                <a
                    href="{{ route('public.home') }}"
                    class="{{ request()->routeIs('public.home') ? 'active' : '' }}"
                >
                    Beranda
                </a>
            </li>


            <li>
                <a href="{{ url('/profil') }}">
                    Profil
                </a>
            </li>


            {{-- INFORMASI --}}

            <li class="public-dropdown">

                <button
                    type="button"
                    class="public-dropdown-toggle"
                    data-public-dropdown="informasi"
                    aria-expanded="false"
                >
                    <span>Informasi</span>

                    <span
                        class="public-dropdown-arrow"
                        aria-hidden="true"
                    ></span>
                </button>


                <div
                    class="public-dropdown-menu"
                    data-public-dropdown-menu="informasi"
                >

                    <a href="{{ url('/berita') }}">
                        Berita & Pengumuman
                    </a>

                    <a href="{{ url('/regulasi') }}">
                        Regulasi
                    </a>

                </div>

            </li>


            {{-- LAYANAN --}}

            <li class="public-dropdown">

                <button
                    type="button"
                    class="public-dropdown-toggle"
                    data-public-dropdown="layanan"
                    aria-expanded="false"
                >
                    <span>Layanan</span>

                    <span
                        class="public-dropdown-arrow"
                        aria-hidden="true"
                    ></span>
                </button>


                <div
                    class="public-dropdown-menu"
                    data-public-dropdown-menu="layanan"
                >

                    <a href="{{ route('helpdesk.index') }}">
                        Konsultasi PBJ
                    </a>

                    <a href="{{ url('/aduan-kritik-saran') }}">
                        Aduan Kritik dan Saran
                    </a>

                    <a href="{{ url('/simonpraja') }}">
                        Simonpraja
                    </a>

                </div>

            </li>


            <li>
                <a
                    href="{{ route('public.contact') }}"
                    class="{{ request()->routeIs('public.contact') ? 'active' : '' }}"
                    >
                    Kontak
                </a>
            </li>

        </ul>


        {{-- MOBILE BUTTON --}}

        <button
            type="button"
            class="public-menu-btn"
            id="publicMenuBtn"
            aria-expanded="false"
            aria-controls="publicMobileMenu"
            aria-label="Buka menu"
        >
            <i class="fas fa-bars"></i>
        </button>

    </div>

</nav>



{{-- =========================================================
     MOBILE BACKDROP
     ========================================================= --}}

<div
    class="public-mobile-backdrop"
    id="publicMobileBackdrop"
></div>



{{-- =========================================================
     MOBILE MENU
     ========================================================= --}}

<aside
    class="public-mobile-menu"
    id="publicMobileMenu"
    aria-hidden="true"
>

    <button
        type="button"
        class="public-mobile-close"
        id="publicMobileClose"
        aria-label="Tutup menu"
    >
        <i class="fas fa-xmark"></i>
    </button>


    <nav class="public-mobile-navigation">

        <a
            href="{{ route('public.home') }}"
            class="{{ request()->routeIs('public.home') ? 'active' : '' }}"
        >
            Beranda
        </a>

        <a href="{{ url('/profil') }}" class="{{ request()->routeIs('profil') ? 'active' : '' }}">
            Profil
        </a>


        {{-- INFORMASI --}}

        <div
            class="public-mobile-dropdown
                {{ request()->is('berita*') || request()->is('pengumuman*') || request()->is('regulasi*') ? 'active' : '' }}"
            >

            <button
                type="button"
                class="public-mobile-dropdown-toggle"
                data-mobile-dropdown="informasi"
                aria-expanded="false"
            >
                <span>Informasi</span>

                <span
                    class="public-mobile-dropdown-arrow"
                ></span>
            </button>


            <div
                class="public-mobile-dropdown-menu"
                data-mobile-dropdown-menu="informasi"
            >

                <a href="{{ url('/berita') }}" class="{{ request()->routeIs('berita') ? 'active' : '' }}">
                    Berita
                </a>

                <a href="{{ url('/pengumuman') }}" class="{{ request()->routeIs('pengumuman') ? 'active' : '' }}">
                    Pengumuman
                </a>

                <a href="{{ url('/regulasi') }}" class="{{ request()->routeIs('regulasi') ? 'active' : '' }}">
                    Regulasi
                </a>

            </div>

        </div>


        {{-- LAYANAN --}}

        <div
            class="public-mobile-dropdown
                {{ request()->is('konsultasi*') || request()->is('aduan-kritik-saran*') || request()->is('simonpraja*') ? 'active' : '' }}"
            >

            <button
                type="button"
                class="public-mobile-dropdown-toggle"
                data-mobile-dropdown="layanan"
                aria-expanded="false"
            >
                <span>Layanan</span>

                <span
                    class="public-mobile-dropdown-arrow"
                ></span>
            </button>


            <div
                class="public-mobile-dropdown-menu"
                data-mobile-dropdown-menu="layanan"
            >

                <a href="{{ url('/konsultasi') }}" class="{{ request()->routeIs('konsultasi') ? 'active' : '' }}">
                    Konsultasi PBJ
                </a>

                <a href="{{ url('/aduan-kritik-saran') }}" class="{{ request()->routeIs('aduan-kritik-saran') ? 'active' : '' }}">
                    Aduan Kritik dan Saran
                </a>

                <a href="{{ url('/simonpraja') }}" class="{{ request()->routeIs('simonpraja') ? 'active' : '' }}">
                    Simonpraja
                </a>

            </div>

        </div>


        <a
            href="{{ url('/kontak') }}"
            class="{{ request()->is('kontak*') ? 'active' : '' }}"
            >
            Kontak
        </a>

    </nav>

    <div class="public-mobile-user">
        @guest
            <a href="{{ route('login') }}" class="public-mobile-user-toggle">
                <span class="public-mobile-user-info">
                    <i class="fa-solid fa-user"></i>
                    <span>Login</span>
                </span>

                <span class="public-mobile-user-arrow"></span>
            </a>
        @else
            <button
                type="button"
                class="public-mobile-user-toggle"
                aria-expanded="false"
            >
                <span class="public-mobile-user-info">
                   @if (auth()->user()->avatar)

                        <img
                            src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///ywAAAAAAQABAAACAUwAOw=="
                            data-avatar-src="{{ asset('storage/' . auth()->user()->avatar) }}"
                            alt="Foto {{ auth()->user()->name }}"
                            class="public-mobile-user-avatar public-avatar-lazy"
                            width="40"
                            height="40"
                        >

                    @else
                        <span class="public-mobile-user-avatar">
                            <i class="fa-solid fa-user"></i>
                        </span>
                    @endif

                    <span>{{ auth()->user()->name }}</span>
                </span>

                <span class="public-mobile-user-arrow"></span>
            </button>

            <div class="public-mobile-user-menu">
                <a href="{{ route('public.account.edit') }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Setting Akun</span>
                </a>

                  {{-- Dashboard Admin --}}
               @if (auth()->user()->role?->code !== 'PUBLIC_USER')
                    <a href="{{ route('dashboard') }}">
                        <i class="fa-solid fa-gauge-high"></i>
                        <span>Dashboard Admin</span>
                    </a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button type="submit">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        @endguest
    </div>

</aside>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        const lazyAvatars = document.querySelectorAll(
            '.public-avatar-lazy[data-avatar-src]'
        );

        if (!lazyAvatars.length) {
            return;
        }


        function loadAvatar(image) {

            if (image.dataset.avatarLoaded === 'true') {
                return;
            }

            const src = image.dataset.avatarSrc;

            if (!src) {
                return;
            }

            image.src = src;

            image.dataset.avatarLoaded = 'true';

        }


        /*
         * DESKTOP
         *
         * Avatar langsung dimuat ketika
         * dropdown user dibuka.
         */
        const userToggle = document.getElementById(
            'publicUserToggle'
        );

        const userMenu = document.getElementById(
            'publicUserMenu'
        );


        if (userToggle) {

            userToggle.addEventListener('click', function () {

                lazyAvatars.forEach(function (image) {

                    if (
                        image.closest('#publicUserDropdown')
                    ) {
                        loadAvatar(image);
                    }

                });

            });

        }


        /*
         * MOBILE
         *
         * Avatar dimuat ketika area user
         * pada mobile dibuka.
         */
        const mobileUserToggle =
            document.querySelector(
                '.public-mobile-user-toggle'
            );


        if (mobileUserToggle) {

            mobileUserToggle.addEventListener(
                'click',
                function () {

                    lazyAvatars.forEach(function (image) {

                        if (
                            image.closest('.public-mobile-user')
                        ) {
                            loadAvatar(image);
                        }

                    });

                }
            );

        }

    });
</script>