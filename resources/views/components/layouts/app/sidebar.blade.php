 <!DOCTYPE html>
 <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

 <head>
     @include('partials.head')
 </head>

 <body class="admin-body">
     <div class="admin-layout">
         <!-- Sidebar -->
         <aside x-data="{
             open: window.innerWidth >= 1024,
             init() {
                 // Gérer le redimensionnement
                 window.addEventListener('resize', () => {
                     if (window.innerWidth >= 1024 && !this.open) {
                         this.open = true;
                     }
                 });
             }
         }" :class="{ 'admin-sidebar-collapsed': !open }" class="admin-sidebar">
             <!-- Toggle button -->
             <div class="admin-sidebar-toggle">
                 <button @click="open = ! open" type="button" class="toggle-button">

                     <svg class="toggle-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                             d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                     </svg>
                 </button>
             </div>

             <!-- Logo -->

             <div class="admin-sidebar-logo">
                 <a href="{{ route('admin.dashboard') }}" class="logo-link">
                     <x-app-logo-icon x-bind:class="open ? 'w-12 h-12' : 'w-10 h-10'" />
                 </a>
             </div>

             <!-- Navigation -->
             <nav class="admin-sidebar-nav">
                 <ul class="nav-items">
                     <li>
                         <a href="{{ route('admin.dashboard') }}" @class([
                             'nav-link',
                             'active' => request()->routeIs('admin.dashboard'),
                         ])>
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                             </svg>
                             <span class="nav-label" x-show="open" x-transition>Tableau de bord</span>
                         </a>
                     </li>
                     <li>
                         <a href="{{ route('settings.profile') }}" @class(['nav-link', 'active' => request()->routeIs('settings.*')]) wire:navigate>
                             <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                             </svg>
                             <span class="nav-label" x-show="open" x-transition>Mon Profil</span>
                         </a>
                     </li>
                     <li x-data="{ menuOpen: {{ request()->routeIs(['admin.concerts.*', 'admin.photos.*']) ? 'true' : 'false' }} }" class="nav-group">
                         <button @click="menuOpen = ! menuOpen" type="button" class="nav-link nav-link-button">
                             <span class="nav-group-title">
                                 <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                         d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z" />
                                 </svg>
                                 <span class="nav-label" x-show="open" x-transition>Contenu</span>
                             </span>
                             <svg x-show="open" class="w-4 h-4" :class="menuOpen && 'rotate-180'" fill="none"
                                 stroke="currentColor" viewBox="0 0 24 24">
                                 <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                     d="M19 9l-7 7-7-7" />
                             </svg>
                         </button>
                         <div x-show="menuOpen" x-collapse class="nav-submenu">
                             <a href="{{ route('admin.concerts.index') }}" @class([
                                 'nav-sublink',
                                 'active' => request()->routeIs('admin.concerts.*'),
                             ])>
                                 Concerts
                             </a>
                             <a href="{{ route('admin.photos.index') }}" @class([
                                 'nav-sublink',
                                 'active' => request()->routeIs('admin.photos.*'),
                             ])>
                                 Photos
                             </a>
                         </div>


                     </li>
                 </ul>

                 <!-- Bottom section -->

                 <div class="admin-sidebar-footer">
                     <!-- Voir le site -->
                     <a href="{{ route('accueil') }}" target="_blank" class="nav-link footer-link">

                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                         </svg>

                         <span class="nav-label" x-show="open" x-transition>Voir le site</span>
                     </a>

                     <!-- Theme toggle -->
                     <button onclick="window.toggleTheme()" class="nav-link footer-link" type="button">

                         <svg class="w-5 h-5 theme-icon theme-icon--light" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z" />
                         </svg>
                         <svg class="w-5 h-5 theme-icon theme-icon--dark" fill="none" stroke="currentColor"
                             viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                 d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z" />
                         </svg>


                         <span class="nav-label theme-label theme-label--light" x-show="open" x-transition>Mode
                             sombre</span>
                         <span class="nav-label theme-label theme-label--dark" x-show="open" x-transition>Mode
                             clair</span>
                     </button>

                     <!-- User menu -->

                     <div x-data="{ userOpen: false }" class="user-menu">
                         <button @click="userOpen = ! userOpen" type="button" class="nav-link footer-link">
                             <img src="{{ auth()->user()->getGravatar() }}" alt="avatar"
                                 class="w-8 h-8 rounded-full">
                             <div class="user-details" x-show="open" x-transition>
                                 <span class="user-name">{{ auth()->user()->name }}</span>
                                 <span class="user-email">{{ auth()->user()->email }}</span>
                             </div>
                         </button>
                         <div x-show="userOpen" x-transition @click.outside="userOpen = false" class="user-dropdown">
                             <form action="{{ route('logout') }}" method="post">
                                 @csrf
                                 <button type="submit" class="dropdown-link">
                                     <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                         <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                             d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
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
         <main class="admin-content">
             <div class="admin-content-inner">
                 {{ $slot }}
             </div>
         </main>
     </div>

     @livewireScripts
 </body>

 </html>
