<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Regen 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">

    <div class="flex min-h-screen">

        <x-admin.sidebar />

        <main class="flex-1 overflow-y-auto">
            @yield('content')
        </main>

    </div>

    @yield('scripts')

</body>
</html>
