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
        Schema::table('relations', function (Blueprint $table) {
            $table->string('post_address')->nullable();
            $table->string('post_zipcode')->nullable();
            $table->string('post_place')->nullable();
            $table->string('post_address')->nullable();
            $table->string('website')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('contacts', function (Blueprint $table) {
            $table->dropColumn([
                'instagram',
                'twitter',
                'facebook',
                'intern_number',
                'street',
                'city',
                'postal_code',
                'country',
                'image',
            ]);
        });
    }
};
