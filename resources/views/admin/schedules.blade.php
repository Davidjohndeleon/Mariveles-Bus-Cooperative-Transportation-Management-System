<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Schedules') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
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

                @if (request()->get('route') === 'Balanga to Mariveles' || !request()->get('route'))
                    <!-- Balanga to Mariveles Schedule Table -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Schedule</h3>
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
                    <!-- Mariveles to Balanga Schedule Table -->
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
</x-app-layout>
