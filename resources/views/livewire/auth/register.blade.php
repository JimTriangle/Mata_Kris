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

{{-- TOUT LE HTML EST ENVELOPPÉ DANS CE SEUL DIV --}}
<div>
    <div class="flex flex-col gap-6">
        <x-auth-header :title="__('Create an account')" :description="__('Enter your details below to create your account')" />

        <form wire:submit="register" class="flex flex-col gap-6">
            <div class="form-group">
                <label for="name">{{ __('Name') }}</label>
                <input id="name" type="text" wire:model="name" required autofocus autocomplete="name" placeholder="Nom complet">
            </div>

            <div class="form-group">
                <label for="email">{{ __('Email address') }}</label>
                <input id="email" type="email" wire:model="email" required autocomplete="email" placeholder="email@exemple.com">
            </div>

            <div class="form-group">
                <label for="password">{{ __('Password') }}</label>
                <input id="password" type="password" wire:model="password" required autocomplete="new-password" placeholder="Mot de passe">
            </div>

            <div class="form-group">
                <label for="password_confirmation">{{ __('Confirm password') }}</label>
                <input id="password_confirmation" type="password" wire:model="password_confirmation" required autocomplete="new-password" placeholder="Confirmer le mot de passe">
            </div>

            <button type="submit" class="button w-full mt-4">{{ __('Créer le compte') }}</button>
        </form>

        <div class="text-center text-sm">
            <span>{{ __('Already have an account?') }}</span>
            <a href="{{ route('login') }}" wire:navigate>{{ __('Log in') }}</a>
        </div>
    </div>
</div>