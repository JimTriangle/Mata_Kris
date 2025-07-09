<header>
    <div class="container">
        <h1><a href="{{ route('accueil') }}">Mata & Kris</a></h1>
        <p class="subtitle">Les Feuilles Chantantes</p>
        <nav>
            <a href="{{ route('accueil') }}" @class(['active' => request()->routeIs('accueil')])>Accueil</a>
            <a href="{{ route('concerts') }}" @class(['active' => request()->routeIs('concerts')])>Concerts</a>
            <a href="{{ route('galerie') }}" @class(['active' => request()->routeIs('galerie')])>Galerie</a>
            <a href="{{ route('contact') }}" @class(['active' => request()->routeIs('contact')])>Contact</a>
        </nav>
    </div>
</header>