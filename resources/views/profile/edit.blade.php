<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm sm:rounded-lg border border-[#F44171]">
                <div class="p-6">
                    <!-- En-tête -->
                    <div class="mb-8">
                        <h1 class="text-3xl font-semibold text-[#F44171]">{{ __('Mon Profil') }}</h1>
                        <p class="text-gray-600 mt-2">{{ __('Gérez vos informations personnelles et les paramètres de sécurité.') }}</p>
                    </div>

                    <!-- Section Informations du Profil -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-[#F44171]/20 mb-8">
                        <div class="max-w-xl">
                            @include('profile.partials.update-profile-information-form')
                        </div>
                    </div>

                    <!-- Section Mot de Passe -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-[#F44171]/20 mb-8">
                        <div class="max-w-xl">
                            @include('profile.partials.update-password-form')
                        </div>
                    </div>

                    <!-- Section Suppression du Compte -->
                    <div class="bg-white p-6 rounded-lg shadow-sm border border-[#F44171]/20">
                        <div class="max-w-xl">
                            @include('profile.partials.delete-user-form')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
