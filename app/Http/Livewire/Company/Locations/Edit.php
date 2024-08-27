<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;


use App\Models\Location;
use App\Models\Customer;
use App\Models\managementCompany;
use Livewire\WithFileUploads;
use File;
use Illuminate\Support\Facades\Http;

use Illuminate\Http\Request;


class Edit extends Component
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


    use WithFileUploads;

 

    protected $rules = ['name' => 'required', ];
    
    public function mount($id)
    {
        $this->data = Location::findOrFail($id);
        $this->edit_id      = $id;
        $this->name         = $this->data->name;
        $this->zipcode        = $this->data->zipcode;
        $this->place  = $this->data->place;
        $this->address     = $this->data->address;
        $this->customer_id  = $this->data->customer_id;
        $this->image_db  = $this->data->image;
        $this->management_id  = $this->data->management_id;
        $this->remark  = $this->data->remark;
        $this->building_type_id  = $this->data->building_type_id;
        $this->building_access_type_id  = $this->data->building_access_type_id;

        $this->access_code  = $this->data->access_code;

        $this->gps_lat  = $this->data->gps_lat;
        $this->gps_lon  = $this->data->gps_lon;
        $this->construction_year  = $this->data->construction_year;
        $this->levels  = $this->data->levels;
        $this->surface  = $this->data->surface;
        $this->access_contact  = $this->data->access_contact;
        $this->location_key_lock  = $this->data->location_key_lock;
        $this->province  = $this->data->province;
        $this->municipality  = $this->data->municipality;
        $this->housenumber  = $this->data->housenumber;
        $this->building_type  = $this->data->building_type;
      
       

        
        

        

        
 
        
    }

    public function save()
    {

        
        $this->validate();
 
        try {
            $this->data->update($this->all());
        } catch (QueryException $e) {
            dd('Ioe fout');
        }
        

   

      

        if ($this->image  != $this->data->image_db ){
    
            $filename = $this->image->getClientOriginalName();
            $directory = "uploads/locations/" . $this->data->id;
            $this->image->storePubliclyAS($directory, $filename, "public");
    
            Location::where("id", $this->data->id)->update([
                "image" => $directory . "/" . $filename,
            ]);
        }
    

        pnotify()->addWarning('Gegevens opgeslagen');

        //image
      
      
 
         return redirect('/location/' .  $this->data->slug);
        
    }

    public function render()
    {
        return view('livewire.company.locations.edit',
        [
             'managementCompanies' => managementCompany::orderBy('name', 'asc')->get() ,
             
           ]);
    }


    public function clearImage()
    {

        
        Location::where("id", $this->data->id)->update([
            "image" => NULL,
        ]);
        

 

        if (File::exists(public_path($this->image))) {
             File::delete(public_path($this->image));
         }

 


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
                 pnotify()->addWarning('Geen gegevens gevonden met deze postcode en huisnummer');
             }
         }
     }

}
