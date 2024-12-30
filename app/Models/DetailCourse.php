<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class DetailCourse extends Model
{
    protected $fillable = ['teacher_id', 'course_id', 'period_id'];

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function period() {
        return $this->belongsTo(Period::class);
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'enrollments', 'detail_course_id', 'student_id')->withPivot(['payment', 'status']);
    }

    public function assignments() {
        return $this->hasMany(Assignment::class);
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}
