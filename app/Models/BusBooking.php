<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BusBooking extends Model
{
    use HasFactory;

    protected $fillable = ['bus_id','bus_name', 'user_id', 'status', 'remarks'];

    protected $table = 'bookings';

    public function bus()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }

    public function passenger()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
