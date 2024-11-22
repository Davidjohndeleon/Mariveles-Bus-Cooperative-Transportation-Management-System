<?php
namespace App\Http\Controllers;

use App\Models\ScannedQR;
use Illuminate\Http\Request;

class CheckpointController extends Controller
{
    // Display the scan form and pass the scanned QR codes to the view
    public function showScanForm()
    {
        // Fetch all scanned QR codes
        $scannedQRs = ScannedQR::with('driver')->get();
        return view('checkpoint.scan', compact('scannedQRs'));
    }

    // Handle QR code scanning logic
    public function scanQRCode(Request $request)
    {
        $driverId = $request->input('driver_id');

        // Check if the driver has already scanned this QR code
        $scannedQR = ScannedQR::where('driver_id', $driverId)->first();
        if ($scannedQR) {
            return redirect()->route('checkpoint.scan')->with('error', 'This QR code has already been scanned.');
        }

        // Otherwise, store the scanned QR code
        ScannedQR::create([
            'driver_id' => $driverId,
            'status' => 'scanned', // Set the status as scanned
        ]);

        return redirect()->route('checkpoint.scan')->with('success', 'QR code scanned successfully.');
    }

    // Success page after QR code scanning
    public function success()
    {
        return view('checkpoint.success');
    }
}
