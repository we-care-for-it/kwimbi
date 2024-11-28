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
        Schema::create('object_features', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            $table->integer('feature_id')->nullable();
            $table->integer('object_id')->nullable();
            $table->longtext('remark')->nullable();
            $table->string('is_active')->nullable();
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('object_features');
    }
};
