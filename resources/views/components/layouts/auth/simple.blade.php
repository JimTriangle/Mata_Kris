<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
    <head>
        <x-head />
    </head>
    {{-- On modifie le body pour qu'il ressemble au layout public --}}
    <body>
        {{-- Ajout du conteneur pour l'animation des feuilles --}}
        <div id="leaf-container"></div>

        {{-- Inclusion de l'en-tête du site public --}}
        @include('components.layouts.partials.header')

        <main style="background-color: transparent;">
            <div class="container">
                {{-- On utilise le style du formulaire de contact pour centrer et encadrer le contenu --}}
                <div class="contact-form" style="max-width: 500px;">
                    {{ $slot }}
                </div>
            </div>
        </main>

        {{-- Inclusion du pied de page du site public --}}
        @include('components.layouts.partials.footer')

        @fluxScripts
    </body>
</html>