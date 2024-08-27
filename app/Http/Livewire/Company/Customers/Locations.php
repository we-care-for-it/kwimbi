<?php

namespace App\Http\Livewire\Company\Customers;

use Livewire\Component;
 
use App\Models\Location;
use App\Models\managementCompany;

//Datatable
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
 


class Locations extends Component
{

    use WithPerPagePagination;
    use WithSorting;
    use WithBulkActions;
    use WithCachedRows;

    public $sortField = 'id';
    public $sortDirection = 'desc';
    public $keyword;
    public $locations = [];
    public $management_companies = [];
   
    public $debtor_id;
    public $name;
    public $phonenumber;
    public $address;
    public $zipcode;
    public $place;
    public $emailaddress;
    public $edit_id;
    public $customer;


    public $filters = [
        'keyword'   => '',     
    ];

    public function render()
    {
 
        return view('livewire.company.customers.locations',
    ['management_companies' => managementCompany::get(),
    'TEST' => "TEST"]);
    }

    public function mount(){
  
        $this->locations =  Location::query()->where('customer_id',$this->debtor_id)->get();
    }

    public function clear(){

    }

    public function save(){

        $data = Location::updateOrCreate(
            [
                'id' =>$this->edit_id
            ],
            [
                'customer_id' => $this->debtor_id,
                'name' => $this->name,
                'place' => $this->place,
                'zipcode' => $this->zipcode,
                'name' => $this->name,
                'address' => $this->address,
                'emailaddress' => $this->emailaddress,
                'phonenumber' => $this->phonenumber, 
            ]
        );
 
        

        $this->locations =  Location::query()->where('customer_id',$this->debtor_id)->get();
        $this->clear();
        $this->dispatch('close-crud-modal');
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
