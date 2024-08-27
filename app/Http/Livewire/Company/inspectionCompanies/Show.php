<?php

namespace App\Http\Livewire\Company\inspectionCompanies;
use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\inspectionCompany;
use Illuminate\Support\Facades\Http;

class Show extends Component
{

    public $object = [];
    public $edit_id;
    public $data = [];

    public function render()
    {
        return view('livewire.company.inspectionCompanies.show');
    }

    public function mount(Request $request)
    {
         $this->object = inspectionCompany::where('id',$request->id)->first();
     }

        
}
