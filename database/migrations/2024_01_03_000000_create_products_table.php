<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description');
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(1);
            $table->string('sku')->unique();
            $table->json('images');
            $table->json('specifications')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->boolean('is_featured')->default(false);
            $table->string('link')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'is_featured']);
            $table->index(['slug']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
