<section>
    <header>
        <h2 class="text-2xl font-semibold text-[#F44171]">
            {{ __('Modifier le Mot de Passe') }}
        </h2>

        <p class="mt-2 text-gray-600">
            {{ __('Assurez-vous d\'utiliser un mot de passe long et aléatoire pour garantir la sécurité de votre compte.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('put')

        <div class="space-y-2">
            <x-input-label for="update_password_current_password" :value="__('Mot de passe actuel')" />
            <x-text-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password" :value="__('Nouveau mot de passe')" />
            <x-text-input id="update_password_password" name="password" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <x-input-label for="update_password_password_confirmation" :value="__('Confirmer le mot de passe')" />
            <x-text-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#F44171] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#F44171]/90 focus:bg-[#F44171]/90 active:bg-[#F44171]/80 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                    {{ __('Enregistré.') }}
                </p>
            @endif
        </div>
    </form>
</section>
