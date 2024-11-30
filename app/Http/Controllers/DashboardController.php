<?php

namespace App\Http\Controllers;
use App\Models\Schedule;
use App\Models\Fare;
use App\Models\Driver;
use App\Models\Bus;
use App\Models\Conductor;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch schedules from the database
        $balangaToMarivelesSchedules = Schedule::where('route', 'Balanga to Mariveles')->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'Mariveles to Balanga')->get();

        // Assuming you have Bus and Driver models
        $buses = Bus::all();
        $drivers = Driver::all();
        $conductors = Conductor::all();
        $fares = Fare::all();
        

        // Pass the data to the view
        return view('dashboard', compact('balangaToMarivelesSchedules', 'marivelesToBalangaSchedules', 'buses','fares', 'drivers','conductors'));

    }
}
