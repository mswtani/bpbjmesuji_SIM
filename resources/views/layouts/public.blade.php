<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>
        @yield('title', 'BPBJ Kabupaten Mesuji')
    </title>

    <link
        rel="icon"
        href="{{ asset('images/public/logo-mesuji-baru-1.png') }}"
        type="image/png"
    >

    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
    >

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
    >

    @vite('resources/css/public.css')

    @stack('styles')

</head>

<body>

    <x-public.navbar />

    <main>
        @yield('content')
    </main>

    <x-public.footer />


    <script
        src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    ></script>

    @vite('resources/js/public.js')

    @stack('scripts')

</body>

</html>