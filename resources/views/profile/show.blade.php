<x-app-layout>
    <x-slot name="header">
        {{-- Custom Golden Drip Header --}}
        <div class="bg-[#893A17] -mx-4 sm:-mx-6 lg:-mx-8 px-4 sm:px-6 lg:px-8 py-12 text-center text-white relative overflow-hidden">
            {{-- Background Pattern Opacity --}}
            <div class="absolute inset-0 opacity-10" style="background-image: url('https://www.transparenttextures.com/patterns/coffee.png');"></div>
            
            <div class="relative z-10">
                <p class="text-amber-400 font-serif italic text-lg mb-2">Welcome to your Profile</p>
                <h2 class="font-serif text-3xl md:text-4xl font-bold leading-tight tracking-wide">
                    Hello, {{ Auth::user()->name }}
                </h2>
            </div>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif

            <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>

            @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
