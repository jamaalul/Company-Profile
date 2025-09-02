<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->string('angkatan')->after('customer_address');
            $table->enum('bidang', ['HIMTI (non hima)', 'Per Departement', 'Alumni'])->after('angkatan');
            $table->enum('size', ['XS', 'S', 'M', 'L', 'XL', 'XXL', '3XL'])->after('bidang');
            $table->string('no_bundling')->nullable()->after('size');
            $table->enum('payment_method', ['cash', 'qris'])->after('no_bundling');
            $table->string('payment_proof')->nullable()->after('payment_method');
            $table->text('admin_notes')->nullable()->after('status');
            
            // Update status enum to include new statuses
            $table->enum('status', ['pending', 'pending_confirmation', 'confirmed', 'paid', 'cancelled', 'rejected'])->change();
        });
    }

    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn([
                'order_number',
                'angkatan', 
                'bidang',
                'size',
                'no_bundling',
                'payment_method',
                'payment_proof',
                'admin_notes'
            ]);
        });
    }
};