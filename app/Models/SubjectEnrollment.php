<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SubjectEnrollment extends Model
{
    protected $fillable = ['user_id', 'subject_id', 'year'];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}

