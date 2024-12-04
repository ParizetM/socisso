<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#FFF9F9] overflow-hidden shadow-sm sm:rounded-lg border border-[#F44171]">
                <div class="p-6">
                    <div class="flex flex-col space-y-4">
                        <div class="text-black">
                            <h2 class="text-2xl font-semibold">Bienvenue, {{ Auth::user()->prenom }} {{ Auth::user()->nom }}</h2>
                            <p class="text-gray-600 mt-2">{{ now()->format('l d F Y') }}</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 mt-6">
                            <div class="p-4 bg-white rounded-lg border border-[#F44171]/20">
                                <h3 class="text-lg font-medium text-[#F44171]">Mon Profil</h3>
                                <p class="mt-2 text-gray-600">{{ Auth::user()->email }}</p>
                            </div>

                            <div class="p-4 bg-white rounded-lg border border-[#F44171]/20">
                                <h3 class="text-lg font-medium text-[#F44171]">État de Session</h3>
                                <p class="mt-2 text-gray-600">Connecté depuis {{ now()->format('H:i') }}</p>
                            </div>

                            <div class="p-4 bg-white rounded-lg border border-[#F44171]/20">
                                <h3 class="text-lg font-medium text-[#F44171]">Dernière Connexion</h3>
                                <p class="mt-2 text-gray-600">{{ now()->subDays(1)->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
