<nav x-data="{ open: false }" class="bg-[#FFF9F9] border-b border-[#F44171]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-20">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}">
                        <img class="h-12 w-auto lg:h-16" src="./images/socisso-logo.png" alt="Socisso" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"
                        class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('dashboard') ? 'border-b-2 border-[#F44171] text-[#F44171]' : '' }}">
                        {{ __('Dashboard') }}
                    </x-nav-link>
                    <x-nav-link :href="route('welcome')" :active="request()->routeIs('welcome')"
                        class="text-black hover:text-[#F44171] transition-colors {{ request()->routeIs('welcome') ? 'border-b-2 border-[#F44171] text-[#F44171]' : '' }}">
                        {{ __('welcome') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
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
            </div>

            <!-- Mobile menu with same updates -->
            <div class="-me-2 flex items-center sm:hidden">
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
    </div>
</nav>
