<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Checkpoints') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-lg p-6">
                @if (session('success'))
                    <div class="bg-green-200 text-green-800 p-4 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                <h3 class="text-lg font-semibold mb-4">Your Checkpoints</h3>

                @if($checkpoints->isEmpty())
                    <p class="text-gray-600">No checkpoints available.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="table-auto w-full border-collapse border border-gray-300 text-left">
                            <thead>
                                <tr class="bg-gray-100 text-gray-700">
                                    <th class="border border-gray-300 px-4 py-2">Checkpoint Name</th>
                                    <th class="border border-gray-300 px-4 py-2">Status</th>
                                    <th class="border border-gray-300 px-4 py-2">Timestamp</th>
                                    <th class="border border-gray-300 px-4 py-2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($checkpoints as $checkpoint)
                                    <tr class="hover:bg-gray-50">
                                        <td class="border border-gray-300 px-4 py-2">{{ $checkpoint->name }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            @if($checkpoint->status === 'completed')
                                                <span class="text-green-600 font-medium">Completed</span>
                                            @else
                                                <span class="text-yellow-600 font-medium">Pending</span>
                                            @endif
                                        </td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $checkpoint->created_at->format('F j, Y, g:i A') }}</td>
                                        <td class="border border-gray-300 px-4 py-2">
                                            @if($checkpoint->status !== 'completed')
                                                <form action="{{ route('driver.completeCheckpoint', $checkpoint->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
                                                        Mark as Complete
                                                    </button>
                                                </form>
                                            @else
                                                <span class="text-gray-500">No Action</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
