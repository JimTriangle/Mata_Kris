<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />

<title>{{ $title ?? config('app.name') }}</title>

<link rel="icon" href="/favicon.ico" sizes="any">
<link rel="icon" href="/favicon.svg" type="image/svg+xml">
<link rel="apple-touch-icon" href="/apple-touch-icon.png">

<link rel="preconnect" href="https://fonts.bunny.net">
<link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

<!-- Script de gestion du thème global -->
<script>
    // Initialiser le thème avant le rendu de la page pour éviter le flash
    (function() {
        const theme = localStorage.getItem('theme') || 'light';
        // Important: enlever toute classe existante avant d'ajouter le thème
        document.documentElement.classList.remove('light', 'dark');
        document.documentElement.classList.add(theme);

        // Fonction globale pour toggle le thème
        window.toggleTheme = function() {
            const html = document.documentElement;
            const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

            html.classList.remove('light', 'dark');
            html.classList.add(newTheme);
            localStorage.setItem('theme', newTheme);

            // Dispatch event pour permettre aux composants de réagir
            window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: newTheme } }));
        };
    })();
</script>

@vite(['resources/css/app.css', 'resources/js/app.js'])
@livewireStyles
