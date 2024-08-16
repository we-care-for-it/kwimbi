<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use OwenIt\Auditing\Contracts\Auditable;

use Carbon\Carbon;
 
class vehicle extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;
    use HasSlug;

 
    protected $fillable = [
        'wielbasis',
        'aantal_deuren',
        'aantal_wielen',
        'lengte','breedte',
        'kenteken',
        'inrichting',
        'voertuigsoort',
        'merk',
        'type',
        'variant',
        'handelsbenaming',
        'eerste_kleur',
        'uitvoering',
        'catalogusprijs',
        'bruto_bpm',
        'aantal_zitplaatsen',
        'aantal_rolstoelplaatsen',
        'vervaldatum_apk',
        'datum_tenaamstelling',
        'aantal_cilinders',
        'cilinderinhoud',
        'massa_ledig_voortuig',
        'toegestane_maxium_massa_voortuig',
        'maximum_massa_trekken_ongeremd',
        'maximum_massa_trekken_geremd',
        'technische_max_massa_voertuig',
        'datum_eerste_toelating',
        'datum_eerste_tenaamstelling_in_nederland',
        'wacht_op_keuren', 
        'typegoedkeuringsnummer',
        'openstaande_terugroepactie_indicator',
        'maximum_ondersteunende_snelheid',
        'jaar_laatste_registratie_tellerstand',
        'zuinigheidclassificatie',
        'datum_tenaamstelling_dt',
        'datum_eerste_toelating_dt',
        'vervaldatum_apk_dt',
      
    ];

     
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
        ->generateSlugsFrom('kenteken')
            ->saveSlugsTo('slug');
    }
 

    // protected $fillable = [
   //     'last_action_at',
    // /    'code',
   //     'location_id',
    // ];

    ///protected $appends = ['location_name'];
}
