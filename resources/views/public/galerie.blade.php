@extends('components.layouts.public')

@section('content')
<div class="container">
    <div class="page-header-modern">
        <h1 class="page-title-modern">
            <span class="title-icon">📸</span>
            Galerie Photos
        </h1>
        <p class="page-subtitle-modern">Revivez nos meilleurs moments en images</p>
    </div>

    @if($photos->count() > 0)
        <div class="gallery-masonry">
            @foreach ($photos as $index => $photo)
                <div class="gallery-item-masonry" style="animation-delay: {{ $index * 0.05 }}s" data-index="{{ $index }}">
                    <img src="{{ $photo->image_data_base64 }}" alt="{{ $photo->legende }}" loading="lazy" onclick="openLightbox({{ $index }})">
                    @if($photo->legende)
                        <div class="gallery-caption">
                            <p>{{ $photo->legende }}</p>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>

        {{-- Lightbox --}}
        <div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
            <button class="lightbox-close" onclick="closeLightbox(event)" aria-label="Fermer">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <button class="lightbox-prev" onclick="navigateLightbox(-1, event)" aria-label="Précédent">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </button>
            <button class="lightbox-next" onclick="navigateLightbox(1, event)" aria-label="Suivant">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                </svg>
            </button>
            <div class="lightbox-content">
                <img id="lightbox-img" src="" alt="">
                <div id="lightbox-caption" class="lightbox-caption-text"></div>
            </div>
        </div>

        <script>
            const photos = @json($photos->map(function($photo) {
                return [
                    'image' => $photo->image_data_base64,
                    'legende' => $photo->legende
                ];
            })->values());

            let currentPhotoIndex = 0;

            function openLightbox(index) {
                currentPhotoIndex = index;
                const lightbox = document.getElementById('lightbox');
                const img = document.getElementById('lightbox-img');
                const caption = document.getElementById('lightbox-caption');

                img.src = photos[index].image;
                img.alt = photos[index].legende || '';
                caption.textContent = photos[index].legende || '';
                caption.style.display = photos[index].legende ? 'block' : 'none';

                lightbox.classList.add('active');
                document.body.style.overflow = 'hidden';
            }

            function closeLightbox(event) {
                if (event.target.id === 'lightbox' || event.target.closest('.lightbox-close')) {
                    const lightbox = document.getElementById('lightbox');
                    lightbox.classList.remove('active');
                    document.body.style.overflow = '';
                }
            }

            function navigateLightbox(direction, event) {
                event.stopPropagation();
                currentPhotoIndex += direction;

                if (currentPhotoIndex < 0) currentPhotoIndex = photos.length - 1;
                if (currentPhotoIndex >= photos.length) currentPhotoIndex = 0;

                const img = document.getElementById('lightbox-img');
                const caption = document.getElementById('lightbox-caption');

                img.style.opacity = '0';
                setTimeout(() => {
                    img.src = photos[currentPhotoIndex].image;
                    img.alt = photos[currentPhotoIndex].legende || '';
                    caption.textContent = photos[currentPhotoIndex].legende || '';
                    caption.style.display = photos[currentPhotoIndex].legende ? 'block' : 'none';
                    img.style.opacity = '1';
                }, 200);
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                const lightbox = document.getElementById('lightbox');
                if (lightbox.classList.contains('active')) {
                    if (e.key === 'Escape') closeLightbox({ target: lightbox });
                    if (e.key === 'ArrowLeft') navigateLightbox(-1, e);
                    if (e.key === 'ArrowRight') navigateLightbox(1, e);
                }
            });
        </script>
    @else
        <div class="empty-state-page">
            <svg class="empty-icon-large" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/>
            </svg>
            <h2>Aucune photo dans la galerie</h2>
            <p>Les photos de nos concerts seront bientôt disponibles ici !</p>
            <a href="{{ route('accueil') }}" class="button button-primary">Retour à l'accueil</a>
        </div>
    @endif
</div>
@endsection