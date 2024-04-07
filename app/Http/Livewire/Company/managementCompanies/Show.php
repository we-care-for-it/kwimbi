<?php

namespace App\Http\Livewire\Company\managementCompanies;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\managementCompany;
use Illuminate\Support\Facades\Http;

class Show extends Component
{

    public $object = [];
    public $edit_id;
    public $data = [];

    public function render()
    {
        return view('livewire.company.managementCompanies.show');
    }

    public function mount(Request $request)
    {
        $this->object = managementCompany::find($request->id);    
    }

        
}
