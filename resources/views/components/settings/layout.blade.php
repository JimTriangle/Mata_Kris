<div class="settings-layout-container">
    {{-- Navigation horizontale --}}
    <div class="settings-nav-wrapper">
        <nav class="settings-nav-horizontal">
            <a href="{{ route('settings.profile') }}"
               class="settings-nav-item {{ request()->routeIs('settings.profile') ? 'active' : '' }}"
               wire:navigate>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                </svg>
                <span>{{ __('Profile') }}</span>
            </a>
            <a href="{{ route('settings.password') }}"
               class="settings-nav-item {{ request()->routeIs('settings.password') ? 'active' : '' }}"
               wire:navigate>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
                <span>{{ __('Password') }}</span>
            </a>
            <a href="{{ route('settings.appearance') }}"
               class="settings-nav-item {{ request()->routeIs('settings.appearance') ? 'active' : '' }}"
               wire:navigate>
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" />
                </svg>
                <span>{{ __('Appearance') }}</span>
            </a>
        </nav>
    </div>

    <flux:separator variant="subtle" class="my-6" />

    {{-- Contenu principal --}}
    <div class="settings-content">
        <div class="settings-content-header">
            <flux:heading>{{ $heading ?? '' }}</flux:heading>
            <flux:subheading>{{ $subheading ?? '' }}</flux:subheading>
        </div>

        <div class="settings-content-body">
            {{ $slot }}
        </div>
    </div>
</div>
