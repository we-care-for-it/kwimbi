<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateApiLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('api_logs', function (Blueprint $table) {
            $table->integer('status_code')->nullable();
            $table->longText('payload_raw')->nullable();
            $table->longText('response')->nullable();
            $table->longText('response_headers')->nullable();
            $table->text('headers')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }
}
