<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <x-head />
    </head>
    <body class="min-h-screen dark:bg-zinc-800">
        <div id="leaf-container"></div>

        <div class="admin-layout">
            <aside class="admin-sidebar">
                <div class="admin-sidebar-header">
                    <h3><a href="{{ route('admin.dashboard') }}">Mata & Kris<br/><span style="font-size: 1rem; font-family: var(--font-primary); font-weight: 300;">Panneau d'administration</span></a></h3>
                </div>

                <nav class="admin-sidebar-nav">
                    <ul>
                        <li>
                            <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                                Tableau de bord
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.concerts.index') }}" class="{{ request()->routeIs('admin.concerts.*') ? 'active' : '' }}">
                                Gérer les concerts
                            </a>
                        </li>
                        <li>
                             <a href="{{ route('admin.photos.index') }}" class="{{ request()->routeIs('admin.photos.*') ? 'active' : '' }}">
                                Gérer les photos
                            </a>
                        </li>
                    </ul>
                </nav>

                <div class="admin-sidebar-footer">
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <a href="{{ route('settings.profile') }}">Mon profil</a>
                    <span class="mx-2">|</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="logout-button">Déconnexion</button>
                    </form>
                </div>
            </aside>

            <main class="admin-content">
                {{-- Le contenu de chaque page admin viendra s'insérer ici --}}
                {{ $slot }}
            </main>
        </div>

        @fluxScripts
    </body>
</html>