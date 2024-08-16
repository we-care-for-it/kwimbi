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
        Schema::create('inspections_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('zin_code')->nullable();
            $table->string('comment')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->integer('inspection_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspections_data');
    }
};

 