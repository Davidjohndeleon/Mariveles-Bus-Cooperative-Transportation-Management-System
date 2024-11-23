<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BusBooking;
use App\Models\Bus;

class PassengerController extends Controller
{
    public function viewBusBookings()
    {
        // Fetch bookings for the logged-in passenger
        $bookings = BusBooking::where('user_id', auth()->id())->with('bus')->get();

        // Fetch all available buses
        $buses = Bus::all();

        return view('passenger.bookings', compact('bookings', 'buses'));
    }

    public function requestBusBooking($busId)
    {
        // Find the bus and create a booking request
        $bus = Bus::findOrFail($busId);
        
        // Create the booking for the logged-in passenger
        $booking = new BusBooking();
        $booking->user_id = auth()->id();
        $booking->bus_id = $bus->id;
        $booking->status = 'pending'; // Set the status to pending by default
        $booking->save();
    
        return redirect()->route('passenger.bookings')->with('success', 'Booking request submitted.');
    }
    
}
