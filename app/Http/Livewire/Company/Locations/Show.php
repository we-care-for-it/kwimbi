<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Location;
use App\Models\managementCompany;

class Show extends Component
{

    public $location;
  




    public function render()
    {
        return view('livewire.company.locations.show',
        [
            'managementCompanies' => managementCompany::orderBy('name', 'asc')->get() ,
            
          ]);
    }

    public function mount(Request $request)
    {
        $this->location = Location::findBySlug($request->slug);
        


    }

    protected $rules = ['name' => 'required', ];
    
     //Postcode check
     public function checkZipcode()
     {
         $this->zipcode = strtoupper(trim(preg_replace("/\s+/", "", $this->zipcode)));
         if (strlen($this->zipcode) == 6) {
             $response = Http::get('https://api.pro6pp.nl/v1/autocomplete?auth_key=okw7jAaDun87tKnD&nl_sixpp=' . $this->zipcode);
             $data = $response->json();
 
             if ($data['results']) {
                 $this->place = $data['results'][0]['city'];
                 $this->address = $data['results'][0]['street'];
             } else {
                 $this->place = "";
                 $this->address = "";
                 pnotify()->addWarning('Geen gegevens gevonden met deze postcode');
             }
         }
        }
}
