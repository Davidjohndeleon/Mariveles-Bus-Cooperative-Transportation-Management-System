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

                @if (session('error'))
                    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <!-- Video element for Instascan preview -->
                <video id="reader" style="width: 100%; max-width: 1000px; height: 800px;"></video>

                <div id="result"></div>

                <form id="driverForm" action="{{ route('checkpoint.scan') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="driver_id" id="driver_id" required>
                </form>

                <h3 class="mt-4">Scanned QR Codes:</h3>
                @if($scannedQRs->isEmpty())
                    <p>No QR codes scanned yet.</p>
                    @else
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border border-gray-300 mt-4">
                            <thead>
                                <tr class="bg-gray-200">
                                    <th class="border border-gray-300 px-4 py-2">Driver ID</th>
                                    <th class="border border-gray-300 px-4 py-2">Driver Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2">Timestamp</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($scannedQRs as $scannedQR)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedQR->driver_id }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            {{ $scannedQR->driver ? $scannedQR->driver->name : 'Unknown' }}
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">{{ ucfirst($scannedQR->status) }}</td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $scannedQR->created_at->format('F j, Y, g:i A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>

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
