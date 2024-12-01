<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scanned Checkpoints') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Filter Scanned Checkpoints</h3>

                <!-- Dropdown to filter checkpoints -->
                <form action="{{ route('admin.checkpoints.scanned') }}" method="GET" class="mb-6">
                    <div class="flex items-center space-x-4">
                        <div>
                            <label for="checkpoint_name" class="block text-gray-700">Select Checkpoint</label>
                            <select name="checkpoint_name" id="checkpoint_name" class="mt-2 block w-64 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="" {{ request('checkpoint_name') === null ? 'selected' : '' }}>All Checkpoints</option>
                                @foreach(\App\Models\Checkpoint::pluck('name') as $checkpointName)
                                    <option value="{{ $checkpointName }}" {{ request('checkpoint_name') === $checkpointName ? 'selected' : '' }}>
                                        {{ $checkpointName }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="pt-6">
                            <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Display scanned checkpoints -->
                @if($scannedCheckpoints->isEmpty())
                    <p class="text-gray-600">No scanned QR codes found.</p>
                @else
                    <h3 class="text-lg font-semibold mb-4">
                        Scanned QR Codes 
                        @if(request('checkpoint_name')) for "{{ request('checkpoint_name') }}" @endif
                    </h3>
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300 text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="border border-gray-300 px-4 py-2">Checkpoint Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Driver</th>
                                    <th class="border border-gray-300 px-4 py-2">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scannedCheckpoints as $scannedCheckpoint)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->checkpoint_name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->driver->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->created_at->format('F j, Y, g:i A') }}</td>
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
