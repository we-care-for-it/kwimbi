<?php

namespace App\Http\Livewire\Company\Addresses;

use Livewire\Component;
//Models
use App\Models\Address;


class Show extends Component
{

    public $address;

    public function render()
    {
        return view('livewire.company.addresses.show');
    }



    public function mount($slug)
    {
       $this->address =  Address::findBySlug($slug);
 
    }


}
