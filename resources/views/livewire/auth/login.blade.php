<?php

use Illuminate\Auth\Events\Lockout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Volt\Component;

new #[Layout('components.layouts.auth')] class extends Component {
    #[Validate('required|string|email')]
    public string $email = '';

    #[Validate('required|string')]
    public string $password = '';

    public bool $remember = false;

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->ensureIsNotRateLimited();

        if (! Auth::attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => __('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
        Session::regenerate();

        $this->redirectIntended(default: route('admin.dashboard', absolute: false), navigate: true);
    }

    /**
     * Ensure the authentication request is not rate limited.
     */
    protected function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout(request()));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => __('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the authentication rate limiting throttle key.
     */
    protected function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->email).'|'.request()->ip());
    }
}; ?>

{{-- TOUT LE HTML EST ENVELOPPÉ DANS CE SEUL DIV --}}
<div>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Log in to your account')" :description="__('Enter your email and password below to log in')" />

        <x-auth-session-status class="text-center" :status="session('status')" />

        {{-- ... --}}
<form wire:submit="login" class="flex flex-col gap-6">
    <div class="form-group">
        <label for="email">{{ __('Email address') }}</label>
        <input id="email" type="email" wire:model="email" required autofocus autocomplete="email" placeholder="email@example.com">
        @error('email') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <label for="password">{{ __('Password') }}</label>
        <input id="password" type="password" wire:model="password" required autocomplete="current-password" placeholder="Mot de passe">
        @error('password') <span class="error-text">{{ $message }}</span> @enderror
    </div>

    <div class="flex items-center justify-between">
        <label for="remember" class="flex items-center text-sm">
            <input id="remember" type="checkbox" wire:model="remember" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
            <span class="ml-2">{{ __('Remember me') }}</span>
        </label>
        <a href="{{ route('password.request') }}" wire:navigate>{{ __('Forgot your password?') }}</a>
    </div>

    <button type="submit" class="button w-full">{{ __('Log in') }}</button>
</form>
{{-- ... --}}
        @if (Route::has('register'))
            <div class="text-center text-sm">
                <span>{{ __("Don't have an account?") }}</span>
                <a href="{{ route('register') }}" wire:navigate>{{ __('Sign up') }}</a>
            </div>
        @endif
    </div>
</div>