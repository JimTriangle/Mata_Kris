<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered(($user = User::create($validated))));

        Auth::login($user);

        $this->redirectIntended(route('admin.dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="auth-page">
    {{-- En-tête de la page --}}
    <div class="auth-header-section">
        <div class="auth-icon auth-icon-register">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
        </div>
        <h1 class="auth-title">Créer un compte</h1>
        <p class="auth-subtitle">Rejoignez l'espace d'administration Mata & Kris</p>
    </div>

    {{-- Formulaire d'inscription --}}
    <form wire:submit="register" class="auth-form">
        <div class="auth-form-group">
            <label for="name" class="auth-label">
                <svg class="auth-label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
                Nom complet
            </label>
            <input
                id="name"
                type="text"
                wire:model="name"
                class="auth-input"
                required
                autofocus
                autocomplete="name"
                placeholder="Votre nom"
            >
            @error('name')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-form-group">
            <label for="email" class="auth-label">
                <svg class="auth-label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
                </svg>
                Adresse email
            </label>
            <input
                id="email"
                type="email"
                wire:model="email"
                class="auth-input"
                required
                autocomplete="email"
                placeholder="votre@email.com"
            >
            @error('email')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-form-group">
            <label for="password" class="auth-label">
                <svg class="auth-label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                </svg>
                Mot de passe
            </label>
            <input
                id="password"
                type="password"
                wire:model="password"
                class="auth-input"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            >
            @error('password')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <div class="auth-form-group">
            <label for="password_confirmation" class="auth-label">
                <svg class="auth-label-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                Confirmer le mot de passe
            </label>
            <input
                id="password_confirmation"
                type="password"
                wire:model="password_confirmation"
                class="auth-input"
                required
                autocomplete="new-password"
                placeholder="••••••••"
            >
            @error('password_confirmation')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-button">
            <svg class="auth-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            Créer mon compte
        </button>
    </form>

    {{-- Lien de connexion --}}
    <div class="auth-footer">
        <span>Vous avez déjà un compte ?</span>
        <a href="{{ route('login') }}" wire:navigate class="auth-link-bold">
            Se connecter
        </a>
    </div>
</div>