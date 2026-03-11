<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin') - Regen 2026</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 dark:bg-gray-900 min-h-screen">

    {{-- Mobile overlay --}}
    <div id="sidebar-overlay"
         class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden"
         onclick="closeSidebar()"></div>

    <div class="flex min-h-screen">

        <x-admin.sidebar />

        <div class="flex-1 flex flex-col min-w-0">

            {{-- Mobile top bar --}}
            <header class="lg:hidden flex items-center gap-3 px-4 py-3 bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-30">
                <button onclick="openSidebar()"
                        class="p-1.5 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="text-base font-bold text-gray-800 dark:text-white">Regen 2026</span>
            </header>

            <main class="flex-1 overflow-y-auto">
                @yield('content')
            </main>

        </div>

    </div>

    @yield('scripts')

    <script>
        function openSidebar() {
            document.getElementById('sidebar').classList.remove('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.remove('hidden');
        }
        function closeSidebar() {
            document.getElementById('sidebar').classList.add('-translate-x-full');
            document.getElementById('sidebar-overlay').classList.add('hidden');
        }
    </script>

</body>
</html>
