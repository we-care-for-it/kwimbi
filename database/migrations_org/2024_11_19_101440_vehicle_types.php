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
        Schema::create('vehicle_types', function (Blueprint $table) {
            $table->softDeletes();
            $table->longtext('name')->nullable();
            $table->boolean('is_active');
            $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
   
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
