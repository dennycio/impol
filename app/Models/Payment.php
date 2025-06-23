<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'enrollment_id',
        'amount',
        'payment_date',
        'method',
        'status',
    ];

    public function enrollment()
    {
        return $this->belongsTo(Enrollment::class);
    }
}
