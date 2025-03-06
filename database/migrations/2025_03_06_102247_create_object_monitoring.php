<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectMonitoringTable extends Migration
{
    public function up()
    {
        Schema::create('object_monitoring', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sensor01');
            $table->string('sensor02');
            $table->string('sensor03');
            $table->string('sensor04');
            $table->string('sensor05');
            $table->float('temp01')->nullable();
            $table->float('humidity01')->nullable();
            $table->float('temp02')->nullable();
            $table->float('humidity02')->nullable();
            $table->float('temp03')->nullable();
            $table->float('humidity03')->nullable();
            $table->float('longitude')->nullable();
            $table->float('latitude')->nullable();
            $table->float('lati')->nullable();
            $table->integer('network_signal')->nullable();
            $table->string('protocol')->nullable();
            $table->string('ipaddress')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('object_monitoring');
    }
}