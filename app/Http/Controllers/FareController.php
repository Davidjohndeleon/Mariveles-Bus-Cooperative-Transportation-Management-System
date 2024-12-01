<?php

namespace App\Http\Controllers;

use App\Models\Fare;
use Illuminate\Http\Request;

class FareController extends Controller
{
    /**
     * Display a listing of fares.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $balangaToMarivelesFares = Fare::where('route', 'Balanga to Mariveles')->get();
        $marivelesToBalangaFares = Fare::where('route', 'Mariveles to Balanga')->get();

        return view('admin.fares', [
            'balangaToMarivelesFares' => $balangaToMarivelesFares,
            'marivelesToBalangaFares' => $marivelesToBalangaFares,
        ]);
    }
    /**
     * Show the form for creating a new fare.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('admin.create_fare');
    }

    /**
     * Store a newly created fare in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the input data
        $request->validate([
            'distance' => 'required|numeric|min:0',
            'regular_fare' => 'required|numeric|min:0',
            'elderly_student_disabled_fare' => 'required|numeric|min:0',
        ]);

        // Create a new fare record
        Fare::create($request->only(['distance', 'regular_fare', 'elderly_student_disabled_fare']));

        // Redirect to the fares list with a success message
        return redirect()->route('fares.index')->with('success', 'Fare added successfully!');
    }

    /**
     * Show the form for editing the specified fare.
     *
     * @param  int  $id
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $fare = Fare::findOrFail($id);
        return view('admin.edit_fare', compact('fare'));
    }

    /**
     * Update the specified fare in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'distance' => 'required|numeric|min:0',
            'regular_fare' => 'required|numeric|min:0',
            'elderly_student_disabled_fare' => 'required|numeric|min:0',
        ]);

        $fare = Fare::findOrFail($id);
        $fare->update($request->only(['distance', 'regular_fare', 'elderly_student_disabled_fare']));

        return redirect()->back()->with('success', 'Fare updated successfully!');
    }

    /**
     * Remove the specified fare from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $fare = Fare::findOrFail($id);
        $fare->delete();

        return redirect()->route('fares.index')->with('success', 'Fare deleted successfully!');
    }

    public function editAll()
    {
        $balangaToMarivelesFares = Fare::where('route', 'Balanga to Mariveles')->get();
        $marivelesToBalangaFares = Fare::where('route', 'Mariveles to Balanga')->get();

        return view('admin.edit_fares', compact('balangaToMarivelesFares', 'marivelesToBalangaFares'));
    }

    public function updateAll(Request $request)
    {
        $fares = $request->input('fares');

        foreach ($fares as $fareData) {
            $fare = Fare::findOrFail($fareData['id']);
            $fare->update($fareData);
        }

        return redirect()->route('fares.index')->with('success', 'Fares updated successfully!');
    }

}
