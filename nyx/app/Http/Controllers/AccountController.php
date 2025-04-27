<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Handle the form submission from account_details.blade.php
     */
    public function update(Request $request)
    {
        // Validate input
        $data = $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'phone'      => ['nullable','string','max:20'],
            'password'   => ['nullable','string','min:8','confirmed'],
        ]);

        // Grab the current user
        $user = Auth::user();

        // Update basic fields
        $user->first_name = $data['first_name'];
        $user->last_name  = $data['last_name'];
        $user->phone      = $data['phone'];

        // If password filled in, hash & update
        if (! empty($data['password'])) {
            $user->password = Hash::make($data['password']);
        }

        // Save all changes
        $user->save();

        // Redirect back with a success message
        return back()->with('status', 'Your account was updated successfully.');
    }
}
