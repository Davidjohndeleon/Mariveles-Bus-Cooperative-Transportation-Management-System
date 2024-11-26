<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bus extends Model
{
    use HasFactory;
    
    protected $fillable = ['bus_name', 'driver_id','conductor_id'];
    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function conductor()
{
    return $this->belongsTo(User::class, 'conductor_id');
}

    public function bookings()
    {
        return $this->hasMany(BusBooking::class);
    }
    
}
