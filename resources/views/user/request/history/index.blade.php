<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('My Personal History') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Navigation Links for User Sections -->
            <div class="mb-6 flex space-x-4">
                <a href="{{ route('user.requests.index') }}"
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('Request New Asset') }}
                </a>
                <a href="{{ route('dashboard') }}"
                   class="inline-flex items-center px-4 py-2 bg-gray-200 border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 transition ease-in-out duration-150">
                    {{ __('My Assigned Items') }}
                </a>
                {{-- This is the current page, so it's styled differently --}}
                <span class="inline-flex items-center px-4 py-2 bg-gray-300 border border-gray-400 rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest">
                    {{ __('View Personal History') }}
                </span>
            </div>
            <!-- End Navigation Links -->

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-medium text-gray-900 mb-6">{{ __('All Your Asset-Related Activities') }}</h3>

                @if ($userRequests->isEmpty() && $assignedAssets->isEmpty())
                    <div class="text-center p-10 bg-gray-50 rounded-lg">
                        <svg class="mx-auto h-12 w-12 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.333 0 2.667 0 4 0 1.333 0 2.667 0 4 0s4 0 4 0m-4 4v.01M16 4v.01M12 20v.01M8 4v.01M4 20v.01M20 20v.01M4 16v.01M20 16v.01M4 12v.01M20 12v.01M8 20v.01M16 20v.01M12 4v.01M8 8v.01M16 8v.01M12 16v.01M8 12v.01M16 12v.01" />
                        </svg>
                        <p class="mt-2 text-sm font-medium text-gray-900">{{ __('No History Found') }}</p>
                        <p class="mt-1 text-sm text-gray-500">
                            {{ __('You have no past asset requests or assigned items to display.') }}
                        </p>
                        <div class="mt-6">
                            <a href="{{ route('user.requests.index') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                {{ __('Request an Asset') }}
                            </a>
                        </div>
                    </div>
                @else
                    {{-- Section for Asset Requests --}}
                    <h4 class="text-xl font-bold text-gray-800 mb-4">{{ __('Your Asset Requests') }}</h4>
                    <div class="overflow-x-auto mb-8">
                        @if ($userRequests->isNotEmpty())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Requested Item') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Requested On') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Needed By') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Justification') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Actions') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($userRequests as $request)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $request->assetModel->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @php
                                                    $statusClass = [
                                                        'Pending' => 'bg-yellow-100 text-yellow-800',
                                                        'Approved' => 'bg-green-100 text-green-800',
                                                        'Denied' => 'bg-red-100 text-red-800',
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
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $request->needed_by_date ? $request->needed_by_date->format('M d, Y') : 'N/A' }}
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
                                                            {{ __('Cancel') }}
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
                        @else
                            <p class="text-gray-600 italic">No asset requests found in your history.</p>
                        @endif
                    </div>

                    {{-- Section for Currently Assigned Assets (also part of history) --}}
                    <h4 class="text-xl font-bold text-gray-800 mb-4 mt-8">{{ __('Currently Assigned Assets') }}</h4>
                    <div class="overflow-x-auto">
                        @if ($assignedAssets->isNotEmpty())
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Asset Tag') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Item') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Serial Number') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Assigned On') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Status') }}
                                        </th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            {{ __('Notes') }}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach ($assignedAssets as $asset)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                                {{ $asset->asset_tag }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                                {{ $asset->assetModel->name ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                                {{ $asset->serial ?? 'N/A' }}
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm text