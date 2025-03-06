<?php

namespace App\Models;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'phone',
        'doctor_id',
        'date',
        'time',
        'status',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
