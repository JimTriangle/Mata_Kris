<x-layouts.app title="Modifier un concert">
    <div class="admin-form-modern">
        <div class="form-header">
            <h1 class="form-title">Modifier le concert</h1>
            <p class="form-subtitle">Mettez à jour les informations de ce concert</p>
        </div>

        <form action="{{ route('admin.concerts.update', $concert) }}" method="POST" class="form-content">
            @csrf
            @method('PUT')

            {{-- Date du concert --}}
            <div class="form-group-modern">
                <label for="date" class="form-label-modern">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                    </svg>
                    Date du concert
                </label>
                <input
                    type="date"
                    name="date"
                    id="date"
                    class="form-input-modern"
                    required
                    value="{{ old('date', $concert->date->format('Y-m-d')) }}"
                >
                @error('date')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Ville --}}
            <div class="form-group-modern">
                <label for="ville" class="form-label-modern">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
                    </svg>
                    Ville
                </label>
                <input
                    type="text"
                    name="ville"
                    id="ville"
                    placeholder="Ex: Prades"
                    class="form-input-modern"
                    required
                    value="{{ old('ville', $concert->ville) }}"
                >
                @error('ville')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Lieu --}}
            <div class="form-group-modern">
                <label for="lieu" class="form-label-modern">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"/>
                    </svg>
                    Lieu
                </label>
                <input
                    type="text"
                    name="lieu"
                    id="lieu"
                    placeholder="Ex: Camping de Prades"
                    class="form-input-modern"
                    required
                    value="{{ old('lieu', $concert->lieu) }}"
                >
                @error('lieu')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div class="form-group-modern">
                <label for="description" class="form-label-modern">
                    <svg class="label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/>
                    </svg>
                    Description <span class="label-optional">(optionnel)</span>
                </label>
                <textarea
                    name="description"
                    id="description"
                    rows="4"
                    placeholder="Détails sur l'événement..."
                    class="form-input-modern"
                >{{ old('description', $concert->description) }}</textarea>
                <p class="form-help">Ajoutez des informations complémentaires sur le concert</p>
                @error('description')
                    <p class="form-error">{{ $message }}</p>
                @enderror
            </div>

            {{-- Boutons d'action --}}
            <div class="form-actions-modern">
                <a href="{{ route('admin.concerts.index') }}" class="button-admin-cancel" wire:navigate>
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                    Annuler
                </a>
                <button type="submit" class="button-admin-submit">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                    </svg>
                    Mettre à jour
                </button>
            </div>
        </form>
    </div>
</x-layouts.app>
