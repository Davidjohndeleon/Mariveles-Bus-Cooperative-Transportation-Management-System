<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    // protected $fillable = ['bus_name', 'driver_id'];
    // public function bus()
    // {
    //     return $this->belongsTo(Bus::class);
    // }

    // public function driver()
    // {
    //     return $this->belongsTo(User::class, 'driver_id');
    // }
    // use HasFactory;
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'departure_time',
        'driver_id',
        'conductor_id',
        'departure_time',
        'route'
    ];

    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }

    public function driver()
    {
        return $this->belongsTo(User::class, 'driver_id');
    }

    public function conductor()
    {
        return $this->belongsTo(User::class, 'conductor_id'); 
    }

    public function busBookings()
    {
        return $this->hasMany(BusBooking::class);
    }
}
