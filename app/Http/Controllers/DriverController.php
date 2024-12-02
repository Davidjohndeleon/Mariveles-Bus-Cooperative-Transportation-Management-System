<?php
namespace App\Http\Controllers;

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
        $driver = Auth::user();
        
        $selectedCheckpoint = $request->query('checkpoint_name', null);
    
        $checkpointsQuery = ScannedQR::where('driver_id', $driver->id);
    
        if ($selectedCheckpoint) {
            $checkpointsQuery->where('checkpoint_name', $selectedCheckpoint);
        }
    
        $checkpoints = $checkpointsQuery->get();
    
        return view('drivers.checkpoints', [
            'checkpoints' => $checkpoints,
            'selectedCheckpoint' => $selectedCheckpoint,
        ]);
    }
    

}
