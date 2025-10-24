<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <x-head />
    </head>
    <body>
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