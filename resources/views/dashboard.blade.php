<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">

                    <h3 class="text-lg font-semibold mb-4">Current Date: {{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>

                    <!-- Balanga to Mariveles Schedule -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Define static departure times for Balanga to Mariveles
                                $departureTimes = [
                                    '03:50', '04:50', '05:50', '06:50',
                                    '07:50', '08:50', '09:50', '10:50',
                                    '11:50', '12:50', '13:50', '14:50',
                                    '15:50', '16:50', '17:50', '18:50',
                                    '19:50', '20:50', '21:20'
                                ];
                            @endphp

                            @foreach ($departureTimes as $time)
                                <tr>
                                    <td class="border px-4 py-2">{{ $time }}</td>
                                    <td class="border px-4 py-2">Bus Name Here</td> <!-- Replace with actual bus name -->
                                    <td class="border px-4 py-2">Driver Name Here</td> <!-- Replace with actual driver name -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Mariveles to Balanga Schedule -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                // Define static departure times for Mariveles to Balanga
                                $departureTimesMariveles = [
                                    '05:00', '06:00', '07:00', '08:00',
                                    '09:00', '10:00', '11:00', '12:00',
                                    '13:00', '14:00', '15:00', '16:00',
                                    '17:00', '18:00', '19:00', '20:00',
                                    '20:30'
                                ];
                            @endphp

                            @foreach ($departureTimesMariveles as $time)
                                <tr>
                                    <td class="border px-4 py-2">{{ $time }}</td>
                                    <td class="border px-4 py-2">Bus Name Here</td> <!-- Replace with actual bus name -->
                                    <td class="border px-4 py-2">Driver Name Here</td> <!-- Replace with actual driver name -->
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
