<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','name', 'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function scannedQR()
    {
        return $this->hasMany(ScannedQR::class, 'checkpoint_id');
    }

}
