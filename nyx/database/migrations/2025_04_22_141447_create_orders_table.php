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

            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->string('session_token')->nullable();
            $table->string('status')->default('pending');   // pending | paid | shipped …
            $table->decimal('total_price', 10, 2)->default(0);
            $table->decimal('discount', 10, 2)->default(0);

            $table->string('payment_method_id')->nullable();
            $table->string('shipping_method_id')->nullable();
            $table->string('discount_code')->nullable();

            $table->foreignId('shipping_address_id')
                ->nullable()
                ->constrained('addresses')
                ->nullOnDelete();

            $table->timestamps();
        });
    }
    public function down(): void { Schema::dropIfExists('orders'); }
};
