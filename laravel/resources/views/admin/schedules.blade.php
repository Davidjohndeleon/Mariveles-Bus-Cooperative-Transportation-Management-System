<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Schedule Listing Section -->
                <h3 class="text-lg font-semibold mb-4">Schedules List</h3>
                <div class="mb-4">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">ID</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bus</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Driver</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Departure Time</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Arrival Time</th>
                                <th scope="col" class="relative px-6 py-3"></th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach ($schedules as $schedule)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->id }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->bus->bus_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if ($schedule->driver)
                                        {{ $schedule->driver->name }}
                                    @else
                                        Not Assigned
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->departure_time }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">{{ $schedule->arrival_time }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.edit.schedule', $schedule->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                    <form action="{{ route('admin.delete.schedule', $schedule->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Add Schedule Form Section -->
                <h3 class="text-lg font-semibold mb-4">Add New Schedule</h3>
                <form action="{{ route('admin.add.schedule') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
                        <select name="bus_id" id="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a bus</option>
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="driver_id" class="block text-sm font-medium text-gray-700">Driver</label>
                        <select name="driver_id" id="driver_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                        <input type="datetime-local" name="departure_time" id="departure_time" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    <div class="mb-4">
                        <label for="arrival_time" class="block text-sm font-medium text-gray-700">Arrival Time</label>
                        <input type="datetime-local" name="arrival_time" id="arrival_time" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Add Schedule</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
