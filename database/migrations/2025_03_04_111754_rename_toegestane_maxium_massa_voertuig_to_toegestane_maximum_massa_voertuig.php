<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameToegestaneMaxiumMassaVoertuigToToegestaneMaximumMassaVoertuig extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Rename the column
            $table->renameColumn('toegestane_maxium_massa_voertuig', 'toegestane_maximum_massa_voertuig');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('vehicles', function (Blueprint $table) {
            // Reverse the column name change
            $table->renameColumn('toegestane_maximum_massa_voertuig', 'toegestane_maxium_massa_voertuig');
        });
    }
}