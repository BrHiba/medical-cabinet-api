<?php
namespace App\Models;
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model {
    use HasFactory;

    protected $fillable = [
        'name',
        'speciality',
        'phone',
        'email',
        'description',
        'photo'
    ];
}
