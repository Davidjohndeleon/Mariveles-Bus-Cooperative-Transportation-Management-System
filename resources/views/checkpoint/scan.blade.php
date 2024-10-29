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

                <div id="reader" style="width: 600px; display: none;"></div>

                <button id="start-camera" class="bg-blue-500 text-white p-2 rounded">
                    Start Camera
                </button>
                
                <form id="driverForm" action="{{ route('checkpoint.scan') }}" method="POST" style="display: none;">
                    @csrf
                    <input type="hidden" name="driver_id" id="driver_id" required>
                    <button type="submit">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Include html5-qrcode library -->
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
    <script>
        const html5QrCode = new Html5Qrcode("reader");

        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            console.log("QR Code scanned:", decodedText);
            document.getElementById('driver_id').value = decodedText;
            document.getElementById('driverForm').submit();
        };

        const config = { fps: 10, qrbox: { width: 250, height: 250 } };

        document.getElementById('start-camera').addEventListener('click', () => {
            document.getElementById('reader').style.display = "block";
            console.log("Starting camera...");

            html5QrCode.start(
                { facingMode: "environment" },
                config,
                qrCodeSuccessCallback
            ).then(() => {
                console.log("Camera started successfully.");
            }).catch(err => {
                console.error("Unable to start scanning:", err);
                alert("Error accessing the camera. Please allow camera access and try again.");
                document.getElementById('reader').style.display = "none"; // Hide if failed
            });
        });
    </script>
</x-app-layout>
