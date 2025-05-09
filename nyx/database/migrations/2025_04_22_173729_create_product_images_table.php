<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('product_images', function (Blueprint $table) {
            // no auto-increment ID: composite key instead
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('image_id');

            // composite primary key to prevent duplicates
            $table->primary(['product_id','image_id']);

            //$table->dropForeign(['product_id']);
            //$table->dropForeign(['image_id']);
            // foreign keys
            $table->foreign('product_id')
                ->references('id')->on('products')
                ->onDelete('cascade');

            $table->foreign('image_id')
                ->references('id')->on('images')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('product_images');
    }

};
