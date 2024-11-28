<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elevators', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();

            $table->string('name')->nullable();
            $table->string('construction_year')->nullable();
            $table->string('unit_no')->nullable();
            $table->string('remark')->nullable();
            $table->string('install_date')->nullable();

            $table->integer('nobo_no')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('supplier_id')->nullable();

            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();

            $table->integer('object_type_id')->nullable();
            $table->integer('speakconnection')->nullable();
            $table->integer('inspection_company_id')->nullable();

            $table->integer('maintenance_company_id')->nullable();

            $table->integer('inspection_state_id')->nullable();

            $table->integer('fire_elevator')->nullable();
            $table->integer('emergency_power')->nullable();
            $table->integer('stretcher_elevator')->nullable();
            $table->integer('stopping_places')->nullable();
            $table->integer('carrying_capacity')->nullable();
            $table->string('energy_label')->nullable();
            $table->integer('status_id')->nullable();
            
            




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('objects');
    }
};
