<section>
    <header>
        <h2 class="text-2xl font-semibold text-[#F44171]">
            {{ __('Informations du Profil') }}
        </h2>

        <p class="mt-2 text-gray-600">
            {{ __("Mettez à jour les informations de votre profil et votre adresse email.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-6">
        @csrf
        @method('patch')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <div class="space-y-2">
                <x-input-label for="nom" :value="__('Nom')" />
                <x-text-input id="nom" name="nom" type="text" class="mt-1 block w-full" :value="old('nom', $user->nom)" required autofocus autocomplete="nom" />
                <x-input-error class="mt-2" :messages="$errors->get('nom')" />
            </div>

            <div class="space-y-2">
                <x-input-label for="prenom" :value="__('Prénom')" />
                <x-text-input id="prenom" name="prenom" type="text" class="mt-1 block w-full" :value="old('prenom', $user->prenom)" required autocomplete="prenom" />
                <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
            </div>
        </div>

        <div class="space-y-2">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-700">
                        {{ __('Votre adresse email n\'est pas vérifiée.') }}

                        <button form="send-verification" class="text-sm text-[#F44171] hover:text-[#F44171]/80 underline rounded-md focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2">
                            {{ __('Cliquez ici pour renvoyer l\'email de vérification.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 text-sm text-green-600">
                            {{ __('Un nouveau lien de vérification a été envoyé à votre adresse email.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-4">
            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#F44171] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#F44171]/90 focus:bg-[#F44171]/90 active:bg-[#F44171]/80 focus:outline-none focus:ring-2 focus:ring-[#F44171] focus:ring-offset-2 transition ease-in-out duration-150">
                {{ __('Enregistrer') }}
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 2000)" class="text-sm text-gray-600">
                    {{ __('Enregistré.') }}
                </p>
            @endif
        </div>
    </form>
</section>
