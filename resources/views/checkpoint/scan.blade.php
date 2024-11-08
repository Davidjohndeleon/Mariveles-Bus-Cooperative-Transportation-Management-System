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

  <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('4a417eafa97b91c0b841', {
      cluster: 'ap1'
    });

    var channel = pusher.subscribe('my-channel');
    channel.bind('my-event', function(data) {
      alert(JSON.stringify(data));
    });
  </script>

  <h1>Pusher Test</h1>
  <p>
    Try publishing an event to channel <code>my-channel</code>
    with event name <code>my-event</code>.
  </p>
    <!-- Include instascan.min.js script -->

    <script type="text/javascript">
        setTimeout(function(){
                    // To enforce the use of the new api with detailed scan results, call the constructor with an options object, see below.
const qrScanner = new QrScanner(
    document.getElementById('reader'),
    result => console.log('decoded qr code:', result),
    { /* your options or returnDetailedScanResult: true if you're not specifying any other options */ },
);

qrScanner.start();
        }, 1000);
    </script>
</x-app-layout>
