<x-layouts.app title="Gestion des concerts">
    <div class="admin-dashboard-modern">
        {{-- En-tête avec titre et action --}}
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Gestion des concerts</h1>
                <p class="dashboard-subtitle">Gérez vos dates de concerts, lieux et descriptions</p>
            </div>
            <div>
                <a href="{{ route('admin.concerts.create') }}" wire:navigate class="button-admin-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Ajouter un concert
                </a>
            </div>
        </div>

        {{-- Message de succès --}}
        @if(session('success'))
            <div style="padding: 1rem; margin-bottom: 2rem; background: rgba(106, 153, 78, 0.1); border-left: 4px solid var(--color-spring); border-radius: 8px; color: var(--color-spring); font-weight: 500;">
                {{ session('success') }}
            </div>
        @endif

        {{-- Liste des concerts --}}
        @if($concerts->isEmpty())
            <div class="empty-state-page">
                <div class="empty-icon-large">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <h2>Aucun concert</h2>
                <p>Vous n'avez pas encore ajouté de concerts. Commencez par en créer un !</p>
                <a href="{{ route('admin.concerts.create') }}" wire:navigate class="button-admin-primary">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" style="width: 20px; height: 20px;">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                    </svg>
                    Ajouter votre premier concert
                </a>
            </div>
        @else
            <div class="concerts-timeline">
                @foreach($concerts as $concert)
                    <div class="concert-timeline-item">
                        <div class="concert-timeline-marker"></div>
                        <div class="concert-timeline-card">
                            {{-- Date Badge --}}
                            <div class="concert-date-badge">
                                <div class="badge-day">{{ \Carbon\Carbon::parse($concert->date)->format('d') }}</div>
                                <div class="badge-month">{{ \Carbon\Carbon::parse($concert->date)->translatedFormat('F') }}</div>
                                <div class="badge-year">{{ \Carbon\Carbon::parse($concert->date)->format('Y') }}</div>
                            </div>

                            {{-- Concert Info --}}
                            <div class="concert-info">
                                <h3 class="concert-ville">{{ $concert->ville }}</h3>
                                <p class="concert-lieu">
                                    <svg class="lieu-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                                    </svg>
                                    {{ $concert->lieu }}
                                </p>
                                @if($concert->description)
                                    <p class="concert-description">{{ $concert->description }}</p>
                                @endif
                            </div>

                            {{-- Actions --}}
                            <div class="concert-actions">
                                <a href="{{ route('admin.concerts.edit', $concert) }}" wire:navigate class="button-icon-round" title="Modifier">
                                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                    </svg>
                                </a>
                                <form action="{{ route('admin.concerts.destroy', $concert) }}" method="POST" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce concert ?');" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="button-icon-round" style="border-color: #ff4444;" title="Supprimer">
                                        <svg fill="none" stroke="#ff4444" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div style="margin-top: 3rem;">
                {{ $concerts->links() }}
            </div>
        @endif
    </div>
</x-layouts.app>
