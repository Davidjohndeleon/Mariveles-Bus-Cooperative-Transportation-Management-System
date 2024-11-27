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

        if ($drivers->isEmpty()) {
            $this->command->error('No drivers found. Please add users with usertype driver.');
            return;
        }

        $buses = [
            'Bus 101',

        ];

        // Ensure drivers are not reused
        $assignedDrivers = [];

        foreach ($buses as $busName) {
            // Find the first available driver who hasn't been assigned yet
            $driver = $drivers->whereNotIn('id', $assignedDrivers)->first();

            // If no more drivers are available, break the loop
            if (!$driver) {
                $this->command->warn('Not enough drivers to assign to all buses.');
                break;
            }

            // Create the bus with the driver
            Bus::create([
                'bus_name' => $busName,
                'driver_id' => $driver->id,
            ]);

            // Mark this driver as assigned
            $assignedDrivers[] = $driver->id;
        }
    }
}
