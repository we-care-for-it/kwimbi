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
        Schema::table('uploads', function (Blueprint $table) {
            $table->integer('elevator_id')->nullable();
            $table->integer('group_id')->nullable();
            $table->integer('relation_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('title')->nullable();
            $table->string('path')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('uploads', function (Blueprint $table) {
            //
        });
    }
};
