<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Schedule;

class DriverController extends Controller
{
    public function viewSchedules()
    {
        $schedules = Schedule::where('driver_id', auth()->id())->get();
        return view('driver.schedules', compact('schedules'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|string',
        ]);

        $schedule = Schedule::where('id', $id)->where('driver_id', auth()->id())->first();

        if (!$schedule) {
            return redirect()->back()->with('error', 'Schedule not found.');
        }

        $schedule->update([
            'status' => $request->status,
        ]);

        return redirect()->route('driver.schedules')->with('success', 'Schedule updated successfully.');
    }
}
