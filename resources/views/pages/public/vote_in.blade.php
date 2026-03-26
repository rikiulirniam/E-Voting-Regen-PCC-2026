<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Thank You for Participating!</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="w-full min-h-screen flex flex-col py-10 pb-10 pt-8 bg-mobile bg-desktop">
    <div
        class="mx-auto w-max rounded-full bg-white/10 border-3 border-white/20 p-1.5 md:p-2.5 backdrop-blur-sm lg:hidden">
        <div class="flex items-center gap-0 bg-white px-2 py-1 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
        </div>
    </div>
    <div class="hidden lg:flex items-center justify-between w-full px-10">
        <div class="flex items-center gap-0 bg-white px-3 py-1.5 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-6 w-auto">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-6 w-auto">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-6 w-auto">
        </div>
        <div
            class="text-white px-15 py-1.5 bg-linear-to-b from-gray-900 to-gray-700 rounded-xl border border-white/40 tracking-wide">
            <p>{{ Auth::user()->name }}</p>
        </div>
    </div>

    {{-- <section class="relative flex items-center justify-center gap-1.5 flex-col my-auto">
        <div class="relative h-112 w-100 bg-gray-500"
            style="clip-path: path('M 0 0 L 300 0 L 300 30 L 400 20 L 400 450 L 0 450 L 0 0')">
        </div>
    </section> --}}

    <section class="relative flex items-center justify-center my-auto px-10 md:px-0">
        <div class="relative scale-85 md:scale-120 lg:scale-100 origin-top">
            <div class="relative p-px bg-white"
                style="clip-path: path('M 20 0 L 260 0 C 260 0, 280 0, 280 20 L 280 40 C 280 40, 280 60, 300 60 L 380 60 C 380 60, 400 60, 400 80 L 400 430 C 400 420, 400 450, 380 450 L 180 450 C 180 450, 160 450, 160 430 L 160 420 C 160 420, 160 400, 140 400 L 20 400 C 20 400, 0 400, 0 380 L 0 20 C 0 20, 0 0, 20 0 Z')">
                <div class="h-112 w-100 bg-linear-to-br from-gray-400 via-gray-700 to-gray-900 backdrop-blur-2xl"
                    style="clip-path: path('M 20 0 L 260 0 C 260 0, 280 0, 280 20 L 280 40 C 280 40, 280 60, 300 60 L 380 60 C 380 60, 400 60, 400 80 L 400 430 C 400 420, 400 450, 380 450 L 180 450 C 180 450, 160 450, 160 430 L 160 420 C 160 420, 160 400, 140 400 L 20 400 C 20 400, 0 400, 0 380 L 0 20 C 0 20, 0 0, 20 0 Z')">
                    <div class="absolute top-4 left-3 w-7 h-7 bg-gray-950 border border-white rounded-full"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-center gap-3">
                        <div class="flex bg-gray-300 lg:bg-gray-200 w-45 h-9 items-center justify-center self-start ml-7">
                            <p
                                class="font-montserrat tracking-widest text-xl font-semibold text-green-800 leading-none">
                                VOTE IN
                            </p>
                        </div>
                        <div class="relative w-full px-7 h-35 flex items-center overflow-hidden">
                            <div class="flex w-full h-full border-2 border-white z-0">
                                <img src="https://picsum.photos/600?1"
                                    style="clip-path: polygon(0 0, 60% 0, 100% 100%, 0 100%);"
                                    class="h-full flex-1 min-w-0 object-cover">
                                <img src="https://picsum.photos/600?2"
                                    style="clip-path: polygon(0 0, 100% 0, 60% 100%, 40% 100%);"
                                    class="h-full flex-1 min-w-0 object-cover -ml-18">
                                <img src="https://picsum.photos/600?3"
                                    style="clip-path: polygon(40% 0, 100% 0, 100% 100%, 0 100%);"
                                    class="h-full flex-1 min-w-0 object-cover -ml-25">
                            </div>
                            <div class="absolute inset-0 bg-black/40 mx-7"></div>
                            <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                                <p
                                    class="text-white/90 font-montserrat text-3xl font-semibold tracking-widest z-2 thank-glow">
                                    Thank You
                                </p>
                                <p class="text-black font-gwendolyn text-5xl tracking-[0.2em] absolute z-1">
                                    Thank You
                                </p>
                            </div>
                        </div>
                        <p class="text-white font-montserrat text-lg lg:text-xs px-7 text-left mt-4 md:text-sm">
                            For participating in the selection of 2026/2027 PCC UKM Administrator Candidates.
                        </p>
                    </div>
                    <div class="absolute bottom-4 right-5 w-7 h-7 bg-gray-950 border border-white rounded-full"></div>
                </div>
            </div>
            <div class="absolute bottom-0 left-0 lg:scale-100 origin-left
                    w-38 h-10 bg-gray-300 lg:bg-gray-200 rounded-full flex items-center justify-center">
                <p class="font-handjet text-2xl font-bold text-green-800 leading-none">
                    VOTE IN
                </p>
            </div>
        </div>
    </section>
    <section class="mx-auto -mt-25 lg:mt-0 md:mt-10 lg:hidden">
        <button type="button" onclick="location.href='{{ route('logout') }}'"
            class="w-30 bg-gray-600/20 shadow-[6px_6px_2px_rgba(0,0,0,0.5)] rounded-xl text-white font-mono tracking-wide py-1.5 border border-white backdrop-blur-2xl hover:bg-indigo-950/80 hover:scale-100 hover:transition-all scale-105">
            Log Out
        </button>
    </section>
    <section class="hidden lg:flex absolute bottom-8 right-9">
        <button type="button" onclick="location.href='{{ route('logout') }}'"
            class="text-white font-mono tracking-wide py-4 md:py-6 flex-1 md:w-50 shadow-[6px_6px_2px_rgba(59,56,55,1)] lg:shadow-black/50 lg:text-2xl lg:py-1.5 lg:w-35 lg:rounded-2xl lg:border lg:border-white lg:bg-none lg:backdrop-blur-2xl lg:hover:bg-indigo-950/80 lg:hover:scale-95 lg:hover:transition-all">
            Log Out
        </button>
    </section>
</body>

</html>