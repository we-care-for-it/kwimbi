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
        Schema::create('objects_inspections', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->date('executed_datetime')->nullable();
            $table->date('end_date')->nullable();
            $table->integer('status_id')->nullable();
            $table->longtext('remark')->nullable();
            $table->longtext('document')->nullable();
            $table->longtext('certification')->nullable();
            $table->foreignId('elevator_id')->references('id')->on('elevators')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
      
    }
};
