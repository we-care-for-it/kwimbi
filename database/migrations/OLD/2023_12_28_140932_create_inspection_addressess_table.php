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
        Schema::create('addressess', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();     
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->string('complexnumber')->nullable();
            $table->string('remark')->nullable();
            $table->integer('management_id')->nullable();
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
        Schema::dropIfExists('inspection_companies');
    }
};
