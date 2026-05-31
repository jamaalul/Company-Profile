<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('order_item_field_values', function (Blueprint $table) {
            $table->unsignedInteger('copy_index')->default(0)->after('file_path');
        });
    }

    public function down(): void
    {
        Schema::table('order_item_field_values', function (Blueprint $table) {
            $table->dropColumn('copy_index');
        });
    }
};
