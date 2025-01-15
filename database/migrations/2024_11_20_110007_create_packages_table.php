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
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->string('operator'); // e.g., Robi, Airtel
            $table->string('category'); // e.g., Bundle, Internet, Minute
            $table->string('title'); // e.g., "100 GB + 1000 Min (1 Month)"
            $table->integer('price'); // e.g., 899
            $table->integer('cashback')->nullable(); // e.g., 30
            $table->text('description')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('packages');
    }
};
