<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CopiedTrader extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'trader_id',
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function trader()
    {
        return $this->belongsTo(Trader::class);
    }
}
