<aside id="sidebar"
       class="fixed inset-y-0 left-0 z-50 w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col
              -translate-x-full transition-transform duration-300 ease-in-out
              lg:relative lg:translate-x-0 lg:w-60 lg:shrink-0 lg:z-auto">

    <div class="px-6 py-5 border-b border-gray-100 dark:border-gray-700 flex items-center justify-between">
        <div>
            <h1 class="text-lg font-bold text-gray-800 dark:text-white leading-tight">Regen 2026</h1>
            <p class="text-xs text-gray-400 dark:text-gray-500 mt-0.5">Panel Admin</p>
        </div>
        <button onclick="closeSidebar()"
                class="lg:hidden p-1 rounded-lg text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    <nav class="flex-1 px-3 py-4 space-y-1">
        {{-- Dashboard --}}
        <a href="{{ route('admin.dashboard') }}" onclick="closeSidebar()"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                  {{ request()->routeIs('admin.dashboard') ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H15a.75.75 0 01-.75-.75v-5.25h-4.5V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z"/>
            </svg>
            Dashboard
        </a>

        {{-- Peserta --}}
        <a href="{{ route('peserta.index') }}" onclick="closeSidebar()"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                  {{ request()->routeIs('peserta.*') ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 20h5v-1a4 4 0 00-5.356-3.779M9 20H4v-1a4 4 0 015.356-3.779M15 7a4 4 0 11-8 0 4 4 0 018 0zm6 4a3 3 0 11-6 0 3 3 0 016 0zM3 11a3 3 0 116 0 3 3 0 01-6 0z"/>
            </svg>
            Peserta
        </a>

        {{-- Calon Admin --}}
        <a href="{{ route('camin.index') }}" onclick="closeSidebar()"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium transition-colors duration-200
                  {{ request()->routeIs('camin.*') ? 'bg-blue-600 text-white' : 'text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700' }}">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M5.121 17.804A9 9 0 1118.88 6.196M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
            </svg>
            Calon Admin
        </a>
    </nav>

    {{-- Logout --}}
    <div class="px-3 py-4 border-t border-gray-100 dark:border-gray-700">
        <a href="{{ route('logout') }}"
           class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium text-red-500 hover:bg-red-50 dark:hover:bg-red-950 transition-colors duration-200">
            <svg class="w-4 h-4 shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 01-2 2H5a2 2 0 01-2-2V7a2 2 0 012-2h6a2 2 0 012 2v1"/>
            </svg>
            Logout
        </a>
    </div>
</aside>
