<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Fares') }}
        </h2>
    </x-slot>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">

                <!-- Success Message -->
                @if(session('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Edit All Button -->
                <div class="mb-6">
                    <a href="{{ route('fares.editAll') }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                        Edit All Fares
                    </a>
                </div>

                <!-- Balanga to Mariveles Fares -->
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
                                <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
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
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($marivelesToBalangaFares as $fare)
                            <tr>
                                <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>
