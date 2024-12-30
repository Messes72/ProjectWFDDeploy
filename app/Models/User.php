<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Pendaftaran;
use App\Models\Teacher;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'email',
        'password',
        'role'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi ke Pendaftaran (Setiap User bisa memiliki banyak Pendaftaran)
    public function pendaftaran()
    {
        return $this->hasMany(Pendaftaran::class, 'student_id');
    }

    // Relasi ke Teacher (Jika user berperan sebagai Teacher)
    public function teacher()
    {
        return $this->hasOne(Teacher::class);
    }

    public function student(){
    return $this->hasOne(Student::class);
    }

}
