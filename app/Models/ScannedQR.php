<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScannedQR extends Model
{
    use HasFactory;

    protected $fillable = ['driver_id', 'name', 'status'];

    protected $table = 'scanned_qr';

    public function checkpoint()
{
    return $this->belongsTo(Checkpoint::class);
}

public function driver()
{
    return $this->belongsTo(User::class, 'driver_id');
}
}
