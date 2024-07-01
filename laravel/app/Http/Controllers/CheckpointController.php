<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CheckpointController extends Controller
{
    public function scanQRCode($driverId)
    {
        $driver = User::where('id', $driverId)->where('usertype', 'driver')->first();

        if (!$driver) {
            return redirect()->back()->with('error', 'Driver not found.');
        }

        return view('checkpoint.scan', compact('driver'));
    }
}
