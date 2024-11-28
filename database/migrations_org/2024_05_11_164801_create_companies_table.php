<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\EntityType;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
              $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('company_registration')->nullable();
            $table->string('company_kra_pin')->nullable();
            $table->longText('address')->nullable();
            $table->enum('entity_type', EntityType::values())->nullable()->default(EntityType::DEFAULT);


            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
