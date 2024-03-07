<?php

namespace App\Http\Livewire\Company\Customers\Location;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Customer;

class Create extends Component



{


    public $customer_id;


    public function render()
    {
        return view('livewire.company.customers.location.create');
        
    }

    public function mount(Request $request)
    {
        $this->customer_id = $request->elevator_id;
    }

}
