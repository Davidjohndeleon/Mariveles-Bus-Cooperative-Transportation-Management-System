<?php

namespace App\Http\Controllers;

use App\Models\Bus;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $buses = Bus::with('driver', 'schedules')->get();
        return view('dashboard', compact('buses'));
    }
}
