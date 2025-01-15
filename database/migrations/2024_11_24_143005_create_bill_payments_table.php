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
        Schema::create('bill_payments', function (Blueprint $table) {
            $table->id();  // Auto-incrementing ID
            $table->string('bill_no');  
            $table->string('mobile_number');  
            $table->string('operator');  // Operator field (like water, electricity, etc.)
            $table->decimal('total_bill', 10, 2);  // Total bill amount
            $table->string('status')->default('pending');  
            $table->unsignedBigInteger('user_id')->nullable();  // User ID field for foreign key relation
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');  // Foreign key constraint
            $table->string('address')->nullable();  
            $table->decimal('cashback', 10, 2)->default(0);
            $table->timestamps(); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bill_payments');
    }
};
