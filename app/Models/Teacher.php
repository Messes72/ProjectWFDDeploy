<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use App\Models\Course;
use App\Models\User;
use App\Models\DetailCourse;
use App\Models\Lesson;

class Teacher extends Model
{
    protected $fillable = ['user_id', 'name', 'qualification', 'experiences'];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function detail_courses() {
        return $this->hasMany(DetailCourse::class);
    }

    public function courses() {
        return $this->hasMany(Course::class, 'teacher_id');
    }

    public function lessons() {
        return $this->hasMany(Lesson::class);
    }
}

