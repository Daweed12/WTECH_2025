<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    // Show the form. Point this at your Blade view.
    public function showRegistrationForm()
    {
        return view('auth.login_register');  // or wherever your register form lives
    }

    // Handle the POST /register
    public function register(Request $request)
    {
        // 1) Validate
        $data = $request->validate([
            'first_name' => ['required','string','max:255'],
            'last_name'  => ['required','string','max:255'],
            'email'      => ['required','email','max:255','unique:users'],
            'password'   => ['required','string','min:8','confirmed'],
        ]);

        // 2) Create the user
        $user = User::create([
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'email'      => $data['email'],
            'password'   => Hash::make($data['password']),     // ← NEW
        ]);

        // 3) Fire the Registered event (optional, for listeners)
        event(new Registered($user));

        // 4) Log them in
        Auth::login($user);

        // 5) Redirect
        return redirect()->intended($this->redirectTo);
    }
}
