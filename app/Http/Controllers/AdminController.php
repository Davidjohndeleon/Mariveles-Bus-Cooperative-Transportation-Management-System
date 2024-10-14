<?php 

namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\User;
use App\Models\Schedule;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    // public function adminDashboard()
    // {
    //     $buses = Bus::with('driver')->get();
    //     return view('admin.admin_dashboard', compact('buses'));
    // }

    public function index()
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
        return view('admin.edit_bus', compact('bus', 'drivers'));
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

        return redirect()->route('admin.buses')->with('success', 'Bus updated successfully.');
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
        $drivers = User::where('usertype', 'driver')->get();  

        // Log information for debugging
        Log::info('Balanga to Mariveles Schedules:', $balangaToMarivelesSchedules->toArray());
        Log::info('Mariveles to Balanga Schedules:', $marivelesToBalangaSchedules->toArray());

        return view('admin.schedules', compact('balangaToMarivelesSchedules', 'marivelesToBalangaSchedules', 'buses', 'drivers'));
    }

    public function addSchedule(Request $request)
{
    $formFields = $request->validate([
        'departure_time' => 'required|date_format:H:i',
        'bus_id' => 'required|exists:buses,id',
        'driver_id' => 'nullable|exists:users,id',  // Optional
        'route' => 'required|string|max:255',      // Dynamic route input
    ]);

    Schedule::create($formFields);

    return redirect()->route('admin.manage.schedules')->with('success', 'Schedule added successfully!');
}

    public function editSchedule($id)
    {
        $schedule = Schedule::findOrFail($id);
        $buses = Bus::all();
        $drivers = User::where('usertype', 'driver')->get();

        return view('admin.edit_schedule', compact('schedule', 'buses', 'drivers'));
    }

    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'driver_id' => 'required|exists:users,id',
            'departure_time' => 'required|time',
        ]);

        $schedule = Schedule::findOrFail($id);
        $schedule->update([
            'bus_id' => $request->bus_id,
            'driver_id' => $request->driver_id,
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
        return view('admin.register_driver');
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
        $balangaToMarivelesSchedules = Schedule::where('route', 'Balanga to Mariveles')->with(['bus', 'driver'])->get();
        $marivelesToBalangaSchedules = Schedule::where('route', 'Mariveles to Balanga')->with(['bus', 'driver'])->get();
    
        // Fetch buses and drivers for the select dropdowns
        $buses = Bus::all();
        $drivers = Driver::all();
    
        // Pass the schedules, buses, and drivers to the view
        return view('dashboard', [
            'balangaToMarivelesSchedules' => $balangaToMarivelesSchedules,
            'marivelesToBalangaSchedules' => $marivelesToBalangaSchedules,
            'buses' => $buses,
            'drivers' => $drivers,
        ]);
    }

    public function addDefaultBalangaToMarivelesSchedules()
{
    try {
        $startTime = Carbon::createFromTime(3, 50, 0); // 3:50 AM
        $endTime = Carbon::createFromTime(21, 20, 0); // 9:20 PM
        $interval = 60; // 1-hour interval

        while ($startTime->lte($endTime)) {
            Schedule::create([
                'departure_time' => $startTime->format('H:i'), // Store in 24-hour format for the database
                'bus_id' => 1,
                'driver_id' => 1,
                'route' => 'Balanga to Mariveles',
            ]);

            $startTime->addMinutes($interval);
        }

        return redirect()->route('admin.manage.schedules')->with('message', 'Default Balanga to Mariveles schedules added.');
    } catch (\Exception $e) {
        Log::error('Error adding default schedules: ' . $e->getMessage());
        return back()->with('error', 'Failed to add schedules.');
    }
}
}
