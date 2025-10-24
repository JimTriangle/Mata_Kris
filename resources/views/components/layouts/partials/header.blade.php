<header>
    <div class="container">
        <!-- Bouton toggle thème -->
        <button onclick="window.toggleTheme()" class="theme-toggle" title="Changer de thème" aria-label="Changer de thème">
            <svg class="theme-icon sun-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"/>
            </svg>
            <svg class="theme-icon moon-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"/>
            </svg>
        </button>

        <h1>
            <a href="{{ route('accueil') }}" style="text-decoration: none;">
                <span class="hero-name mata">Mata</span>
                <span class="hero-separator">&</span>
                <span class="hero-name kris">Kris</span>
            </a>
        </h1>
        <p class="subtitle">Les Feuilles Chantantes</p>
        <nav>
            <a href="{{ route('accueil') }}" @class(['active' => request()->routeIs('accueil')])>Accueil</a>
            <a href="{{ route('concerts') }}" @class(['active' => request()->routeIs('concerts')])>Concerts</a>
            <a href="{{ route('galerie') }}" @class(['active' => request()->routeIs('galerie')])>Galerie</a>
            <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
        </nav>
    </div>
</header>