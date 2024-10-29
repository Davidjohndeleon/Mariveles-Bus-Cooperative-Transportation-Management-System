<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CheckpointController extends Controller
{
    public function scanQRCode(Request $request)
{
    $request->validate(['driver_id' => 'required|exists:users,id',]);

    $driverId = $request->input('driver_id'); 
    $driver = User::where('id', $driverId)->where('usertype', 'driver')->first();

    if (!$driver) {
        return redirect()->back()->with('error', 'Driver not found.');
    }

    return redirect()->route('checkpoint.success')->with('success', 'QR Code scanned successfully for driver: ' . $driver->name);
}

public function success()
{
    return view('checkpoint.success'); 
}


    
}
