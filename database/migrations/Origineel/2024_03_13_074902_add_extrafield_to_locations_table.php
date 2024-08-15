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
        Schema::table('locations', function (Blueprint $table) {
            $table->string('access_code')->nullable();
            $table->string('gps_lat')->nullable();
            $table->string('gps_lon')->nullable();
            $table->string('levels')->nullable();
            $table->string('surface')->nullable();
            $table->string('access_contact')->nullable();
            $table->string('location_key_lock')->nullable();
            $table->string('province')->nullable();
            $table->string('municipality')->nullable();
            $table->string('building_type')->nullable();
            $table->string('housenumber')->nullable();
            $table->string('building_access_type_id')->nullable();
            

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('locations', function (Blueprint $table) {

      
        });

 

    }
};
