<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Schedule;
use App\Models\Bus;
use App\Models\User;
use Carbon\Carbon;

class ScheduleTableSeeder extends Seeder
{
    public function run()
    {
        // Fetch all buses along with their assigned drivers
        $buses = Bus::with('driver')->get();
        $conductorIds = User::where('usertype', 'conductor')->pluck('id')->toArray();

        if ($buses->isEmpty()) {
            $this->command->error('No buses found. Please add buses with assigned drivers first.');
            return;
        }

        if (empty($conductorIds)) {
            $this->command->error('No conductors found. Please add users with usertype conductor.');
            return;
        }

        // Define start, end times, and interval in minutes
        $startTime = Carbon::createFromTime(3, 50, 0); // 3:50 AM
        $endTime = Carbon::createFromTime(21, 20, 0);  // 9:20 PM
        $interval = 60;  // Interval in minutes (1 hour)

        // Routes data for schedules
        $routes = ['Balanga to Mariveles', 'Mariveles to Balanga'];

        // Generate schedules with departure times
        while ($startTime <= $endTime) {
            foreach ($routes as $route) {
                foreach ($buses as $bus) {
                    Schedule::create([
                        'departure_time' => $startTime->format('H:i:s'), // 24-hour format (HH:MM:SS)
                        'route' => $route,
                        'bus_id' => $bus->id,                          // Assigned bus ID
                        'driver_id' => $bus->driver->id,               // Driver assigned to the bus
                        'conductor_id' => $conductorIds[array_rand($conductorIds)], // Random conductor
                    ]);
                }
            }

            // Increment the start time by the interval
            $startTime->addMinutes($interval);
        }
    }
}
