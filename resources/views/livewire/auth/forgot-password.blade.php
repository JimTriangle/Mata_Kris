<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        Password::sendResetLink($this->only('email'));

        session()->flash('status', __('A reset link will be sent if the account exists.'));
    }
}; ?>

<div class="auth-page">
    {{-- En-tête de la page --}}
    <div class="auth-header-section">
        <div class="auth-icon" style="background: linear-gradient(135deg, #ff6b6b, #ee5a6f);">
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
        </div>
        <h1 class="auth-title">Mot de passe oublié</h1>
        <p class="auth-subtitle">Entrez votre adresse email pour recevoir un lien de réinitialisation</p>
    </div>

    <x-auth-session-status class="auth-status-message" :status="session('status')" />

    {{-- Formulaire de réinitialisation --}}
    <form wire:submit="sendPasswordResetLink" class="auth-form">
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
                autofocus
                autocomplete="email"
                placeholder="votre@email.com"
            >
            @error('email')
                <span class="auth-error">{{ $message }}</span>
            @enderror
        </div>

        <button type="submit" class="auth-button">
            <svg class="auth-button-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
            </svg>
            Envoyer le lien de réinitialisation
        </button>
    </form>

    {{-- Lien de retour --}}
    <div class="auth-footer">
        <span>Vous vous souvenez de votre mot de passe ?</span>
        <a href="{{ route('login') }}" wire:navigate class="auth-link-bold">
            Se connecter
        </a>
    </div>
</div>
