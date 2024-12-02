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
        Schema::create('scanned_qr', function (Blueprint $table) {
            $table->id();
            $table->foreignId('driver_id');
            $table->unsignedBigInteger('checkpoint_id')->nullable();
            $table->string('checkpoint_name'); 
            $table->string('status')->default('scanned');
            $table->timestamps();

            $table->foreign('checkpoint_id')->references('id')->on('checkpoints')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scanned_qr');
    }
};