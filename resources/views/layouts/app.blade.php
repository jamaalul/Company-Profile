<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'HIMTI - Teknik Informatika')</title>
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@400;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <link href="{{ asset('css/common.css') }}" rel="stylesheet">
    {{-- <link rel="stylesheet" href="{{ asset('css/animations.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">
    <link href="http://127.0.0.1:8000/css/common.css" rel="stylesheet">
</head>

<body>
    @include('components.navbar')
    @yield('content')
    @include('components.footer')
</body>
<script src="{{ asset('js/main.js') }}"></script>
<script src="{{ asset('js/portal.js') }}"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script src="{{ asset('js/compro.js') }}"></script>
<script src="https://cdn.tailwindcss.com"></script>
<script>
    AOS.init();
</script>

</html>