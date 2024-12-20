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
        Schema::create('checkpoints', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('driver_id');
            $table->unsignedBigInteger('scanned_qr_id')->nullable(); // Foreign key for scanned QR
            $table->string('status')->default('pending');
            $table->string('checkpoint_name');
            $table->timestamps();

            $table->foreign('driver_id')->references('id')->on('drivers')->onDelete('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkpoints');
    }
};
