<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard - Public</title>
        @vite('resources/css/app.css', 'resources/js/app.js')

</head>
<body>

    <div class="w-screen h-screen flex flex-col items-center justify-center">
        <h1 class="text-2xl font-bold">This is Dashboard public</h1>
        <a href="{{ route('logout') }}" class="inline-block bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors duration-300">Logout</a>
    </div>
</body>
</html>