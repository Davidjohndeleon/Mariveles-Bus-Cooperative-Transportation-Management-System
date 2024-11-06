<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fare extends Model
{
    use HasFactory;

    protected $fillable = [
        'landmark',
        'distance',
        'regular_fare',
        'elderly_student_disabled_fare'
    ];
}
