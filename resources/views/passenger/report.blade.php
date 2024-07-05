<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Report a Bus') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6">
                <!-- Report Form Section -->
                <h3 class="text-lg font-semibold mb-4">Report a Bus</h3>
                <form action="{{ route('passenger.report.submit') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="bus_id" class="block text-sm font-medium text-gray-700">Select Bus</label>
                        <select name="bus_id" id="bus_id" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Select a bus</option>
                            <!-- Populate with bus data -->
                            @foreach ($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->bus_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="topic" class="block text-sm font-medium text-gray-700">Topic</label>
                        <select name="topic" id="topic" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required>
                            <option value="">Select a topic</option>
                            <option value="driver">Driver</option>
                            <option value="conductor">Conductor</option>
                            <option value="bus_condition">Bus Condition</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label for="report" class="block text-sm font-medium text-gray-700">Report</label>
                        <textarea name="report" id="report" rows="4" class="mt-1 block w-full py-2 px-3 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" required></textarea>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-700 focus:outline-none focus:border-indigo-700 focus:ring focus:ring-indigo-500 disabled:opacity-25 transition">Submit Report</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
