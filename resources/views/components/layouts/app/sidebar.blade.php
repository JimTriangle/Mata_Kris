<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <aside
            x-data="{
                open: window.innerWidth >= 1024,
                init() {
                    // Gérer le redimensionnement
                    window.addEventListener('resize', () => {
                        if (window.innerWidth >= 1024 && !this.open) {
                            this.open = true;
                        }
                    });
                }
            }"
            :class="open ? 'w-64' : 'w-20'"
            class="relative h-screen bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 flex flex-col shrink-0 transition-all duration-300 sticky top-0"
        >
            <!-- Toggle button -->
            <div class="absolute top-3 -right-3 z-10 hidden lg:block">
                <button
                    @click="open = ! open"
                    type="button"
                    class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-800 border border-gray-200 dark:border-gray-700 text-gray-600 dark:text-gray-400 hover:bg-gray-200 dark:hover:bg-gray-700"
                >
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"/>
                    </svg>
                </button>
            </div>

            <!-- Logo -->
            <div class="h-16 flex items-center justify-center shrink-0 border-b border-gray-200 dark:border-gray-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-center">
                    <x-app-logo-icon x-bind:class="open ? 'w-12 h-12' : 'w-10 h-10'" />
                </a>
            </div>

            <!-- Navigation -->
            <nav class="flex-1 flex flex-col overflow-y-auto">
                <div class="flex-1 space-y-1 p-3">
                    <a
                        href="{{ route('admin.dashboard') }}"
                        @class([
                            'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                            'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.dashboard'),
                            'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.dashboard'),
                        ])
                        :class="! open && 'justify-center'"
                    >
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                        </svg>
                        <span x-show="open" x-transition>Tableau de bord</span>
                    </a>

                    <a
                        href="{{ route('settings.profile') }}"
                        @class([
                            'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                            'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('settings.*'),
                            'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('settings.*'),
                        ])
                        :class="! open && 'justify-center'"
                        wire:navigate
                    >
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                        </svg>
                        <span x-show="open" x-transition>Mon Profil</span>
                    </a>

                    <div x-data="{ menuOpen: {{ request()->routeIs(['admin.concerts.*', 'admin.photos.*']) ? 'true' : 'false' }} }">
                        <button
                            @click="menuOpen = ! menuOpen"
                            type="button"
                            class="w-full flex items-center justify-between gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                            :class="! open && 'justify-center'"
                        >
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                </svg>
                                <span x-show="open" x-transition>Contenu</span>
                            </div>
                            <svg
                                x-show="open"
                                class="w-4 h-4 shrink-0 transition-transform"
                                :class="menuOpen && 'rotate-180'"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>
                        <div x-show="menuOpen" x-collapse class="mt-1 space-y-1">
                            <a
                                href="{{ route('admin.concerts.index') }}"
                                @class([
                                     'flex items-center gap-3 pl-11 pr-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                                     'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.concerts.*'),
                                     'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.concerts.*'),
                                ])
                            >
                                Concerts
                            </a>
                            <a
                                href="{{ route('admin.photos.index') }}"
                                @class([
                                     'flex items-center gap-3 pl-11 pr-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                                     'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.photos.*'),
                                     'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.photos.*'),
                                ])
                            >
                                Photos
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Bottom section -->
                <div class="p-3 mt-auto border-t border-gray-200 dark:border-gray-800 space-y-2">
                    <!-- Voir le site -->
                    <a
                        href="{{ route('accueil') }}"
                        target="_blank"
                        class="w-full flex items-center gap-3 p-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                        :class="! open && 'justify-center'"
                    >
                        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span x-show="open" x-transition>Voir le site</span>
                    </a>

                    <!-- Theme toggle -->
                    <button
                        onclick="window.toggleTheme()"
                        class="w-full flex items-center gap-3 p-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                        :class="! open && 'justify-center'"
                    >
                        <svg class="w-5 h-5 shrink-0 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="w-5 h-5 shrink-0 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                        <span x-show="open" x-transition class="dark:hidden">Mode sombre</span>
                        <span x-show="open" x-transition class="hidden dark:inline">Mode clair</span>
                    </button>

                    <!-- User menu -->
                    <div x-data="{ userOpen: false }" class="relative">
                        <button
                            @click="userOpen = ! userOpen"
                            type="button"
                            class="w-full flex items-center gap-3 p-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                            :class="! open && 'justify-center'"
                        >
                            <img
                                src="{{ auth()->user()->getGravatar() }}"
                                alt="avatar"
                                class="w-8 h-8 rounded-full"
                            >
                            <div x-show="open" x-transition class="flex flex-col items-start flex-1 text-left">
                                <span class="font-semibold text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                                <span class="text-xs text-gray-500 dark:text-gray-400 truncate w-full">{{ auth()->user()->email }}</span>
                            </div>
                        </button>
                        <div
                            x-show="userOpen"
                            x-transition
                            @click.outside="userOpen = false"
                            class="absolute bottom-full left-0 mb-2 w-full bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
                        >
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full flex items-center gap-3 px-3 py-2 text-sm font-medium transition-colors duration-150 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    <span>Déconnexion</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </nav>
        </aside>

        <!-- Main content -->
        <main class="flex-1 overflow-auto">
            <div class="p-6">
                {{ $slot }}
            </div>
        </main>
    </div>

    @livewireScripts
</body>
</html>
