<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\Fare;
use App\Models\Driver;
use App\Models\Bus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch schedules from the database
        $balangaToMarivelesSchedules = Schedule::where('route', 'balanga_to_mariveles')->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'mariveles_to_balanga')->get();

        // Assuming you have Bus and Driver models
        $buses = Bus::all();
        $drivers = Driver::all();
        $fares = Fare::all();
        

        // Pass the data to the view
        return view('dashboard', compact('balangaToMarivelesSchedules', 'marivelesToBalangaSchedules', 'buses','fares', 'drivers'));
    }
}
