<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
class PassengerController extends Controller
{
    public function viewBusSchedules()
    {
        // Fetch schedules for both routes
        $balangaToMarivelesSchedules = Schedule::where('route', 'Balanga to Mariveles')->with('bus', 'driver')->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'Mariveles to Balanga')->with('bus', 'driver')->get();

        // Pass both schedules to the view
        return view('passenger.schedules', compact('balangaToMarivelesSchedules', 'marivelesToBalangaSchedules'));
    }
}
