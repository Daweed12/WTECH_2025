<?php

use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Database\Migrations\Migration;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Database\Schema\Blueprint;
use PROJEKT_WTECH_2025\WTECH25_NYX\vendor\laravel\framework\src\Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username',128);
            $table->string('password',128);
            $table->string('email',128)->unique();
            $table->string('phone',128)->unique();
            $table->string('address',128)->nullable();
            $table->string('city',128)->nullable();
            $table->string('country',128)->nullable();
            $table->integer('role')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
