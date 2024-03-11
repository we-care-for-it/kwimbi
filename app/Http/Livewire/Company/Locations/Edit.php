<?php

namespace App\Http\Livewire\Company\Locations;

use Livewire\Component;


use App\Models\Location;
use App\Models\Customer;

class Edit extends Component
{


    public $data;

        
    public $name;
 
    public $address;
    public $zipcode;
    public $place;
   
    public $edit_id;
    public $customer;


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
    }

    public function save()
    {

        $this->validate();

        $this->data->update($this->all());

        pnotify()->addWarning('Gegevens opgeslagen');

        $customer = Customer::where('id', $this->data->customer_id)->first();
        return redirect('/customer/' . $customer->slug);
        
    }

    public function render()
    {
        return view('livewire.company.locations.edit');
    }
}
