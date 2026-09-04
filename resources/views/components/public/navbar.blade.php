{{-- =========================================================
     TOP BAR
     ========================================================= --}}

<div class="top-bar">
    <div class="container">

        <span class="public-location">
            <i class="fas fa-location-dot"></i>
            Kompleks Perkantoran Pemkab Mesuji, Lampung
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

                <span class="public-user-avatar">
                    <i class="fas fa-user"></i>
                </span>


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

                    <a href="{{ url('/profile') }}">
                        Setting Akun
                    </a>


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

        <div class="search-box">

            <input
                type="search"
                placeholder="Search..."
                aria-label="Pencarian"
            >

            <button
                type="button"
                aria-label="Cari"
            >
                <i class="fas fa-search"></i>
            </button>

        </div>

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
                        Berita
                    </a>

                    <a href="{{ url('/pengumuman') }}">
                        Pengumuman
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
                <a href="{{ url('/kontak') }}">
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
                    <img
                        src="{{ auth()->user()->profile_photo_url ?? asset('images/default-avatar.png') }}"
                        alt="User"
                        class="public-mobile-user-avatar"
                    >

                    <span>{{ auth()->user()->name }}</span>
                </span>

                <span class="public-mobile-user-arrow"></span>
            </button>

            <div class="public-mobile-user-menu">
                <a href="{{ url('/profile') }}">
                    <i class="fa-solid fa-user-gear"></i>
                    <span>Setting Akun</span>
                </a>

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