<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('traders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('picture')->nullable(); // profile image URL or path
            $table->decimal('average_return', 5, 2)->default(0.00); // e.g. 12.34 (%)
            $table->unsignedInteger('followers')->default(0);
            $table->decimal('profit_share', 5, 2)->default(0.00); // e.g. 20.00 (%)
            $table->decimal('win_rate', 5, 2)->default(0.00); // e.g. 75.50 (%)
            $table->decimal('total_profit', 15, 2)->default(0.00); // cumulative profit
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('traders');
    }
};
