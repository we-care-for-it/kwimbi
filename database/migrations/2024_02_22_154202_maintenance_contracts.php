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
      Schema::create('maintenance_contracts', function (Blueprint $table) {
          $table->id();
          $table->timestamps();
          $table->softDeletes();
          $table->date('begindate')->nullable();
          $table->date('enddate')->nullable();
          $table->foreignId('elevator_id')->references('id')->on('elevators')->nullable();
          $table->foreignId('maintenancie_companie_id')->references('id')->on('maintenancy_companies')->nullable();
      });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
