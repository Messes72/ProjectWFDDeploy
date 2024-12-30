<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    // Display the login page
    public function viewLogin()
    {
        return view('User.login');
    }

    // Display the register page
    public function viewRegister()
    {
        return view('User.register');
    }

    // Process the login
    public function processLogin(Request $request)
    {
        // Validate login credentials
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required'
        ]);

        // Attempt to login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // Check user role and redirect accordingly
            if (auth()->user()->role == 1) {
                return redirect()->route('courses.index'); // Admin goes to user management
            } elseif (auth()->user()->role == 2) {
                return redirect()->route('teachers.index'); // Teacher
            } elseif (auth()->user()->role == 3) {
                return redirect()->intended('profile'); // Student
            } else {
                return back()->with('error', 'Unknown role');
            }
        }

        // If login fails, return error
        return back()->with('error', 'Invalid login credentials');
    }

    // Display the registration page
    public function register()
    {
        return view('User.register');
    }

    // Process the registration
    public function processRegister(Request $request)
    {
        // Validate registration input
        $data = $request->validate([
            'email' => 'required|email:dns|unique:users,email',
            'name' => 'required',
            'age' => 'required|numeric',
            'phone' => 'required',
            'address' => 'required',
            'school' => 'required',
            'password' => 'required|min:6|confirmed' // Password confirmation
        ]);

        // Begin database transaction for user and student creation
        DB::beginTransaction();
        try {
            // Create the user
            $user = User::create([
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => 3 // Default to regular user role
            ]);

            // Create the student record
            Student::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'age' => $data['age'],
                'phone' => $data['phone'],
                'address' => $data['address'],
                'school' => $data['school']
            ]);

            // Commit the transaction
            DB::commit();
        } catch (Exception $e) {
            // Rollback in case of error
            DB::rollBack();
            Log::error('Register Error', ['Message' => $e->getMessage()]);
            return back()->with('error', 'Failed to create an account, please try again later.');
        }

        // Redirect to login after successful registration
        return redirect()->route('user.login')->with('success', 'Successfully created an account.');
    }

    // Logout and clear session
    public function logout()
    {
        Auth::logout();
        session()->flush(); // Clear all session data

        return redirect()->route('user.login'); // Redirect to login page
    }
}
