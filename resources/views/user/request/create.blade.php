<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Request Asset:') }} {{ $model->name ?? 'Loading...' }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg border border-purple-200">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-900 mb-4">{{ __('Submit Your Request') }}</h3>
                    <p class="text-gray-600 mb-6">{{ __('Please confirm the item details and provide a reason for your request.') }}</p>

                    @if (isset($model))
                        <!-- Item Details Card -->
                        <div class="border border-purple-200 bg-purple-50 p-4 rounded-lg mb-8">
                            <h4 class="font-semibold text-lg text-purple-700">{{ $model->name }}</h4>
                            <p class="text-sm text-purple-500">{{ $model->manufacturer ?? 'N/A' }} - {{ $model->category ?? 'N/A' }}</p>
                            <p class="mt-2 text-sm text-purple-600">{{ $model->description ?? 'No description provided.' }}</p>
                            <div class="mt-3">
                                <span class="text-xs font-medium text-purple-700 bg-purple-200 px-2 py-1 rounded-full">Available Stock: {{ $model->available_count ?? 0 }}</span>
                            </div>
                        </div>

                        <!-- Request Form -->
                        <form method="POST" action="{{ route('user.requests.store') }}">
                            @csrf
                            
                            {{-- Hidden field to pass the asset model ID --}}
                            <input type="hidden" name="asset_model_id" value="{{ $model->id }}">

                            <!-- Required Date -->
                            <div class="mt-4">
                                <x-label for="needed_by_date" value="{{ __('Needed By Date (Optional)') }}" />
                                <input id="needed_by_date" class="block mt-1 w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm" type="date" name="needed_by_date" :value="old('needed_by_date')" />
                                <x-input-error for="needed_by_date" class="mt-2" />
                            </div>

                            <!-- Justification -->
                            <div class="mt-4">
                                <x-label for="justification" value="{{ __('Justification / Reason for Request') }}" />
                                <textarea id="justification" name="justification" rows="4" required class="block mt-1 w-full border-gray-300 focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50 rounded-md shadow-sm">{{ old('justification') }}</textarea>
                                <x-input-error for="justification" class="mt-2" />
                            </div>

                            <div class="flex items-center justify-end mt-6">
                                <a href="{{ route('user.requests.index') }}" class="mr-4 text-sm text-gray-600 hover:text-gray-900">
                                    {{ __('Cancel') }}
                                </a>

                                <x-button class="ms-4 bg-purple-600 hover:bg-purple-700">
                                    {{ __('Submit Request') }}
                                </x-button>
                            </div>
                        </form>
                    @else
                        <p class="text-red-500 font-semibold">{{ __('Error: Asset Model not found.') }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>