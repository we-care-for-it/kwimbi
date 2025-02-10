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





        Schema::table('object_inspections', function (Blueprint $table) {
            $table->string('inspection_company_id')->nullable();
            $table->string('nobo_number')->nullable();
            $table->string('if_match')->nullable();
            $table->string('type')->nullable();
            $table->string('external_uuid')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('object_inspections', function (Blueprint $table) {
            //
        });
    }
};
