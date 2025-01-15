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
        Schema::create('premium_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id'); // Requester user ID
            $table->unsignedBigInteger('referred_by')->nullable(); // Referral ID for hierarchy
            $table->string('name'); // User-provided name
            $table->decimal('selling_price', 10, 2); // Selling price input
            $table->string('gmail'); // Gmail address
            $table->boolean('is_approved')->default(false); // Approval status
            $table->boolean('terms_accepted')->default(false);
            $table->timestamps();
        
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('premium_orders');
    }
};
