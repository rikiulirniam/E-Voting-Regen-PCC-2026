<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body
    class="w-full mx-auto min-h-screen flex flex-col py-10 pb-10 pt-8 bg-[radial-gradient(circle_at_0%_100%,rgba(220,38,38,0.4),transparent_30%),radial-gradient(circle_at_50%_0%,rgba(220,38,38,0.4),transparent_40%),linear-gradient(to_bottom,#020617,#000000)]">
    <div class="mx-auto w-max rounded-full bg-white/10 border-3 border-white/20 p-1.5 md:p-2.5 backdrop-blur-sm">
        <header class="flex items-center gap-0 bg-white px-2 py-1 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
        </header>
    </div>
    <section class="m-auto flex flex-col gap-15 lg:gap-14 md:gap-30 lg:pt-5 pt-10 md:pt-0 mx-8">
        <div class="flex flex-col items-center gap-0 font-montserrat">
            <p class="text-2xl lg:text-2xl md:text-3xl text-white tracking-wide">Who The Next</p>
            {{-- <h1 class="text-4xl text-white font-bold">ADMINISTRATOR</h1> --}}
            <img src="{{ asset('assets/img/administrator_text.png') }}" alt="Teks Administrator" class="w-auto h-13 lg:h-16 md:h-20">
            <p class="text-2xl lg:text-3xl md:text-4xl text-white tracking-[.25em] -mt-2 font-semibold">UKM PCC</p>
            <p class="text-xl lg:text-2xl md:text-3xl text-white tracking-wide -mt-1.5 lg:-mt-1 font-semibold">2026/2027</p>

        </div>
        <form action="{{ route('authenticate') }}" method="POST" class="flex flex-col gap-8 mx-1" autocomplete="off" id="loginForm">
            @csrf
            <div
                class="flex flex-col gap-6 bg-linear-to-r from-gray-500 to-gray-900 rounded-full outline-1 outline-white py-3.5 md:py-6 lg:py-4 mx-3.5 md:w-100 md:mx-auto lg:w-90">
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your username">
            </div>
            <div
                class="flex flex-col gap-6 bg-linear-to-r from-gray-500 to-gray-900 rounded-full outline-1 outline-white py-3.5 md:py-6 lg:py-4 mx-3.5 md:w-100 md:mx-auto lg:w-90">
                <input type="password" name="password" id="password"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your password">
            </div>
            <button type="submit" id="btn_submit"
                class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-3.5 md:py-6 w-36 md:w-50 lg:py-4 mx-auto shadow-[6px_6px_2px_rgba(59,56,55,1)]">
                Confirm
            </button>
        </form>

    </section>
</body>

</html>
