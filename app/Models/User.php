<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'usertype',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function buses()
    {
        return $this->hasMany(Bus::class, 'driver_id');
    }

    public function conductor()
    {
        return $this->hasOne(Conductor::class);
    }

    public function isAdmin()
    {
        return $this->usertype === 'admin';
    }

    public function isDriver()
    {
        return $this->usertype === 'driver';
    }

    public function isCheckpoint()
    {
        return $this->usertype === 'checkpoint';
    }

    public function isPassenger()
    {
        return $this->usertype === 'passenger';
    }

    public function isConductor()
    {
        return $this->usertype === 'conductor';
    }

    public function checkpoints()
    {
        return $this->hasMany(Checkpoint::class);
    }

    public function busBookings()
    {
        return $this->hasMany(BusBooking::class, 'user_id');
    }

    public function hasRole($role)
    {
        return strtolower($this->usertype) === strtolower($role);
    }
    
}
