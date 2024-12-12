<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Fares') }}
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

                <!-- Tab Navigation -->
                <div class="mb-4">
                    <button id="balangaToMarivelesTab" class="px-4 py-2 border-b-2 font-semibold focus:outline-none active:border-blue-500 text-blue-500 hover:text-blue-700">
                        Balanga to Mariveles Fares
                    </button>
                    <button id="marivelesToBalangaTab" class="px-4 py-2 border-b-2 font-semibold focus:outline-none text-gray-500 hover:text-blue-700">
                        Mariveles to Balanga Fares
                    </button>
                </div>

                <!-- Tab Content -->
                <div id="balangaToMarivelesContent">
                    <h3 class="text-lg font-semibold mt-8 mb-4">Balanga to Mariveles Fares</h3>
                    <button id="toggle-edit-buttons-balanga" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Show Edit</button>
                    <table class="min-w-full bg-white border border-gray-300 mb-6">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Landmark</th>
                                <th class="border px-4 py-2">Distance (km)</th>
                                <th class="border px-4 py-2">Regular Fare</th>
                                <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                                <th class="border px-4 py-2 edit-column-header hidden">Edit Buttons</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($balangaToMarivelesFares as $fare)
                                <tr>
                                    <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                    <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                    <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                    <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
                                    <td class="border px-4 py-2 edit-column hidden"> 
                                        <a href="{{ route('fares.edit', $fare->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div id="marivelesToBalangaContent" class="hidden">
                    <h3 class="text-lg font-semibold mt-8 mb-4">Mariveles to Balanga Fares</h3>
                    <button id="toggle-edit-buttons-mariveles" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">Show Edit</button>
                    <table class="min-w-full bg-white border border-gray-300">
                        <thead>
                            <tr>
                                <th class="border px-4 py-2">Landmark</th>
                                <th class="border px-4 py-2">Distance (km)</th>
                                <th class="border px-4 py-2">Regular Fare</th>
                                <th class="border px-4 py-2">Elderly/Student/Disabled Fare</th>
                                <th class="border px-4 py-2 edit-column-header hidden">Edit Buttons</th> 
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($marivelesToBalangaFares as $fare)
                                <tr>
                                    <td class="border px-4 py-2">{{ $fare->landmark }}</td>
                                    <td class="border px-4 py-2">{{ $fare->distance }}</td>
                                    <td class="border px-4 py-2">{{ $fare->regular_fare }}</td>
                                    <td class="border px-4 py-2">{{ $fare->elderly_student_disabled_fare }}</td>
                                    <td class="border px-4 py-2 edit-column hidden"> 
                                        <a href="{{ route('fares.edit', $fare->id) }}" class="text-blue-500 hover:text-blue-700">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <script>
                    // Tab Switching Logic
                    const balangaToMarivelesTab = document.getElementById("balangaToMarivelesTab");
                    const marivelesToBalangaTab = document.getElementById("marivelesToBalangaTab");
                    const balangaToMarivelesContent = document.getElementById("balangaToMarivelesContent");
                    const marivelesToBalangaContent = document.getElementById("marivelesToBalangaContent");

                    balangaToMarivelesTab.addEventListener("click", function() {
                        balangaToMarivelesTab.classList.add("text-blue-500", "border-blue-500");
                        marivelesToBalangaTab.classList.remove("text-blue-500", "border-blue-500");
                        marivelesToBalangaTab.classList.add("text-gray-500");
                        balangaToMarivelesContent.classList.remove("hidden");
                        marivelesToBalangaContent.classList.add("hidden");
                    });

                    marivelesToBalangaTab.addEventListener("click", function() {
                        marivelesToBalangaTab.classList.add("text-blue-500", "border-blue-500");
                        balangaToMarivelesTab.classList.remove("text-blue-500", "border-blue-500");
                        balangaToMarivelesTab.classList.add("text-gray-500");
                        marivelesToBalangaContent.classList.remove("hidden");
                        balangaToMarivelesContent.classList.add("hidden");
                    });

                    // Show/Hide Edit Column for Balanga to Mariveles
                    const showEditButtonBalanga = document.getElementById("toggle-edit-buttons-balanga");
                    const editColumnsBalanga = document.querySelectorAll("#balangaToMarivelesContent .edit-column");
                    const editColumnHeadersBalanga = document.querySelectorAll("#balangaToMarivelesContent .edit-column-header");

                    showEditButtonBalanga.addEventListener("click", function() {
                        editColumnsBalanga.forEach(function(column) {
                            column.classList.toggle("hidden");
                        });
                        editColumnHeadersBalanga.forEach(function(header) {
                            header.classList.toggle("hidden");
                        });
                    });

                    // Show/Hide Edit Column for Mariveles to Balanga
                    const showEditButtonMariveles = document.getElementById("toggle-edit-buttons-mariveles");
                    const editColumnsMariveles = document.querySelectorAll("#marivelesToBalangaContent .edit-column");
                    const editColumnHeadersMariveles = document.querySelectorAll("#marivelesToBalangaContent .edit-column-header");

                    showEditButtonMariveles.addEventListener("click", function() {
                        editColumnsMariveles.forEach(function(column) {
                            column.classList.toggle("hidden");
                        });
                        editColumnHeadersMariveles.forEach(function(header) {
                            header.classList.toggle("hidden");
                        });
                    });
                </script>

            </div>
        </div>
    </div>
</x-app-layout>
