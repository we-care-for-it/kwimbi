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
        Schema::create('sub_warehouses', function (Blueprint $table) {
          $table->id();
            $table->timestamps();
            $table->softDeletes(); 
          $table->integer('warehouse_id')->nullable();
            $table->string('name')->nullable();
            $table->boolean('is_active')->nullable()->default('1');
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
    
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_warehouses');
    }
};
