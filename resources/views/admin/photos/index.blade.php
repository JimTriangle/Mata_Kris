<x-layouts.app title="Gestion de la galerie">
    <div class="admin-dashboard-modern">
        {{-- En-tête avec titre et action --}}
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Galerie photo</h1>
                <p class="dashboard-subtitle">Ajoutez et organisez vos photos de concerts</p>
            </div>
            <div>
                <a href="{{ route('admin.photos.create') }}" wire:navigate class="button-admin-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Ajouter une photo
                </a>
            </div>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div style="padding: 1rem; margin-bottom: 2rem; background: rgba(106, 153, 78, 0.1); border-left: 4px solid var(--color-spring); border-radius: 8px; color: var(--color-spring); font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Galerie de photos --}}
        @if($photos->isEmpty())
            <div class="empty-state-page">
                <div class="empty-icon-large">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2>Aucune photo</h2>
                <p>Votre galerie est vide. Commencez par ajouter une première photo !</p>
                <a href="{{ route('admin.photos.create') }}" wire:navigate class="button-admin-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                    </svg>
                    Ajouter votre première photo
                </a>
            </div>
        @else
            <div class="gallery-masonry">
                @foreach($photos as $photo)
                    <div class="gallery-item-masonry">
                        <img src="{{ $photo->image }}" alt="{{ $photo->legende }}">

                        {{-- Overlay avec légende et actions --}}
                        <div class="gallery-caption">
                            <p>{{ $photo->legende ?? 'Sans légende' }}</p>
                        </div>

                        {{-- Bouton de suppression --}}
                        <form action="{{ route('admin.photos.destroy', $photo) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette photo ?');" style="position: absolute; top: 1rem; right: 1rem; z-index: 10;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" style="width: 40px; height: 40px; background: rgba(255, 68, 68, 0.9); border: none; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);" onmouseover="this.style.background='rgba(255, 68, 68, 1)'; this.style.transform='scale(1.1)';" onmouseout="this.style.background='rgba(255, 68, 68, 0.9)'; this.style.transform='scale(1)';">
                                <svg style="width: 20px; height: 20px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </button>
                        </form>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div style="margin-top: 3rem;">
                {{ $photos->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
