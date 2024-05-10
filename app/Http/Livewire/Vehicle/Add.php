<?php

namespace App\Http\Livewire\Vehicle;

use Livewire\Component;
use App\Models\vehicle;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Livewire\WithFileUploads;


class Add extends Component
{

   
    protected $rules = [
        'kenteken' => 'required|min:6',
 
    ];
 

    public $kenteken = '';


    public $inrichting;
    public $voertuigsoort;
    public $merk;
    public $type;
    public $variant;
    public $handelsbenaming;
    public $eerste_kleur;
    public $uitvoering;
    public $catalogusprijs;
    public $bruto_bpm;

    public $aantal_zitplaatsen;
    public $aantal_rolstoelplaatsen;
    public $wielbasis;
    public $aantal_deuren;
    public $aantal_wielen;
    public $lengte;
    public $breedte;

    public $massa_ledig_voortuig;
    public $toegestane_maxium_massa_voortuig;
    public $maximum_massa_trekken_ongeremd;
    public $maximum_massa_trekken_geremd;
    public $technische_max_massa_voertuig;

 
    public $datum_tenaamstelling_dt;
    public $datum_eerste_toelating_dt;
    public $vervaldatum_apk_dt;

        //Afbeelding
        public $image_db;
        public $image;

        use WithFileUploads;

    public function render()
    {
        return view('livewire.vehicle.add');
    }


 


     
public function save(){
   

 
    $this->validate();
    $vehicle = vehicle::create($this->all());

 
     
    if ($this->image  != $this->image_db ){
    
        $filename = $this->image->getClientOriginalName();
        $directory = "uploads/vehicles/" . $vehicle->id;
        $this->image->storePubliclyAS($directory, $filename, "public");

        vehicle::where("id", $vehicle->id)->update([
            "image" => $directory . "/" . $filename,
        ]);
    }
 
    $this->reset();
 
    return redirect('/vehicles');


    noty()
    ->layout('bottomRight')
    ->addInfo('Gegevens opgeslagen');

}
public function getDataFromRDW()
{
   
    if($this->kenteken){

        $this->kenteken = strtoupper($this->kenteken);
     
    $url = "https://opendata.rdw.nl/resource/m9d7-ebf2.json?kenteken=" . $this->kenteken;

 
    $json = file_get_contents($url);
    $json = json_decode($json);

    

   if(!empty($json)){
    $json_data = $json[0];

   $this->inrichting =  $json_data->inrichting;
   $this->voertuigsoort =  $json_data->voertuigsoort;
   $this->merk =  $json_data->merk;
   $this->type =  $json_data->type;
   $this->variant =  $json_data->variant;
   $this->handelsbenaming =  $json_data->handelsbenaming;
   $this->eerste_kleur =  $json_data->eerste_kleur;
   $this->uitvoering =  $json_data->uitvoering;
   $this->voertuigsoort = $json_data->voertuigsoort;
 
   //Fiscaal
   $this->catalogusprijs =  $json_data->catalogusprijs;
   $this->bruto_bpm = $json_data->bruto_bpm;
  
    //Eigenschappen
    $this->aantal_zitplaatsen = $json_data->aantal_zitplaatsen;
    $this->aantal_rolstoelplaatsen = $json_data->aantal_rolstoelplaatsen;
    $this->wielbasis = $json_data->wielbasis;
    $this->aantal_deuren = $json_data->aantal_deuren;
    $this->aantal_wielen = $json_data->aantal_wielen;
    $this->lengte = $json_data->lengte;
    $this->breedte = $json_data->breedte;
 
    $this->massa_ledig_voortuig = $json_data->massa_ledig_voertuig;
     $this->maximum_massa_trekken_geremd = $json_data->maximum_massa_trekken_geremd ?? null;
    $this->maximum_massa_trekken_ongeremd = $json_data->maximum_massa_trekken_ongeremd ?? null;
    $this->technische_max_massa_voertuig = $json_data->technische_max_massa_voertuig ?? null;

    ///Datums

    $this->datum_tenaamstelling_dt = Carbon::parse($json_data->datum_tenaamstelling_dt)->format('Y-m-d');
    $this->datum_eerste_toelating_dt = Carbon::parse($json_data->datum_eerste_toelating_dt)->format('Y-m-d');
    $this->vervaldatum_apk_dt = Carbon::parse($json_data->vervaldatum_apk_dt)->format('Y-m-d');
 


   }else{

    noty()
    ->layout('bottomRight')
    ->addError('Geen gegevens gevonden met kenteken: ' . $this->kenteken . ' controleer het kenteken! ');
   }

}else{
    noty()
    ->layout('bottomRight')
    ->addError('Geen juist kenteken ingevuld');
}

}


}