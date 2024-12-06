<section class="space-y-6">
    <header>
        <h2 class="text-2xl font-semibold text-[#F44171]">
            {{ __('Supprimer le Compte') }}
        </h2>

        <p class="mt-2 text-gray-600">
            {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Avant de supprimer votre compte, veuillez télécharger les données que vous souhaitez conserver.') }}
        </p>
    </header>

    <button x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="inline-flex items-center px-4 py-2 bg-white border border-[#F44171] rounded-md font-semibold text-xs text-[#F44171] uppercase tracking-widest hover:bg-[#FFF9F9] focus:bg-[#FFF9F9] active:bg-[#FFF9F9] focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
        {{ __('Supprimer le compte') }}
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6">
            @csrf
            @method('delete')

            <h2 class="text-xl font-semibold text-[#F44171]">
                {{ __('Êtes-vous sûr de vouloir supprimer votre compte ?') }}
            </h2>

            <p class="mt-2 text-gray-600">
                {{ __('Une fois votre compte supprimé, toutes ses ressources et données seront définitivement effacées. Veuillez entrer votre mot de passe pour confirmer que vous souhaitez supprimer définitivement votre compte.') }}
            </p>

            <div class="mt-6 space-y-2">
                <x-input-label for="password" :value="__('Mot de passe')" />
                <x-text-input id="password" name="password" type="password" class="mt-1 block w-full" placeholder="{{ __('Mot de passe') }}" />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-6 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')"
                    class="inline-flex items-center px-4 py-2 bg-white border border-[#F44171]/20 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-[#FFF9F9] focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Annuler') }}
                </button>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest bg-[#F44171] hover:bg-[#F44171]/90 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Supprimer le compte') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
