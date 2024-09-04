<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add new columns for first name, infix, and last name
        Schema::table('users', function (Blueprint $table) {
            $table->string('first_name')->nullable()->after('id');
            $table->string('infix')->nullable()->after('first_name');
            $table->string('last_name')->nullable()->after('infix');
        });

        // Split the existing 'name' field into first_name and last_name
        DB::table('users')->get()->each(function ($user) {
            $nameParts = explode(' ', $user->name);

            $firstName = $nameParts[0] ?? null;
            $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : null;

            DB::table('users')->where('id', $user->id)->update([
                'first_name' => $firstName,
                'last_name' => $lastName,
            ]);
        });

        // Drop the old 'name' column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        // Add a virtual 'name' column concatenating first name, infix, and last name
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->virtualAs('CONCAT_WS(" ", first_name, infix, last_name)')->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove the virtual 'name' column
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('name');
        });

        // Re-add the original 'name' column
        Schema::table('users', function (Blueprint $table) {
            $table->string('name')->nullable()->after('id');
        });

        // Combine first_name, infix, and last_name back into the 'name' column
        DB::table('users')->get()->each(function ($user) {
            $name = collect([$user->first_name, $user->infix, $user->last_name])->filter()->implode(' ');

            DB::table('users')->where('id', $user->id)->update([
                'name' => $name,
            ]);
        });

        // Drop the individual name columns
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'infix', 'last_name']);
        });
    }
};
