<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\DetailCourse;
use App\Models\Teacher;
use App\Models\Course;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LessonController extends Controller
{
    public function index()
    {
        $lessons = Lesson::all(); // Retrieve all lessons
        $courseId = null; // Set a default value or retrieve it based on your logic
        return view('Admin.lessons.index', compact('lessons', 'courseId')); // Pass lessons and courseId to the view
    }

    // Menampilkan form untuk membuat lesson
    public function create($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        }
        $courses = DetailCourse::all();
        $teacher = Teacher::findOrFail($course->teacher_id);

    return view('Admin.lessons.create', compact('courses', 'teacher', 'course'));
}


    // Menyimpan lesson baru ke database
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'date' => 'required|date',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'pdf' => 'nullable|mimes:pdf|max:2048',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Ubah cara penyimpanan file
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('images', 'public');
        } else {
            $imagePath = null;
        }

        if ($request->hasFile('pdf')) {
            $pdfPath = $request->file('pdf')->store('pdfs', 'public');
        } else {
            $pdfPath = null;
        }

        // Ambil nama course
        $course = Course::find($request->input('course_id'));

        // Simpan data ke database
        Lesson::create([
            'course_id' => $request->input('course_id'),
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'date' => $request->input('date'),
            'image' => $imagePath,
            'pdf' => $pdfPath,
            ]);

        // Redirect atau kembali ke halaman yang diinginkan
        return redirect()->route('lessons.index')->with('success', 'Lesson created successfully.');
    }

    // Menampilkan daftar lesson
   
}