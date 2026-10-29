<nav x-data="{ open: false }" class="bg-gray-900 border-b border-gray-800 font-mono">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- PRTS Brand Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 group">
                        <span class="text-xl font-bold text-cyan-400 tracking-widest group-hover:text-blue-400 transition-colors">
                            [PRTS]
                        </span>
                        <span class="text-xs bg-cyan-950 border border-cyan-500/30 text-cyan-400 px-2 py-0,5 rounded">
                            v1.0
                        </span>
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <a href="{{ route('dashboard') }}" class="inline-flex items-center px-1 pt-1 border-b-2 text-sm font-medium leading-5 transition duration-150 ease-in-out {{ request()->routeIs('dashboard') ? 'border-cyan-400 text-cyan-400' : 'border-transparent text-gray-400 hover:text-gray-200 hover:border-gray-700' }}">
                        // DASHBOARD
                    </a>
                </div>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-gray-800 text-xs font-bold rounded bg-gray-950 text-gray-300 hover:text-cyan-400 hover:border-cyan-500/50 focus:outline-none transition duration-150 ease-in-out">
                            <div>OPERATOR: {{ strtoupper(Auth::user()->name) }}</div>

                            <div class="ms-1 text-cyan-400">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1.1 0 011.414 0L10 10.586l3.293-3.293a1.1 0 111.414 1.414l-4 4a1.1 0 01-1.414 0l-4-4a1.1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="bg-gray-900 border border-gray-800 rounded shadow-xl py-1">
                            <x-dropdown-link :href="route('profile.edit')" class="text-gray-300 hover:bg-gray-800 hover:text-cyan-400 text-xs tracking-wider">
                                // PROFILE_SETTINGS
                            </x-dropdown-link>

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                        onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                        class="text-red-400 hover:bg-gray-800 hover:text-red-300 text-xs tracking-wider">
                                    // SYSTEM_LOGOUT
                                </x-dropdown-link>
                            </form>
                        </div>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Mobile Hamburger -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded text-gray-400 hover:text-cyan-400 hover:bg-gray-800 focus:outline-none">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'inline-flex': open, 'hidden': ! open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Mobile Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900 border-b border-gray-800">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block ps-3 pe-4 py-2 border-l-4 border-cyan-400 text-base font-medium text-cyan-400 bg-gray-800/50">
                // DASHBOARD
            </a>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-800">
            <div class="px-4">
                <div class="font-medium text-sm text-cyan-400">{{ Auth::user()->name }}</div>
                <div class="font-medium text-xs text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-xs text-gray-300 hover:text-cyan-400">
                    // PROFILE_SETTINGS
                </a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 text-xs text-red-400 hover:text-red-300">
                        // SYSTEM_LOGOUT
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>