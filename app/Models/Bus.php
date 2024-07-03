<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    
    protected $fillable = ['bus_name', 'driver_id'];
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }
    
}
