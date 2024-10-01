<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Current Date -->
                <h3 class="text-lg font-semibold mb-4">{{ \Carbon\Carbon::now()->format('F j, Y') }}</h3>

                <!-- Balanga to Mariveles Schedule -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>
                <table class="min-w-full bg-white border border-gray-300 mb-6">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 border-b">Departure Time</th>
                            <th class="px-4 py-2 border-b">Bus</th>
                            <th class="px-4 py-2 border-b">Driver</th>
                            <th class="px-4 py-2 border-b">Actions</th>
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
                                <form action="{{ route('admin.add.schedule') }}" method="POST">
                                    @csrf
                                    <td class="border px-4 py-2">
                                        <input type="time" name="departure_time" value="{{ $time }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="driver_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Add</button>
                                    </td>
                                </form>
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
                            <th class="px-4 py-2 border-b">Actions</th>
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
                                <form action="{{ route('admin.add.schedule') }}" method="POST">
                                    @csrf
                                    <td class="border px-4 py-2">
                                        <input type="time" name="departure_time" value="{{ $time }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" readonly>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($buses as $bus)
                                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <select name="driver_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                            @foreach ($drivers as $driver)
                                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td class="border px-4 py-2">
                                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Add</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
