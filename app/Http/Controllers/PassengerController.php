<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;
class PassengerController extends Controller
{
    public function viewBusSchedules()
    {
        $schedules = Schedule::with('bus')->get();
        return view('passenger.schedules', compact('schedules'));
    }
}
