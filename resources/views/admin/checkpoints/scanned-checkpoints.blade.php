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
                <form action="{{ route('admin.checkpoints.scanned-checkpoints') }}" method="GET" class="mb-6">
                    <div class="mt-4">
                        <label for="checkpoint_name" class="block text-sm font-medium text-gray-700">Select Checkpoint</label>
                        <select name="checkpoint_name" id="checkpoint_name" class="mt-2 block w-64 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" {{ old('checkpoint_name') == '' ? 'selected' : '' }}>Select a checkpoint</option>
                            @foreach($checkpointNames as $checkpointName)
                                <option value="{{ $checkpointName }}" {{ old('checkpoint_name') == $checkpointName ? 'selected' : '' }}>{{ $checkpointName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-6">
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                            Filter
                        </button>
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
                        <table id="qr-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="border border-gray-300 px-4 py-2">Checkpoint Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Driver</th>
                                    <th class="border border-gray-300 px-4 py-2">Conductor</th>
                                    <th class="border border-gray-300 px-4 py-2">Bus Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Route</th>
                                    <th class="border border-gray-300 px-4 py-2">Departure Time</th>
                                    <th class="border border-gray-300 px-4 py-2">Arrival Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scannedCheckpoints as $scannedCheckpoint)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->checkpoint_name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->driver->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->schedule->conductor->name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->schedule->bus->bus_name ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->schedule->route ?? 'N/A' }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedCheckpoint->schedule->departure_time ?? 'N/A' }}</td>
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

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.bootstrap5.js"></script>

    <script>
        new DataTable('#qr-table');
    </script>
</x-app-layout>
