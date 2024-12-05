<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Buses') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Add Bus Form Section -->
                <h3 class="text-lg font-semibold mb-4">Add New Bus</h3>
                @if ($errors->any())
                    <div class="mb-4">
                        <div class="font-medium text-red-600">
                            {{ __('Whoops! Something went wrong.') }}
                        </div>
                        <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                @if (session('success'))
                    <div class="mb-4 text-green-600">
                        {{ session('success') }}
                    </div>
                @endif

                @if (session('error'))
                    <div class="mb-4 text-red-600">
                        {{ session('error') }}
                    </div>
                @endif

                <form action="{{ route('admin.add.bus') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="bus_name" class="block text-sm font-medium text-gray-700">Bus Name</label>
                        <input type="text" name="bus_name" id="bus_name" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <!-- Add Plate Number -->
                    <div class="mb-4">
                        <label for="plate_number" class="block text-sm font-medium text-gray-700">Plate Number</label>
                        <input type="text" name="plate_number" id="plate_number" class="mt-1 focus:ring-indigo-500 focus:border-indigo-500 block w-full shadow-sm sm:text-sm border-gray-300 rounded-md" required>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Add Bus</button>
                    </div>
                </form>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 mt-6">
                <!-- Bus Listing Section -->
                <h3 class="text-lg font-semibold mb-4">Buses List</h3>

                <table id="buses-table"class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Bus Name</th>
                            <th>Plate Number</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($buses as $bus)
                            <tr>
                                <td>{{ $bus->id }}</td>
                                <td>{{ $bus->bus_name }}</td>
                                <td>{{ $bus->plate_number }}</td>
                                <td>
                                    <a href="{{ route('admin.edit.bus', $bus->id) }}" class="text-indigo-600 hover:text-indigo-900">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Include DataTables CSS & JS -->
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#buses-table').DataTable(); 
        });
    </script>
</x-app-layout>
