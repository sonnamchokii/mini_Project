<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    {{-- This should likely go to the main dashboard or welcome page --}}
                    <a href="{{ route('dashboard') }}">
                        <x-application-mark class="block h-9 w-auto" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Updated Dashboard link to "My Assigned Items" --}}
                    <x-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                        {{ __('My Assigned Items') }}
                    </x-nav-link>

                    {{-- NEW: Request New Asset Link --}}
                    <x-nav-link href="{{ route('user.requests.index') }}" :active="request()->routeIs('user.requests.*')">
                        {{ __('Request New Asset') }}
                    </x-nav-link>

                    {{-- NEW: View Personal History Link --}}
                    <x-nav-link href="{{ route('user.history.index') }}" :active="request()->routeIs('user.history.*')">
                        {{ __('View Personal History') }}
                    </x-nav-link>
                </div>
            </div>

            {{-- The rest of your navigation-menu.blade.php for profile, teams, etc. remains here --}}
            {{-- ... (Your existing code for settings dropdown, team dropdown, hamburger menu) ... --}}
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Updated Dashboard responsive link --}}
            <x-responsive-nav-link href="{{ route('dashboard') }}" :active="request()->routeIs('dashboard')">
                {{ __('My Assigned Items') }}
            </x-responsive-nav-link>

            {{-- NEW: Responsive Request New Asset Link --}}
            <x-responsive-nav-link href="{{ route('user.requests.index') }}" :active="request()->routeIs('user.requests.*')">
                {{ __('Request New Asset') }}
            </x-responsive-nav-link>

            {{-- NEW: Responsive View Personal History Link --}}
            <x-responsive-nav-link href="{{ route('user.history.index') }}" :active="request()->routeIs('user.history.*')">
                {{ __('View Personal History') }}
            </x-responsive-nav-link>
        </div>

        {{-- ... (Rest of your responsive settings options) ... --}}
    </div>
</nav>
