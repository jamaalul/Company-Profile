<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('product_fields', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->cascadeOnDelete();
            $table->string('label');
            $table->enum('field_type', ['text', 'dropdown', 'file']);
            $table->json('dropdown_options')->nullable();
            $table->boolean('is_required')->default(true);
            $table->unsignedInteger('sort_order')->default(0);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('product_fields');
    }
};
