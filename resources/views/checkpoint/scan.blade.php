<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Scan QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Driver Details</h3>

                <p><strong>Name:</strong> {{ $driver->name }}</p>
                <p><strong>Email:</strong> {{ $driver->email }}</p>

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

                <form action="{{ route('checkpoint.scan') }}" method="POST">
                    @csrf
                    <label for="driver_id">Driver ID:</label>
                    <input type="text" name="driver_id" id="driver_id" required>
                    <button type="submit">Scan QR Code</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
