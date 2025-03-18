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
        Schema::create('object_monitoring_codes', function (Blueprint $table) {
            $table->string('brand')->nullable();
            $table->string('error_code')->nullable();
            $table->string('brand_mondescriptionitoring')->nullable();
            $table->string('possreason')->nullable();
            $table->string('detection')->nullable();
            $table->string('operation')->nullable();
            $table->string('recovery')->nullable();
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
