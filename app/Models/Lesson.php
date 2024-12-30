<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = ['course_id', 'title', 'content', 'date', 'image', 'pdf'];

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function teacher() {
        return $this->belongsTo(Teacher::class);
    }
}
