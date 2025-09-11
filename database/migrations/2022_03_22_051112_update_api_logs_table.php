<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class UpdateApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Step 0: Add new columns first
        Schema::table('api_logs', function (Blueprint $table) {
            $table->longText('payload_raw')->nullable()->after('payload');
            $table->longText('response_headers')->after('response');
            $table->text('headers')->nullable()->after('response');
        });

        // Step 1: Safely convert status_code to integer
        // Non-numeric values will become NULL
        DB::statement("
            ALTER TABLE api_logs
            ALTER COLUMN status_code TYPE integer
            USING CASE 
                WHEN status_code ~ '^[0-9]+$' THEN status_code::integer
                ELSE NULL
            END
        ");

        // Step 2: Ensure the column is nullable in Laravel schema
        Schema::table('api_logs', function (Blueprint $table) {
            $table->integer('status_code')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('api_logs', function (Blueprint $table) {
            $table->dropColumn('response');
            $table->dropColumn('response_headers');
            $table->dropColumn('payload_raw');
            $table->dropColumn('headers');
        });

        // Revert status_code to text safely
        DB::statement('ALTER TABLE api_logs ALTER COLUMN status_code TYPE text USING status_code::text');
    }
}