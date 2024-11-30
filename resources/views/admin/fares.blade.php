<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Fares') }}
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

                <!-- Balanga to Mariveles Fares -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Fares</h3>
                <table class="min-w-full bg-white border border-gray-300 mb-6">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Landmark</th>
                            <th class="border px-4 py-2">Distance (km)</th>
                            <th class="border px-4 py-2">Regular Fare</th>
                            <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($balangaToMarivelesFares as $fare)
                            <tr>
                                <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('fares.update', $fare->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="distance" value="{{ old('distance', $fare->distance) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                        @error('distance')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="number" name="regular_fare" value="{{ old('regular_fare', $fare->regular_fare) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    @error('regular_fare')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="number" name="elderly_student_disabled_fare" value="{{ old('elderly_student_disabled_fare', $fare->elderly_student_disabled_fare) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    @error('elderly_student_disabled_fare')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Mariveles to Balanga Fares -->
                <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Fares</h3>
                <table class="min-w-full bg-white border border-gray-300">
                    <thead>
                        <tr>
                            <th class="border px-4 py-2">Landmark</th>
                            <th class="border px-4 py-2">Distance (km)</th>
                            <th class="border px-4 py-2">Regular Fare</th>
                            <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                            <th class="border px-4 py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marivelesToBalangaFares as $fare)
                            <tr>
                                <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                <td class="border px-4 py-2">
                                    <form action="{{ route('fares.update', $fare->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="distance" value="{{ old('distance', $fare->distance) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                        @error('distance')
                                            <span class="text-red-600 text-sm">{{ $message }}</span>
                                        @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="number" name="regular_fare" value="{{ old('regular_fare', $fare->regular_fare) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    @error('regular_fare')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <input type="number" name="elderly_student_disabled_fare" value="{{ old('elderly_student_disabled_fare', $fare->elderly_student_disabled_fare) }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    @error('elderly_student_disabled_fare')
                                        <span class="text-red-600 text-sm">{{ $message }}</span>
                                    @enderror
                                </td>
                                <td class="border px-4 py-2">
                                    <button type="submit" class="bg-blue-500 text-white px-4 py-1 rounded">Update</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
