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
        Schema::table('projects', function (Blueprint $table) {
            $table->string('cost_price')->nullable();
            $table->string('quote_number')->nullable();
            $table->string('quote_price')->nullable();
            $table->string('quote_number_external')->nullable();
            $table->string('quote_price_external')->nullable();
            $table->date('date_of_execution')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
};
