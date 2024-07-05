<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PassengerReportController extends Controller
{
    public function showReportForm()
    {
        $buses = \App\Models\Bus::all();

        return view('passenger.report', ['buses' => $buses]);
    }
    public function submitReport(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'topic' => 'required|string',
            'report' => 'required|string',
        ]);
    

    return redirect()->route('passenger.report.form')->with('success', 'Report submitted successfully!');
}
}