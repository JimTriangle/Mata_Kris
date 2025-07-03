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

<div class="flex flex-col gap-6">
    <x-auth-header :title="__('Forgot password')" :description="__('Enter your email to receive a password reset link')" />

    <x-auth-session-status class="text-center" :status="session('status')" />

    <form wire:submit="sendPasswordResetLink" class="flex flex-col gap-6">
        <div class="form-group">
            <label for="email">{{ __('Email address') }}</label>
            <input id="email" type="email" wire:model="email" required autofocus placeholder="email@example.com">
        </div>

        <button type="submit" class="button w-full">{{ __('Email password reset link') }}</button>
    </form>

    <div class="text-center text-sm">
        <span>{{ __('Or, return to') }}</span>
        <a href="{{ route('login') }}" wire:navigate>{{ __('log in') }}</a>
    </div>
</div>
