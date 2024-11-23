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
        if (!Schema::hasColumn('bookings', 'bus_id')) {
            Schema::table('bookings', function (Blueprint $table) {
                $table->unsignedBigInteger('bus_id')->after('user_id')->nullable();
            });
        }
    }
    
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn('bus_id');
        });
    }
};
