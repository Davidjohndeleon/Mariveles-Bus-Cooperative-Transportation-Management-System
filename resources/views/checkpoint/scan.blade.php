<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan QR Code') }}
        </h2>
    </x-slot>

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

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
                <video id="reader" style="width: 100%; max-width: 600px; height: 400px;"></video>
                
                <div id="result"></div>

                <form id="driverForm" action="{{ route('checkpoint.scan') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="driver_id" id="driver_id" required>
                </form>
            </div>
        </div>
    </div>

    <!-- Include instascan.min.js script -->
    <script src="{{ asset('path_to/instascan.min.js') }}"></script> <!-- Update path as needed -->

    <script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        let scanner = new Instascan.Scanner({ video: document.getElementById('reader') });

        scanner.addListener('scan', function (content) {
            console.log("QR Code scanned:", content);
            document.getElementById('driver_id').value = content;
            document.getElementById('driverForm').submit();
        });

        Instascan.Camera.getCameras().then(function (cameras) {
            if (cameras.length > 0) {
                scanner.start(cameras[0]);
            } else {
                console.error('No cameras found.');
            }
        }).catch(function (e) {
            console.error("Error starting the camera:", e);
        });
    });
    </script>
</x-app-layout>
