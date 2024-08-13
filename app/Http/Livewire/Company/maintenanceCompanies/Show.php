<?php

namespace App\Http\Livewire\Company\maintenanceCompanies;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\maintenanceCompany;
use Illuminate\Support\Facades\Http;

class Show extends Component
{

    public $object = [];
    public $edit_id;
    public $data = [];

    public function render()
    {
        return view('livewire.company.maintenanceCompanies.show');
    }

    public function mount(Request $request)
    {
 
        

        $this->object = maintenanceCompany::where('id',$request->id)->first();   


    }

        
}
