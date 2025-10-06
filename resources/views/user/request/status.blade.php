<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Asset Request Status') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Links -->
            <div class="mb-6 grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('user.requests.index') }}" 
                   class="flex items-center justify-center p-4 bg-gradient-to-r from-purple-100 to-white border border-purple-200 rounded-lg shadow-md hover:shadow-lg transition ease-in-out duration-150 text-purple-800 hover:text-purple-900 font-semibold text-base text-center">
                    <svg class="w-6 h-6 mr-2 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    {{ __('Request New Asset') }}
                </a>
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
                <h3 class="text-lg font-medium text-gray-900 mb-6">{{ __('Current and Past Requests') }}</h3>

                {{-- The $requests variable is assumed to be passed by the RequestController::status() method --}}
                @if (isset($requests) && $requests->isEmpty())
                    <div class="text-center p-10 bg-purple-50 rounded-lg border border-purple-100">
                        <svg class="mx-auto h-12 w-12 text-purple-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">{{ __('No Asset Requests Found') }}</p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('You have not submitted any asset requests yet. Start by checking the catalog!') }}
                        </p>
                    </div>
                @elseif (isset($requests))
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-purple-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        {{ __('Requested Item') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        {{ __('Status') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        {{ __('Requested On') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        {{ __('Justification') }}
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-purple-800 uppercase tracking-wider">
                                        {{ __('Actions') }}
                                    </th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($requests as $request)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $request->assetModel->name ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @php
                                                // Dynamic styling based on request status
                                                $statusClass = [
                                                    'Pending' => 'bg-yellow-100 text-yellow-800',
                                                    'Approved' => 'bg-green-100 text-green-800',
                                                    'Denied' => 'bg-red-100 text-red-800',
                                                    'Checked Out' => 'bg-blue-100 text-blue-800',
                                                    'Fulfilled' => 'bg-blue-100 text-blue-800', // Added Fulfilled
                                                    'Cancelled' => 'bg-gray-100 text-gray-800', // Added Cancelled
                                                ][$request->status] ?? 'bg-gray-100 text-gray-800';
                                            @endphp
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                                {{ $request->status }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $request->created_at->format('M d, Y') }}
                                        </td>
                                        <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="{{ $request->justification }}">
                                            {{ Str::limit($request->justification, 50) }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                            @if ($request->status === 'Pending')
                                                <form method="POST" action="{{ route('user.requests.cancel', $request->id) }}" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900">
                                                        {{ __('Cancel Request') }}
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-400">{{ __('No action') }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>