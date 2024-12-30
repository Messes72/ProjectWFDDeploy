<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth; // Tambahkan Auth
use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Pendaftaran;
use App\Models\Assignment;
use App\Models\Lesson;

class UserController extends Controller
{
    public function profile()
    {
        // Pastikan user sudah login
        $user = Auth::user();

        if (!$user) {
            // Redirect jika tidak login
            return redirect()->route('user.login')->with('error', 'Anda bukan seorang student.');
        }

        // Ambil data pendaftaran jika user adalah student
        $pendaftarans = [];
        if ($user->role === 'student') {
            $pendaftarans = Pendaftaran::where('student_id', $user->id)->with('course')->get();
        }

        $courses = Course::all();
        // Return view profil dengan data user
        return view('User.profile', [
            'user' => $user,
            'pendaftarans' => $pendaftarans,
            'courses' => $courses
        ]);
    }

    /**
     * Method untuk menampilkan history pendaftaran kursus user.
     */
    public function history()
    {
        // Pastikan user sudah login
        $user = Auth::user();

        if (!$user) {
            // Redirect jika tidak login
            return redirect()->route('user.login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Ambil data pendaftaran terkait user
        $pendaftarans = Pendaftaran::where('student_id', $user->id)
            ->with('course')
            ->get();

        return view('User.history', [
            'user' => $user,
            'pendaftarans' => $pendaftarans
        ]);
    }

    public function showHistoryDetail($id)
    {
        $pendaftaran = Pendaftaran::with('course')->findOrFail($id);

        // Filter assignments dan lessons berdasarkan course_id
        $assignments = Assignment::where('course_id', $pendaftaran->course_id)->get();
        $lessons = Lesson::where('course_id', $pendaftaran->course_id)->get();

        return view('User.history-detail', compact('pendaftaran', 'assignments', 'lessons'));
    }



}
