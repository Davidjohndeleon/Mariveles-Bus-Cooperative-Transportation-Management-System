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
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->time('departure_time');
            $table->string('route');
            $table->unsignedBigInteger('bus_id')->nullable();
            $table->unsignedBigInteger('driver_id')->nullable();
            $table->unsignedBigInteger('conductor_id')->nullable(); 
            $table->timestamps();
        
            $table->foreign('bus_id')->references('id')->on('buses')->onDelete('set null');
            $table->foreign('driver_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('conductor_id')->references('id')->on('users')->onDelete('set null'); 
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};
