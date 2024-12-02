<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'driver_id',
        'scanned_qr_id',
        'status',
        'checkpoint_name',
    ];

    public function scannedQR()
    {
        return $this->hasMany(ScannedQR::class, 'checkpoint_id');
    }
    
}
