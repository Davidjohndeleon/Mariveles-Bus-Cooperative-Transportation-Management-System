<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('QR Code') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- QR Code Display Section -->
                <h3 class="text-lg font-semibold mb-4">Your QR Code</h3>
                <div class="flex justify-center mt-8">
                    {!! $qrCode !!}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
