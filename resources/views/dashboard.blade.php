<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Tab Navigation -->
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('dashboard', ['tab' => 'balanga-to-mariveles-schedule']) }}"
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('tab') === 'balanga-to-mariveles-schedule' || !request()->has('tab') ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        Balanga to Mariveles Schedule
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'mariveles-to-balanga-schedule']) }}"
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('tab') === 'mariveles-to-balanga-schedule' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        Mariveles to Balanga Schedule
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'balanga-to-mariveles-fares']) }}"
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('tab') === 'balanga-to-mariveles-fares' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        Balanga to Mariveles Fares
                    </a>
                    <a href="{{ route('dashboard', ['tab' => 'mariveles-to-balanga-fares']) }}"
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('tab') === 'mariveles-to-balanga-fares' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                        Mariveles to Balanga Fares
                    </a>
                </div>

                <!-- Default Tab: Balanga to Mariveles Schedule -->
                @if (request()->get('tab') === 'balanga-to-mariveles-schedule' || !request()->has('tab'))
                    <h3 class="text-lg font-semibold mb-4">Balanga to Mariveles Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($balangaToMarivelesSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center border px-4 py-2">No schedules available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif

                <!-- Mariveles to Balanga Schedule -->
                @if (request()->get('tab') === 'mariveles-to-balanga-schedule')
                    <h3 class="text-lg font-semibold mb-4">Mariveles to Balanga Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($marivelesToBalangaSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center border px-4 py-2">No schedules available</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                @endif

                <!-- Balanga to Mariveles Fares -->
                @if (request()->get('tab') === 'balanga-to-mariveles-fares')
                    <h3 class="text-lg font-semibold mb-4">Balanga to Mariveles Fares</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Landmark</th>
                                <th class="border px-4 py-2">Distance (km)</th>
                                <th class="border px-4 py-2">Regular Fare</th>
                                <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fares as $fare)
                                @if ($fare->route === 'Balanga to Mariveles')
                                    <tr>
                                        <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                        <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                        <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                        <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif

                <!-- Mariveles to Balanga Fares -->
                @if (request()->get('tab') === 'mariveles-to-balanga-fares')
                    <h3 class="text-lg font-semibold mb-4">Mariveles to Balanga Fares</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Landmark</th>
                                <th class="border px-4 py-2">Distance (km)</th>
                                <th class="border px-4 py-2">Regular Fare</th>
                                <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($fares as $fare)
                                @if ($fare->route === 'Mariveles to Balanga')
                                    <tr>
                                        <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                        <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                        <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                        <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    
<div>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
    <script>
        let id;
        let target;
        let options;

        function success(pos) {
        const crd = pos.coords;
        
        $.post({
            headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            url: '/driver/locping',
            data: {
            busId: {{ auth()->user()->id ?? 1 }},
            lat: crd.latitude,
            lng: crd.longitude
            }
        }).then((data) => {
            console.log(data);
        });
        }

        function error(err) {
        console.error(`ERROR(${err.code}): ${err.message}`);
        }

        target = {
        latitude: 0,
        longitude: 0,
        };

        options = {
        enableHighAccuracy: true,
        timeout: 5000,
        maximumAge: 0,
        };

        id = navigator.geolocation.watchPosition(success, error, options);

    </script>
    </div>
</x-app-layout>∏
