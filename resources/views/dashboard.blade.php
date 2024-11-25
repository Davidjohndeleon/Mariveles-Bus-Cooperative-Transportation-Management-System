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

                    <div class="grid grid-cols-1 gap-6">
                        <!-- Balanga to Mariveles Schedule and Fares -->
                        <div>
                            <h3 class="text-lg font-semibold mt-8 mb-6">Balanga to Mariveles Schedule</h3>
                            <table class="min-w-full bg-white border border-gray-300 mb-6">
                                <thead>
                                    <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white text-xl text-left">
                                        <th class="px-4 py-2 border-b">Departure Time</th>
                                        <th class="px-4 py-2 border-b">Bus</th>
                                        <th class="px-4 py-2 border-b">Driver</th>
                                        <th class="px-4 py-2 border-b">Conductor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($balangaToMarivelesSchedules as $schedule)
                                        <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white">
                                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="border px-4 py-2 text-center">No schedules available</td></tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <h3 class="text-lg font-semibold mt-8 mb-6">Balanga to Mariveles Fares</h3>
                            <table class="min-w-full bg-white border border-gray-300 mb-6 text-left">
                                <thead>
                                    <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white text-left">
                                        <th class="border px-4 py-2">Landmark</th>
                                        <th class="border px-4 py-2">Distance (km)</th>
                                        <th class="border px-4 py-2">Regular Fare</th>
                                        <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fares as $fare)
                                        @if ($fare->route == 'Balanga to Mariveles')
                                            <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white text-left">
                                                <td class="border px-4 py-2 ">{{ $fare->landmark }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->distance }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->regular_fare }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->elderly_student_disabled_fare }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Mariveles to Balanga Schedule and Fares -->
                        <div>
                            <h3 class="text-lg font-semibold mt-8 mb-6">Mariveles to Balanga Schedule</h3>
                            <table class="min-w-full bg-white border border-gray-300 mb-6 text-left">
                                <thead>
                                    <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white">
                                        <th class="px-4 py-2 border-b">Departure Time</th>
                                        <th class="px-4 py-2 border-b">Bus</th>
                                        <th class="px-4 py-2 border-b">Driver</th>
                                        <th class="px-4 py-2 border-b">Conductor</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($marivelesToBalangaSchedules  as $schedule)
                                        <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white ">
                                            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'N/A' }}</td>
                                            <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'N/A' }}</td>
                                        </tr>
                                    @empty
                                        <tr><td colspan="4" class="border px-4 py-2 text-center">No schedules available</td></tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <h3 class="text-lg font-semibold mt-8 mb-6">Mariveles to Balanga Fares</h3>
                            <table class="min-w-full bg-white border border-gray-300 mb-6 text-left">
                                <thead>
                                    <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white">
                                        <th class="border px-4 py-2">Landmark</th>
                                        <th class="border px-4 py-2">Distance (km)</th>
                                        <th class="border px-4 py-2">Regular Fare</th>
                                        <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($fares as $fare)
                                        @if ($fare->route == 'Mariveles to Balanga') 
                                            <tr class="hover:bg-gray-100 odd:bg-gray-50 even:bg-white">
                                                <td class="border px-4 py-2 ">{{ $fare->landmark }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->distance }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->regular_fare }}</td>
                                                <td class="border px-4 py-2 ">{{ $fare->elderly_student_disabled_fare }}</td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
