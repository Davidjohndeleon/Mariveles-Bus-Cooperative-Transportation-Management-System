<?php 

namespace App\Http\Controllers;
use App\Models\Conductor;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\User;
use App\Models\Fare;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function gps()
    {
        return view('admin.admin_dashboard');
    }

    public function manageBuses()
    {
        $buses = Bus::with('driver')->get();
        $drivers = User::where('usertype', 'driver')->get();
        return view('admin.buses', compact('buses', 'drivers'));
    }

    public function addBus(Request $request)
{
    $request->validate([
        'bus_name' => 'required|string|max:255',
        'driver_id' => 'required|exists:users,id',
        
    ]);

    Bus::create([
        'bus_name' => $request->bus_name,
        'driver_id' => $request->driver_id,
        
    ]);

    // Redirect to the correct route name
    return redirect()->route('admin.manage.buses')->with('success', 'Bus added successfully.');
}

    public function editBus($id)
    {
        $bus = Bus::findOrFail($id);
        $drivers = User::where('usertype', 'driver')->get();
        return view('admin.edit_bus', compact('bus', 'drivers',));
    }

    public function updateBus(Request $request, $id)
    {
        $request->validate([
            'bus_name' => 'required|string|max:255',
            'driver_id' => 'required|exists:users,id',
            
        ]);

        $bus = Bus::findOrFail($id);
        $bus->update([
            'bus_name' => $request->bus_name,
            'driver_id' => $request->driver_id,
            
        ]);

        return redirect()->route('admin.manage.buses')->with('success', 'Bus updated successfully.');
    }

    public function deleteBus($id)
    {
        $bus = Bus::findOrFail($id);
        $bus->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Bus deleted successfully.');
    }

    public function manageSchedules()
    {
        // Fetch schedules based on specific routes
        $balangaToMarivelesSchedules = Schedule::where('route', 'Balanga to Mariveles')->with('bus', 'driver')->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'Mariveles to Balanga')->with('bus', 'driver')->get();

        // Fetch all buses and drivers
        $buses = Bus::all();  
        $drivers = Driver::all();
        $conductors = Conductor::all(); 

        // Log information for debugging
        Log::info('Balanga to Mariveles Schedules:', $balangaToMarivelesSchedules->toArray());
        Log::info('Mariveles to Balanga Schedules:', $marivelesToBalangaSchedules->toArray());

        return view('admin.schedules', compact('balangaToMarivelesSchedules', 'marivelesToBalangaSchedules', 'buses', 'drivers','conductors'));
    }

    public function addSchedule(Request $request)
{
    $formFields = $request->validate([
        'departure_time' => 'required|date_format:H:i',
        'bus_id' => 'required|exists:buses,id',
        'driver_id' => 'nullable|exists:users,id',
        'conductor_id' => 'nullable|exists:users,id',  
        'route' => 'required|string|max:255',     
    ]);

    Schedule::create($formFields);

    return redirect()->route('admin.manage.schedules')->with('success', 'Schedule added successfully!');
}

    public function editSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $buses = Bus::all();
        $drivers = User::where('usertype', 'driver')->get();
        $conductors = User::where('usertype', 'conductor')->get();

        return view('admin.edit_schedule', compact('schedule', 'buses', 'drivers','conductors'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:users,id',
            'conductor_id' => 'nullable|exists:users,id',
            'departure_time' => [
                'required',
                'regex:/^([01]\d|2[0-3]):([0-5]\d)(:[0-5]\d)?$/', 
            ],
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'bus_id' => $request->bus_id,
            'driver_id' => $request->driver_id,
            'conductor_id' => $request->conductor_id,
            'departure_time' => $request->departure_time,
        ]);

        return redirect()->route('admin.manage.schedules')->with('success', 'Schedule updated successfully.');
    }

    public function deleteSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $schedule->delete();
        return redirect()->route('admin.manage.schedules')->with('success', 'Schedule updated successfully.');
    }

    // Method to show the registration form
    public function showRegisterDriverForm()
    {
        // Fetch all users with 'driver' usertype
    $drivers = User::where('usertype', 'driver')->get();

    // Pass the $drivers variable to the view
    return view('admin.register_driver', compact('drivers'));
    }

    // Method to handle the registration form submission
    public function registerDriver(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'driver', // Set the user type to driver
        ]);

        return redirect()->route('admin.register.driver.form')->with('status', 'Driver registered successfully!');
    }

    public function showSchedules()
    {
        // Fetch schedules for Balanga to Mariveles and Mariveles to Balanga
        $balangaToMarivelesSchedules = Schedule::where('route', 'Balanga to Mariveles')->with(['bus', 'driver','conductor'])->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'Mariveles to Balanga')->with(['bus', 'driver','conductor'])->get();
    
        // Fetch buses and drivers for the select dropdowns
        $buses = Bus::all();
        $drivers = Driver::all();
        $conductors = Conductor::all();
        
        
        // Pass the schedules, buses, and drivers to the view
        return view('dashboard', [
            'balangaToMarivelesSchedules' => $balangaToMarivelesSchedules,
            'marivelesToBalangaSchedules' => $marivelesToBalangaSchedules,
            'buses' => $buses,
            'drivers' => $drivers,
            'conductors' => $conductors,
        ]);
    }



public function showRegisterConductorForm()
{
    $conductors = User::where('usertype', 'conductor')->get();
    return view('admin.register_conductor', compact('conductors'));
}

public function registerConductor(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'conductor', 
        ]);

        return redirect()->route('admin.register.conductor.form')->with('status', 'Conductor registered successfully!');
    }

    public function showRegisterCheckpointForm()
{
    $checkpoints = User::where('usertype', 'checkpoint')->get();

    return view('admin.register_checkpoint_user', compact('checkpoints'));
}

    public function registerCheckpointUser(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'usertype' => 'checkpoint', 
        ]);

        return redirect()->route('admin.register.checkpoint.user.form')->with('status', 'Checkpoint user registered successfully!');
    }
    public function manageFares()
    {
        
        $fares = Fare::all();

        
        return view('admin.fares', compact('fares'));
    }
}
