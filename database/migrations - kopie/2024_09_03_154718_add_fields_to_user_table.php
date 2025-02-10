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
        Schema::table('users', function (Blueprint $table) {
            $table->date('date_of_birth')->nullable()->after('password');
            $table->string('private_email')->nullable()->after('date_of_birth');
            $table->string('private_phone')->nullable()->after('private_email');
            $table->string('private_street')->nullable()->after('private_phone');
            $table->string('private_house_number')->nullable()->after('private_street');
            $table->string('private_house_number_addition')->nullable()->after('private_house_number');
            $table->string('private_postal_code')->nullable()->after('private_house_number_addition');
            $table->string('private_city')->nullable()->after('private_postal_code');
            $table->string('private_country')->nullable()->after('private_city');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('date_of_birth');
            $table->dropColumn('private_email');
            $table->dropColumn('private_phone');
            $table->dropColumn('private_street');
            $table->dropColumn('private_house_number');
            $table->dropColumn('private_house_number_addition');
            $table->dropColumn('private_postal_code');
            $table->dropColumn('private_city');
            $table->dropColumn('private_country');
        });
    }
};
