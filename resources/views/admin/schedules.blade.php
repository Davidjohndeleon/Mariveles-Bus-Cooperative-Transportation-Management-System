<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Add Schedule Form -->
                <div class="mb-8">
                    <h3 class="text-lg font-semibold mb-4">Add New Schedule</h3>
                    <form action="{{ route('admin.add.schedule') }}" method="POST" class="space-y-4">
                        @csrf
                        <!-- Route -->
                        <div>
                            <label for="route" class="block text-sm font-medium text-gray-700">Route</label>
                            <select name="route" id="route" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="Balanga to Mariveles" {{ request()->get('route') === 'Balanga to Mariveles' ? 'selected' : '' }}>Balanga to Mariveles</option>
                                <option value="Mariveles to Balanga" {{ request()->get('route') === 'Mariveles to Balanga' ? 'selected' : '' }}>Mariveles to Balanga</option>
                            </select>
                        </div>
                        
                        <!-- Bus -->
                        <div>
                            <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
                            <select name="bus_id" id="bus_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Driver -->
                        <div>
                            <label for="driver_id" class="block text-sm font-medium text-gray-700">Driver</label>
                            <select name="driver_id" id="driver_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Conductor -->
                        <div>
                            <label for="conductor_id" class="block text-sm font-medium text-gray-700">Conductor</label>
                            <select name="conductor_id" id="conductor_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                @foreach ($conductors as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Departure Time -->
                        <div>
                            <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                            <input type="time" name="departure_time" id="departure_time" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        </div>
                        
                        <!-- Submit Button -->
                        <div>
                            <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                Add Schedule
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Tab Navigation -->
                <div class="flex space-x-4 mb-6">
                    <a href="{{ route('admin.manage.schedules', ['route' => 'Balanga to Mariveles']) }}" 
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('route') === 'Balanga to Mariveles' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                              Balanga to Mariveles
                    </a>
                    <a href="{{ route('admin.manage.schedules', ['route' => 'Mariveles to Balanga']) }}" 
                       class="px-4 py-2 rounded-md 
                              {{ request()->get('route') === 'Mariveles to Balanga' ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-800' }}">
                              Mariveles to Balanga
                    </a>
                </div>

                <!-- Schedule Tables -->
                @if (request()->get('route') === 'Balanga to Mariveles' || !request()->get('route'))
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>
                    <!-- Schedule Table for Balanga to Mariveles -->
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($balangaToMarivelesSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                    <td class="border px-4 py-2 flex justify-between">
                                        <a href="{{ route('admin.edit.schedule', $schedule->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.delete.schedule', $schedule->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @elseif (request()->get('route') === 'Mariveles to Balanga')
                    <!-- Schedule Table for Mariveles to Balanga -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                                <th class="px-4 py-2 border-b">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marivelesToBalangaSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                    <td class="border px-4 py-2 flex justify-between">
                                        <a href="{{ route('admin.edit.schedule', $schedule->id) }}" class="text-blue-500 hover:underline">Edit</a>
                                        <form action="{{ route('admin.delete.schedule', $schedule->id) }}" method="POST" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:underline ml-4">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
</x-app-layout>
