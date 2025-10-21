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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('private_email')->nullable();
            $table->string('private_phone')->nullable();
            $table->string('private_street')->nullable();
            $table->string('private_house_number')->nullable();
            $table->string('private_house_number_addition')->nullable();
            $table->string('private_postal_code')->nullable();
            $table->string('private_city')->nullable();
            $table->string('private_country')->nullable();

            $table->integer('customer_id')->nullable();
            $table->string('theme')->nullable()->default('default');
            $table->string('theme_color')->nullable();
            $table->json('custom_fields')->nullable();
            $table->string(config('filament-edit-profile.avatar_column', 'avatar_url'))->nullable();

            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
