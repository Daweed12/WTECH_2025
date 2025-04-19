<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();                                       // PK
            $table->string('name', 255);                        // názov
            $table->text('description')->nullable();            // popis
            $table->decimal('price', 10, 2);                    // cena
            $table->integer('stock_quantity')->default(0);      // množstvo na sklade
            $table->smallInteger('discount')->default(0);       // zľava v %

            $table->timestamps();                               // created_at, updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
}
