<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;


use App\Models\Location;
use App\Models\Customer;
use App\Models\managementCompany;
use Livewire\WithFileUploads;
use File;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Http\Request;


class Add extends Component
{


    public $name;
    public $address;
    public $zipcode;
    public $place;
    public $image;
    public $building_type_id;
    public $management_id;
    public $remark;
    public $complexnumber;
    public $access_code;
    public $gps_lat;
    public $gps_lon;
    public $construction_year;
    public $levels;
    public $surface;
    public $access_contact;
    public $location_key_lock;
    public $province;
    public $municipality;
    public $housenumber;
    public $building_type;
    public $building_access_type_id;



    use WithFileUploads;



    protected $rules = [
      'place' => 'required',
    'address' => 'required',
  'zipcode' => 'required'
 ];


    public function save(Request $request)
    {


        $this->validate();
        $location =  Location::create(
           $this->all()
         );
        if ($this->image){

            $filename = $this->image->getClientOriginalName();
            $directory = "uploads/locations/" .$lastInsertId;
            $this->image->storePubliclyAS($directory, $filename, "public");

            Location::where("id", $last_id)->update([
                "image" => $directory . "/" . $filename,
            ]);
        }


        $this->redirect('/location/'.$location->slug);
        notyf()->success('Gegevens opgeslagen');


    }

    public function render()
    {
        return view('livewire.company.locations.add',
        [
             'managementCompanies' => managementCompany::orderBy('name', 'asc')->get() ,

           ]);
    }


    public function clearImage()
    {





        $this->image = null;
        $this->image_db = null;



    }

     //Postcode check
     public function checkZipcode()
     {
         $this->zipcode = strtoupper(trim(preg_replace("/\s+/", "", $this->zipcode)));
         if (strlen($this->zipcode) == 6) {


             $response = Http::get('https://api.pro6pp.nl/v2/autocomplete/nl?authKey=dn2KXXsW2K1jzzgx&postalCode=' . $this->zipcode.'&streetNumberAndPremise=' . $this->housenumber.'');

             //https://api.pro6pp.nl/v2/autocomplete/nl?authKey=dn2KXXsW2K1jzzgx&postalCode=
             $data = $response->json();





             if (!isset($data['error_id'])) {
                 $this->place = $data['settlement'];
                 $this->address = $data['street'];
                 $this->municipality = $data['municipality'];
                 $this->gps_lon = $data['lng'];
                 $this->gps_lat = $data['lat'];
                 $this->province = $data['province'];
                 $this->construction_year = $data['constructionYear'];
                 $this->surface = $data['surfaceArea'];
                 $this->building_type = ucfirst($data['purposes'][0]);



             } else {
                 $this->place = "";
                 $this->address = "";
                 notyf()->warning('Geen gegevens gevonden met deze postcode en huisnummer');

             }
         }
     }

}
