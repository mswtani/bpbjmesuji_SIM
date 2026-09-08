<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'SIM BPBJ Mesuji')
    </title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body
    class="
        min-h-screen
        bg-gray-100
        text-gray-900
    "
>

    <main
        class="
            flex
            min-h-screen
            flex-col
            items-center
            justify-center
            px-4
            py-8
            sm:px-6
        "
    >

        {{-- Authentication Container --}}
        <div class="w-full max-w-md">

            {{-- Authentication Card --}}
            <div
                class="
                    overflow-hidden
                    rounded-2xl
                    border
                    border-gray-200
                    bg-white
                    shadow-xl
                    shadow-gray-200/60
                "
            >

                {{-- System Header --}}
                <div
                    class="                        
                        px-6
                        pt-7
                        pb-2
                        text-center
                        sm:px-8
                    "
                >

                    {{-- Logo --}}
                    <a
                        href="{{ url('/') }}"
                        class="
                            inline-flex
                            justify-center
                            transition
                            hover:opacity-90
                            focus:outline-none
                            focus:ring-2
                            focus:ring-blue-500
                            focus:ring-offset-2
                            rounded-xl
                        "
                        aria-label="Kembali ke Beranda"
                    >

                        <img
                            src="{{ asset('assets/images/logo-mesujikab.png') }}"
                            alt="Logo Kabupaten Mesuji"
                            class="
                                h-20
                                w-auto
                                sm:h-24
                            "
                        >

                    </a>


                    {{-- System Name --}}
                    <h1
                        class="
                            mt-3
                            text-3xl
                            font-extrabold
                            tracking-tight
                            text-gray-900
                            sm:text-2xl
                        "
                    >
                        SIM BPBJ Mesuji
                    </h1>
                   
                </div>


                {{-- Page Content --}}
                <div
                    class="
                        px-6
                        py-6
                        sm:px-8
                    "
                >

                    {{ $slot }}

                </div>

            </div>


            {{-- Footer --}}
            <footer
                class="
                    mt-5
                    text-center
                    text-xs
                    text-gray-500
                "
            >

                © {{ date('Y') }} BPBJ Kabupaten Mesuji

            </footer>

        </div>

    </main>

</body>

</html>