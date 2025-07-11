<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'course_id'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function teacher()
    {
    return $this->belongsTo(User::class, 'teacher_id');
    }
    
    public function grades()
    {
        return $this->hasMany(Grade::class);
    }
}
