@vite(['resources/css/app.css', 'resources/js/app.js'])

<!-- code untuk tempat logo pcc -->
<div id="intro-screen" class="fixed inset-0 z-[9999] flex items-center justify-center bg-black">
    <div class="relative inline-block">
        <img id="intro-logo"
            src="{{ asset('assets/img/pcc.png') }}"
            alt="pcc"
            class="w-28 mx-auto opacity-0">
    </div>
</div>