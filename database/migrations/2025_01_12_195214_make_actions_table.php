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
        Schema::create('actions', function (Blueprint $table) {
            $table->id();
            $table->integer('for_user_id')->nullable();
            $table->integer('create_by_user_id')->nullable();
            $table->longtext('title')->nullable();
            $table->longtext('body')->nullable();
            $table->integer('priority')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('for_company_id')->nullable();
            $table->integer('status_id')->default(1)->nullable();
            $table->integer('type_id')->default(3)->nullable();
            $table->integer('relation_id')->nullable();
            $table->string('model')->nullable();
            $table->date('plan_date')->nullable();
            $table->time('plan_time')->nullable();
            $table->integer('private')->nullable();
            $table->time('private_action')->nullable();
            $table->foreignId('company_id')->nullable()->constrained('companies');

            $table->softDeletes();
            $table->timestamps();
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
