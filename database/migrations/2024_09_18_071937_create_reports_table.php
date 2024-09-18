<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('reports', function (Blueprint $table) {
        $table->id();
        $table->foreignId('bus_id')->constrained('buses')->onDelete('cascade');
        $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Assuming 'users' is your passengers table
        $table->string('topic');
        $table->text('report');
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('reports');
}
};
