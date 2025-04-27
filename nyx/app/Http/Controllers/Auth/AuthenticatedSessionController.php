<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->only(['create','store']);
        $this->middleware('auth')->only('destroy');
    }

    /**
     * Show the login form.
     */
    public function create()
    {
        return view('login_register_user');  // or login_register, if you merged login & register into one
    }

    /**
     * Handle an incoming login request.
     */
    public function store(Request $request)
    {
        // validate the credentials
        $credentials = $request->validate([
            'email'    => ['required','email'],
            'password' => ['required','string'],
        ]);

        // attempt login
        if (! Auth::attempt($credentials, $request->boolean('remember'))) {
            return back()
                ->withErrors(['email' => 'These credentials do not match our records.'])
                ->onlyInput('email');
        }

        // regenerate session to prevent fixation
        $request->session()->regenerate();

        return redirect()->intended('/home');
    }

    /**
     * Log the user out.
     */
    public function destroy(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
