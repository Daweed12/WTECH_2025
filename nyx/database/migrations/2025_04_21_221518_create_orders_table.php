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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->string('session_token')->nullable();
            $table->string('status')->default('pending');
            $table->decimal('total_price',10,2);
            $table->decimal('tax',10,2)->default(0);
            $table->decimal('discount',10,2)->default(0);
            $table->foreignId('payment_method_id')->constrained('payment_methods');
            $table->foreignId('shipping_method_id')->constrained('shipping_methods');
            $table->foreignId('coupon_id')->nullable()->constrained('coupons');
            $table->foreignId('shipping_address_id')->constrained('addresses');
            $table->timestamps();
            $table->softDeletes();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
