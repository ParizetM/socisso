<nav x-data="{ open: false }" class="bg-[#FFF9F9] border-b border-[#F44171]">
    <!-- En-tête de la navbar reste inchangé -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('welcome') }}">
                        <img class="h-20 w-auto" src="{{ asset('images/socisso-logo.png') }}" alt="Socisso" />
                    </a>
                </div>

                <!-- Navigation Links pour desktop -->
                @auth
                    <div class="hidden space-x-8 sm:ms-10 sm:flex items-center">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('dashboard') ? 'border-b-2 border-[#F44171] text-black' : '' }}">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                    <div class="hidden space-x-8 sm:ms-10 sm:flex items-center">
                        <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                            class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('welcome') ? 'border-b-2 border-[#F44171] text-black' : '' }}">
                            {{ __('Produits') }}
                        </x-nav-link>
                    </div>
                    @can('admin')
                    @else
                        <div class="hidden space-x-8 sm:ms-10 sm:flex items-center">
                            <x-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.index')"
                                class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('payments.index') ? 'border-b-2 border-[#F44171] text-black' : '' }}">
                                {{ __('Paiements') }}
                            </x-nav-link>
                        </div>
                    @endcan
                @endauth
            </div>

            <!-- Settings Dropdown pour desktop -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                <div>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#FFF9F9] rounded-md shadow-lg">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="text-gray-700 hover:bg-[#F44171] hover:text-[#F44171]">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        class="text-gray-700 hover:bg-[#F44171] hover:text-[#F44171]"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
                                @can('admin')
                                    <x-dropdown-link :href="route('payments.all')"
                                        class="text-gray-700 hover:bg-[#F44171] hover:text-[#F44171]">
                                        {{ __('Tous les paiements') }}
                                    </x-dropdown-link>
                                @endcan
                            </div>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex space-x-4">
                        <a href="{{ route('login') }}"
                            class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                            {{ __('Se connecter') }}
                        </a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}"
                                class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                {{ __('S\'inscrire') }}
                            </a>
                        @endif
                    </div>
                @endauth
            </div>

            <!-- Bouton menu mobile -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open"
                    class="p-2 rounded-md text-[#F44171] hover:bg-[#F44171]/10 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Menu mobile amélioré -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        @auth
            <div class="px-4 py-2 bg-[#FFF9F9]">
                <div class="flex items-center space-x-3 mb-4 p-3 bg-white rounded-lg border border-[#F44171]/20">
                    <div
                        class="flex-shrink-0 h-10 w-10 rounded-full bg-[#F44171]/10 flex items-center justify-center text-[#F44171]">
                        {{ strtoupper(substr(Auth::user()->prenom, 0, 1)) }}
                    </div>
                    <div>
                        <div class="font-medium text-gray-800">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                        <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
                    </div>
                </div>

                <div class="space-y-2">
                    <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="rounded-md">
                        {{ __('Dashboard') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')" class="rounded-md">
                        {{ __('Produits') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('payments.index')" :active="request()->routeIs('payments.index')" class="rounded-md">
                        {{ __('Paiements') }}
                    </x-responsive-nav-link>

                    <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" class="rounded-md">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    @can('admin')
                        <x-responsive-nav-link :href="route('payments.all')" :active="request()->routeIs('payments.all')" class="rounded-md">
                            {{ __('Tous les paiements') }}
                        </x-responsive-nav-link>
                    @endcan

                    <form method="POST" action="{{ route('logout') }}" class="mt-4">
                        @csrf
                        <button type="submit"
                            class="w-full text-left p-3 rounded-md border border-[#F44171] text-[#F44171] hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                            {{ __('Déconnexion') }}
                        </button>
                    </form>
                </div>
            </div>
        @else
            <div class="px-4 py-4 bg-[#FFF9F9] space-y-3">
                <a href="{{ route('login') }}"
                    class="block w-full p-3 text-center rounded-md border border-[#F44171] text-[#F44171] hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                    {{ __('Se connecter') }}
                </a>
                @if (Route::has('register'))
                    <a href="{{ route('register') }}"
                        class="block w-full p-3 text-center rounded-md border border-[#F44171] text-[#F44171] hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                        {{ __('S\'inscrire') }}
                    </a>
                @endif
            </div>
        @endauth
    </div>
</nav>
