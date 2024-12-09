<?php

namespace App\Http\Controllers;

use App\Models\ScannedQR;
use Illuminate\Http\Request;

class AdminCheckpointController extends Controller
{
    /**
     * View scanned checkpoints with optional filtering by checkpoint name.
     */
public function viewScannedCheckpoints(Request $request)
{
    // Fetch the selected checkpoint name from the request
    $selectedCheckpoint = $request->query('checkpoint_name');

    // Query all scanned QR records
    $scannedCheckpointsQuery = ScannedQR::query()->with(['driver', 'schedule.bus', 'schedule.conductor']);

    // Filter by checkpoint name if provided
    if ($selectedCheckpoint) {
        $scannedCheckpointsQuery->where('checkpoint_name', $selectedCheckpoint);
    }

    // Fetch the results
    $scannedCheckpoints = $scannedCheckpointsQuery->get();

    // Fetch unique checkpoint names for the dropdown filter
    $checkpointNames = ScannedQR::distinct()->pluck('checkpoint_name');

    return view('admin.checkpoints.scanned-checkpoints', [
        'scannedCheckpoints' => $scannedCheckpoints,
        'selectedCheckpoint' => $selectedCheckpoint,
        'checkpointNames' => $checkpointNames,
    ]);
}

}

