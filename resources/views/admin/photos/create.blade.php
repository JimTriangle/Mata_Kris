<x-layouts.app title="Ajouter une photo">
    <h1 class="text-2xl font-bold mb-4">Ajouter une nouvelle photo</h1>

    <div class="p-6 bg-white dark:bg-zinc-900 rounded-lg border">
        <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            <div>
                <label for="photo" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fichier image</label>
                <input type="file" name="photo" id="photo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" required>
                <p class="mt-1 text-sm text-gray-500 dark:text-gray-300">PNG, JPG, GIF (MAX. 5Mo).</p>
                 @error('photo')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div>
                <flux:input name="legende" label="Légende (optionnel)" placeholder="Ex: Concert à Lyon" />
            </div>

            <div class="flex justify-end space-x-4">
    {{-- On remplace flux:button par une balise <a> avec la nouvelle classe --}}
    <a href="{{ route('admin.photos.index') }}" class="button-secondary" wire:navigate>Annuler</a>
    <button type="submit" class="button">Enregistrer</button>
</div>
        </form>
    </div>
</x-layouts.app>