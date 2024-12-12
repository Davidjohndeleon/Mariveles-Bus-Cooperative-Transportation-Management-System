<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div> 
                @endif 

                <!-- Error Message -->
                @if(session('error')) 
                    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                        {{ session('error') }} 
                    </div>
                @endif
                
                <!-- Validation Errors -->
                @if($errors->any()) 
                    <div class="bg-red-200 text-red-800 p-4 rounded mb-4">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li> 
                            @endforeach 
                        </ul> 
                    </div> 
                @endif
                
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

                <!-- Add Schedule Button -->
                <div id="add-schedule-container" class="mb-8">
                    <button 
                        id="toggle-add-schedule" 
                        class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Add Schedule
                    </button>
                    <!-- Add Schedule Form -->
                    <div id="add-schedule-form" class="hidden mt-4">
                        <h3 class="text-lg font-semibold mb-4">Add New Schedule</h3>
                        <form action="{{ route('admin.add.schedule') }}" method="POST" class="space-y-4">
                            @csrf
                            <!-- Route -->
                            <div>
                                <label for="route" class="block text-sm font-medium text-gray-700">Route</label>
                                <select name="route" id="route" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="Balanga to Mariveles">Balanga to Mariveles</option>
                                    <option value="Mariveles to Balanga">Mariveles to Balanga</option>
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
                            <!-- Submit and Cancel Buttons -->
                            <div class="flex space-x-4">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                                    Add Schedule
                                </button>
                                <button type="button" id="cancel-add-schedule" class="px-6 py-2 bg-gray-400 text-white rounded-md hover:bg-gray-500">
                                    Cancel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Show/Hide Actions Button -->
                <button 
                    id="toggle-actions" 
                    class="mb-6 px-6 py-2 bg-gray-600 text-white rounded-md hover:bg-gray-700">
                    Show Actions
                </button>

                <!-- Schedule Tables -->
                @if (request()->get('route') === 'Balanga to Mariveles' || !request()->get('route'))
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                                <th class="px-4 py-2 border-b actions-column hidden">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($balangaToMarivelesSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                    <td class="border px-4 py-2 actions-column hidden flex justify-between">
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

                @if (request()->get('route') === 'Mariveles to Balanga' || !request()->get('route'))
                    <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Schedule</h3>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 border-b">Departure Time</th>
                                <th class="px-4 py-2 border-b">Bus</th>
                                <th class="px-4 py-2 border-b">Driver</th>
                                <th class="px-4 py-2 border-b">Conductor</th>
                                <th class="px-4 py-2 border-b actions-column hidden">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($marivelesToBalangaSchedules as $schedule)
                                <tr>
                                    <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($schedule->departure_time)->format('g:i A') }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->bus->bus_name ?? 'No bus assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->driver->name ?? 'No driver assigned yet' }}</td>
                                    <td class="border px-4 py-2">{{ $schedule->conductor->name ?? 'No conductor assigned yet' }}</td>
                                    <td class="border px-4 py-2 actions-column hidden flex justify-between">
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

    <!-- JavaScript for toggling -->
    <script>
        // Toggle Add Schedule Form
        document.getElementById('toggle-add-schedule').addEventListener('click', function () {
            const form = document.getElementById('add-schedule-form');
            const isVisible = !form.classList.contains('hidden');
            form.classList.toggle('hidden', isVisible);
            this.textContent = isVisible ? 'Add Schedule' : 'Cancel';
        });

        // Cancel Add Schedule
        document.getElementById('cancel-add-schedule').addEventListener('click', function () {
            const form = document.getElementById('add-schedule-form');
            form.classList.add('hidden');
            document.getElementById('toggle-add-schedule').textContent = 'Add Schedule';
        });

        // Toggle Actions Column
        document.getElementById('toggle-actions').addEventListener('click', function () {
            const actionsColumns = document.querySelectorAll('.actions-column');
            const isHidden = actionsColumns[0].classList.contains('hidden');
            actionsColumns.forEach(col => col.classList.toggle('hidden', !isHidden));
            this.textContent = isHidden ? 'Hide Actions' : 'Show Actions';
        });
    </script>
</x-app-layout>
