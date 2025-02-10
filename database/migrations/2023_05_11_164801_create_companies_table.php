<?php

use App\Models\User;
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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
            $table->string('zipcode')->nullable();
            $table->string('place')->nullable();
            $table->string('address')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('phonenumber')->nullable();
            
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
        Schema::dropIfExists('companies');
    }
};
