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
        Schema::create('inspection_companies', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->dateTime('last_edit_at')->nullable();
            $table->integer('last_edit_by')->nullable();
            $table->string('name')->nullable();
            $table->string('zipcode')->nullable();     
            $table->string('place')->nullable();
            $table->string('website')->nullable();
            $table->string('address')->nullable();
            $table->string('general_emailaddress')->nullable();
            $table->string('phonenumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('inspection_companies');
    }
};
