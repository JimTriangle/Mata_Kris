<x-layouts.app title="Modifier un concert">
    <h1 class="text-2xl font-bold mb-4">Modifier le concert</h1>

    <div class="p-6 bg-white dark:bg-zinc-900 rounded-lg border">
        <form action="{{ route('admin.concerts.update', $concert) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            <div>
                <flux:input name="date" label="Date du concert" type="date" value="{{ $concert->date->format('Y-m-d') }}" required />
            </div>
            <div>
                <flux:input name="ville" label="Ville" value="{{ $concert->ville }}" required />
            </div>
            <div>
                <flux:input name="lieu" label="Lieu" value="{{ $concert->lieu }}" required />
            </div>
            <div>
                <flux:textarea name="description" label="Description (optionnel)">{{ $concert->description }}</flux:textarea>
            </div>
            <div class="flex justify-end space-x-4">
    {{-- On remplace flux:button par une balise <a> avec la nouvelle classe --}}
    <a href="{{ route('admin.concerts.index') }}" class="button-secondary" wire:navigate>Annuler</a>
    <button type="submit" class="button">Mettre à jour</button>
</div>
        </form>
    </div>
</x-layouts.app>