<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <meta
        name="csrf-token"
        content="{{ csrf_token() }}"
    >

    <title>
        @yield('title', 'BPBJ Mesuji')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>


<body class="min-h-screen bg-gray-50 text-gray-800">

    {{-- =========================================================
         NAVBAR
    ========================================================== --}}

    <header class="border-b border-gray-200 bg-white">

        <nav class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

            <div class="flex h-20 items-center justify-between">

                {{-- Logo / Brand --}}
                <a
                    href="/"
                    class="flex items-center gap-3"
                >

                    <div
                        class="flex h-11 w-11 items-center justify-center rounded-lg bg-[#0b2f64] text-sm font-bold text-white"
                    >
                        BPBJ
                    </div>

                    <div class="hidden sm:block">

                        <div class="text-sm font-bold text-[#0b2f64]">
                            BPBJ Kabupaten Mesuji
                        </div>

                        <div class="text-xs text-gray-500">
                            Bagian Pengadaan Barang/Jasa
                        </div>

                    </div>

                </a>


                {{-- Desktop Menu --}}
                <div class="hidden items-center gap-1 md:flex">

                    <a
                        href="/"
                        class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                    >
                        Beranda
                    </a>

                    <a
                        href="#profil"
                        class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                    >
                        Profil
                    </a>


                    <a
                        href="{{ route('public.news') }}"
                        class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                    >
                        Berita
                    </a>


                    <a
                        href="{{ route('public.announcements') }}"
                        class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                    >
                        Pengumuman
                    </a>


                    {{-- Regulasi akan kita aktifkan setelah modul regulasi selesai --}}
                    @if (Route::has('public.regulations'))

                        <a
                            href="{{ route('public.regulations') }}"
                            class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                        >
                            Regulasi
                        </a>

                    @else

                        <span
                            class="rounded-md px-4 py-2 text-sm font-medium text-gray-400"
                        >
                            Regulasi
                        </span>

                    @endif


                    <a
                        href="#kontak"
                        class="rounded-md px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-100 hover:text-[#0b2f64]"
                    >
                        Kontak
                    </a>

                </div>


                {{-- Mobile Button --}}
                <button
                    type="button"
                    id="public-menu-button"
                    aria-label="Buka menu"
                    aria-expanded="false"
                    class="inline-flex items-center justify-center rounded-md p-2 text-gray-600 hover:bg-gray-100 hover:text-[#0b2f64] md:hidden"
                >

                    <svg
                        id="public-menu-open-icon"
                        class="h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16"
                        />
                    </svg>


                    <svg
                        id="public-menu-close-icon"
                        class="hidden h-6 w-6"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            stroke-width="2"
                            d="M6 18L18 6M6 6l12 12"
                        />
                    </svg>

                </button>

            </div>


            {{-- Mobile Menu --}}
            <div
                id="public-mobile-menu"
                class="hidden border-t border-gray-100 pb-4 pt-2 md:hidden"
            >

                <div class="space-y-1">

                    <a
                        href="/"
                        class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Beranda
                    </a>

                    <a
                        href="#profil"
                        class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Profil
                    </a>

                    <a
                        href="{{ route('public.news') }}"
                        class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Berita
                    </a>

                    <a
                        href="{{ route('public.announcements') }}"
                        class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Pengumuman
                    </a>

                    @if (Route::has('public.regulations'))

                        <a
                            href="{{ route('public.regulations') }}"
                            class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                        >
                            Regulasi
                        </a>

                    @else

                        <span
                            class="block rounded-md px-4 py-3 text-sm font-medium text-gray-400"
                        >
                            Regulasi
                        </span>

                    @endif

                    <a
                        href="#kontak"
                        class="block rounded-md px-4 py-3 text-sm font-medium text-gray-700 hover:bg-gray-100"
                    >
                        Kontak
                    </a>

                </div>

            </div>

        </nav>

    </header>


    {{-- =========================================================
         CONTENT
    ========================================================== --}}

    <main>

        @yield('content')

    </main>


    {{-- =========================================================
         FOOTER
    ========================================================== --}}

    <footer
        id="kontak"
        class="mt-16 border-t border-gray-200 bg-[#0b2f64] text-white"
    >

        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">

            <div class="grid gap-8 md:grid-cols-3">

                <div>

                    <h2 class="text-lg font-semibold">
                        BPBJ Kabupaten Mesuji
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-blue-100">
                        Bagian Pengadaan Barang/Jasa Kabupaten Mesuji.
                    </p>

                </div>


                <div>

                    <h2 class="text-sm font-semibold uppercase tracking-wide">
                        Navigasi
                    </h2>

                    <div class="mt-3 space-y-2 text-sm text-blue-100">

                        <div>
                            <a href="/" class="hover:text-white">
                                Beranda
                            </a>
                        </div>

                        <div>
                            <a
                                href="{{ route('public.news') }}"
                                class="hover:text-white"
                            >
                                Berita
                            </a>
                        </div>

                        <div>
                            <a
                                href="{{ route('public.announcements') }}"
                                class="hover:text-white"
                            >
                                Pengumuman
                            </a>
                        </div>

                    </div>

                </div>


                <div>

                    <h2 class="text-sm font-semibold uppercase tracking-wide">
                        Kontak
                    </h2>

                    <p class="mt-3 text-sm leading-6 text-blue-100">
                        Informasi kontak dan layanan BPBJ Kabupaten Mesuji.
                    </p>

                </div>

            </div>


            <div class="mt-10 border-t border-blue-900 pt-6">

                <p class="text-center text-xs text-blue-200">
                    © {{ date('Y') }} BPBJ Kabupaten Mesuji.
                    Seluruh hak cipta dilindungi.
                </p>

            </div>

        </div>

    </footer>


    {{-- Mobile menu script --}}
    <script>

        document.addEventListener('DOMContentLoaded', function () {

            const button = document.getElementById('public-menu-button');
            const menu = document.getElementById('public-mobile-menu');

            const openIcon = document.getElementById('public-menu-open-icon');
            const closeIcon = document.getElementById('public-menu-close-icon');

            if (!button || !menu) {
                return;
            }

            button.addEventListener('click', function () {

                const isOpen = !menu.classList.contains('hidden');

                menu.classList.toggle('hidden', isOpen);

                openIcon.classList.toggle('hidden', !isOpen);
                closeIcon.classList.toggle('hidden', isOpen);

                button.setAttribute(
                    'aria-expanded',
                    String(!isOpen)
                );

            });

        });

    </script>

</body>

</html>