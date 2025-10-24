<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Mata & Kris</title>

    <!-- Script de gestion du thème global -->
    <script>
        // Initialiser le thème avant le rendu de la page pour éviter le flash
        (function() {
            const theme = localStorage.getItem('theme') || 'light';
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
</head>
<body>
    <div id="leaf-container"></div>

    @include('components.layouts.partials.header')

    <main>
        @yield('content')
    </main>

    @include('components.layouts.partials.footer')
</body>
</html>