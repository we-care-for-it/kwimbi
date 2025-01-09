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
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('api_uuid')->nullable();
            $table->string('api_url')->nullable();
            $table->string('source')->nullable();
            $table->string('bic')->nullable();
            $table->string('iban')->nullable();
            $table->string('language')->nullable();
            $table->string('country')->nullable();
            $table->boolean('is_active')->nullable()->default('1');
        });
    }
};
