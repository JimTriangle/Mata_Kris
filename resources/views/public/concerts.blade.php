@extends('components.layouts.public')

@section('content')
<div class="container">
    <div class="page-header-modern">
        <h1 class="page-title-modern">
            <span class="title-icon">🎵</span>
            Nos Prochains Concerts
        </h1>
        <p class="page-subtitle-modern">Rejoignez-nous pour des moments musicaux uniques</p>
    </div>

    @if($concerts->count() > 0)
        <div class="concerts-timeline">
            @foreach ($concerts as $index => $concert)
                <div class="concert-timeline-item" style="animation-delay: {{ $index * 0.1 }}s">
                    <div class="concert-timeline-marker"></div>
                    <div class="concert-timeline-card">
                        <div class="concert-date-badge">
                            <div class="badge-day">{{ \Carbon\Carbon::parse($concert->date)->format('d') }}</div>
                            <div class="badge-month">{{ \Carbon\Carbon::parse($concert->date)->translatedFormat('M') }}</div>
                            <div class="badge-year">{{ \Carbon\Carbon::parse($concert->date)->format('Y') }}</div>
                        </div>
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
                        <div class="concert-actions">
                            <button class="button-icon-round" aria-label="Partager">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z"/>
                                </svg>
                            </button>
                            <button class="button-icon-round" aria-label="Ajouter au calendrier">
                                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @else
        <div class="empty-state-page">
            <svg class="empty-icon-large" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
            </svg>
            <h2>Aucun concert prévu pour le moment</h2>
            <p>Revenez bientôt pour découvrir nos prochaines dates !</p>
            <a href="{{ route('accueil') }}" class="button button-primary">Retour à l'accueil</a>
        </div>
    @endif
</div>
@endsection