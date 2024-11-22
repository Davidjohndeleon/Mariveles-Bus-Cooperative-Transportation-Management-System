<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Balanga to Mariveles Schedule -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>

                <form action="{{ route('admin.add.schedule') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="route" value="Balanga to Mariveles">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="departure_time" class="block text-sm font-medium">Departure Time</label>
                            <input type="time" name="departure_time" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="bus_id" class="block text-sm font-medium">Select Bus</label>
                            <select name="bus_id" required class="w-full border-gray-300 rounded-md">
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="driver_id" class="block text-sm font-medium">Select Driver</label>
                            <input type="text" id="driver-filter" placeholder="Search Driver" class="w-full border-gray-300 rounded-md mb-2">
                            <select name="driver_id" id="driver-dropdown" required class="w-full border-gray-300 rounded-md">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="conductor_id" class="block text-sm font-medium">Select Conductor</label>
                            <input type="text" id="conductor-filter" placeholder="Search Conductor" class="w-full border-gray-300 rounded-md mb-2">
                            <select name="conductor_id" id="conductor-dropdown" required class="w-full border-gray-300 rounded-md">
                                @foreach ($conductors as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md">
                        Add Schedule
                    </button>
                </form>

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
                                <td class="border px-4 py-2">
                                    {{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->driver->name ?? 'No driver assigned yet' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->conductor->name ?? 'No conductor assigned yet' }}
                                </td>
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

                <!-- Mariveles to Balanga Schedule -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Schedule</h3>

                <form action="{{ route('admin.add.schedule') }}" method="POST" class="mb-6">
                    @csrf
                    <input type="hidden" name="route" value="Mariveles to Balanga">
                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label for="departure_time" class="block text-sm font-medium">Departure Time</label>
                            <input type="time" name="departure_time" required class="w-full border-gray-300 rounded-md">
                        </div>
                        <div>
                            <label for="bus_id" class="block text-sm font-medium">Select Bus</label>
                            <select name="bus_id" required class="w-full border-gray-300 rounded-md">
                                @foreach ($buses as $bus)
                                    <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="driver_id" class="block text-sm font-medium">Select Driver</label>
                            <input type="text" id="driver-filter-2" placeholder="Search Driver" class="w-full border-gray-300 rounded-md mb-2">
                            <select name="driver_id" id="driver-dropdown-2" required class="w-full border-gray-300 rounded-md">
                                @foreach ($drivers as $driver)
                                    <option value="{{ $driver->id }}">{{ $driver->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="conductor_id" class="block text-sm font-medium">Select Conductor</label>
                            <input type="text" id="conductor-filter-2" placeholder="Search Conductor" class="w-full border-gray-300 rounded-md mb-2">
                            <select name="conductor_id" id="conductor-dropdown-2" required class="w-full border-gray-300 rounded-md">
                                @foreach ($conductors as $conductor)
                                    <option value="{{ $conductor->id }}">{{ $conductor->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="mt-4 px-4 py-2 bg-indigo-600 text-white rounded-md">
                        Add Schedule
                    </button>
                </form>

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
                                <td class="border px-4 py-2">
                                    {{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->driver->name ?? 'No driver assigned yet' }}
                                </td>
                                <td class="border px-4 py-2">
                                    {{ $schedule->conductor->name ?? 'No conductor assigned yet' }}
                                </td>
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


                <!-- Dynamic Name Filter Script -->
                <script>
                    // Filter function for dropdowns
                    function filterDropdown(inputId, dropdownId) {
                        const input = document.getElementById(inputId);
                        const dropdown = document.getElementById(dropdownId);
                        const options = dropdown.querySelectorAll('option');

                        input.addEventListener('input', () => {
                            const filter = input.value.toLowerCase();

                            options.forEach(option => {
                                const text = option.textContent.toLowerCase();
                                option.style.display = text.includes(filter) ? '' : 'none';
                            });
                        });
                    }

                    // Initialize filters for all dropdowns
                    document.addEventListener('DOMContentLoaded', () => {
                        filterDropdown('driver-filter', 'driver-dropdown');
                        filterDropdown('conductor-filter', 'conductor-dropdown');
                        filterDropdown('driver-filter-2', 'driver-dropdown-2');
                        filterDropdown('conductor-filter-2', 'conductor-dropdown-2');
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
