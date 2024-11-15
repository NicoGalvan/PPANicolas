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
        Schema::create('routes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('airplane_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('origin_airport_id');
            $table->unsignedBigInteger('destination_airport_id');
            $table->unsignedBigInteger('route_id')->nullable();
            $table->boolean('direct');
            $table->integer('duration');

            $table->foreign('origin_airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('destination_airport_id')->references('id')->on('airports')->onDelete('cascade');
            $table->foreign('route_id')->references('id')->on('routes')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('routes');
    }
};
