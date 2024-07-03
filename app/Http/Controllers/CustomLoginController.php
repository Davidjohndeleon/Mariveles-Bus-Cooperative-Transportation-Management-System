<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            $user = Auth::user();
            
            // Determine usertype based on your logic
            if ($user->isAdmin()) {
                $user->usertype = 'admin';
            } elseif ($user->isDriver()) {
                $user->usertype = 'driver';
            } elseif ($user->isCheckpointStaff()) {
                $user->usertype = 'checkpoint';
            } else {
                $user->usertype = 'passenger';
            }
            $user->save();

            return redirect()->intended('/dashboard'); // Redirect to appropriate dashboard
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }
}
