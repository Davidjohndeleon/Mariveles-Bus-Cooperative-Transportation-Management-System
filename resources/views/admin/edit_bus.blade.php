<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Bus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Edit Bus Form -->
                <form action="{{ route('admin.update.bus', $bus->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="bus_name" class="block text-sm font-medium text-gray-700">Bus Name</label>
                        <input type="text" name="bus_name" id="bus_name" value="{{ old('bus_name', $bus->bus_name) }}" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md">
                    </div>

                    <div class="mb-4">
                        <label for="driver_id" class="block text-sm font-medium text-gray-700">Driver</label>
                        <select name="driver_id" id="driver_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="">Select a driver</option>
                            @foreach ($drivers as $driver)
                                <option value="{{ $driver->id }}" {{ $bus->driver_id == $driver->id ? 'selected' : '' }}>{{ $driver->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Update Bus</button>
                    </div>
                </form>

                <!-- Delete Bus Section -->
                <div class="mt-6 border-t pt-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Delete Bus</h3>
                    <p class="text-sm text-gray-600">Deleting this bus cannot be undone. Are you sure?</p>
                    <form action="{{ route('admin.delete.bus', $bus->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="return confirm('Are you sure you want to delete this bus?')" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring focus:ring-red-500 disabled:opacity-25 transition">Delete Bus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
