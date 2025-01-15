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
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();$table->unsignedBigInteger('user_id'); // ইউজারের আইডি
            $table->decimal('amount', 10, 2); // ইনকামের পরিমাণ
            $table->string('source'); // ইনকামের উৎস (যেমন: রেফারেল বা টাস্ক)
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incomes');
    }
};
