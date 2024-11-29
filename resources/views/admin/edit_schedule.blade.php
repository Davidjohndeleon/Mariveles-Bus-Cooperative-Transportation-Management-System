<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Schedule') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <form action="{{ route('admin.update.schedule', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="bus_id" class="block text-sm font-medium text-gray-700">Bus</label>
                        <select name="bus_id" id="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}" {{ $schedule->bus_id == $bus->id ? 'selected' : '' }}>
                                    {{ $bus->bus_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Driver selection -->
                    <div class="mb-4">
                        <label for="driver_id" class="block text-sm font-medium text-gray-700">Driver</label>
                        <select name="driver_id" id="driver_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $schedule->driver_id == $driver->id ? 'selected' : '' }}>
                                    {{ $driver->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="conductor_id" class="block text-sm font-medium text-gray-700">Conductor</label>
                        <select name="conductor_id" id="conductor_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            @foreach ($conductors as $conductor)
                                <option value="{{ $conductor->id }}" {{ $schedule->conductor_id == $conductor->id ? 'selected' : '' }}>
                                    {{ $conductor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="departure_time" class="block text-sm font-medium text-gray-700">Departure Time</label>
                        <input type="datetime-local" name="departure_time" id="departure_time" value="{{ date('Y-m-d\TH:i', strtotime($schedule->departure_time)) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>
                    
                    <div class="mt-4 flex items-center space-x-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">
                            Update Schedule
                        </button>

                        <a href="{{ route('admin.manage.schedules') }}" class="inline-flex items-center px-4 py-2 bg-gray-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-600 active:bg-gray-600 focus:outline-none focus:border-gray-700 focus:ring focus:ring-gray-500 disabled:opacity-25 transition">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
