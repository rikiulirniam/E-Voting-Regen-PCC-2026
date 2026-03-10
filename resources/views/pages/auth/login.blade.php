<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full mx-auto h-screen flex flex-col p-10 bg-[radial-gradient(circle_at_0%_100%,rgba(220,38,38,0.4),transparent_30%),radial-gradient(circle_at_50%_0%,rgba(220,38,38,0.4),transparent_40%),linear-gradient(to_bottom,#020617,#000000)]">
    <header
        class="flex flex-row justify-center gap-1 bg-white w-max mx-auto py-2 px-4 rounded-full shadow-md outline-3 outline-offset-6 outline-white">
        <img src="{{ asset('assets/img/polines.png') }}" alt="Polines" class="w-auto h-5">
        <img src="{{ asset('assets/img/polines-2.png') }}" alt="Polines" class="w-auto h-5">
        <img src="{{ asset('assets/img/pcc.png') }}" alt="Polytechnic Computer Club" class="w-auto h-5">
    </header>

    <section class="m-auto flex flex-col gap-20 pt-10">
        <div class="flex flex-col items-center gap-0">
            <p class="text-2xl text-white tracking-wide">The Next</p>
            {{-- <h1 class="text-4xl text-white font-bold">ADMINISTRATOR</h1> --}}
            <img src="{{ asset('assets/img/administrator_text.png') }}" alt="Teks Administrator" class="w-auto h-13">
            <p class="text-2xl text-white tracking-[.25em] -mt-2">UKM PCC</p>
            <p class="text-xl text-white tracking-wide -mt-1.5">2026/2027</p>
        </div>
        <form action="{{ route('authenticate') }}" method="POST" class="flex flex-col gap-8 mx-1" autocomplete="off" id="loginForm">
            @csrf
            <div
                class="flex flex-col gap-6 bg-linear-to-r from-gray-500 to-gray-900 rounded-full outline-1 outline-white py-4 mx-3.5">
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your username">
            </div>
            <div
                class="flex flex-col gap-6 bg-linear-to-r from-gray-500 to-gray-900 rounded-full outline-1 outline-white py-4 mx-3.5">
                <input type="password" name="password" id="password"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your password">
            </div>
            <button type="submit" id="btn_submit"
                class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-4 w-36 mx-auto shadow-[6px_6px_2px_rgba(59,56,55,1)]">
                Confirm
            </button>
        </form>

    </section>
</body>

</html>