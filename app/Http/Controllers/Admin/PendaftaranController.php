<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pendaftaran;
use App\Models\Course;
use Illuminate\Http\Request;

class PendaftaranController extends Controller
{
    public function index(Request $request)
    {
        $query = Pendaftaran::with(['course']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kursus
        if ($request->filled('course')) {
            $query->where('course_id', $request->course);
        }

        // Get all courses for filter dropdown
        $courses = Course::all();
        $pendaftaran = $query->latest()->get();

        return view('Admin.pendaftaran.index', compact('pendaftaran', 'courses'));
    }

    public function adminIndex(Request $request)
    {
        $query = Pendaftaran::with(['course']);

        // Filter berdasarkan status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter berdasarkan kursus
        if ($request->filled('course')) {
            $query->where('course_id', $request->course);
        }

        // Get all courses for filter dropdown
        $courses = Course::all();
        $pendaftaran = $query->latest()->get();

        return view('Admin.pendaftaran.index', compact('pendaftaran', 'courses'));
    }

    public function updateStatus(Request $request, $id)
    {
        // Validate the request
        $request->validate([
            'status' => 'required|in:pending,accepted,failed'
        ]);

        // Find the registration
        $pendaftaran = Pendaftaran::findOrFail($id);

        // Update the status
        $pendaftaran->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pendaftaran berhasil diperbarui.');
    }
} 