<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;


use App\Models\Location;
use App\Models\Customer;
use App\Models\managementCompany;
use Livewire\WithFileUploads;
use File;
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
 
        
    }

    public function save()
    {

        
        $this->validate();

        $this->data->update($this->all());

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


}
