<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trader extends Model
{
     use HasFactory;

    protected $fillable = [
        'name',
        'picture',
        'average_return',
        'followers',
        'profit_share',
        'win_rate',
        'total_profit',
    ];

    public function copiedByUsers()
    {
        return $this->belongsToMany(User::class, 'copied_traders', 'trader_id', 'user_id');
    }
}
