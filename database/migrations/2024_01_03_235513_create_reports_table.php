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
        Schema::create('reports', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('resident_id');
            $table->string('code');
            $table->string('title');
            $table->longText('description');
            $table->string('image');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('address');
            $table->string('spesific_location')->nullable();
            $table->foreign('resident_id')->references('id')->on('residents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
