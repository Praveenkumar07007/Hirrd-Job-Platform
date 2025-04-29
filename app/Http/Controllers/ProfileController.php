<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Assuming you have a User model

class ProfileController extends Controller
{
    /**
     * Constructor to apply middleware
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        // Ensure user is a job seeker
        if (Auth::user()->user_type != 'job_seeker') {
            return redirect()->route('home')->with('error', 'Access denied. Job seeker profiles only.');
        }

        $user = Auth::user();
        // You might need to load related profile data if it's in a separate model
        return view('profile.edit', compact('user')); // Make sure you have a 'profile.edit' view
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request)
    {
        // Ensure user is a job seeker
        if (Auth::user()->user_type != 'job_seeker') {
            return redirect()->route('home')->with('error', 'Access denied. Job seeker profiles only.');
        }

        $user = Auth::user();

        // Validate the request data (add your validation rules)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Add other profile fields as needed
        ]);

        // Update the user model
        $user->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully!');
    }
}
