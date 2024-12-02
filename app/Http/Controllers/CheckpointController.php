<?php

namespace App\Http\Controllers;

use App\Models\Checkpoint;
use App\Models\ScannedQR;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CheckpointController extends Controller
{
    /**
     * Show the form for scanning QR codes.
     */
    public function showScanForm()
    {
        // Fetch all checkpoints and their associated scanned QR data
        $scannedCheckpoints = ScannedQR::with(['checkpoint', 'driver'])->get();
        
        // Pass both checkpoints and scanned QR data to the view
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
    
        // Check if QR code was scanned recently
        $scannedCheckpoints = ScannedQR::where('driver_id', $request->driver_id)->latest()->first();
    
        if ($scannedCheckpoints) {
            $minutesDiff = $scannedCheckpoints->created_at->diffInMinutes(Carbon::now());
    
            // Ensure a 10-minute interval between scans
            if ($minutesDiff < 10) {
                return redirect()->route('checkpoint.scan')->with(
                    'error',
                    'You must wait 10 minutes before scanning this driver\'s QR code again.'
                );
            }
        }
    
        // Store the QR code scan with the checkpoint name
        $newScannedQR = ScannedQR::create([
            'driver_id' => $request->driver_id,
            'checkpoint_name' => $request->checkpoint_name,
            'status' => 'scanned',
        ]);
    
        // Redirect with success message
        return redirect()->route('checkpoint.scan')->with('success', 'QR code scanned and checkpoint saved successfully.');
    }
    
    
    
    
    

    /**
     * Success page.
     */
    public function success()
    {
        return view('checkpoint.success');
    }
}
