.<x-layouts.app title="Gestion des concerts">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Liste des concerts</h1>
        <a href="{{ route('admin.concerts.create') }}" wire:navigate>
            <flux:button variant="primary">Ajouter un concert</flux:button>
        </a>
    </div>

    @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto bg-white dark:bg-zinc-900 rounded-lg border">
        <table class="min-w-full text-sm text-left text-zinc-500 dark:text-zinc-400">
            <thead class="text-xs text-zinc-700 uppercase bg-zinc-50 dark:bg-zinc-800 dark:text-zinc-400">
                <tr>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Ville</th>
                    <th scope="col" class="px-6 py-3">Lieu</th>
                    <th scope="col" class="px-6 py-3">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($concerts as $concert)
                    <tr class="bg-white border-b dark:bg-zinc-900 dark:border-zinc-700">
                        <td class="px-6 py-4">{{ \Carbon\Carbon::parse($concert->date)->format('d/m/Y') }}</td>
                        <td class="px-6 py-4">{{ $concert->ville }}</td>
                        <td class="px-6 py-4">{{ $concert->lieu }}</td>
                        <td class="px-6 py-4 flex space-x-2">
    {{-- On remplace flux:button par une balise <a> avec la nouvelle classe --}}
    <a href="{{ route('admin.concerts.edit', $concert) }}" class="button-secondary" wire:navigate>Modifier</a>

    <form action="{{ route('admin.concerts.destroy', $concert) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce concert ?');">
        @csrf
        @method('DELETE')
        {{-- On remplace aussi le bouton de suppression par un bouton standard --}}
        <button type="submit" class="button-secondary" style="background-color: #ef4444; color: white;">Supprimer</button>
    </form>
</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="px-6 py-4 text-center">Aucun concert trouvé.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="mt-4">
        {{ $concerts->links() }}
    </div>
</x-layouts.app>
