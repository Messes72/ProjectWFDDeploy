<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Assignment;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $assignments = Assignment::all(); // Retrieve all assignments
        $courseId = null; // Set a default value or retrieve it based on your logic
        return view('Admin.assignments.index', compact('assignments', 'courseId')); // Pass assignment and courseId to the view
    }

    // Menampilkan form untuk membuat assignment
    public function create($id)
    {
        $course = Course::find($id);
        if (!$course) {
            return redirect()->route('courses.index')->with('error', 'Course not found.');
        }
        $teacher = Teacher::findOrFail($course->teacher_id);
        return view('Admin.assignments.create', compact('course', 'teacher'));
    }


    // Menyimpan assignment baru ke database
    public function store(Request $request)
    {
        // Debugging: Validasi dan log data yang masuk
        ;
        $request->validate([
            // 'detail_course_id' => 'required|exists:detail_courses,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'required|date',
            'course_id' => 'required|exists:courses,id',
        ]);

        // Log::info('Validated Data:', $validated);

        // Simpan data ke database
        Assignment::create([
            'course_id' => $request->input('course_id'),
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'due_date' => $request->input('due_date'),
        ]);

        // Redirect dengan pesan sukses
        return redirect()->route('assignments.index')->with('success', 'Assignment successfully added!');
    }

    public function showSubmissionForm($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('User.submit', compact('assignment'));
    }

    public function submitAssignment(Request $request, $id)
    {
        try {
            // Ambil student_id dari relasi user->student
            $user = Auth::user();
            $student = \App\Models\Student::where('user_id', $user->id)->first();
            
            if (!$student) {
                throw new \Exception('Student profile not found');
            }

            // Validasi input
            $validated = $request->validate([
                'pdf' => 'required|file|mimes:pdf|max:2048',
                'course_id' => 'required|exists:courses,id',
                'assignment_id' => 'required|exists:assignments,id',
            ]);

            // Simpan file
            $filePath = $request->file('pdf')->store('submissions');

            // Buat submission dengan student_id yang benar
            $submission = \App\Models\Submission::create([
                'student_id' => $student->id, // Gunakan ID dari tabel students
                'course_id' => $validated['course_id'],
                'assignment_id' => $validated['assignment_id'],
                'pdf' => $filePath,
            ]);

            Log::info('Submission created successfully:', $submission->toArray());
            
            return redirect()->route('assignments.index')
                ->with('success', 'File berhasil diupload!');

        } catch (\Exception $e) {
            Log::error('Error in submitAssignment:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            
            return redirect()->back()
                ->with('error', 'Gagal mengupload file: ' . $e->getMessage())
                ->withInput();
        }
    }

}
