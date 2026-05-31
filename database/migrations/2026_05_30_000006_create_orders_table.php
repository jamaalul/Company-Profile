<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('tracking_token')->unique();
            $table->string('buyer_name');
            $table->string('buyer_email');
            $table->string('buyer_whatsapp');
            $table->decimal('total_price', 12, 2);
            $table->enum('status', [
                'pending_approval',
                'approved',
                'rejected',
                'completed',
            ])->default('pending_approval');
            $table->string('payment_proof_path')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
