<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_address', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('address_id');
            $table->timestamps();

            $table->unique('user_id');
            $table->unique('address_id');

            $table->foreign('user_id')
                ->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('address_id')
                ->references('id')->on('addresses')->cascadeOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_address');
    }
};

