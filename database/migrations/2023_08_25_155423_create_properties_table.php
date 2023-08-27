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
        // Name,Price,Bedrooms,Bathrooms,Storeys,Garages
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->integer('price', false, true);
            $table->tinyInteger('bedrooms', false, true);
            $table->tinyInteger('bathrooms', false, true);
            $table->tinyInteger('storeys', false, true);
            $table->tinyInteger('garages', false, true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
