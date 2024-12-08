<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScannedQR extends Model
{
    use HasFactory;

    protected $table = 'scanned_qr';

    protected $fillable = [
        'driver_id',
        'checkpoint_id',
        'checkpoint_name',
        'status',
    ];

    public function checkpoint()
    {
        return $this->belongsTo(Checkpoint::class);
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
    public function schedule()
    {
        return $this->hasOne(Schedule::class, 'driver_id', 'driver_id');
    }
}
