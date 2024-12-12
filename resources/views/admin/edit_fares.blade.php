<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Fare') }}
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
                <a href="{{ route('fares.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded mb-4 inline-block">
                    Back to Fares
                </a>

                <form action="{{ route('fares.update', $fare->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="distance" class="mb-2">Distance (km)</label>
                            <input type="number" name="distance" value="{{ $fare->distance }}" class="border rounded p-2" step="0.01" min="0" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="regular_fare" class="mb-2">Regular Fare</label>
                            <input type="number" name="regular_fare" value="{{ $fare->regular_fare }}" class="border rounded p-2" step="0.01" min="0" required>
                        </div>

                        <div class="flex flex-col">
                            <label for="elderly_student_disabled_fare" class="mb-2">Elderly/Student/Disabled Fare</label>
                            <input type="number" name="elderly_student_disabled_fare" value="{{ $fare->elderly_student_disabled_fare }}" class="border rounded p-2" step="0.01" min="0" required>
                        </div>
                    </div>

                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded mt-6">Save</button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>
