<x-app-layout>
    {{-- We are REMOVING the custom x-slot name="header" and its contents --}}
    {{-- <x-slot name="header">
        <div class="flex justify-between items-center bg-red-600 p-2 rounded">
            <h2 class="font-semibold text-xl text-white leading-tight">
                {{ __('ADMINISTRATOR ACCESS GRANTED') }}
            </h2>

            <!-- Logout Button -->
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" 
                        class="bg-white text-red-600 font-semibold px-4 py-1 rounded hover:bg-red-200 transition">
                    {{ __('Logout') }}
                </button>
            </form>
        </div>
    </x-slot> --}}

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-red-100 overflow-hidden shadow-xl sm:rounded-lg p-6 border-4 border-red-500">
                <!-- Admin Dashboard Content -->
                <h3 class="text-xl font-bold text-red-800">
                    Welcome to the Asset Management Admin Panel.
                </h3>
                <p class="mt-2 text-base text-red-700">
                    This view (<code>/admin/dashboard</code>) is protected by the 'access-admin-area' Gate.
                </p>
                <p class="mt-4 text-sm text-red-500">
                    This is <strong>admin dashboard</strong>
                </p>
            </div>
        </div>
    </div>
</x-app-layout>
