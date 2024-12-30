<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Period;
use App\Models\Teacher;
use App\Models\Lesson;
use App\Models\Assignment;
use Illuminate\Http\Request;

class CourseManagementController extends Controller
{
    public function index(Request $request)
    {
        // Start with a base query
        $query = Course::with(['period', 'teacher']);

        // Apply filters
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('period')) {
            $query->where('period_id', $request->period);
        }

        if ($request->filled('teacher')) {
            $query->where('teacher_id', $request->teacher);
        }

        // Get the filtered courses
        $courses = $query->latest()->get();

        // Get data for filter dropdowns
        $periods = Period::all();
        $teachers = Teacher::all();

        // Get statistics
        $totalCourses = Course::count();
        $totalActivePeriods = Period::where('active', true)->count();
        $totalLessons = Lesson::count();
        $totalAssignments = Assignment::count();

        return view('Admin.course-management.index', compact(
            'courses',
            'periods',
            'teachers',
            'totalCourses',
            'totalActivePeriods',
            'totalLessons',
            'totalAssignments'
        ));
    }

    public function show($id)
    {
        $course = Course::with(['period', 'teacher', 'lessons', 'assignments'])->findOrFail($id);
        return view('Admin.course-management.show', compact('course'));
    }
}
