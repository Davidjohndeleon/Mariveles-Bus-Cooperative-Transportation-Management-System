<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class DriverController extends Controller
{
    
    public function generateQRCode(Request $request)
    {
        $user = $request->user();
        $qrCode = QrCode::size(300)->generate($user->id . '-' . now()->timestamp);

        return view('drivers.qrcode', compact('qrCode'));
    }
}
