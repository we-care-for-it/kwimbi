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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('external_id')->nullable();
            $table->string('customer_id')->nullable();
            $table->string('date')->nullable();
            $table->string('term_of_payment')->nullable();
            $table->integer('price_ex')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('price_inc')->nullable();
            $table->integer('total_open')->nullable();
            $table->longtext('pdf_file')->nullable();
            $table->longtext('articles')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
