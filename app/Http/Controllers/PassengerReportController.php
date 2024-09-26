<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use App\Models\Bus;

class PassengerReportController extends Controller
{
    public function submitReport(Request $request)
    {
        $request->validate([
            'bus_id' => 'required|exists:buses,id',
            'topic' => 'required|string',
            'report' => 'required|string',
        ]);

       
        Report::create([
            'bus_id' => $request->bus_id,
            'user_id' => auth()->id(), 
            'topic' => $request->topic,
            'report' => $request->report,
        ]);

        return redirect()->back()->with('status', 'Report submitted successfully!');
    }

    public function showReportForm()
    {
        $buses = Bus::all();
        return view('passenger.report_form', compact('buses'));
    }
    
}
