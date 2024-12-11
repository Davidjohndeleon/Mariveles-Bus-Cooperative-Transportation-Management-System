<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Schedule;
use App\Models\ScannedQR;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckpointController extends Controller
{
    public function showScanForm()
    {
        $scannedCheckpoints = ScannedQR::with(['checkpoint', 'driver','schedule.bus', 'schedule.conductor'])->get();
        
        return view('checkpoint.scan', compact('scannedCheckpoints'));
    }

    /**
     * Handle QR code scanning.
     */
    public function scanQRCode(Request $request)
    {
        // Validate the request
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'checkpoint_name' => 'required|string|max:255',
        ]);
        // Fetch the schedule for the driver
        $schedule = Schedule::where('driver_id', $request->driver_id)->first();
        $driver = Driver::find($request->driver_id);
        $driverName = $driver ? $driver->name : 'Unknown Driver';

        if (!$schedule) {
            return redirect()->route('checkpoint.scan')->with('error', 'No schedule found for the selected driver.');
        }
    
        // Check if QR code was scanned recently
        $scannedCheckpoints = ScannedQR::where('driver_id', $request->driver_id)->latest()->first();
    
        if ($scannedCheckpoints) {
            $minutesDiff = $scannedCheckpoints->created_at->diffInMinutes(Carbon::now());
    
            // Ensure a 10-minute interval between scans
            if ($minutesDiff < 10) {
                return redirect()->route('checkpoint.scan')->with([
                    'message' => "Driver: $driverName - QR-code already scanned",
                    'type' => 'green', 
                ]);
            }
        }

        ScannedQR::create([
            'driver_id' => $request->driver_id,
            'schedule_id' => $schedule->id,
            'checkpoint_name' => $request->checkpoint_name,
            'status' => 'scanned',
            ]);

        // Redirect with success message
        return redirect()->route('checkpoint.scan')->with(
            'success', 'QR code scanned and checkpoint saved successfully.');
    }
    
    public function success()
    {
        return view('checkpoint.success');
    }
}
