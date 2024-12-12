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

    public function requestBusBooking(Request $request, $busId)
    {
        $user = auth()->user();

        // Check how many buses the user has booked (pending or approved)
        $bookingsCount = BusBooking::where('user_id', $user->id)
            ->whereIn('status', ['pending', 'approved'])
            ->count();

        // Check if the user has already booked this specific bus
        $existingBooking = BusBooking::where('user_id', $user->id)
            ->where('bus_id', $busId)
            ->first();

        // If the user has a pending or approved booking for the bus, prevent rebooking
        if ($existingBooking && $existingBooking->status !== 'rejected') {
            return back()->with('error', 'You have already booked this bus, and the booking is either pending or approved.');
        }

        // If the user has reached the limit of 3 bookings, prevent further bookings
        if ($bookingsCount >= 3) {
            return back()->with('error', 'You can only book up to 3 buses at a time.');
        }

        // Find the bus and create a booking request
        $bus = Bus::findOrFail($busId);

        // Create the new booking request
        $booking = new BusBooking();
        $booking->user_id = $user->id;
        $booking->bus_id = $bus->id;
        $booking->status = 'pending';
        $booking->remarks = $request->remarks; 
        $booking->save();

        return redirect()->route('passenger.bookings')->with('success', 'Booking request submitted successfully. Please wait for approval.');
    }

    public function deleteBooking($id)
    {
        $user = auth()->user();

        // Find the booking by ID and ensure it belongs to the authenticated user
        $booking = BusBooking::where('id', $id)->where('user_id', $user->id)->firstOrFail();

        // Delete the booking
        $booking->delete();

        return redirect()->route('passenger.bookings')->with('success', 'Booking deleted successfully.');
    }

    public function viewGPS()
    {
        
        $buses = Bus::all(); 

        return view('passenger.gps', compact('buses'));
    }
}
