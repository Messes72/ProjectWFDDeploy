<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Course;
use App\Models\User;

class Pendaftaran extends Model
{
    // Status constants
    const STATUS_PENDING = 'pending';
    const STATUS_FAILED = 'failed';
    const STATUS_ACCEPTED = 'accepted';

    protected $fillable = [
        'student_id',
        'course_id',
        'name',
        'email',
        'phone',
        'school',
        'alasan',
        'payment_method',
        'card_number',
        'ovo_gopay_number',
        'status',
    ];

    // Relasi ke User (Student)
    public function student(): BelongsTo
    {
        return $this->belongsTo(User::class, 'student_id');
    }

    // Relasi ke Course
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    // Helper methods for status
    public function isPending(): bool
    {
        return $this->status === self::STATUS_PENDING;
    }

    public function isFailed(): bool
    {
        return $this->status === self::STATUS_FAILED;
    }

    public function isAccepted(): bool
    {
        return $this->status === self::STATUS_ACCEPTED;
    }
}
