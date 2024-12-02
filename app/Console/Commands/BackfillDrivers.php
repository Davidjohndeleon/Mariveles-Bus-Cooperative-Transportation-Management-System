<?php

namespace App\Console\Commands;

use App\Models\User;
use App\Models\Driver;
use Illuminate\Console\Command;

class BackfillDrivers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:backfill-drivers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Populate the drivers table with existing users of usertype driver';

    /**
     * Execute the console command.
     */
    public function handle():int
    {
        $drivers = User::where('usertype', 'driver')->get();

        foreach ($drivers as $user) {
            Driver::updateOrCreate(
                ['user_id' => $user->id], 
                ['name' => $user->name]  
            );
        }

        $this->info('Drivers table backfilled successfully.');
        return 0;
    }
}
