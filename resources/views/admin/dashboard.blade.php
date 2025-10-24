<x-layouts.app title="Tableau de bord Admin">
    <div class="admin-dashboard-modern">
        {{-- En-tête avec bienvenue --}}
        <div class="dashboard-header">
            <div>
                <h1 class="dashboard-title">Bienvenue {{ auth()->user()->name }} 👋</h1>
                <p class="dashboard-subtitle">Gérez facilement votre site Mata & Kris</p>
            </div>
            <div class="dashboard-date">
                {{ \Carbon\Carbon::now()->translatedFormat('l d F Y') }}
            </div>
        </div>

        {{-- Statistiques rapides --}}
        <div class="stats-grid">
            <div class="stat-card stat-card-concerts">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    @php
                        try {
                            $concertCount = \App\Models\Concert::count();
                            $upcomingConcerts = \App\Models\Concert::where('date', '>=', now())->count();
                        } catch (\Exception $e) {
                            $concertCount = 0;
                            $upcomingConcerts = 0;
                        }
                    @endphp
                    <div class="stat-value">{{ $concertCount }}</div>
                    <div class="stat-label">Concerts</div>
                    <div class="stat-sublabel">{{ $upcomingConcerts }} à venir</div>
                </div>
            </div>

            <div class="stat-card stat-card-photos">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                </div>
                <div class="stat-content">
                    @php
                        try {
                            $photoCount = \App\Models\Photo::count();
                        } catch (\Exception $e) {
                            $photoCount = 0;
                        }
                    @endphp
                    <div class="stat-value">{{ $photoCount }}</div>
                    <div class="stat-label">Photos</div>
                    <div class="stat-sublabel">dans la galerie</div>
                </div>
            </div>

            <a href="{{ url('/') }}" target="_blank" class="stat-card stat-card-site" style="text-decoration: none; color: inherit; display: block;">
                <div class="stat-icon">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9"/>
                    </svg>
                </div>
                <div class="stat-content">
                    <div class="stat-value stat-value-text">En ligne</div>
                    <div class="stat-label">Site web</div>
                    <div class="stat-sublabel">
                        <span class="stat-link">Voir le site →</span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Actions rapides --}}
        <div class="quick-actions-section">
            <h2 class="section-title-admin">Actions rapides</h2>
            <div class="quick-actions-grid">
                <a href="{{ route('admin.concerts.create') }}" wire:navigate class="action-card">
                    <div class="action-icon action-icon-autumn">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Ajouter un concert</h3>
                        <p class="action-description">Créer une nouvelle date de concert</p>
                    </div>
                    <div class="action-arrow">→</div>
                </a>

                <a href="{{ route('admin.photos.create') }}" wire:navigate class="action-card">
                    <div class="action-icon action-icon-spring">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/>
                        </svg>
                    </div>
                    <div class="action-content">
                        <h3 class="action-title">Ajouter une photo</h3>
                        <p class="action-description">Uploader une nouvelle image</p>
                    </div>
                    <div class="action-arrow">→</div>
                </a>
            </div>
        </div>

        {{-- Gestion du contenu --}}
        <div class="content-management-section">
            <h2 class="section-title-admin">Gestion du contenu</h2>
            <div class="content-cards-grid">
                <div class="content-card">
                    <div class="content-card-header">
                        <h3 class="content-card-title">
                            <svg class="content-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                            </svg>
                            Concerts
                        </h3>
                    </div>
                    <p class="content-card-description">Gérez vos dates de concerts, lieux et descriptions</p>
                    <div class="content-card-actions">
                        <a href="{{ route('admin.concerts.index') }}" wire:navigate class="button-admin-primary">Gérer</a>
                        <a href="{{ route('admin.concerts.create') }}" wire:navigate class="button-admin-secondary">Ajouter</a>
                    </div>
                </div>

                <div class="content-card">
                    <div class="content-card-header">
                        <h3 class="content-card-title">
                            <svg class="content-card-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                            </svg>
                            Galerie photos
                        </h3>
                    </div>
                    <p class="content-card-description">Ajoutez et organisez vos photos de concerts</p>
                    <div class="content-card-actions">
                        <a href="{{ route('admin.photos.index') }}" wire:navigate class="button-admin-primary">Gérer</a>
                        <a href="{{ route('admin.photos.create') }}" wire:navigate class="button-admin-secondary">Ajouter</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>