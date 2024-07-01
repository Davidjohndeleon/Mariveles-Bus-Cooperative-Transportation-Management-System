<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\User;
use App\Models\Schedule;

class AdminController extends Controller
{
    public function manageBuses()
    {
        $buses = Bus::with('driver')->get();
        $drivers = User::where('usertype', 'driver')->get();
        return view('admin.buses', compact('buses', 'drivers'));
    }

    public function addBus(Request $request)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'driver_id' => 'nullable|exists:users,id',
        ]);
        
        $driver = null;
        if ($request->driver_name) {
            $driver = User::where('name', $request->driver_name)->where('usertype', 'driver')->first();
            if (!$driver) {
                return redirect()->route('admin.manage.buses')->withErrors(['driver_name' => 'Driver not found or not a valid driver.']);
            }
        }

        Bus::create([
            'bus_name' => $request->bus_name,
            'driver_id' => $request->driver_id,
        ]);

        return redirect()->route('admin.manage.buses')->with('success', 'Bus added successfully.');
    }
    public function editBus(Bus $bus)
    {
        $drivers = User::where('usertype', 'driver')->get();
        return view('admin.edit_bus', compact('bus', 'drivers'));
    }

    public function updateBus(Request $request, Bus $bus)
    {
    $request->validate([
        'bus_name' => 'required|string|max:255',
        'driver_name' => 'nullable|string|max:255',
    ]);

    $driver = null;
    if ($request->driver_name) {
        $driver = User::where('name', $request->driver_name)->where('usertype', 'driver')->first();
        if (!$driver) {
            return redirect()->route('admin.edit.bus', $bus->id)->withErrors(['driver_name' => 'Driver not found or not a valid driver.']);
        }
    }

    $bus->update([
        'bus_name' => $request->bus_name,
        'driver_id' => $driver ? $driver->id : null,
    ]);

    return redirect()->route('admin.manage.buses')->with('success', 'Bus updated successfully.');
    }

    public function manageSchedules()
    {
        $schedules = Schedule::with('bus', 'driver')->get();
        return view('admin.schedules', compact('schedules'));
    }

    public function addSchedule(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:users,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date|after:departure_time',
        ]);

        Schedule::create([
            'bus_id' => $request->bus_id,
            'driver_id' => $request->driver_id,
            'departure_time' => $request->departure_time,
            'arrival_time' => $request->arrival_time,
        ]);

        return redirect()->route('admin.manage.schedules')->with('success', 'Schedule added successfully.');
    }
}
