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

<body
    class="w-full min-h-screen flex flex-col py-10 pb-10 pt-8 bg-[radial-gradient(circle_at_0%_100%,rgba(67,37,137,0.8),transparent_30%),radial-gradient(circle_at_50%_0%,rgba(67,37,137,0.8),transparent_40%),linear-gradient(to_bottom,#020617,#000000)]">
    <div class="mx-auto w-max rounded-full bg-white/10 border-3 border-white/20 p-1.5 md:p-2.5 backdrop-blur-sm">
        <header class="flex items-center gap-0 bg-white px-2 py-1 rounded-full shadow-md">
            <img src="{{ asset('assets/img/polines.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/polines-2.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
            <img src="{{ asset('assets/img/pcc.png') }}" class="h-4 w-auto md:h-8 lg:h-6">
        </header>
    </div>
    <section class="flex flex-col gap-5 justify-center mx-10 mt-10 lg:mt-10 md:my-auto items-start md:items-center">
        <div class="max-w-100 mx-auto w-full md:w-1/2">
            <div class="w-max border border-white/60 rounded-xl px-3.5 py-0.5 bg-linear-to-r from-gray-600 to-gray-900">
                <p class="text-white text-2xl font-gabarito font-bold tracking-[.25em] lg:tracking-widest">
                    CHOOSE
                </p>
            </div>
        </div>
        <a href="{{ route("logout") }}" class="text-white bg-gray-600 to-gray-700 rounded-md px-2 py-1">
            Logout doang
        </a>
        <div class="w-full overflow-hidden">
            <div id="carousel" class="flex gap-6 transition-transform duration-500">
                @foreach($calon_admin as $c_adm)
                <div class="shrink-0 w-full md:w-1/2 lg:w-1/3 c-admin-card" data-id="{{ $c_adm->id }}">
                    <div
                        class="mx-auto w-full max-w-100 rounded-2xl bg-white/10 border-2 border-white/60 p-2 backdrop-blur-sm font-montserrat">
                        <div class="relative overflow-hidden rounded-2xl w-full h-130 shadow-lg">
                            <div class="absolute z-50 right-2 top-2 w-12 h-12 flex items-center justify-center">
                                <p class="text-red-600 font-bold text-5xl font-lemon filter drop-shadow-lg tracking-tighter"
                                    style="-webkit-text-stroke: 1.5px #000">
                                    {{ $c_adm->no_urut }}
                                </p>
                            </div>
                            <img src="{{ asset('storage/' . $c_adm->foto) }}"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div class="absolute bottom-0 w-full h-1/2 bg-black/20 backdrop-blur-md text-white p-4 pt-15 overflow-y-auto"
                                style="mask-image:linear-gradient(to top,black 75%,transparent 100%);
                                    -webkit-mask-image:linear-gradient(to top,black 75%,transparent 100%);">
                                <h3 class="font-bold text-lg mb-1 drop-shadow-2xl">
                                    {{ $c_adm->name }}
                                </h3>
                                <p class="text-sm font-semibold mb-1">Visi</p>
                                <p class="text-xs mb-3 opacity-90">
                                    {{ $c_adm->visi }}
                                </p>
                                <p class="text-sm font-semibold mb-1">Misi</p>
                                <p class="text-xs opacity-90">
                                    {{ $c_adm->misi }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        <div class="flex flex-row justify-center gap-12 lg:gap-16 mx-auto">
            <div onclick="prev()"
                class="cursor-pointer border border-white/60 rounded-full px-3 bg-linear-to-r from-gray-600 to-gray-900 lg:px-3.5 transition hover:scale-105">
                <p class="text-white text-2xl font-gabarito">
                    <i class="fa-solid fa-chevron-left text-white text-xl items-center"></i>
                </p>
            </div>
            <form id="frm_voting" method="poat" action="#">
                @csrf
                <input type="hidden" name="c_admin_id" id="c_admin_id">
                <button type="submit"
                    class="border border-white/60 rounded-xl px-3.5 py-1 bg-linear-to-r from-gray-600 to-gray-900 lg:px-3.5 transition hover:scale-105">
                    <p class="text-white text-2xl font-gabarito font-bold tracking-[.25em]">VOTE</p>
                </button>
            </form>
            <div onclick="next()"
                class="cursor-pointer border border-white/60 rounded-full px-3 bg-linear-to-r from-gray-600 to-gray-900 lg:px-3.5 transition hover:scale-105">
                <p class="text-white text-2xl font-gabarito"><i
                        class="fa-solid fa-chevron-right text-white text-xl items-center"></i></p>
            </div>
        </div>
    </section>

    <script>
        let idx = 0
        const carousel = document.getElementById("carousel")
        const camin = document.querySelectorAll(".c-admin-card")

        function update() {
            const cardW = camin[0].offsetWidth + 24
            const wrapW = carousel.parentElement.offsetWidth
            const center = (wrapW / 2) - (camin[0].offsetWidth / 2)
            carousel.style.transform = `translateX(${center - (idx * cardW)}px)`
            camin.forEach((card, i) => {
                if (i === idx) {
                    card.classList.remove("md:opacity-40", "md:blur-xs", "md:scale-95")
                    card.classList.add("scale-100")
                } else {
                    card.classList.add("md:opacity-40", "md:blur-xs", "md:scale-95")
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
        document.getElementById("frm_voting").addEventListener("submit", function() {
            const cardAktif = camin[idx]
            const idcAdm = cardAktif.dataset.id
            document.getElementById("c_admin_id").value = idcAdm
            console.log(document.getElementById("c_admin_id").value = idcAdm)
        })
    </script>
</body>

</html>