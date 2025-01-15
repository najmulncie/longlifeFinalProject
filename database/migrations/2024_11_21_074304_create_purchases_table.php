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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('package_id')->constrained()->onDelete('cascade');
            $table->string('mobile');
            $table->string('operator');
            $table->string('region');
            $table->decimal('price', 10, 2);
            $table->enum('status', ['pending', 'completed', 'rejected'])->default('pending');
            $table->enum('connection_type', ['prepaid', 'postpaid'])->default('prepaid'); // Add the connection type field
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
