@extends('components.layouts.public')

@section('content')
{{-- Hero Section Moderne --}}
<div class="hero-modern">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">Duo de chant</div>
            <h1 class="hero-title">
                <span class="hero-name mata">Mata</span>
                <span class="hero-separator">&</span>
                <span class="hero-name kris">Kris</span>
            </h1>
            <p class="hero-subtitle">Les Feuilles Chantantes</p>
            <p class="hero-description">Musiques variées, entre ombres et lumières.<br>
            Découvrez notre univers, nos prochaines dates de concert et notre galerie de souvenirs.</p>
            <div class="hero-buttons">
                <a href="{{ route('concerts') }}" class="button button-primary">
                    <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Nos Concerts
                </a>
                <a href="{{ route('galerie') }}" class="button button-outline">
                    <svg class="button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Galerie
                </a>
            </div>
        </div>
    </div>
    <div class="hero-decoration"></div>
</div>

{{-- Section des prochains concerts --}}
<div class="section-concerts">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title-modern">
                <span class="section-icon">🎵</span>
                Prochains Concerts
            </h2>
            <p class="section-subtitle">Venez nous rencontrer lors de nos prochaines représentations</p>
        </div>

        <div class="concert-cards-home">
            @forelse ($prochains_concerts as $concert)
                <div class="concert-card-home">
                    <div class="concert-card-date">
                        <div class="concert-day">{{ \Carbon\Carbon::parse($concert->date)->format('d') }}</div>
                        <div class="concert-month">{{ \Carbon\Carbon::parse($concert->date)->translatedFormat('M') }}</div>
                    </div>
                    <div class="concert-card-details">
                        <h3 class="concert-card-title">{{ $concert->ville }}</h3>
                        <p class="concert-card-location">
                            <svg class="location-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                            </svg>
                            {{ $concert->lieu }}
                        </p>
                    </div>
                    <div class="concert-card-arrow">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                        </svg>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"/>
                    </svg>
                    <p>Aucun concert à venir pour le moment. Restez connectés !</p>
                </div>
            @endforelse
        </div>

        @if($prochains_concerts->count() > 0)
            <div class="section-cta">
                <a href="{{ route('concerts') }}" class="button button-primary">Voir toutes les dates</a>
            </div>
        @endif
    </div>
</div>

{{-- Section de la galerie photo --}}
<div class="section-gallery">
    <div class="container">
        <div class="section-header">
            <h2 class="section-title-modern">
                <span class="section-icon">📸</span>
                Dernières Photos
            </h2>
            <p class="section-subtitle">Nos derniers moments capturés en image</p>
        </div>

        <div class="gallery-grid-modern">
            @forelse ($photos_recentes as $photo)
                <div class="gallery-item-modern">
                    <img src="{{ $photo->image_data_base64 }}" alt="{{ $photo->legende }}">
                    @if($photo->legende)
                        <div class="gallery-overlay">
                            <p>{{ $photo->legende }}</p>
                        </div>
                    @endif
                </div>
            @empty
                <div class="empty-state">
                    <svg class="empty-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    <p>Aucune photo dans la galerie pour le moment.</p>
                </div>
            @endforelse
        </div>

        @if($photos_recentes->count() > 0)
            <div class="section-cta">
                <a href="{{ route('galerie') }}" class="button button-outline">Visiter la galerie complète</a>
            </div>
        @endif
    </div>
</div>
@endsection