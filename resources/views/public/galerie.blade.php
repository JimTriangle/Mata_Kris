@extends('layouts.public')

@section('content')
<div class="container">
    <h1>Galerie</h1>
    <div class="gallery-grid">
        @forelse ($photos as $photo)
            <div class="gallery-item">
                {{-- La source de l'image est directement les données Base64 de la BDD --}}
                <img src="{{ $photo->image_data_base64 }}" alt="{{ $photo->legende }}">
            </div>
        @empty
            <p>Aucune photo dans la galerie pour le moment.</p>
        @endforelse
    </div>
</div>
@endsection