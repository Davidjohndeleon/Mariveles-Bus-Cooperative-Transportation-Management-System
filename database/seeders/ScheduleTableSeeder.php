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
        $busIds = Bus::pluck('id')->toArray();
        $driverIds = User::where('usertype', 'driver')->pluck('id')->toArray();
        $conductorIds = User::where('usertype', 'conductor')->pluck('id')->toArray();
        // Define start, end times, and interval in minutes
        $startTime = Carbon::createFromTime(3, 50, 0); // 3:50 AM
        $endTime = Carbon::createFromTime(21, 20, 0);  // 9:20 PM
        $interval = 60;  // Interval in minutes (1 hour)

        // Routes data for schedules (you can expand this array)
        $routes = ['Balanga to Mariveles', 'Mariveles to Balanga'];

        // Generate schedules with departure times
        while ($startTime <= $endTime) {
            foreach ($routes as $route) {
                Schedule::create([
                    'departure_time' => $startTime->format('H:i:s'),  // Use 24-hour format (HH:MM:SS)
                    'route' => $route,
                    'bus_id' => $busIds[array_rand($busIds)],          // Random existing bus ID
                    'driver_id' => $driverIds[array_rand($driverIds)], // Random existing driver ID
                    'conductor_id' => $conductorIds[array_rand($conductorIds)], // Random existing conductor ID
                ]);
            }

            // Increment the start time by the interval
            $startTime->addMinutes($interval);
        }
    }
}
