<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Assigned Items') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Links for User Sections -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('user.requests.index') }}"
                   class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-100 to-white border border-purple-200 rounded-lg shadow-md hover:shadow-lg transition ease-in-out duration-150 text-purple-800 hover:text-purple-900 font-semibold text-base text-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Request New Asset') }}
                </a>
                
                <span class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-200 to-white border border-purple-300 rounded-lg shadow-md text-purple-900 font-bold text-base text-center ring-2 ring-purple-500">
                    <svg class="w-6 h-6 mr-2 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m7 0V5a2 2 0 012-2h2a2 2 0 012 2v2M7 11V5a2 2 0 012-2h2a2 2 0 012 2v2"></path></svg>
                    {{ __('My Assigned Items') }}
                </span>
                
                <a href="{{ route('user.history.index') }}"
                   class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-100 to-white border border-purple-200 rounded-lg shadow-md hover:shadow-lg transition ease-in-out duration-150 text-purple-800 hover:text-purple-900 font-semibold text-base text-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 0l-1-1m1 1l1 1m-1-1l-1 1M13 16h-1m1-4h-1m1-4h-1"></path></svg>
                    {{ __('View Personal History') }}
                </a>
            </div>
            <!-- End Navigation Links -->

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-purple-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6">{{ __('Assets Currently Assigned to You') }}</h3>

                @if ($assignedAssets->isEmpty())
                    <div class="text-center p-10 bg-purple-50 rounded-lg border border-purple-100">
                        <svg class="mx-auto h-12 w-12 text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.333 0 2.667 0 4 0 1.333 0 2.667 0 4 0s4 0 4 0m-4 4v.01M16 4v.01M12 20v.01M8 4v.01M4 20v.01M20 20v.01M4 16v.01M20 16v.01M4 12v.01M20 12v.01M8 20v.01M16 20v.01M12 4v.01M8 8v.01M16 8v.01M12 16v.01M8 12v.01M16 12v.01" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">{{ __('No Assets Assigned Yet') }}</p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('It looks like you don\'t have any IT assets checked out to you at the moment.') }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('user.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Request an Asset') }}
                            </a>
                        </div>
                    </div>
                @else
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($assignedAssets as $asset)
                            <div class="border border-purple-200 bg-purple-50 rounded-lg shadow-sm overflow-hidden">
                                <div class="p-5">
                                    <h4 class="text-lg font-bold text-purple-800 mb-1">{{ $asset->assetModel->name ?? 'N/A' }}</h4>
                                    <p class="text-sm text-purple-600 mb-3">Asset Tag: {{ $asset->asset_tag }}</p>

                                    <div class="space-y-1 text-sm text-gray-700">
                                        <p><strong>Serial:</strong> {{ $asset->serial ?? 'N/A' }}</p>
                                        <p><strong>Assigned On:</strong> {{ $asset->checked_out_at ? $asset->checked_out_at->format('M d, Y') : 'N/A' }}</p>
                                        <p><strong>Status:</strong> <span class="px-2 py-1 inline-flex text-xs leading-5 font-semibold rounded-full bg-purple-200 text-purple-800">{{ $asset->status }}</span></p>
                                        <p class="italic text-gray-600 mt-2">{{ Str::limit($asset->notes ?? 'No notes.', 70) }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>