<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->dateTime('last_edit_at')->nullable();
            $table->integer('last_edit_by')->nullable();

            $table->integer('management_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('inspection_company_id')->nullable();
            $table->integer('maintency_company_id')->nullable();
            $table->integer('address_id')->nullable();
 
            $table->string('email')->nullable();
            $table->string('function')->nullable();
            $table->string('name')->nullable();
            $table->string('remark')->nullable();
            $table->string('emailaddress')->nullable();
            $table->string('website')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('mobile_phonenumber')->nullable();
            $table->string('social_linkedin')->nullable();
            $table->string('social_facebook')->nullable(); 
            $table->string('social_istagram')->nullable(); 
            $table->integer('customer_id')->nullable();
            


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contacts');
    }
};
