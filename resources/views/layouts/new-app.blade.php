<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta')
    <title>@yield('title', 'HIMTI - Teknik Informatika')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="overflow-x-hidden font-sans">
    @include('components.navbar', ['alwaysBlack' => $__env->hasSection('navbar_always_black')])
    @yield('content')
    @include('components.footer')
</body>

</html>