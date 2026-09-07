<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller {
    /**
     * Show login page
     */
    public function login() {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }

        return view('auth.login');
    }

    /**
     * Authenticate user
     */
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'adm_user_name' => ['required', 'string'],
            'password' => ['required', 'string'],
        ]);
        $credentials['adm_status'] = 1;
//        $remember = $request->boolean('remember');
        if (Auth::attempt($credentials)) {
            $admin = Auth::user();
            $request->session()->regenerate();
            $logged_in_user_session_arr = [
                'user_id' => $admin->adm_id,
                'emp_id' => $admin->adm_emp_id,
                'user_name' => $admin->adm_user_name,
                'user_role' => $admin->adm_role,
            ];

            $request->session()->put('logged_in_user_session', $logged_in_user_session_arr);
            return redirect()->intended(route('dashboard'))->with('success', 'Login successful.');
        }
        return back()->withErrors(['adm_user_name' => 'The username or password is incorrect.',])->withInput($request->only('adm_user_name'));
    }

    /**
     * Logout
     */
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->forget('logged_in_user_session');

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('login')
            ->with('success', 'You have been logged out.');
    }
}
