<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirm Your Choice!</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body
    class="w-full mx-auto h-screen flex flex-col py-10 pb-10 pt-8 bg-[radial-gradient(circle_at_0%_100%,rgba(67,37,137,0.8),transparent_30%),radial-gradient(circle_at_50%_0%,rgba(67,37,137,0.8),transparent_40%),linear-gradient(to_bottom,#020617,#000000)]">
    <div class="mx-auto w-max rounded-full bg-white/10 border-3 border-white/20 p-1.5 md:p-2.5 backdrop-blur-sm">
        <header class="flex items-center gap-0 bg-white px-2 py-1 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-4 w-auto md:h-8">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-4 w-auto md:h-8">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-4 w-auto md:h-8">
        </header>
    </div>
    <form action="#" class="my-auto">
        @csrf
        <section class="flex flex-col justify-center gap-8">
            <div
                class="py-6 px-1 text-center bg-linear-to-b from-gray-800 to-gray-600 m-auto mx-12 rounded-2xl border border-white md:w-110 md:py-12 md:mx-auto">
                <p class="font-mono tracking-wide text-white mx-10 text-xl md:text-2xl">
                    Choose it wisely.<br> Are you sure about your choice?
                </p>
            </div>
            <div class="flex flex-row gap-9 mx-auto">
                <button type="button" onclick="history.back()"
                    class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-4.5 md:py-6 w-32 md:w-50 lg:py-5 shadow-[6px_6px_2px_rgba(59,56,55,1)] hover:scale-105 transition">
                    Back
                </button>
                <button type="submit"
                    class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-4.5 md:py-6 w-32 md:w-50 lg:py-5 shadow-[6px_6px_2px_rgba(59,56,55,1)] hover:scale-105 transition">
                    Confirm
                </button>
            </div>
        </section>
    </form>
</body>
</html>