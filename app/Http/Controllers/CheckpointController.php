<?php

namespace App\Http\Controllers;

use App\Models\ScannedQR;
use App\Models\Checkpoint;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckpointController extends Controller
{
    public function showScanForm()
    {
        // Fetch all active checkpoints and scanned QR codes
        $checkpoints = Checkpoint::all(); // Optionally filter by status, e.g., ->where('status', 'active')
        $scannedQRs = ScannedQR::with('driver')->get();

        return view('checkpoint.scan', compact('checkpoints', 'scannedQRs'));
    }

    public function scanQRCode(Request $request)
    {
        

        $driverId = $request->input('driver_id');
        $request->validate([
            'driver_id' => 'required|exists:drivers,id',
            'checkpoint_name' => 'required|string|max:255',
            
        ]);

        $scannedQR = ScannedQR::where('driver_id', $driverId)
            ->latest()
            ->first();

        if ($scannedQR) {
            $minutesDiff = $scannedQR->created_at->diffInMinutes(Carbon::now());

            if ($minutesDiff < 10) {
                return redirect()->route('checkpoint.scan')->with('error', 'You must wait 10 minutes before scanning this driver\'s QR code again.');
            }
        }

        // Store the checkpoint data
        ScannedQR::create([
            'driver_id' => $driverId,
            'checkpoint_name' => $request->input('checkpoint_name'), 
            
        ]);


        return redirect()->route('checkpoint.scan')->with('success', 'QR code scanned successfully.');
    }

        public function success()
        {
            return view('checkpoint.success');
        }
}
