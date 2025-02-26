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
        Schema::table('external', function (Blueprint $table) {
            $table->foreignId('relation_id')->nullable()->constrained('relations');
            $table->date('from_date')->nullable();
        });

        Schema::table('external_apilogs', function (Blueprint $table) {
            $table->int('external_id')->nullable();
            $table->date('from_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('external', function (Blueprint $table) {
            //
        });
    }
};
