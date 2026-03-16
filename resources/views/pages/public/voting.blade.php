<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Choose the Next Administrator</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/img/pcc.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    @vite('resources/css/app.css', 'resources/js/app.js')
</head>

<body class="w-full min-h-screen flex flex-col py-10 pb-10 pt-8 bg-purple bg-desktop overflow-x-hidden">
    <div id="votingPage">
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
        <section
            class="flex flex-col gap-5 justify-center mx-10 lg:mx-0 mt-10 lg:mt-10 md:my-auto items-start md:items-center relative md:mt-15">
            <div
                class="text-white px-15 py-0.5 bg-linear-to-r from-gray-600 via-purple-600 to-indigo-950 rounded-2xl border border-white/40 tracking-wide hidden lg:flex">
                <p class="text-white text-2xl font-gabarito font-bold tracking-[.25em]">
                    CHOOSE YOUR CANDIDATE
                </p>
            </div>
            <div
                class="lg:hidden max-w-100 mx-auto w-full md:w-1/2 absolute left-0 right-0 top-5 md:relative md:top-16">
                <div
                    class="w-max border border-white/60 rounded-xl px-3.5 py-0.5 bg-linear-to-r from-gray-600 to-gray-900">
                    <p class="text-white text-2xl font-gabarito font-bold tracking-[.25em]">
                        CHOOSE
                    </p>
                </div>
            </div>
            <div class="w-full overflow-hidden pt-18 lg:pt-8 lg:pr-6">
                <div id="carousel" class="flex gap-6 lg:gap-2 transition-transform duration-500">
                    @foreach($calon_admin as $c_adm)
                        <div class="shrink-0 w-full md:w-[50%] lg:w-[28%] c-admin-card" data-id="{{ $c_adm->id }}">
                            <div
                                class="mx-auto w-full max-w-100 rounded-2xl bg-white/10 border-2 border-white/60 p-2 lg:p-3 backdrop-blur-sm font-montserrat">
                                <div class="relative rounded-2xl w-full h-130 lg:h-150 shadow-lg">
                                    <div
                                        class="hidden lg:flex absolute -top-8 -right-8 z-50 w-15 h-15 items-center justify-center rounded-full bg-gray-600/95 border border-white/60 shadow-lg">
                                        <p class="text-white text-4xl font-bold font-montaga items-center"
                                            style="-webkit-text-stroke: 0.1px #7520b6;">
                                            {{ $c_adm->no_urut }}
                                        </p>
                                    </div>
                                    {{-- nourut mobilr --}}
                                    <div
                                        class="lg:hidden absolute -top-9 -right-2.5 z-50 w-16 h-16 flex items-center justify-center rounded-full bg-gray-600/90 shadow-lg">
                                        <p class="text-4xl font-bold text-red-500 font-lemon items-center"
                                            style="-webkit-text-stroke: 0.1px #000;">
                                            {{ $c_adm->no_urut }}
                                        </p>
                                    </div>
                                    <img src="{{ asset('storage/' . $c_adm->foto) }}"
                                        class="absolute inset-0 w-full h-full object-cover rounded-2xl">
                                    <div class="caminOverlay absolute bottom-0 w-full h-1/2 bg-black/60 backdrop-blur-md text-white p-4 pt-15 overflow-hidden rounded-b-2xl scb-hide mask-transparan z-30 pointer-event-auto">
                                        <div class="fade-btm h-full pb-5 rounded-b-2xl">
                                            <button type="button"
                                                class="btn-selengkapnya flex flex-row gap-2 items-center justify-end mb-2 ml-auto">
                                                <i class="fa-solid fa-chevron-up"></i>
                                                <p class="text-xs">Selengkapnya</p>
                                            </button>
                                            <h3 class="font-bold text-lg mb-1 drop-shadow-2xl lg:text-2xl">
                                                {{ $c_adm->name }}
                                            </h3>
                                            <p class="text-sm font-semibold mb-1 lg:text-lg">Visi</p>
                                            <p class="text-xs mb-3 opacity-90 lg:text-sm">
                                                {{ $c_adm->visi }}
                                            </p>
                                            <p class="text-sm font-semibold mb-1 lg:text-lg">Misi</p>
                                            <p class="text-xs opacity-90 lg:text-sm">
                                                {{ $c_adm->misi }}
                                            </p>
                                            <button type="button"
                                                class="btn-tutup hidden flex flex-row gap-2 items-center justify-end mt-5 ml-auto mr-4">
                                                <i class="fa-solid fa-chevron-down"></i>
                                                <p class="text-xs">Tutup</p>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <form method="post" action="{{ route('vote-in') }}"
                                class="frm_voting hidden lg:flex justify-center mt-5">
                                @csrf
                                <input type="hidden" name="c_admin_id" class="c_admin_id">
                                <button type="submit"
                                    class="rounded-xl py-2 bg-linear-to-r from-indigo-600 via-indigo-500 to-indigo-600 transition hover:scale-95 px-15 mb-8 shadow-lg lg:hover:bg-linear-to-r lg:hover:from-indigo-900 lg:hover:via-indigo-700 lg:hover:to-indigo-900 lg:hover:scale-98 lg:transition-all">
                                    <p class="text-white text-2xl font-montaga tracking-[.25em]">VOTE</p>
                                </button>
                            </form>
                        </div>
                    @endforeach
                </div>
            </div>
            {{-- muncul mobilr only --}}
            <div class="flex items-center justify-between w-full max-w-xs mx-auto lg:hidden">
                <div onclick="prev()"
                    class="cursor-pointer border border-white/60 rounded-full w-10 h-10 flex items-center justify-center bg-linear-to-r from-gray-600 to-gray-900">
                    <p class="text-white text-2xl font-gabarito text-center">
                        <i class="fa-solid fa-chevron-left text-white text-xl items-center"></i>
                    </p>
                </div>
                <form class="frm_voting" method="poat" action="#">
                    @csrf
                    <input type="hidden" name="c_admin_id" class="c_admin_id">
                    <button type="submit"
                        class="border border-white/60 rounded-xl px-3.5 py-1 bg-linear-to-r from-gray-600 to-gray-900  transition hover:scale-105">
                        <p class="text-white text-2xl font-gabarito font-bold tracking-[.25em]">VOTE</p>
                    </button>
                </form>
                <div onclick="next()"
                    class="cursor-pointer border border-white/60 rounded-full w-10 h-10 flex items-center justify-center bg-linear-to-r from-gray-600 to-gray-900">
                    <p class="text-white text-2xl font-gabarito text-center"><i
                            class="fa-solid fa-chevron-right text-white text-xl items-center"></i></p>
                </div>
            </div>
        </section>
        {{-- dsktop btn --}}
        <div class="hidden lg:flex absolute flex-row justify-between gap-12 mx-auto my-auto px-10 w-full top-[70%] z-0 pointer-events-none">
            <div onclick="prev()"
                class="pointer-events-auto cursor-pointer border border-white/60 rounded-full w-14 h-14 bg-linear-to-l from-gray-600 to-gray-950 flex items-center justify-center transition hover:scale-95">
                <i class="fa-solid fa-chevron-left text-white text-xl"></i>
            </div>
            <div onclick="next()"
                class="pointer-events-auto cursor-pointer border border-white/60 rounded-full w-14 h-14 bg-linear-to-r from-purple-400 to-indigo-900 flex items-center justify-center transition hover:scale-95">
                <i class="fa-solid fa-chevron-right text-white text-xl"></i>
            </div>
        </div>
    </div>

    {{-- confirm popup --}}
    <div id="confirmOverlay" class="hidden fixed inset-0 z-999 items-center justify-center">
        <div class="absolute inset-0 backdrop-blur-sm hidden lg:block"></div>
        <div class="relative z-10">
            <form id="confirm_form" action="{{ route('vote-in') }}" method="post" class="my-auto">
                @csrf
                <input type="hidden" name="c_admin_id" id="confirm_id">
                <section class="flex flex-col justify-center gap-8">
                    <div
                        class="shadow-[6px_6px_2px_rgba(59,56,55,1)] lg:shadow-black/50 py-6 px-1 text-center bg-linear-to-b from-gray-800 to-gray-600 m-auto mx-12 rounded-2xl border border-white md:w-110 md:py-12 md:mx-auto lg:bg-none lg:backdrop-blur-2xl">
                        <p class="font-mono tracking-wide text-white mx-10 text-xl md:text-2xl">
                            Choose it wisely.<br>
                            Are you sure about your choice?
                        </p>
                    </div>

                    <div class="flex w-full gap-5 md:gap-15 px-12 md:px-0 md:w-auto md:mx-auto">
                        <button type="button" onclick="tutupConfirm()"
                            class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-4 md:py-6 flex-1 md:w-50 shadow-[6px_6px_2px_rgba(59,56,55,1)] lg:shadow-black/50 lg:text-2xl lg:py-1.5 lg:w-35 lg:rounded-2xl lg:border lg:border-white lg:bg-none lg:backdrop-blur-2xl lg:hover:bg-indigo-950/80 lg:hover:scale-95 lg:hover:transition-all">
                            Back
                        </button>

                        <button type="submit"
                            class="bg-linear-to-r from-gray-400 to-gray-600 rounded-full text-white font-mono tracking-wide py-4 md:py-6 flex-1 md:w-50 shadow-[6px_6px_2px_rgba(59,56,55,1)] lg:shadow-black/50 lg:text-2xl lg:py-1.5 lg:w-35 lg:rounded-2xl lg:border lg:border-white lg:bg-none lg:backdrop-blur-2xl lg:hover:bg-indigo-950/80 lg:hover:scale-95 lg:hover:transition-all">
                            Confirm
                        </button>
                    </div>
                </section>
            </form>
        </div>
    </div>

    <script>
        const carousel = document.getElementById("carousel")
        const camin = document.querySelectorAll(".c-admin-card")
        let caminCard = 1
        if (window.innerWidth >= 1024) {
            caminCard = 3
        } else
            if (window.innerWidth >= 768) {
                caminCard = 2
            }
        let idx = Math.floor(caminCard / 2)
        function update() {
            const gap = parseInt(getComputedStyle(carousel).gap || 0)
            const cardW = camin[0].offsetWidth + gap
            const wrapW = carousel.parentElement.offsetWidth
            const center = (wrapW / 2) - (camin[0].offsetWidth / 2)
            carousel.style.transform = `translateX(${center - (idx * cardW)}px)`
            camin.forEach((card, i) => {
                if (i === idx) {
                    card.classList.remove("md:opacity-40", "md:blur-xs", "md:scale-75")
                    card.classList.add("scale-100", "transition")
                } else {
                    card.classList.add("md:opacity-40", "md:blur-xs", "md:scale-75")
                }
            })
        }
        function next() {
            if (idx < camin.length - 1) {
                idx++
                update()
            }
        }
        function prev() {
            if (idx > 0) {
                idx--
                update()
            }
        }
        update()

        function bukaConfirm(id) {
            document.getElementById("confirm_id").value = id
            const ovl = document.getElementById("confirmOverlay")
            const vtgPage = document.getElementById("votingPage")
            ovl.classList.remove("hidden")
            ovl.classList.add("flex")

            //mbl
            if (window.innerWidth < 1024) {
                vtgPage.classList.add("hidden")
            }
        }
        function tutupConfirm() {
            const ovl = document.getElementById("confirmOverlay")
            const vtgPage = document.getElementById("votingPage")
            ovl.classList.add("hidden")
            ovl.classList.remove("flex")
            vtgPage.classList.remove("hidden")
        }

        document.querySelectorAll(".frm_voting").forEach(form => {
            form.addEventListener("submit", function (e) {
                e.preventDefault()
                const cardAktif = camin[idx]
                const idcAdm = cardAktif.dataset.id
                bukaConfirm(idcAdm)
                console.log(idcAdm)
            })
        })
        document.querySelectorAll(".c-admin-card").forEach(card => {
            const caminOverlay = card.querySelector(".caminOverlay")
            const btnSelengkapnya = card.querySelector(".btn-selengkapnya")
            const btnTutup = card.querySelector(".btn-tutup")
            btnSelengkapnya.addEventListener("click", () => {
                caminOverlay.classList.remove("h-1/2","mask-transparan","pt-15","overflow-hidden")
                caminOverlay.classList.add("h-full","rounded-t-2xl","pt-8","overflow-y-auto")
                btnSelengkapnya.classList.add("hidden")
                btnTutup.classList.remove("hidden")
            })
            btnTutup.addEventListener("click", () => {
                caminOverlay.classList.remove("h-full","rounded-t-2xl","pt-8","overflow-y-auto")
                caminOverlay.classList.add("h-1/2","mask-transparan","pt-15","overflow-hidden")
                btnTutup.classList.add("hidden")
                btnSelengkapnya.classList.remove("hidden")
                // console.log("tutup ininya")
            })
        })
    </script>
</body>

</html>