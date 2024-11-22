<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bus;
use App\Models\User;

class BusTableSeeder extends Seeder
{
    public function run()
    {
        $drivers = User::where('usertype', 'driver')->get();

        if ($drivers->isEmpty()) {
            $this->command->error('No drivers found. Please add users with usertype driver.');
            return;
        }

        $buses = [
            'Bus 101',
            'Bus 102',
            'Bus 103',
            'Bus 104',
        ];

        foreach ($buses as $busName) {
            $driver = $drivers->random();

            Bus::create([
                'bus_name' => $busName,
                'driver_id' => $driver->id,
            ]);
        }
    }
}
