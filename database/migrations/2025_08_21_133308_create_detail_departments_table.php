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
        Schema::create('detail_departments', function (Blueprint $table) {
            $table->id();
            // Foreign key yang terhubung ke tabel departments
            $table->foreignId('department_id')->constrained()->onDelete('cascade');
            $table->text('division_words'); // Kolom untuk kata-kata dari divisi
            $table->string('head_name'); // Kolom untuk nama ketua departemen
            $table->string('head_photo'); // Kolom untuk foto ketua departemen
            $table->json('sub_departments')->nullable(); // Kolom JSON untuk struktur sub-departemen
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_departments');
    }
};
