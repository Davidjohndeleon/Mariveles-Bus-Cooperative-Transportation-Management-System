<?php
namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Schedule;
use App\Models\Driver;
use App\Models\ScannedQR;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Events\LocationUpdate;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DriverController extends Controller
{
    
    public function generateQRCode(Request $request, $driverId)
    {
        // Fetch the driver by their ID
        $driver = Driver::find($driverId);
    
        if (!$driver) {
            return redirect()->back()->with('error', 'Driver not found.');
        }
    
        // Generate the QR code for the driver's ID
        $qrCode = QrCode::size(600)->generate($driver->id);
    
        return view('drivers.qrcode', compact('qrCode', 'driver'));
    }


    public function locPing(Request $request) {
        event(new LocationUpdate($request->busId, $request->lat, $request->lng));
        
        return response()->json('Ping successful');
    }

    public function viewCheckpoints(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user()->load('driver'); // Load driver relationship
        $driver = $user->driver;
    
        if (!$driver) {
            // Redirect or show an error if the user is not a driver
            return redirect()->route('dashboard')->with('error', 'You are not assigned as a driver.');
        }
    
        $selectedCheckpoint = $request->query('checkpoint_name', null);
        $scannedQRQuery = ScannedQR::where('driver_id', $driver->id);
    
        if ($selectedCheckpoint) {
            $scannedQRQuery->where('checkpoint_name', $selectedCheckpoint);
        }
    
        $scannedQRs = $scannedQRQuery->get();
    
        // Fetch unique checkpoint names for dropdown
        $checkpointNames = ScannedQR::where('driver_id', $driver->id)
            ->distinct()
            ->pluck('checkpoint_name');
    
        return view('drivers.checkpoints', [
            'scannedQRs' => $scannedQRs,
            'selectedCheckpoint' => $selectedCheckpoint,
            'checkpointNames' => $checkpointNames,
            'driverId' => $driver->id, 
        ]);
    }

    public function viewSchedule()
    {
        $user = Auth::user();  // Get the logged-in user
        
        // Ensure that the user is a driver
        if (!$user->isDriver() || !$user->driver) {
            return redirect()->route('drivers.qrcode')->with('error', 'Driver information not found.');
        }
    
        // Fetch schedules assigned to the driver
        $schedules = Schedule::where('driver_id', $user->driver->user_id)->get();
    
        return view('drivers.schedule', compact('schedules'));
    }
    
    
    
    
    
}
