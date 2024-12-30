<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Period;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CourseController extends Controller
{
    // Menampilkan Dashboard
    public function dashboard()
    {
        $activePeriod = Period::where('active', true)->first(); // Ambil periode aktif
        $courses = $activePeriod ? Course::where('period_id', $activePeriod->id)->get() : collect(); // Ambil kursus berdasarkan periode aktif
        return view('User.dashboard', compact('courses'));
    }

    // Menampilkan semua mata pelajaran
    public function subjects()
    {
        $courses = Course::all();
        $activePeriod = Period::where('active', true)->first();
        if ($activePeriod) {
            $courses = Course::where('period_id', $activePeriod->id)->get();
        } else {
            $courses = [];
        }
    
        return view('User.subjects.index', compact('courses'));
    }

    public function getCoursesForTeachers()
    {
        $courses = Course::all(); // Mengambil semua kursus
        return view('admin.teachers.create', compact('courses'));
    }    


    // Menampilkan detail mata pelajaran
    public function show($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('subjects.index')->with('error', 'Mata Pelajaran tidak ditemukan');
        }
        return view('User.subjects.show', compact('course'));
    }

    // Menampilkan formulir pendaftaran kursus
    public function pendaftaran($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('dashboard')->with('error', 'Kursus tidak ditemukan');
        }
        return view('User.pendaftaran', compact('course'));
    }

    public function history($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->back()->with('error', 'Kursus tidak ditemukan');
        }
        return view('User.history', compact('course'));
    }

    public function profile($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('profile')->with('error', 'Kursus tidak ditemukan');
        }
        return view('User.profile', compact('course'));
    }

    // Menampilkan daftar semua kursus (Admin Side)
    public function index(Request $request)
    {
        $filter = $request->input('filter', 'active'); // Ambil filter dari request, default 'active'

        // Ambil periode aktif
        $activePeriod = Period::where('active', true)->first();

        // Filter kursus
        if ($filter == 'all') {
            // Ambil semua kursus
            $courses = Course::with('period', 'teacher')->get();
        } else {
            // Ambil hanya kursus pada periode aktif
            $courses = Course::with('period', 'teacher')->where('period_id', $activePeriod ? $activePeriod->id : null)->get();
        }
    
        // Ambil kursus yang sesuai dengan periode aktif
        // $courses = Course::where('period_id', $activePeriod->id)->get();

        return view('Admin.courses.index', compact('courses', 'filter'));
    }

    // Menampilkan form tambah kursus
    public function create()
    {
        $periods = Period::all(); // Ambil semua periode
        $teachers = Teacher::all(); // Ambil semua data teacher
        return view('Admin.courses.create', compact('periods', 'teachers'));
    }
    
    // Menyimpan data kursus baru
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|between:0,999999.99',
            'period_id' => 'required|exists:periods,id',
            'teacher_id' => 'required|exists:teachers,id'
        ]);

        // Simpan data kursus
        Course::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'period_id' => $request->period_id,
            'teacher_id' => $request->teacher_id,
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('courses.index')->with('success', 'Course berhasil disimpan!');
    }

    // Menampilkan form edit kursus
    // Menampilkan form edit kursus
    public function edit($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Kursus tidak ditemukan');
        }
        $periods = Period::all(); // Ambil semua periode
        $teachers = Teacher::all(); // Ambil semua teacher
        return view('Admin.courses.edit', compact('course', 'periods', 'teachers'));
    }



    // Mengupdate data kursus
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'period_id' => 'required|exists:periods,id',
            'teacher_id' => 'required|exists:teachers,id',
        ]);

        // $course = Course::find($id);
        // if (!$course) {
        //     return redirect()->route('courses.index')->with('error', 'Kursus tidak ditemukan');
        // }

        $course = Course::findOrFail($id);
        $course->update($request->all());

        // $course->update([
        //     'name' => $request->name,
        //     'description' => $request->description,
        // ]);

        return redirect('/courses')->with('success', 'Course berhasil diperbarui!');
    }



    // Menghapus kursus
    public function delete($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Kursus tidak ditemukan');
        }

        $course->delete();
        return redirect()->route('courses.index')->with('success', 'Kursus berhasil dihapus!');
    }

    // lihat detail
    // lihat detail
    public function details($id)
    {
        // Ambil data course berdasarkan ID, dengan eager load relasi period dan teacher
        $course = Course::with(['period', 'teacher'])->find($id);

        // Validasi jika course tidak ditemukan
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Kursus tidak ditemukan');
        }

        // Tampilkan view dengan detail course
        return view('Admin.courses.details', compact('course'));
    }

    public function lessons($id) {
        $course = Course::findOrFail($id);
        $lessons = $course->lessons; // Mengambil semua lessons yang terkait dengan course ini

        return view('Admin.courses.lessons.index', compact('course', 'lessons'));
    }

}
