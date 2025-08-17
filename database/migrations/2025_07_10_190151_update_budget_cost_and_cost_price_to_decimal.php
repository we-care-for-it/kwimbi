<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;


return new class extends Migration
{
    /**
     * Run the migrations.
     */
   
public function up(): void
{
    Schema::table('projects', function (Blueprint $table) {
        // You can keep this if `budget_costs` works fine
        $table->decimal('budget_costs', 10, 2)->nullable()->change();
    });

    // Use raw SQL for cost_price
    DB::statement('
        ALTER TABLE projects
        ALTER COLUMN cost_price TYPE numeric(10,2) USING cost_price::numeric(10,2),
        ALTER COLUMN cost_price DROP NOT NULL,
        ALTER COLUMN cost_price DROP DEFAULT,
        ALTER COLUMN cost_price DROP IDENTITY IF EXISTS
    ');
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->decimal('budget_costs', 10, 2)->nullable(false)->change();
            $table->decimal('cost_price', 10, 2)->nullable(false)->change();
        });
    }
};
