<?php

namespace App\Models;
use App\Models\Investment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvestmentPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'roi',
        'min_amount',
        'max_amount',
        'duration',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
