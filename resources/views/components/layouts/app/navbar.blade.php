<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    @include('partials.head')
</head>
<body class="min-h-screen bg-zinc-50 dark:bg-zinc-900">
    <!-- Navbar horizontale moderne -->
    <nav class="sticky top-0 z-50 bg-white dark:bg-gray-900 border-b border-gray-200 dark:border-gray-800 shadow-sm">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16">
                <!-- Logo et titre -->
                <div class="flex items-center gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 group">
                        <div class="w-10 h-10 flex items-center justify-center bg-gradient-to-br from-spring to-spring/80 rounded-lg group-hover:scale-110 transition-transform">
                            <x-app-logo-icon class="w-6 h-6" />
                        </div>
                        <span class="text-xl font-bold text-gray-900 dark:text-white hidden sm:block">Mata & Kris</span>
                    </a>

                    <div class="hidden md:block h-6 w-px bg-gray-300 dark:bg-gray-700"></div>

                    <!-- Navigation principale -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a
                            href="{{ route('admin.dashboard') }}"
                            @class([
                                'flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors',
                                'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.dashboard'),
                                'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('admin.dashboard'),
                            ])
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                            </svg>
                            <span>Tableau de bord</span>
                        </a>

                        <!-- Menu déroulant Contenu -->
                        <div x-data="{ open: false }" class="relative">
                            <button
                                @click="open = ! open"
                                @class([
                                    'flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors',
                                    'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs(['admin.concerts.*', 'admin.photos.*']),
                                    'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs(['admin.concerts.*', 'admin.photos.*']),
                                ])
                            >
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"/>
                                </svg>
                                <span>Contenu</span>
                                <svg class="w-4 h-4 transition-transform" :class="open && 'rotate-180'" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                                </svg>
                            </button>

                            <!-- Dropdown -->
                            <div
                                x-show="open"
                                x-transition
                                @click.outside="open = false"
                                class="absolute top-full left-0 mt-2 w-48 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
                            >
                                <a
                                    href="{{ route('admin.concerts.index') }}"
                                    @class([
                                        'flex items-center gap-3 px-4 py-3 text-sm transition-colors',
                                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.concerts.*'),
                                        'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' => ! request()->routeIs('admin.concerts.*'),
                                    ])
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                                    </svg>
                                    Concerts
                                </a>
                                <a
                                    href="{{ route('admin.photos.index') }}"
                                    @class([
                                        'flex items-center gap-3 px-4 py-3 text-sm transition-colors',
                                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.photos.*'),
                                        'text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700' => ! request()->routeIs('admin.photos.*'),
                                    ])
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                                    </svg>
                                    Photos
                                </a>
                            </div>
                        </div>

                        <a
                            href="{{ route('settings.profile') }}"
                            wire:navigate
                            @class([
                                'flex items-center gap-2 px-3 py-2 rounded-lg text-sm font-medium transition-colors',
                                'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('settings.*'),
                                'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('settings.*'),
                            ])
                        >
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            <span>Profil</span>
                        </a>
                    </div>
                </div>

                <!-- Actions à droite -->
                <div class="flex items-center gap-2">
                    <!-- Bouton retour au site -->
                    <a
                        href="{{ route('accueil') }}"
                        target="_blank"
                        class="hidden sm:flex items-center gap-2 px-3 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                        </svg>
                        <span class="hidden lg:inline">Voir le site</span>
                    </a>

                    <!-- Toggle thème -->
                    <button
                        onclick="window.toggleTheme()"
                        class="p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                        title="Changer de thème"
                    >
                        <svg class="w-5 h-5 hidden dark:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
                        </svg>
                        <svg class="w-5 h-5 dark:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
                        </svg>
                    </button>

                    <!-- Menu utilisateur -->
                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = ! open"
                            class="flex items-center gap-2 p-1.5 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg transition-colors"
                        >
                            <img
                                src="{{ auth()->user()->getGravatar() }}"
                                alt="{{ auth()->user()->name }}"
                                class="w-8 h-8 rounded-full ring-2 ring-gray-200 dark:ring-gray-700"
                            >
                            <span class="hidden lg:block text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</span>
                            <svg class="w-4 h-4 text-gray-500 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                            </svg>
                        </button>

                        <!-- Dropdown utilisateur -->
                        <div
                            x-show="open"
                            x-transition
                            @click.outside="open = false"
                            class="absolute right-0 top-full mt-2 w-56 bg-white dark:bg-gray-800 rounded-lg shadow-lg border border-gray-200 dark:border-gray-700 overflow-hidden"
                        >
                            <div class="px-4 py-3 border-b border-gray-200 dark:border-gray-700">
                                <p class="text-sm font-medium text-gray-900 dark:text-white">{{ auth()->user()->name }}</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400 truncate">{{ auth()->user()->email }}</p>
                            </div>
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                <button
                                    type="submit"
                                    class="w-full flex items-center gap-3 px-4 py-3 text-sm font-medium text-gray-700 dark:text-gray-300 hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                    </svg>
                                    Déconnexion
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Menu mobile burger -->
                    <button
                        @click="mobileMenuOpen = ! mobileMenuOpen"
                        x-data="{ mobileMenuOpen: false }"
                        class="md:hidden p-2 text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800 rounded-lg"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Menu mobile -->
        <div
            x-data="{ open: false }"
            x-show="open"
            x-transition
            class="md:hidden border-t border-gray-200 dark:border-gray-800 bg-white dark:bg-gray-900"
        >
            <div class="px-4 py-3 space-y-1">
                <a
                    href="{{ route('admin.dashboard') }}"
                    @class([
                        'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium',
                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.dashboard'),
                        'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('admin.dashboard'),
                    ])
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                    </svg>
                    Tableau de bord
                </a>
                <a
                    href="{{ route('admin.concerts.index') }}"
                    @class([
                        'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium',
                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.concerts.*'),
                        'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('admin.concerts.*'),
                    ])
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    Concerts
                </a>
                <a
                    href="{{ route('admin.photos.index') }}"
                    @class([
                        'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium',
                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.photos.*'),
                        'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('admin.photos.*'),
                    ])
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Photos
                </a>
                <a
                    href="{{ route('settings.profile') }}"
                    wire:navigate
                    @class([
                        'flex items-center gap-3 px-3 py-2 rounded-lg text-sm font-medium',
                        'bg-primary-50 dark:bg-primary-900/50 text-primary-600 dark:text-primary-400' => request()->routeIs('settings.*'),
                        'text-gray-700 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-800' => ! request()->routeIs('settings.*'),
                    ])
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                    Mon Profil
                </a>
            </div>
        </div>
    </nav>

    <!-- Contenu principal -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
