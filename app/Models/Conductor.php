<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conductor extends Model
{
    use HasFactory;

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'conductor_id');
    }
}
