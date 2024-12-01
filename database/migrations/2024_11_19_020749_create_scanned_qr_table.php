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
            $table->string('checkpoint_name');
            $table->foreignId('driver_id')->constrained('users')->onDelete('cascade');
            $table->unsignedBigInteger('checkpoint_id')->nullable();
            $table->foreign('checkpoint_id')->references('id')->on('checkpoints')->onDelete('set null'); 
            $table->string('status')->default('scanned');
            $table->timestamps();
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
