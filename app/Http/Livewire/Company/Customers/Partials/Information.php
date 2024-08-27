<?php

namespace App\Http\Livewire\Company\Customers\Partials;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Customer;

class Information extends Component
{

    public $customer;
    public function render()
    {
        return view('livewire.company.customers.partials.information');
    }

    public function mount(Request $request)
    {
 
        $this->customer = Customer::where('id', $request->customer_id)->first();;
    }


}
