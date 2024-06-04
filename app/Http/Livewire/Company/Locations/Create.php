<?php

namespace App\Http\Livewire\Company\Locations;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Location;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use App\Models\managementCompany;





use App\Models\Project;
use App\Models\projectObject;
 
use App\Models\Statuses;

class Create extends Component



{

    
 
    public $data;

    public $name;
    public $phonenumber;
    public $address;
    public $zipcode;
    public $place;
    public $emailaddress;
    public $edit_id;
    public $customer;
    public $image;
    public $building_type_id;
    public $management_id;
    public $remark;
    public $complexnumber;
    public $image_db;

    public $building_access_type;
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



    public $customer_id;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.company.locations.create',
        [
             'managementCompanies' => managementCompany::orderBy('name', 'asc')->get() ,
             'customers' => Customer::orderBy('name', 'asc')->get() ,
            
           ]);
        
    }

    public function clearImage()
    {
        $this->image = null;
    }



    protected $rules = ['zipcode' => 'required','customer_id' => 'required' ];

    
public function save(){
   
    $this->validate();

   $location =  Location::create($this->all());
 

    if ($this->image) {
        $filename = $this->image->getClientOriginalName();
        $directory = "uploads/locations/" . $location->id;

        $this->image->storePubliclyAS($directory, $filename, "public");

        Location::where("id", $location->id)->update([
            "image" => $directory . "/" . $filename,
        ]);
    }


 
        noty()
        ->layout('bottomRight')
        ->addInfo('Locatie toegevoegd');
    
        return redirect('/locations');
    $this->reset();

       

        $this->clear();
     
          
    
    }


     //Postcode check
     public function checkZipcode()
     {

        $this->housenumber = str_replace(" ", "", $this->housenumber);
        $this->zipcode = str_replace(" ", "", $this->zipcode);
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
                 pnotify()->addWarning('Geen gegevens gevonden met deze postcode en huisnummer');
             }
            }}

     

}
