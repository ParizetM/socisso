<x-app-layout>
    <div class="min-h-screen bg-[#FFF9F9] flex flex-col">
        <!-- Hero Section -->
        <div class="flex-grow">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <div class="text-center mb-12">
                    <h1 class="text-4xl font-bold text-[#F44171] mb-4">
                        {{ __('Bienvenue sur Socisso') }}
                    </h1>
                    <p class="text-xl text-gray-600 max-w-2xl mx-auto">
                        {{ __('Votre plateforme de services sociaux dédiée') }}
                    </p>
                </div>

                <!-- Main Cards Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <!-- Services Card -->
                    <div class="bg-white p-8 rounded-lg shadow-lg border border-[#F44171]/20 hover:border-[#F44171] transition-colors duration-150">
                        <h2 class="text-2xl font-semibold text-[#F44171] mb-4">
                            {{ __('Nos Services') }}
                        </h2>
                        <p class="text-gray-600 mb-6">
                            {{ __('Découvrez l\'ensemble de nos prestations et fonctionnalités adaptées à vos besoins.') }}
                        </p>
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                {{ __('Accéder aux services') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                {{ __('Découvrir') }}
                            </a>
                        @endauth
                    </div>

                    <!-- Account Access Card -->
                    <div class="bg-white p-8 rounded-lg shadow-lg border border-[#F44171]/20 hover:border-[#F44171] transition-colors duration-150">
                        <h2 class="text-2xl font-semibold text-[#F44171] mb-4">
                            {{ __('Votre Espace') }}
                        </h2>
                        <p class="text-gray-600 mb-6">
                            {{ __('Accédez à votre espace personnel pour gérer vos services et suivre vos demandes.') }}
                        </p>
                        @auth
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                {{ __('Mon tableau de bord') }}
                            </a>
                        @else
                            <div class="space-x-4">
                                <a href="{{ route('login') }}" class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                    {{ __('Se connecter') }}
                                </a>
                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                        {{ __('S\'inscrire') }}
                                    </a>
                                @endif
                            </div>
                        @endauth
                    </div>

                    <!-- Contact Card -->
                    <div class="bg-white p-8 rounded-lg shadow-lg border border-[#F44171]/20 hover:border-[#F44171] transition-colors duration-150">
                        <h2 class="text-2xl font-semibold text-[#F44171] mb-4">
                            {{ __('Contact') }}
                        </h2>
                        <p class="text-gray-600 mb-6">
                            {{ __('Besoin d\'aide ? Notre équipe est là pour vous accompagner et répondre à vos questions.') }}
                        </p>
                        <button class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                            {{ __('Nous contacter') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <x-footer />
    </div>
</x-app-layout>
