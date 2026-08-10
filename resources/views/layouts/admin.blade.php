<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    <title>@yield('title', 'Dashboard')</title>

    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])

</head>

<body class="bg-gray-100">

<div class="min-h-screen flex">

    @include('layouts.partials.admin.sidebar')

    <div class="flex-1">

        @include('layouts.partials.admin.topbar')

        <main class="p-8">

            @yield('content')

        </main>

        @include('layouts.partials.admin.footer')

    </div>

</div>

</body>

</html>