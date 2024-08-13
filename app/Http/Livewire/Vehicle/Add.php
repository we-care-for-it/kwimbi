<?php

namespace App\Http\Livewire\Vehicle;

use Livewire\Component;
use App\Models\vehicle;
use Illuminate\Support\Facades\File;

 
class Add extends Component
{


    #[Validate('required', message: 'Vul minimaal een kenteken in')]
    public $kenteken;
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

    public function render()
    {
        return view('livewire.vehicle.add');
    }

     
public function save(){
   
 
    vehicle::create($this->all());
     
 
    $this->reset();
 
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