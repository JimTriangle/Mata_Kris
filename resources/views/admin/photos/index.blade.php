<x-layouts.app title="Gestion de la galerie">
    <div class="flex justify-between items-center mb-4">
        <h1 class="text-2xl font-bold">Galerie photo</h1>
        <a href="{{ route('admin.photos.create') }}" wire:navigate>
            <flux:button variant="primary">Ajouter une photo</flux:button>
        </a>
    </div>

     @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
        @forelse($photos as $photo)
            <div class="relative group">
                <img class="h-auto max-w-full rounded-lg" src="{{ $photo->image }}" alt="{{ $photo->legende }}">
                <div class="absolute bottom-0 left-0 right-0 p-2 bg-black bg-opacity-50 text-white text-xs opacity-0 group-hover:opacity-100 transition-opacity">
                    {{ $photo->legende }}
                </div>
                <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?');" class="absolute top-2 right-2">
                    @csrf
                    @method('DELETE')
                    <flux:button type="submit" variant="danger" class="!p-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </flux:button>
                </form>
            </div>
        @empty
            <p class="col-span-full text-center">Aucune photo dans la galerie.</p>
        @endforelse
    </div>
     <div class="mt-4">
        {{ $photos->links() }}
    </div>
</x-layouts.app>