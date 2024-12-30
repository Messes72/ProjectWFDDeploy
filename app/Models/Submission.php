<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'student_id',
        'course_id',
        'assignment_id',
        'pdf'
    ];

    // Relasi dengan model Student
    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    // Relasi dengan model Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Relasi dengan model Assignment
    public function assignment()
    {
        return $this->belongsTo(Assignment::class);
    }
}
