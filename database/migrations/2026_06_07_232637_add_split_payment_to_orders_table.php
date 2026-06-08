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
        Schema::table('orders', function (Blueprint $table) {
            $table->enum('payment_type', ['full', 'down_payment'])->default('full')->after('status');
            $table->decimal('amount_paid', 12, 2)->nullable()->after('payment_type');
            $table->string('final_payment_proof_path')->nullable()->after('amount_paid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn(['payment_type', 'amount_paid', 'final_payment_proof_path']);
        });
    }
};
