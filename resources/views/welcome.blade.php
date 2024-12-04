<x-guest-layout>
    <div class="min-h-screen bg-[#FFF9F9]">
        <!-- Header -->
        <header class="border-b border-[#F44171]">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="flex justify-between items-center h-24">
                    <!-- Logo -->
                    <div class="flex items-center">
                        <x-application-logo class="h-16 w-auto lg:h-24" />
                    </div>

                    <!-- Auth Navigation -->
                    @if (Route::has('login'))
                        <div class="flex space-x-4">
                            @auth
                                <x-nav-link :href="route('dashboard')"
                                    class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                    {{ __('Dashboard') }}
                                </x-nav-link>
                            @else
                                <x-nav-link :href="route('login')"
                                    class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                    {{ __('Se connecter') }}
                                </x-nav-link>

                                @if (Route::has('register'))
                                    <x-nav-link :href="route('register')"
                                        class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                        {{ __('S\'inscrire') }}
                                    </x-nav-link>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>
            </div>
        </header>

        <!-- Main Content -->
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                <x-welcome-card
                    title="Bienvenue sur Socisso"
                    description="Connectez-vous ou inscrivez-vous pour accéder à tous nos services." />

                <x-welcome-card
                    title="Nos Services"
                    description="Découvrez l'ensemble de nos prestations et fonctionnalités." />

                <x-welcome-card
                    title="Contact"
                    description="Besoin d'aide ? Notre équipe est là pour vous accompagner." />
            </div>
        </main>

        <!-- Footer -->
        <x-footer />
    </div>
</x-guest-layout>
