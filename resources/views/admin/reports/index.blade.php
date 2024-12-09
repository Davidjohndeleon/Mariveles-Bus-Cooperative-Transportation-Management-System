<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bus Reports') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                
                <h3 class="text-lg font-semibold mb-4">All Complains</h3>

                <table class="min-w-full bg-white">
                    <thead>
                        <tr>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Bus</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Passenger</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Topic</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Complain</th>
                            <th class="px-6 py-3 border-b-2 border-gray-300 text-left leading-4 text-blue-500">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($reports->isEmpty())
                            <tr class="px-6 py-4 border-b border-gray-300">
                                <td class="px-6 py-4 border-b border-gray-300">No Complaints Yet</td>
                            </tr>
                        @else
                        @foreach ($reports as $report)
                            <tr>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $report->bus->bus_name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $report->user->name }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ ucfirst($report->topic) }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $report->report }}</td>
                                <td class="px-6 py-4 border-b border-gray-300">{{ $report->created_at->format('Y-m-d') }}</td>
                            </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>