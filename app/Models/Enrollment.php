<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Enrollment extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'subject_id', 'year'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }

    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
