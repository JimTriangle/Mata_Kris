<x-layouts.app title="Ajouter un concert">
    <h1 class="text-2xl font-bold mb-4">Ajouter un nouveau concert</h1>

    <div class="p-6 bg-white dark:bg-zinc-900 rounded-lg border">
        <form action="{{ route('admin.concerts.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <flux:input name="date" label="Date du concert" type="date" required />
            </div>
            <div>
                <flux:input name="ville" label="Ville" placeholder="Ex: Prades" required />
            </div>
            <div>
                <flux:input name="lieu" label="Lieu" placeholder="Ex: Camping de Prades" required />
            </div>
            <div>
                <flux:textarea name="description" label="Description (optionnel)" placeholder="Détails sur l'événement..." />
            </div>
<div class="flex justify-end space-x-4">
    {{-- On remplace flux:button par une balise <a> avec la nouvelle classe --}}
    <a href="{{ route('admin.concerts.index') }}" class="button-secondary" wire:navigate>Annuler</a>
    <button type="submit" class="button">Enregistrer</button> {{-- On garde la classe .button pour le bouton principal --}}
</div>
        </form>
    </div>
</x-layouts.app>