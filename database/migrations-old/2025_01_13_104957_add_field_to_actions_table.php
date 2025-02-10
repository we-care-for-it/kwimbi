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
        Schema::table('actions', function (Blueprint $table) {
            $table->integer('type_id')->default(3)->nullable();
            $table->integer('relation_id')->nullable();
            $table->date('plan_date')->nullable();
            $table->time('plan_time')->nullable();
            $table->time('private_action')->default(0)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actions', function (Blueprint $table) {
            $table->integer('type_id')->default(3)->nullable();
            $table->date('plan_date')->nullable();
            $table->time('plan_date')->nullable();
        });
    }
};
