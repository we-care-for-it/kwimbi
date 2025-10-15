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
        Schema::table('objects', function (Blueprint $table) {
            $table->dropColumn([
                'speakconnection',
                'inspection_company_id',
                'maintenance_company_id',
                'inspection_state_id',
                'fire_elevator',
                'emergency_power',
                'stretcher_elevator',
                'stopping_places',
                'carrying_capacity',
                'energy_label',
                'current_inspection_end_date',
                'current_inspection_status_id',
                'monitoring_object_id',
                'brand_monitoring',
                'drive_type',
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    
};
