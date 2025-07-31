<nav x-data="{ open: false }" 
     class="sticky top-0 z-50 shadow-sm"
     style="background: linear-gradient(to bottom, #e1bee7, #ffffff);">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Hamburger Mobile - Hanya ini yang ditampilkan -->
            <div class="flex items-center">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#6a1b9a] hover:bg-[#d1c4e9] focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" fill="none" stroke="currentColor" stroke="#6a1b9a" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Dropdown Mobile -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden" style="background: linear-gradient(to bottom, #e1bee7, #ffffff); color: #6a1b9a;">
        <div class="pt-4 pb-1 border-t border-purple-300">
            <div class="px-4">
                <div class="font-medium text-base">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')" class="text-[#6a1b9a]">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" 
                        onclick="event.preventDefault(); this.closest('form').submit();" class="text-[#6a1b9a]">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>