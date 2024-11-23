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
                    <th class="border border-gray-200 px-4 py-2">ID</th>
                    <th class="border border-gray-200 px-4 py-2">Passenger</th>
                    <th class="border border-gray-200 px-4 py-2">Bus</th>
                    <th class="border border-gray-200 px-4 py-2">Remarks</th>
                    <th class="border border-gray-200 px-4 py-2">Status</th>
                    <th class="border border-gray-200 px-4 py-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($bookings as $booking)
                    <tr>
                        <td class="border border-gray-200 px-4 py-2">{{ $booking->id }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $booking->passenger->name }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $booking->bus->plate_number }}</td>
                        <td class="border border-gray-200 px-4 py-2">{{ $booking->remarks ?? 'N/A' }}</td>
                        <td class="border border-gray-200 px-4 py-2">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full
                                {{ $booking->status == 'approved' ? 'bg-green-100 text-green-800' :
                                   ($booking->status == 'rejected' ? 'bg-red-100 text-red-800' : 'bg-yellow-100 text-yellow-800') }}">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </td>
                        <td class="border border-gray-200 px-4 py-2">
                            @if($booking->status === 'pending')
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Approve</button>
                                </form>
                                <form action="{{ route('admin.bookings.update', $booking->id) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Reject</button>
                                </form>
                            @else
                                <span class="text-gray-600">No actions available</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="border border-gray-200 px-4 py-2 text-center text-gray-600">
                            No bookings available.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>
