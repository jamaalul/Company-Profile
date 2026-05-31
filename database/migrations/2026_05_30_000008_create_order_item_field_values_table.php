<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_item_field_values', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('product_field_id')->constrained()->cascadeOnDelete();
            $table->text('value')->nullable();
            $table->string('file_path')->nullable();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_item_field_values');
    }
};
