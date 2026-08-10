<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'BPBJ Mesuji')
    </title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>

<body class="min-h-screen bg-gray-100">

    <div class="flex min-h-screen flex-col items-center justify-center px-6 py-12">

        {{-- Logo / Identitas --}}
        <div class="mb-6 text-center">

            <a href="{{ url('/') }}">

                <h1 class="text-2xl font-bold text-indigo-700">
                    BPBJ Mesuji
                </h1>

            </a>

            <p class="mt-1 text-sm text-gray-500">
                Sistem Informasi Manajemen BPBJ Mesuji
            </p>

        </div>


        {{-- Card --}}
        <div class="w-full max-w-md">

            <div class="overflow-hidden rounded-xl border border-gray-200 bg-white p-6 shadow-lg">

                {{ $slot }}

            </div>

        </div>


        {{-- Footer --}}
        <div class="mt-6 text-center text-xs text-gray-500">

            © {{ date('Y') }} BPBJ Mesuji

        </div>

    </div>

</body>

</html>