<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan QR Code') }}
        </h2>
    </x-slot>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('message'))
                    <div style="color: green; font-weight: bold; padding: 10px; border: 2px solid green; background-color: #d4edda;">
                        {{ session('message') }}
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                                <!-- Form to capture scanned QR code and checkpoint selection -->
                <form id="driverForm" action="{{ route('checkpoint.scan') }}" method="POST">
                    @csrf
                    <input type="hidden" name="driver_id" id="driver_id" required>

                    <!-- Dropdown for selecting checkpoint -->
                    <div class="mt-4">
                        <label for="checkpoint_name" class="block text-sm font-medium text-gray-700">Select Checkpoint</label>
                        <select name="checkpoint_name" id="checkpoint_name" class="mt-2 block w-64 rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                            <option value="" {{ old('checkpoint_name') == '' ? 'selected' : '' }}>Select a checkpoint</option>
                            <option value="Batangas Dos" {{ old('checkpoint_name') == 'Batangas Dos' ? 'selected' : '' }}>Batangas Dos</option>
                            <option value="Limay Jollibee" {{ old('checkpoint_name') == 'Limay Jollibee' ? 'selected' : '' }}>Limay Jollibee</option>
                        </select>
                    </div>
                </form>

                <!-- Video element for QR code scanner -->
                <video id="reader" style="width: 100%; max-width: 1000px; height: 800px;"></video>

                <div id="result"></div>



                <!-- Display Scanned QR Codes -->
                <h3 class="mt-4">Scanned QR Codes:</h3>
                @if($scannedCheckpoints->isEmpty())
                    <p>No QR codes scanned yet.</p>
                @else
                    <div class="overflow-x-auto">
                        <table id="scanned-table" class="table table-striped" style="width:100%">
                            <thead>
                                <tr class="bg-gray-200">
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
        new DataTable('#scanned-table');
    </script>

    <script type="text/javascript">
        setTimeout(function(){
            const qrScanner = new QrScanner(
                document.getElementById('reader'),
                result => {
                    console.log('decoded qr code:', result);
                    document.getElementById('driver_id').value = result.data;
                    document.getElementById('driverForm').submit();  // Submit the form after scan
                },
                { /* your options or returnDetailedScanResult: true if you're not specifying any other options */ }
            );
            qrScanner.start();
        }, 1000);
    </script>
</x-app-layout>
