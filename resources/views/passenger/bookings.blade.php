<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Bus Booking Requests') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{-- Display Success and Error Messages --}}
                    @if(session('success'))
                        <div class="bg-green-100 text-green-800 p-4 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @elseif(session('error'))
                        <div class="bg-red-100 text-red-800 p-4 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @if ($bookings->isEmpty())
                        <p class="text-gray-600">You have no booking requests yet.</p>
                    @else
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead>
                                <tr>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bus</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Contact Info</th>
                                    <th class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($bookings as $booking)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            {{ $booking->bus->bus_name }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                                {{ $booking->status == 'approved' ? 'bg-green-100 text-green-800' : 
                                                   ($booking->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                                {{ ucfirst($booking->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $booking->remarks ?? 'N/A' }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            <form action="{{ route('passenger.bookings.delete', $booking->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                                    Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    <div class="mt-6">
                        <h3 class="text-lg font-medium text-gray-900">Available Buses</h3>
                        <div class="mt-4">
                            @foreach ($buses as $bus)
                                @php
                                    $existingBooking = $bookings->where('bus_id', $bus->id)->first();
                                @endphp

                                @if ($existingBooking && $existingBooking->status !== 'rejected')
                                    <p class="text-gray-500">You have already booked {{ $bus->bus_name }}. Status: {{ ucfirst($existingBooking->status) }}</p>
                                @elseif ($bookings->count() >= 3)
                                    <p class="text-red-500">You can only book up to 3 buses at a time.</p>
                                @else
                                    <div class="flex justify-between items-center py-2">
                                        <span>{{ $bus->bus_name }}</span>
                                        <form action="{{ route('passenger.requestBusBooking', $bus->id) }}" method="POST" class="mt-2 w-full sm:w-3/4 lg:w-1/2">
                                            @csrf
                                            <div class="space-y-2">
                                                <textarea name="remarks" placeholder="Add contact information here" class="w-full px-3 py-2 border rounded-lg focus:outline-none focus:ring focus:border-blue-300" required></textarea>
                                                <button type="submit" class="w-full text-white bg-blue-500 hover:bg-blue-700 px-4 py-2 rounded focus:outline-none focus:ring">
                                                    Book This Bus
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
