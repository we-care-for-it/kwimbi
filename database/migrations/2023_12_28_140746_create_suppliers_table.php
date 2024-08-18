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
        Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->dateTime('last_edit_at')->nullable();
            $table->integer('last_edit_by')->nullable();
            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();     
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->string('general_emailaddress')->nullable();
            $table->string('phonenumber')->nullable();
            $table->string('emailaddress')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('management_companies');
    }
};
