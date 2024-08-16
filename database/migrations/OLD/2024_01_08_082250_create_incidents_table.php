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
            $table->softDeletes(); 
            $table->timestamps();
            $table->integer('elevator_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('description')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('reporter_id')->nullable();
            $table->integer('contact_id')->nullable();
            $table->integer('stand_still')->nullable();
            $table->integer('employee_id')->nullable();
            $table->string('subject')->nullable();

            $table->string('contact_phonenumber')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('contact_address')->nullable();
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
