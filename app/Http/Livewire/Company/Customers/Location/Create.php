<?php

namespace App\Http\Livewire\Company\Customers\Location;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Location;
use Illuminate\Support\Facades\Http;
use Livewire\WithFileUploads;
use App\Models\managementCompany;

class Create extends Component



{

    
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



    public $customer_id;

    use WithFileUploads;

    public function render()
    {
        return view('livewire.company.customers.location.create',
        [
             'managementCompanies' => managementCompany::orderBy('name', 'asc')->get() ,
             
           ]);
        
    }

    public function clearImage()
    {
        $this->image = null;
    }


    public function mount(Request $request)
    {
        $this->customer = Customer::where('id', $request->customer_id)
            ->first();;
    }

    protected $rules = ['name' => 'required', ];

    
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



    pnotify()
        ->addWarning('Gegevens opgeslagen');
    return redirect('/customer/' . $this
        ->customer
        ->slug);
    $this->reset();

       
     
        $this->dispatch('close-crud-modal');
        $this->clear();
     
            
        pnotify()->addWarning('Gegevens opgeslagen');
    
    }


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
