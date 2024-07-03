<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">Buses with Drivers and Schedules</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">

                        @foreach ($buses as $bus)
                            <div class="bg-gray-100 p-4 rounded-lg shadow-md">
                                <h4 class="text-xl font-semibold">{{ $bus->bus_name }}</h4>
                                <p class="text-sm text-gray-600">Driver: {{ $bus->driver->name ?? 'Not Assigned' }}</p>
                                
                                <h5 class="text-lg font-semibold mt-2">Schedules:</h5>
                                <ul class="list-disc list-inside">
                                    @foreach ($bus->schedules as $schedule)
                                    <li> Departure: {{ $schedule->departure_time }} | Arrival: {{ $schedule->arrival_time }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
