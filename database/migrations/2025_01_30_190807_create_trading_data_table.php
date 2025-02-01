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
        // CREAZIONE
        Schema::create('trading_data', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('symbol');
            $table->timestamps();
        });

        //  MODIFICHE
        Schema::table('trading_data', function (Blueprint $table) {
            $table->string('name', 100)->change();
            $table->foreignId('user_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_data');
    }
};
