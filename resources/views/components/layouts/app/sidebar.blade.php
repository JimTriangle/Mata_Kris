<aside
    x-data="{
        open: ! $store.breakpoints.isXs,
    }"
    :class="open ? 'w-64' : 'w-20'"
    class="relative h-screen bg-white dark:bg-gray-900 border-r border-gray-200 dark:border-gray-800 flex flex-col shrink-0 transition-all duration-300"
>
    <div
        x-show="! $store.breakpoints.isXs"
        x-transition:enter="transition ease-in-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition ease-in-out duration-300"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        class="absolute top-3 -right-3 z-10"
    >
        <button
            @click="open = ! open"
            type="button"
            class="w-6 h-6 flex items-center justify-center rounded-full bg-gray-100 dark:bg-gray-950/50 border border-gray-200 dark:border-gray-800 text-gray-400 dark:text-gray-600"
        >
            <x-flux::icon name="chevrons-up-down" class="h-3.5 w-3.5" />
        </button>
    </div>
    <div class="h-16 flex items-center justify-center shrink-0">
        <a href="{{ route('admin.dashboard') }}" class="text-primary-600 dark:text-primary-400">
            <x-app-logo-icon ::class="open ? 'h-9 w-9' : 'h-10 w-10'" />
        </a>
    </div>
    <nav class="flex-1 flex flex-col overflow-y-auto">
        <div class="flex-1 space-y-1 p-3">
            <a
                href="{{ route('admin.dashboard') }}"
                @class([
                    'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                    'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.dashboard'),
                    'bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.dashboard'),
                ])
                :class="! open && 'justify-center'"
            >
                <x-flux::icon name="layout-grid" class="h-5 w-5 shrink-0" />
                <span x-show="open" x-transition>Tableau de bord</span>
            </a>

            {{-- LIEN CORRIGÉ --}}
            <a
                href="{{ route('admin.profile.edit') }}" {{-- <- LA CORRECTION EST ICI --}}
                @class([
                    'flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                    'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.profile.edit'),
                    'bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.profile.edit'),
                ])
                :class="! open && 'justify-center'"
            >
                <x-flux::icon name="user" class="h-5 w-5 shrink-0" />
                <span x-show="open" x-transition>Mon Profil</span>
            </a>

            <div x-data="{
                open: {{ request()->routeIs(['admin.concerts.*', 'admin.photos.*']) ? 'true' : 'false' }}
            }">
                <button
                    @click="open = ! open"
                    type="button"
                    class="w-full flex items-center justify-between gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                    :class="! open && 'justify-center'"
                >
                    <div class="flex items-center gap-3">
                        <x-flux::icon name="folder-git-2" class="h-5 w-5 shrink-0" />
                        <span x-show="open" x-transition>Contenu</span>
                    </div>
                    <x-flux::icon
                        name="chevron-down"
                        class="h-4 w-4 shrink-0 transition-transform"
                        x-show="open"
                        x-transition
                        ::class="open && 'rotate-180'"
                    />
                </button>
                <div x-show="open" x-collapse class="mt-1 space-y-1">
                    <a
                        href="{{ route('admin.concerts.index') }}"
                        @class([
                             'flex items-center gap-3 pl-11 pr-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                             'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.concerts.*'),
                             'bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.concerts.*'),
                        ])
                    >
                        Concerts
                    </a>
                    <a
                        href="{{ route('admin.photos.index') }}"
                        @class([
                             'flex items-center gap-3 pl-11 pr-3 py-2 rounded-md text-sm font-medium transition-colors duration-150',
                             'text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white' => ! request()->routeIs('admin.photos.*'),
                             'bg-primary-50 dark:bg-primary-500/10 text-primary-600 dark:text-primary-400' => request()->routeIs('admin.photos.*'),
                        ])
                    >
                        Photos
                    </a>
                </div>
            </div>
        </div>
        <div class="p-3 mt-auto">
            <div x-data="{ open: false }" class="relative">
                <button
                    @click="open = ! open"
                    type="button"
                    class="w-full flex items-center gap-3 p-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                    :class="! open && 'justify-center'"
                >
                    <img
                        src="{{ auth()->user()->getGravatar() }}"
                        alt="avatar"
                        class="h-8 w-8 rounded-full"
                    >
                    <div x-show="open" x-transition class="flex flex-col items-start">
                        <span class="font-semibold">{{ auth()->user()->name }}</span>
                        <span class="text-xs">{{ auth()->user()->email }}</span>
                    </div>
                </button>
                <div
                    x-show="open"
                    x-transition
                    @click.outside="open = false"
                    class="absolute bottom-full left-0 mb-2 w-full"
                >
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button
                            type="submit"
                            class="w-full flex items-center gap-3 px-3 py-2 rounded-md text-sm font-medium transition-colors duration-150 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-800 hover:text-gray-900 dark:hover:text-white"
                        >
                            <x-flux::icon name="log-out" class="h-5 w-5 shrink-0" />
                            <span>Déconnexion</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
</aside>