<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index() {

        $users = User::latest()->get();
        $totalUsers = User::count();
        $totalAdmins = User::where('role', 1)->count();
        $totalTeachers = User::where('role', 2)->count();
        $totalStudents = User::where('role', 3)->count();

        return view('Admin.user-management.index', compact('users', 'totalUsers', 'totalAdmins', 'totalTeachers', 'totalStudents'));
    }

    public function show($id) {
        $user = User::findOrFail($id);
        return view('Admin.user-management.show', compact('user'));
    }
}
