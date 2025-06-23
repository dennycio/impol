<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    protected $fillable = [
        'enrollment_id',
        'subject_id',
        'test1',
        'test2',
        'test3',
        'exam',
        'recurrence_exam',
        'final_score',
        'status',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
