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
        Schema::create('objects', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('remark')->nullable();
            $table->string('install_date')->nullable();
            $table->bigInteger('type_id')->unsigned();
            $table->integer('nobo_no')->nullable();
            $table->integer('address_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->integer('management_company_id')->nullable();

            $table->integer('object_type_id')->nullable();
                     $table->integer('inspection_company_id')->nullable();

            $table->integer('maintenance_company_id')->nullable();

             $table->integer('status_id')->nullable();

              

            $table->timestamps();
            $table->softDeletes();

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
