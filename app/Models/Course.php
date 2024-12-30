<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\Teacher;
use App\Models\Pendaftaran;
use App\Models\Assignment;
use App\Models\Submission;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'period_id',
        'teacher_id',
        'price',
        // 'period_id'
    ];

    // Relasi ke model Teacher
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    // public function teachers()
    // {
    //     return $this->hasMany(Teacher::class);
    // }

    // Relasi ke Pendaftaran (Setiap Course bisa memiliki banyak Pendaftaran)
    public function pendaftarans()
    {
        return $this->hasMany(Pendaftaran::class, 'course_id');
    }
    public function period()
    {
        return $this->belongsTo(Period::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
