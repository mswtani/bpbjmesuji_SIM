<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="utf-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;600;700&display=swap"
        rel="stylesheet"
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

    <x-public.navbar-styles />

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