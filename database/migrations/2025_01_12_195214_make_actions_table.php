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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->integer('for_user_id')->nullable();
            $table->integer('create_by_user_id')->nullable();
            $table->longtext('title')->nullable();
            $table->longtext('body')->nullable();
            $table->integer('priority')->nullable();  
            $table->integer('item_id')->nullable();    
            $table->string('model')->nullable();    
            $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
