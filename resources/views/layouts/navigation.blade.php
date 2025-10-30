<nav x-data="{ open: false }" class="glass-dark border-b border-purple-800/30 backdrop-blur-xl relative z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="group">
                        <x-application-logo class="block h-9 w-auto fill-current text-purple-400 animate-pulse-glow" />
                    </a>
                </div>

                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        {{ __('Dashboard') }}
                    </x-nav-link>

                    @if (Auth::user()->role === 'admin')
                        <x-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                            {{ __('Kategori') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.dukuns.index')" :active="request()->routeIs('admin.dukuns.*')">
                            {{ __('Dukun') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                            {{ __('Klien') }}
                        </x-nav-link>

                        {{-- MODIFIKASI: Mengganti warna separator --}}
                        <div class="h-16 flex items-center border-b-2 border-transparent px-1 pt-1 text-sm font-medium text-purple-600/50">|</div>
                        
                        <x-nav-link :href="route('admin.approvals.index')" :active="request()->routeIs('admin.approvals.index')">
                            {{ __('Persetujuan') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.active')" :active="request()->routeIs('admin.reports.active')">
                            {{ __('Booking Aktif') }}
                        </x-nav-link>
                        <x-nav-link :href="route('admin.reports.history')" :active="request()->routeIs('admin.reports.history')">
                            {{ __('Riwayat Booking') }}
                        </x-nav-link>
                    @endif

                    @if (Auth::user()->role === 'user')
                        <x-nav-link :href="route('booking.index')" :active="request()->routeIs('booking.index')">
                            {{ __('Booking Saya') }}
                        </x-nav-link>
                        
                        <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                            {{ __('Keranjang') }}
                        </x-nav-link>
                    @endif

                </div>
            </div>

            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-purple-300 bg-transparent hover:text-purple-100 focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Hamburger Menu (Mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-purple-400 hover:text-purple-300 hover:bg-purple-900/50 focus:outline-none focus:bg-purple-900/50 focus:text-purple-300 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Mobile Menu Panel --}}

    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-gray-900/95 backdrop-blur-md">
        <div class="pt-2 pb-3 space-y-1">

            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>

            @if (Auth::user()->role === 'admin')
                {{-- MODIFIKASI: Mengganti 'border-gray-200' dan 'text-gray-500' --}}
                <div class="border-t border-purple-700/50 pt-2 mt-2">
                    <div class="px-4 text-xs font-semibold text-purple-400 uppercase">Manajemen Data</div>
                    <x-responsive-nav-link :href="route('admin.categories.index')" :active="request()->routeIs('admin.categories.*')">
                        {{ __('Kategori') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.dukuns.index')" :active="request()->routeIs('admin.dukuns.*')">
                        {{ __('Dukun') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.users.index')" :active="request()->routeIs('admin.users.*')">
                        {{ __('Klien') }}
                    </x-responsive-nav-link>
                </div>
                {{-- MODIFIKASI: Mengganti 'border-gray-200' dan 'text-gray-500' --}}
                <div class="border-t border-purple-700/50 pt-2 mt-2">
                    <div class="px-4 text-xs font-semibold text-purple-400 uppercase">Manajemen Booking</div>
                    <x-responsive-nav-link :href="route('admin.approvals.index')" :active="request()->routeIs('admin.approvals.index')">
                        {{ __('Persetujuan') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.reports.active')" :active="request()->routeIs('admin.reports.active')">
                        {{ __('Booking Aktif') }}
                    </x-responsive-nav-link>
                    <x-responsive-nav-link :href="route('admin.reports.history')" :active="request()->routeIs('admin.reports.history')">
                        {{ __('Riwayat Booking') }}
                    </x-responsive-nav-link>
                </div>
            @endif

            @if (Auth::user()->role === 'user')
                <x-responsive-nav-link :href="route('booking.index')" :active="request()->routeIs('booking.index')">
                    {{ __('Booking Saya') }}
                </x-responsive-nav-link>
                <x-responsive-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                    {{ __('Keranjang') }}
                </x-responsive-nav-link>
            @endif
        </div>

        {{-- Mobile Menu User Info --}}
        <div class="pt-4 pb-1 border-t border-purple-700/50">
            <div class="px-4">
                <div class="font-medium text-base text-white">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-purple-300">{{ Auth::user()->email }}</div>
            </div>
            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>