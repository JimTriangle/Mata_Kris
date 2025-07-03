@extends('components.layouts.public')

@section('content')
<div class="container">
    {{-- Section de bienvenue --}}
    <div class="hero">
        
        <p class="subtitle">Musique acoustique, entre ombres et lumières.</p>
        <p>Bienvenue sur notre site. Découvrez notre univers, nos prochaines dates de concert et notre galerie de souvenirs.</p>
    </div>

    {{-- Section des prochains concerts --}}
    <div class="prochains-concerts">
        <h2 class="section-title">Prochains Concerts</h2>
        <ul class="concert-list-home">
            @forelse ($prochains_concerts as $concert)
                <li>
                    <strong>{{ \Carbon\Carbon::parse($concert->date)->translatedFormat('d F Y') }}</strong> - {{ $concert->ville }} ({{ $concert->lieu }})
                </li>
            @empty
                <li>Aucun concert à venir pour le moment. Restez connectés !</li>
            @endforelse
        </ul>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('concerts') }}" class="button">Voir toutes les dates</a>
        </div>
    </div>

    <hr style="margin: 60px 0; border: 0; border-top: 1px solid #eee;">

    {{-- Section de la galerie photo --}}
    <div class="photos-recentes">
        <h2 class="section-title">Dernières Photos</h2>
        <div class="gallery-grid-home gallery-grid">
            @forelse ($photos_recentes as $photo)
                <div class="gallery-item">
                    <img src="{{ $photo->image_data_base64 }}" alt="{{ $photo->legende }}">
                </div>
            @empty
                <p style="text-align: center;">Aucune photo dans la galerie pour le moment.</p>
            @endforelse
        </div>
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('galerie') }}" class="button">Visiter la galerie</a>
        </div>
    </div>
</div>
@endsection