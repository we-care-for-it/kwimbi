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
        Schema::create('incidents', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->SoftDeletes();
            $table->integer('project_id')->nullable();
            $table->integer('elevator_id')->nullable();
            $table->integer('employee_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('stand_still')->nullable();
            $table->integer('priority_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->longtext('subject')->nullable();
            $table->longtext('description')->nullable();
            $table->dateTime('report_date_time')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('incidents');
    }
};
