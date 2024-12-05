<nav x-data="{ open: false }" class="bg-[#FFF9F9] border-b border-[#F44171]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-24">
            <div class="flex items-center">
                <!-- Logo -->
                <div class="flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="h-20 w-auto" src="./images/socisso-logo.png" alt="Socisso" />
                    </a>
                </div>

                <!-- Navigation Links -->
                @auth
                    <div class="hidden space-x-8 sm:ms-10 sm:flex items-center">
                        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                            class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('dashboard') ? 'border-b-2 border-[#F44171] text-black' : '' }}">
                            {{ __('Dashboard') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                @auth
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-4 py-2 border border-[#F44171] text-sm font-medium rounded-md text-gray-700 hover:bg-[#F44171] hover:text-white transition-colors duration-150">
                                <div>{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                                <div class="ms-2">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <div class="bg-[#FFF9F9] rounded-md shadow-lg">
                                <x-dropdown-link :href="route('profile.edit')"
                                    class="text-gray-700 hover:bg-[#F44171] hover:text-white">
                                    {{ __('Profile') }}
                                </x-dropdown-link>

                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <x-dropdown-link :href="route('logout')"
                                        class="text-gray-700 hover:bg-[#F44171] hover:text-white"
                                        onclick="event.preventDefault(); this.closest('form').submit();">
                                        {{ __('Log Out') }}
                                    </x-dropdown-link>
                                </form>
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

            <!-- Mobile menu button -->
            <div class="flex items-center sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-700 hover:text-[#F44171] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        @auth
            <div class="pt-2 pb-3 space-y-1 bg-[#FFF9F9]">
                <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                    class="text-gray-700 hover:bg-[#F44171] hover:text-white {{ request()->routeIs('dashboard') ? 'bg-[#F44171] text-white' : '' }}">
                    {{ __('Dashboard') }}
                </x-responsive-nav-link>
            </div>

            <div class="pt-4 pb-1 border-t border-[#F44171]">
                <div class="px-4">
                    <div class="font-medium text-base text-gray-700">{{ Auth::user()->nom }} {{ Auth::user()->prenom }}</div>
                    <div class="font-medium text-sm text-[#F44171]">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')"
                        class="text-gray-700 hover:bg-[#F44171] hover:text-white">
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <x-responsive-nav-link :href="route('logout')"
                            class="text-gray-700 hover:bg-[#F44171] hover:text-white"
                            onclick="event.preventDefault(); this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
            <div class="pt-2 pb-3 space-y-1 bg-[#FFF9F9]">
                <x-responsive-nav-link :href="route('login')"
                    class="text-gray-700 hover:bg-[#F44171] hover:text-white">
                    {{ __('Se connecter') }}
                </x-responsive-nav-link>
                @if (Route::has('register'))
                    <x-responsive-nav-link :href="route('register')"
                        class="text-gray-700 hover:bg-[#F44171] hover:text-white">
                        {{ __('S\'inscrire') }}
                    </x-responsive-nav-link>
                @endif
            </div>
        @endauth
    </div>
</nav>
