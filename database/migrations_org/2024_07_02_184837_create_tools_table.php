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
        Schema::create('tools', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->softDeletes(); 
            $table->string('name')->nullable();
            $table->string('serial_number')->nullable();

            

            $table->integer('category_id')->nullable();
            $table->integer('type_id')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('inspection_company_id')->nullable();
            $table->integer('inspection_method')->nullable();
            $table->boolean('is_active')->nullable();
            $table->longtext('description')->nullable();
            $table->longtext('minutiue')->nullable();
            $table->longtext('employee_id')->nullable();
            $table->longtext('image')->nullable();
            $table->integer('warehouse_id')->nullable();

            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tools');
    }
};
