<?php

namespace App\Models;

use App\Models\Deposit; 
use App\Models\Withdrawal;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'username',
        'email',
        'phone',
        'country',
        'access',
        'password',
        'otp',
        'email_otp',
        'otp_expires_at',
    ];

    public function deposits()
    {
        return $this->hasMany(Deposit::class);
    }
    
    public function withdrawals()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }

    public function profits()
    {
        return $this->hasMany(Profit::class);
    }

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
