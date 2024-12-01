<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fares') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <form action="{{ route('fares.updateAll') }}" method="POST">
                    @csrf
                    @method('PUT')

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-4">Save Changes</button>

                    <!-- Balanga to Mariveles -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Fares</h3>
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
                            @foreach($balangaToMarivelesFares as $fare)
                                <tr>
                                    <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                    <td class="border px-4 py-2">
                                        <input type="hidden" name="fares[{{ $fare->id }}][id]" value="{{ $fare->id }}">
                                        <input type="number" name="fares[{{ $fare->id }}][distance]" value="{{ $fare->distance }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="fares[{{ $fare->id }}][regular_fare]" value="{{ $fare->regular_fare }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="fares[{{ $fare->id }}][elderly_student_disabled_fare]" value="{{ $fare->elderly_student_disabled_fare }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Mariveles to Balanga -->
                    <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Fares</h3>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Landmark</th>
                                <th class="border px-4 py-2">Distance (km)</th>
                                <th class="border px-4 py-2">Regular Fare</th>
                                <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marivelesToBalangaFares as $fare)
                                <tr>
                                    <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                    <td class="border px-4 py-2">
                                        <input type="hidden" name="fares[{{ $fare->id }}][id]" value="{{ $fare->id }}">
                                        <input type="number" name="fares[{{ $fare->id }}][distance]" value="{{ $fare->distance }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="fares[{{ $fare->id }}][regular_fare]" value="{{ $fare->regular_fare }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                    <td class="border px-4 py-2">
                                        <input type="number" name="fares[{{ $fare->id }}][elderly_student_disabled_fare]" value="{{ $fare->elderly_student_disabled_fare }}" class="border rounded p-1 w-full" step="0.01" min="0">
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
