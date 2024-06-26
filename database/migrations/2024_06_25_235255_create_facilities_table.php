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
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description');
            $table->string('category');
            $table->string('address');
            $table->boolean('is_favorite');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('tuna_netra_friendly_status')->nullable();
            $table->string('tuna_rungu_friendly_status')->nullable();
            $table->string('tuna_daksa_friendly_status')->nullable();
            $table->string('tuna_wicara_friendly_status')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facilities');
    }
};
