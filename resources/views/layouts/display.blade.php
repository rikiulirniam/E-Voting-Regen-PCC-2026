<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Display') - Regen 2026</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">
    @yield('content')
    @yield('scripts')
</body>
</html>
