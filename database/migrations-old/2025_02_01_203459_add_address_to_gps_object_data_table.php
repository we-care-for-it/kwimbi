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
        Schema::table('gps_object_data', function (Blueprint $table) {
            $table->string('streetNameAndNumber')->nullable();
            $table->string('countryCode')->nullable();
            $table->string('municipalitySubdivision')->nullable();
            $table->string('countryCodeISO3')->nullable();
            $table->string('countrySubdivisionName')->nullable();
            $table->string('countrySubdivisionCode')->nullable();

            $table->string('zipcode')->nullable();
            $table->string('km_start')->nullable();
            $table->string('km_end')->nullable();
            $table->string('customer_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gps_object_data', function (Blueprint $table) {
            //
        });
    }
};
