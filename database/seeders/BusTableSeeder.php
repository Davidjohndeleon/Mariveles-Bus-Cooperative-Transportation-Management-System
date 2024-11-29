<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\User;

class BusTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch all drivers
        $drivers = User::where('usertype', 'driver')->get();

        // If no drivers exist, show an error and stop
        if ($drivers->isEmpty()) {
            $this->command->error('No drivers found. Please add users with usertype driver.');
            return;
        }

        // List of buses to be added
        $buses = [
            ['bus_name' => 'Bus 101', 'plate_number' => 'ABC123'],
            // Add more buses as needed
        ];

        // To avoid reusing the same driver, we will track the assigned drivers
        $assignedDrivers = [];

        foreach ($buses as $busData) {
            // Find the first available driver who hasn't been assigned yet
            $driver = $drivers->whereNotIn('id', $assignedDrivers)->first();

            // If no more drivers are available, break the loop
            if (!$driver) {
                $this->command->warn('Not enough drivers to assign to all buses.');
                break;
            }

            // Create the bus with the driver and plate number
            Bus::create([
                'bus_name' => $busData['bus_name'],
                'plate_number' => $busData['plate_number'],
                'driver_id' => $driver->id,
            ]);

            // Mark this driver as assigned
            $assignedDrivers[] = $driver->id;
        }
    }
}
