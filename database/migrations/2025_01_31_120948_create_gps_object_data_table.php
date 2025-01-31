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
        Schema::create('gps_object_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->dateTime('dt_server')->nullable();
            $table->dateTime('dt_tracker')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();
            $table->string('altitude')->nullable();
            $table->string('angle')->nullable();
            $table->string('speed')->nullable();
            $table->string('params_gpslev')->nullable();
            $table->string('params_pump')->nullable();
            $table->string('params_track')->nullable();
            $table->string('params_bats')->nullable();
            $table->string('params_acc')->nullable();
            $table->string('params_batl')->nullable();
            $table->string('loc_valid')->nullable();
            $table->string('imei')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gps_object_data');
    }
};
