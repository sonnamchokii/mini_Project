<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Asset Request Catalog') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Links -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <span class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-200 to-white border border-purple-300 rounded-lg shadow-md text-purple-900 font-bold text-base text-center ring-2 ring-purple-500">
                    <svg class="w-6 h-6 mr-2 text-purple-700" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Request New Asset') }}
                </span>
                <a href="{{ route('dashboard') }}" 
                   class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-100 to-white border border-purple-200 rounded-lg shadow-md hover:shadow-lg transition ease-in-out duration-150 text-purple-800 hover:text-purple-900 font-semibold text-base text-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m7 0V5a2 2 0 012-2h2a2 2 0 012 2v2M7 11V5a2 2 0 012-2h2a2 2 0 012 2v2"></path></svg>
                    {{ __('My Assigned Assets') }}
                </a>
                <a href="{{ route('user.history.index') }}" 
                   class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-100 to-white border border-purple-200 rounded-lg shadow-md hover:shadow-lg transition ease-in-out duration-150 text-purple-800 hover:text-purple-900 font-semibold text-base text-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 0l-1-1m1 1l1 1m-1-1l-1 1M13 16h-1m1-4h-1m1-4h-1"></path></svg>
                    {{ __('View Personal History') }}
                </a>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 border border-purple-200">
                <h3 class="text-lg font-medium text-gray-900 mb-6">{{ __('Available Asset Models to Request') }}</h3>

                @if (isset($models) && $models->isEmpty())
                    <div class="text-center p-10 bg-purple-50 rounded-lg border border-purple-100">
                        <svg class="mx-auto h-12 w-12 text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">{{ __('No Requestable Assets Available') }}</p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('The administrator has not marked any asset models as requestable yet.') }}
                        </p>
                    </div>
                @elseif (isset($models))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($models as $model)
                            <div class="border border-purple-200 rounded-lg shadow-sm overflow-hidden bg-white hover:shadow-md transition duration-150">
                                <div class="p-5">
                                    <h4 class="text-xl font-bold text-gray-900 mb-2">{{ $model->name }}</h4>
                                    <p class="text-sm text-gray-500 mb-4">{{ $model->manufacturer }} - {{ $model->category }}</p>

                                    <div class="space-y-2 text-sm">
                                        <p class="flex justify-between">
                                            <span class="font-medium text-gray-700">{{ __('Total Stock:') }}</span>
                                            <span class="text-gray-900">{{ $model->total_assets ?? 0 }}</span>
                                        </p>
                                        <p class="flex justify-between">
                                            <span class="font-medium text-gray-700">{{ __('Available to Request:') }}</span>
                                            <span class="font-bold text-green-600">{{ $model->available_count ?? 0 }}</span>
                                        </p>
                                        <p class="text-gray-600 italic mt-3">{{ Str::limit($model->description ?? 'No description available.', 100) }}</p>
                                    </div>
                                </div>
                                <div class="p-4 bg-purple-50 border-t border-purple-200 flex justify-end">
                                    <a href="{{ route('user.requests.create', $model->id) }}" 
                                       class="inline-flex items-center px-4 py-2 bg-purple-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-purple-700 active:bg-purple-900 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                        {{ __('Request This Item') }}
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>