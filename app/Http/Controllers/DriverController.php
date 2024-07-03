<?php
namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class DriverController extends Controller
{
    public function create()
    {
        return view('drivers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'license_number' => 'required|string|max:255',
            'license_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('license_image')->store('licenses', 'public');

        Driver::create([
            'user_id' => Auth::id(),
            'license_number' => $request->license_number,
            'license_image_path' => $imagePath,
        ]);

        return redirect()->route('drivers.create')->with('success', 'License uploaded successfully.');
    }
}
