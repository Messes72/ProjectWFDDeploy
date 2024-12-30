<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminAuthController extends Controller
{
    // View Login Admin
    public function viewLogin()
    {
        return view('Admin.auth.login');
    }

    // Proses Login Admin
    public function processLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Cek role = 1 (Admin)
        if (Auth::attempt(['email' => $credentials['email'], 'password' => $credentials['password']])) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('courses.index');
            } else {
                Auth::logout();
                return back()->with('error', 'Unauthorized: Only admins can login here.');
            }
        }

        return back()->with('error', 'Invalid credentials.');
    }

    // View Register Admin
    public function viewRegister()
    {
        return view('Admin.auth.register');
    }

    // Proses Register Admin
    public function processRegister(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        User::create([
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => 1 // Role 1 untuk admin
        ]);

        return redirect()->route('admin.login')->with('success', 'Admin account created successfully.');
    }

    // Dashboard Admin
    public function dashboard()
    {
        // Validasi role di dalam controller
        if (Auth::check() && Auth::user()->role == 1) {
            return view('courses.index');
        }

        return redirect()->route('admin.login')->with('error', 'Unauthorized access.');
    }
}
