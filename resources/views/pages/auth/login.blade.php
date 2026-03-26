<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>

    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="w-full mx-auto min-h-screen flex flex-col py-10 pb-10 pt-8 bg-mobile bg-desktop">
    @if($errors->any())
    <div
        x-data="{ show : true }"
        x-init="setTimeout(() => show = false, 3000)"
        x-show="show"
        x-transition
        class="fixed top-5 right-5 bg-red-500 text-white px-4 py-3 rounded shadow-lg w-80">
        <span class="block font-bold mb-1">ERROR</span>
        <ul class="text-sm list-disc list-inside">
            @foreach ($errors->all() as $error)
            {{ $error }} {{ $loop->last ? '. ' : ', dan ' }}
            @endforeach
        </ul>
    </div>
    @endif
    <div
        class="mx-auto w-max rounded-full bg-white/10 border-3 border-white/20 p-1.5 md:p-2.5 backdrop-blur-sm lg:hidden">
        <div class="flex items-center gap-0 bg-white px-2 py-1 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
        </div>
    </div>
    <div class="hidden lg:flex items-center w-full px-10 justify-center">
        <div class="flex items-center gap-0 bg-white px-3 py-1.5 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-6 w-auto">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-6 w-auto">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-6 w-auto">
        </div>
    </div>
    <section class="m-auto flex flex-col gap-30 lg:gap-14 md:gap-30 lg:pt-5 pt-10 md:pt-0 mx-8">
        <div class="lg:hidden items-center mx-auto">
            <img src="{{ asset('assets/img/login_mobile.png') }}" alt="Teks Administrator"
                class="w-auto h-auto scale-120">
        </div>
        <div class="hidden lg:flex items-center mx-auto">
            <img src="{{ asset('assets/img/login_desktop.png') }}" alt="Teks Administrator"
                class="w-auto h-60">
        </div>
        <form action="{{ route('authenticate') }}" method="POST" class="flex flex-col gap-6 mx-1 lg:gap-3.5 scale-85 md:scale-100" autocomplete="off"
            id="loginForm">
            @csrf

            @if ($errors->any())
                <div class="w-full md:w-100 lg:w-70 mx-auto rounded-xl border border-red-400/60 bg-red-900/70 px-4 py-3 text-center text-sm text-red-100 font-mono">
                    @if ($errors->has('login'))
                        {{ $errors->first('login') }}
                    @else
                        {{ $errors->first() }}
                    @endif
                </div>
            @endif

            <div
                class="flex flex-col py-2.5 md:py-6 w-full md:w-100 mx-auto lg:w-70 lg:py-2 rounded-xl placeholder:lg:text-xs bg-linear-to-b from-gray-950 to-gray-900 lborder outline {{ $errors->has('username') ? 'outline-red-400' : 'outline-white/50' }}">
                <input type="text" name="username" id="username" value="{{ old('username') }}"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your username">
            </div>

            @error('username')
                <p class="-mt-4 md:-mt-2 w-full md:w-100 lg:w-70 mx-auto text-xs text-red-200 font-mono text-center">{{ $message }}</p>
            @enderror

            <div
                class="flex flex-col py-2.5 md:py-6 w-full md:w-100 mx-auto lg:w-70 lg:py-2 rounded-xl placeholder:lg:text-xs bg-linear-to-b from-gray-950 to-gray-900 lborder outline {{ $errors->has('password') ? 'outline-red-400' : 'outline-white/50' }}">
                <input type="password" name="password" id="password"
                    class="text-white placeholder:text-center placeholder:font-mono placeholder:text-lg text-center caret-white focus:outline-none font-mono"
                    placeholder="Insert your password">
            </div>

            @error('password')
                <p class="-mt-4 md:-mt-2 w-full md:w-100 lg:w-70 mx-auto text-xs text-red-200 font-mono text-center">{{ $message }}</p>
            @enderror

            <button type="submit" id="btn_submit"
                class="text-white font-mono tracking-wide py-2.5 md:py-6 w-full md:w-50 mx-auto lg:w-70 lg:py-2 rounded-xl placeholder:lg:text-xs bg-linear-to-r from-blue-700 via-indigo-500 to-blue-700
                            border-none lg:mt-2 hover:bg-linear-to-r hover:from-indigo-900 hover:via-indigo-700 hover:to-indigo-900 hover:scale-98 transition-all">
                Login
            </button>
        </form>
    </section>
</body>

</html>
