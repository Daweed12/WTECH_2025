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
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->mediumText('value');
            $table->integer('expiration');
        });

        Schema::create('cache_locks', function (Blueprint $table) {
            $table->string('key')->primary();
            $table->string('owner');
            $table->integer('expiration');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cache');
        Schema::dropIfExists('cache_locks');
    }
};
