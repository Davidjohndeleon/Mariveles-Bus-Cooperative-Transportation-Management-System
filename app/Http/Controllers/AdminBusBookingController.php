<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusBooking;

class AdminBusBookingController extends Controller
{
    public function index()
    {
        // Fetch all bus bookings with related data and group by passenger
        $bookings = BusBooking::with(['bus', 'passenger'])
            ->get()
            ->groupBy('user_id');

        // Pass the grouped bookings to the admin view
        return view('admin.bus_bookings', compact('bookings'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Find the booking by ID
        $booking = BusBooking::findOrFail($id);

        // Validate the incoming status and remarks
        $request->validate([
            'status' => 'required|in:approved,rejected',
            'remarks' => 'nullable|string|max:255',
        ]);

        // Update the status and remarks
        $booking->status = $request->status;
        $booking->remarks = $request->remarks;
        $booking->save();

        return redirect()->back()->with('success', 'Booking status updated successfully.');
    }

    public function deleteBooking($id)
    {
        // Find the bus booking by ID
        $booking = BusBooking::findOrFail($id);

        // Delete the booking
        $booking->delete();

        // Redirect back with a success message
        return redirect()->route('admin.bookings.index')->with('success', 'Bus booking deleted successfully.');
    }

}
