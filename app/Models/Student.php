<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['user_id', 'name', 'age', 'address', 'phone', 'school'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function enrollments() {
        return $this->belongsToMany(DetailCourse::class, 'enrollments', 'student_id', 'detail_course_id')->withPivot(['payment', 'status']);
    }

    public function grades() {
        return $this->belongsToMany(Assignment::class, 'grades', 'student_id', 'assignment_id')->withPivot(['submission', 'score', 'feedback']);
    }

    public function pendaftarans(): HasMany {
        return $this->hasMany(Pendaftaran::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    
}
