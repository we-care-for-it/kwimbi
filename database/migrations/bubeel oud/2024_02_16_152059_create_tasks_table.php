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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->string('debtor_number')->nullable();
            $table->integer('external_id')->nullable();
            $table->string('status')->nullable();
            $table->string('name')->nullable();
            $table->string('description')->nullable();
            $table->integer('progress')->nullable();
            $table->string('date_start')->nullable();
            $table->string('date_end')->nullable();
            $table->string('priority')->nullable();
            $table->string('project_id')->nullable();
            $table->string('category_id')->nullable();
            $table->string('owner_id')->nullable();
            $table->string('assigned_to')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('source')->nullable();

            


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
