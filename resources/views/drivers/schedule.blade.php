<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Your Schedule') }}
        </h2>
    </x-slot>
    
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.1.8/css/dataTables.bootstrap5.css" rel="stylesheet">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Your Upcoming Schedule</h3>

                @if($schedules->isEmpty())
                    <p>You do not have any scheduled trips.</p>
                @else
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Route</th>
                                <th>Departure Time</th>
                                <th>Bus</th>
                                <th>Conductor</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->route }}</td>
                                    <td>{{ \Carbon\Carbon::parse($schedule->departure_time)->format('h:i A') }}</td>
                                    <td>{{ $schedule->bus->bus_name }}</td>
                                    <td>{{ $schedule->conductor ? $schedule->conductor->name : 'No conductor assigned' }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
