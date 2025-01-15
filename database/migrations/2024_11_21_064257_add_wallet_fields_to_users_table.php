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
        Schema::table('users', function (Blueprint $table) {

            $table->decimal('wallet_balance', 15, 2)->default(0)->after('amount'); // Adjust the 'existing_column' position if necessary

            // Adding the 'total_wallet_amount' field to track the total accumulated wallet funds
            $table->decimal('total_wallet_amount', 15, 2)->default(0)->after('wallet_balance');
      
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('wallet_balance');
            $table->dropColumn('total_wallet_amount');
        });
    }
};
