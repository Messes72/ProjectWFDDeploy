<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Period extends Model
{
    protected $fillable = ['year', 'semester', 'active'];

    public function detail_courses() {
        return $this->hasMany(DetailCourse::class);
    }
    // Relasi jika dibutuhkan dengan kursus
    public function courses()
    {
        return $this->hasMany(Course::class);
    }
}
