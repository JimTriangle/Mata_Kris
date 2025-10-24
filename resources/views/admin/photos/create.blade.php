<x-layouts.app title="Ajouter une photo">
    <div class="admin-form-modern">
        <div class="form-header">
            <h1 class="form-title">Ajouter une nouvelle photo</h1>
            <p class="form-subtitle">Uploadez une image pour votre galerie de concerts</p>
        </div>

        <form action="{{ route('admin.photos.store') }}" method="POST" enctype="multipart/form-data" class="form-content">
            @csrf

            {{-- Zone de drag & drop avec prévisualisation --}}
            <div class="upload-zone-wrapper">
                <label for="photo" class="upload-zone" id="dropZone">
                    <input type="file" name="photo" id="photo" accept="image/*" class="upload-input" required>

                    <div class="upload-placeholder" id="uploadPlaceholder">
                        <div class="upload-icon">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"/>
                            </svg>
                        </div>
                        <div class="upload-text">
                            <p class="upload-title">Glissez-déposez votre image ici</p>
                            <p class="upload-subtitle">ou cliquez pour parcourir</p>
                        </div>
                        <div class="upload-formats">PNG, JPG, GIF (max. 5Mo)</div>
                    </div>

                    <div class="upload-preview" id="previewContainer" style="display: none;">
                        <img id="previewImage" src="" alt="Aperçu">
                        <button type="button" class="preview-remove" id="removePreview" aria-label="Supprimer">
                            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                        <div class="preview-overlay">
                            <p>Cliquez pour changer l'image</p>
                        </div>
                    </div>
                </label>

                @error('photo')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Légende --}}
            <div class="form-group-modern">
                <label for="legende" class="form-label-modern">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"/>
                    </svg>
                    Légende <span class="label-optional">(optionnel)</span>
                </label>
                <input
                    type="text"
                    name="legende"
                    id="legende"
                    placeholder="Ex: Concert à Lyon - Décembre 2024"
                    class="form-input-modern"
                >
                <p class="form-help">Cette légende sera affichée avec la photo dans la galerie</p>
            </div>

            {{-- Boutons d'action --}}
            <div class="form-actions-modern">
                <a href="{{ route('admin.photos.index') }}" class="button-admin-cancel" wire:navigate>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="button-admin-submit">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Enregistrer la photo
                </button>
            </div>
        </form>
    </div>

    <script>
        // Drag & Drop et prévisualisation
        const dropZone = document.getElementById('dropZone');
        const photoInput = document.getElementById('photo');
        const placeholder = document.getElementById('uploadPlaceholder');
        const previewContainer = document.getElementById('previewContainer');
        const previewImage = document.getElementById('previewImage');
        const removePreview = document.getElementById('removePreview');

        // Prévisualisation au changement de fichier
        photoInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                showPreview(file);
            }
        });

        // Drag & Drop
        dropZone.addEventListener('dragover', function(e) {
            e.preventDefault();
            dropZone.classList.add('drag-over');
        });

        dropZone.addEventListener('dragleave', function(e) {
            e.preventDefault();
            dropZone.classList.remove('drag-over');
        });

        dropZone.addEventListener('drop', function(e) {
            e.preventDefault();
            dropZone.classList.remove('drag-over');

            const files = e.dataTransfer.files;
            if (files.length > 0 && files[0].type.startsWith('image/')) {
                photoInput.files = files;
                showPreview(files[0]);
            }
        });

        // Supprimer la prévisualisation
        removePreview.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();
            photoInput.value = '';
            placeholder.style.display = 'flex';
            previewContainer.style.display = 'none';
        });

        function showPreview(file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                previewImage.src = e.target.result;
                placeholder.style.display = 'none';
                previewContainer.style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    </script>
</x-layouts.app>