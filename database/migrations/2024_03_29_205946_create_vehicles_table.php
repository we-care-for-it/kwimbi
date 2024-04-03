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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->softDeletes();
            $table->timestamps();
            $table->string('kenteken')->nullable();
            $table->string('voertuigsoort')->nullable();
            $table->string('merk')->nullable();
            $table->string('handelsbenaming')->nullable();
            $table->string('vervaldatum_apk')->nullable();
            $table->string('datum_tenaamstelling')->nullable();
            $table->string('bruto_bpm')->nullable();
            $table->string('inrichting')->nullable();
            $table->string('aantal_zitplaatsen')->nullable();
            $table->string('eerste_kleur')->nullable();
            $table->string('tweede_kleur')->nullable();
            $table->string('aantal_cilinders')->nullable();
            $table->string('cilinderinhoud')->nullable();
            $table->string('massa_ledig_voortuig')->nullable();
            $table->string('toegestane_maxium_massa_voortuig')->nullable();
            $table->string('maximum_massa_trekken_ongeremd')->nullable();
            $table->string('maximum_massa_trekken_geremd')->nullable();
            $table->string('datum_eerste_toelating')->nullable();
            $table->string('datum_eerste_tenaamstelling_in_nederland')->nullable();
            $table->string('wacht_op_keuren')->nullable();
            $table->string('catalogusprijs')->nullable();
            $table->string('wam_verzekerd')->nullable();
            $table->string('aantal_deuren')->nullable();
            $table->string('aantal_wielen')->nullable();
            $table->string('technische_max_massa_voertuig')->nullable();
            $table->string('type')->nullable();
            $table->string('breedte')->nullable();
            $table->string('lengte')->nullable();            
            $table->string('typegoedkeuringsnummer')->nullable();
            $table->string('variant')->nullable();
            $table->string('uitvoering')->nullable();
            $table->string('wielbasis')->nullable();
            $table->string('openstaande_terugroepactie_indicator')->nullable();
            $table->string('maximum_ondersteunende_snelheid')->nullable();
            $table->string('jaar_laatste_registratie_tellerstand')->nullable();
            $table->string('tellerstandoordeel')->nullable();
            $table->string('tenaamstelling_mogelijk')->nullable();
            $table->dateTime('vervaldatum_apk_dt')->nullable();
            $table->dateTime('datum_tenaamstelling_dt')->nullable();
            $table->dateTime('datum_eerste_toelating_dt')->nullable();
            $table->string('zuinigheidclassificatie')->nullable();
            $table->string('image')->nullable();
            $table->integer('employee_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
