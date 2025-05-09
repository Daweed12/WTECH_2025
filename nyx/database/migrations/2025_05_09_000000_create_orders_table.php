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

            // User
            $table->foreignId('user_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            // Session token (pre guest checkout)
            $table->string('session_token')
                ->nullable();

            // Stav objednávky
            $table->string('status')
                ->default('pending');   // pending | paid | shipped …

            // Celková cena a zľava (subtotal počítame v kontroléri)
            $table->decimal('total_price', 10, 2)
                ->default(0);
            $table->decimal('discount', 10, 2)
                ->default(0);
            $table->decimal('delivery_fee', 10, 2)
                ->default(0);
            $table->decimal('payment_fee', 10, 2)
                ->default(0);

            // FK na payment_methods
            $table->foreignId('payment_method_id')
                ->nullable()
                ->constrained('payment_methods')
                ->nullOnDelete();

            // FK na delivery_methods
            $table->foreignId('delivery_method_id')
                ->nullable()
                ->constrained('delivery_methods')
                ->nullOnDelete();

            // Zľavový kód (ak ho používate)
            $table->string('discount_code')
                ->nullable();

            // FK na adresu (shipping address)
            $table->foreignId('address_id')
                ->nullable()
                ->constrained('addresses')
                ->nullOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
