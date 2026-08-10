<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SIM BPBJ Mesujikab')</title>

    @vite(['resources/css/app.css', 'resources/css/app.css'])
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>

    @include('layouts.partials.public.navbar')

    <main class='container mx-auto py8'>
        @yield('content')
    </main>
    
    @include('layouts.partials.public.footer')
</body>
</html>