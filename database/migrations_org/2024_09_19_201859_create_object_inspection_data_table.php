<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Company;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('object_inspection_data', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes();
            $table->integer('inspection_id')->nullable();
            $table->string('zin_code')->nullable();
            $table->longtext('comment')->nullable();
            $table->string('type')->nullable();
            $table->string('status')->nullable();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_inspection_data');
    }
};
