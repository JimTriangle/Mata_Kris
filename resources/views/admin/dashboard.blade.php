<x-layouts.app title="Tableau de bord Admin">
    <div class="space-y-4">
        <h1 class="text-2xl font-bold">Tableau de bord de l'administration</h1>
        <p>Bienvenue dans l'espace d'administration de Mata & Kris. D'ici, vous pouvez gérer le contenu du site public.</p>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            {{-- Carte pour les concerts --}}
            <div class="p-4 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                <h2 class="text-xl font-semibold">Gérer les concerts</h2>
                <p class="mt-2 text-zinc-600 dark:text-zinc-400">Ajouter, modifier ou supprimer les dates de concerts à venir.</p>
                <div class="mt-4">
                    <a href="{{ route('admin.concerts.index') }}" wire:navigate>
                        <flux:button variant="primary">
                            Gérer les concerts
                        </flux:button>
                    </a>
                </div>
            </div>

            {{-- Carte pour les photos --}}
            <div class="p-4 bg-zinc-50 dark:bg-zinc-900 border border-zinc-200 dark:border-zinc-700 rounded-lg">
                <h2 class="text-xl font-semibold">Gérer la galerie</h2>
                <p class="mt-2 text-zinc-600 dark:text-zinc-400">Ajouter ou supprimer des photos de la galerie.</p>
                <div class="mt-4">
                     <a href="{{ route('admin.photos.index') }}" wire:navigate>
                        <flux:button variant="primary">
                            Gérer les photos
                        </flux:button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>