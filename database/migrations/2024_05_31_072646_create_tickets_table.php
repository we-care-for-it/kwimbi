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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->longText('title');
            $table->longText('description');

            $table->integer('added_by_user_id')->nullable();
            $table->dateTime('last_reply_datetime')->nullable();
            $table->integer('last_reply_user_id')->nullable();

            $table->integer('related_object_id')->nullable();
            $table->integer('related_project_id')->nullable();
            $table->integer('related_location_id')->nullable();
            $table->integer('related_customer_id')->nullable();
            $table->integer('related_incident_id')->nullable();
            $table->integer('related_quotation_id')->nullable();
            $table->integer('related_parent_ticket_id')->nullable();
            $table->integer('related_inspection_id')->nullable();

            $table->integer('status_id')->nullable();
            $table->integer('progress_procent')->nullable(); 
        
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
