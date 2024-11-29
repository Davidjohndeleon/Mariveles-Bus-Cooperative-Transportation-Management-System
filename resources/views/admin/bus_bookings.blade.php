<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Manage Bus Bookings') }}
        </h2>
    </x-slot>

    <div class="container mx-auto p-6">
        {{-- Success Message --}}
        @if(session('success'))
            <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        {{-- Bookings Table --}}
        <table class="table-auto w-full border-collapse border border-gray-200">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border border-gray-200 px-4 py-2">Bookings Appointments</th>
                </tr>
            </thead>
            <tbody>
                @foreach($bookings as $passengerId => $userBookings)
                    {{-- Main Booking Row --}}
                    <tr class="hover:bg-gray-50 transition-colors duration-150 ease-in-out">
                        <td class="border-b border-gray-200 px-6 py-4 whitespace-nowrap">
                            <button 
                                class="group inline-flex items-center space-x-2 text-sm font-medium text-gray-900 hover:text-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 rounded-md transition-colors duration-150"
                                onclick="toggleBuses('{{ $passengerId }}')"
                            >
                                <span class="flex items-center">
                                    <!-- User Icon -->
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-blue-500 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                    {{ $userBookings->first()->passenger->name }}
                                </span>
                                <!-- Chevron Icon -->
                                <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-500 transition-transform duration-200 transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </button>
                        </td>
                    </tr>

                    {{-- Hidden Buses and Actions Row --}}
                    <tr id="buses-{{ $passengerId }}" class="hidden">
                        <td colspan="6" class="border border-gray-200 px-4 py-2 bg-gray-50">
                            <strong>Buses booked by {{ $userBookings->first()->passenger->name }}:</strong>
                            <table class="w-full mt-2">
                                <thead>
                                    <tr class="bg-gray-200">
                                        <th class="border border-gray-200 px-4 py-2">Bus Name</th>
                                        <th class="border border-gray-200 px-4 py-2">Contacts</th>
                                        <th class="border border-gray-200 px-4 py-2">Status</th>
                                        <th class="border border-gray-200 px-4 py-2">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($userBookings as $userBooking)
                                        <tr>
                                            <td class="border border-gray-200 px-4 py-2">{{ $userBooking->bus->bus_name }}</td>
                                            <td class="border border-gray-200 px-4 py-2">{{ $userBooking->remarks ?? 'N/A' }}</td>
                                            <td class="border border-gray-200 px-4 py-2">
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                                    {{ $userBooking->status == 'approved' ? 'bg-green-100 text-green-800' :
                                                       ($userBooking->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                    {{ ucfirst($userBooking->status) }}
                                                </span>
                                            </td>
                                            <td class="border border-gray-200 px-4 py-2">
                                                @if($userBooking->status === 'pending')
                                                    <form action="{{ route('admin.bookings.update', $userBooking->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Approve</button>
                                                    </form>
                                                    <form action="{{ route('admin.bookings.update', $userBooking->id) }}" method="POST" class="inline">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                                                    </form>
                                                @endif
                                                <form action="{{ route('admin.bookings.delete', $userBooking->id) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Delete</button>
                                                </form>
                                                @if($userBooking->status !== 'pending')
                                                    <span class="text-gray-600">No actions available</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        function toggleBuses(userId) {
            const row = document.getElementById(`buses-${userId}`);
            if (row) {
                row.classList.toggle('hidden');
            }
        }
    </script>
</x-app-layout>
