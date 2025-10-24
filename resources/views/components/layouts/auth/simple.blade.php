<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <x-head />
        <!-- Script de gestion du thème -->
        <script>
            (function() {
                const theme = localStorage.getItem('theme') || 'light';
                document.documentElement.classList.remove('light', 'dark');
                document.documentElement.classList.add(theme);

                window.toggleTheme = function() {
                    const html = document.documentElement;
                    const currentTheme = html.classList.contains('dark') ? 'dark' : 'light';
                    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

                    html.classList.remove('light', 'dark');
                    html.classList.add(newTheme);
                    localStorage.setItem('theme', newTheme);

                    window.dispatchEvent(new CustomEvent('theme-changed', { detail: { theme: newTheme } }));
                };
            })();
        </script>
    </head>
    <body class="dark:bg-zinc-900 dark:text-gray-100">
        {{-- Conteneur pour l'animation des feuilles --}}
        <div id="leaf-container"></div>

        {{-- En-tête du site public --}}
        @include('components.layouts.partials.header')

        <main class="auth-main">
            <div class="container">
                <div class="auth-container">
                    <div class="auth-card">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>

        {{-- Pied de page du site public --}}
        @include('components.layouts.partials.footer')

        @livewireScripts
    </body>
</html>