<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->string('sku')->unique();
            $table->string('slug')->unique();

            $table->decimal('price', 8, 2);
            $table->decimal('discount', 8, 2)->default(0);

            $table->string('category')->nullable();
            $table->string('color')->nullable();
            $table->string('gender')->nullable();

            $table->string('description');
            $table->text('summary')->nullable();

           
            // text – ak chceš JSON, zmeň na $table->json('details')
            $table->text('details')->nullable();

            $table->timestamps();   // created_at, updated_at
            $table->softDeletes();  // deleted_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
