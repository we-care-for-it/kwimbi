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
        Schema::create('work_types', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
        $table->longtext('name')->nullable();
        $table->time('default_minutes')->nullable();

        $table->longtext('description')->nullable();
        $table->boolean('is_active')->nullable();

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
