<x-action-section>
    <x-slot name="title">
        {{ __('Two Factor Authentication') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Add additional security to your account using two factor authentication.') }}
    </x-slot>

    <x-slot name="content">
        <h3 class="text-lg font-medium text-gray-900">
            @if ($this->enabled)
                @if ($showingConfirmation)
                    {{ __('Finish enabling two factor authentication.') }}
                @else
                    {{ __('You have enabled two factor authentication.') }}
                @endif
            @else
                {{ __('You have not enabled two factor authentication.') }}
            @endif
        </h3>

        <div class="mt-3 max-w-xl text-sm text-gray-600">
            <p>
                {{ __('When two factor authentication is enabled, you will be prompted for a secure, random token during authentication. You may retrieve this token from your phone\'s Google Authenticator application.') }}
            </p>
        </div>

        @if ($this->enabled)
            @if ($showingQrCode)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        @if ($showingConfirmation)
                            {{ __('To finish enabling two factor authentication, enter the setup key into your phone\'s authenticator application and provide the generated OTP code.') }}
                        @else
                            {{ __('Two factor authentication is now enabled. Enter the setup key into your phone\'s authenticator application.') }}
                        @endif
                    </p>
                </div>

                <div class="mt-4 max-w-xl" x-data="{ copied: false, secret: '{{ decrypt($this->user->two_factor_secret) }}' }">
                    <p class="text-sm font-semibold text-gray-600 mb-2">
                        {{ __('Setup Key') }} <span class="text-xs font-normal text-gray-500">({{ __('Use this if you can\'t scan the QR code') }})</span>
                    </p>
                    <div class="flex items-center space-x-2">
                        <input type="text" readonly value="{{ implode(' ', str_split(decrypt($this->user->two_factor_secret), 4)) }}" 
                            class="w-full bg-amber-50 border-amber-200 text-gray-700 font-mono text-sm rounded-md focus:ring-[#6F4E37] focus:border-[#6F4E37] block p-2.5 shadow-sm">
                        
                        <button type="button" 
                            x-on:click="navigator.clipboard.writeText(secret); copied = true; setTimeout(() => copied = false, 2000)"
                            class="inline-flex items-center px-4 py-2.5 bg-[#6F4E37] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#5a3e2b] focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150"
                            title="{{ __('Copy to clipboard') }}">
                            <i class="fas fa-copy" x-show="!copied"></i>
                            <i class="fas fa-check" x-show="copied"></i>
                            <span class="ml-2" x-text="copied ? '{{ __('Copied') }}' : '{{ __('Copy') }}'"></span>
                        </button>
                    </div>
                </div>

                @if ($showingConfirmation)
                    <div class="mt-4">
                        <x-label for="code" value="{{ __('One Time Password from Authenticator') }}" />

                        <x-input id="code" type="text" name="code" class="block mt-1 w-1/2" inputmode="numeric" autofocus autocomplete="one-time-code"
                            wire:model="code"
                            wire:keydown.enter="confirmTwoFactorAuthentication" />

                        <x-input-error for="code" class="mt-2" />
                    </div>
                @endif
            @endif

            @if ($showingRecoveryCodes)
                <div class="mt-4 max-w-xl text-sm text-gray-600">
                    <p class="font-semibold">
                        {{ __('Store these recovery codes in a secure password manager. They can be used to recover access to your account if your two factor authentication device is lost.') }}
                    </p>
                </div>

                <div class="grid gap-1 max-w-xl mt-4 px-4 py-4 font-mono text-sm bg-gray-100 rounded-lg">
                    @foreach (json_decode(decrypt($this->user->two_factor_recovery_codes), true) as $code)
                        <div>{{ $code }}</div>
                    @endforeach
                </div>
            @endif
        @endif

        <div class="mt-5">
            @if (! $this->enabled)
                <x-confirms-password wire:then="enableTwoFactorAuthentication">
                    <x-button type="button" wire:loading.attr="disabled">
                        {{ __('Enable') }}
                    </x-button>
                </x-confirms-password>
            @else
                @if ($showingRecoveryCodes)
                    <x-confirms-password wire:then="regenerateRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('Regenerate Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @elseif ($showingConfirmation)
                    <x-confirms-password wire:then="confirmTwoFactorAuthentication">
                        <x-button type="button" class="me-3" wire:loading.attr="disabled">
                            {{ __('Confirm') }}
                        </x-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="showRecoveryCodes">
                        <x-secondary-button class="me-3">
                            {{ __('Show Recovery Codes') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @endif

                @if ($showingConfirmation)
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-secondary-button wire:loading.attr="disabled">
                            {{ __('Cancel') }}
                        </x-secondary-button>
                    </x-confirms-password>
                @else
                    <x-confirms-password wire:then="disableTwoFactorAuthentication">
                        <x-danger-button wire:loading.attr="disabled">
                            {{ __('Disable') }}
                        </x-danger-button>
                    </x-confirms-password>
                @endif

            @endif
        </div>
    </x-slot>
</x-action-section>
