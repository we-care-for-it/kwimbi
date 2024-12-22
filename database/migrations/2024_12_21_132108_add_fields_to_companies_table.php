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
            $table->dropForeign(['companies_user_id_foreign']);
            $table->dropColumn('user_id');
            $table->string('zipcode')->nullable();
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('phonenumber')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('companies', function (Blueprint $table) {
            //
        });
    }
};
