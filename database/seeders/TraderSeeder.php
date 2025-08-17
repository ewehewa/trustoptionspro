<?php

namespace Database\Seeders;

use App\Models\Trader;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TraderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Trader::create([
            'name' => 'John Doe',
            'picture' => 'images/john.jpg',
            'average_return' => 12.50,
            'followers' => 120,
            'profit_share' => 15.00,
            'win_rate' => 70.25,
            'total_profit' => 45000.00,
        ]);
    }
}
