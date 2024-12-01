<?php

namespace App\Http\Controllers;
use App\Models\Checkpoint;
use App\Models\ScannedQR;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminCheckpointController extends Controller
{
    public function viewScannedCheckpoints(Request $request)
    {
        // Fetch selected checkpoint name from the request
        $selectedCheckpoint = $request->query('checkpoint_name');
    
        // Build the query for scanned QR codes
        $scannedCheckpointsQuery = ScannedQR::with('driver');
    
        // Apply filter if a checkpoint name is selected
        if ($selectedCheckpoint) {
            $scannedCheckpointsQuery->where('checkpoint_name', $selectedCheckpoint);
        }
    
        // Get the results
        $scannedCheckpoints = $scannedCheckpointsQuery->get();
    
        return view('admin.checkpoints.scanned-checkpoints', compact('scannedCheckpoints', 'selectedCheckpoint'));
    }
    
}
