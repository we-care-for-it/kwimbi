<?php

namespace App\Http\Livewire\Company\Suppliers;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Http;

class Show extends Component
{

    public $object = [];
    public $edit_id;
    public $data = [];

    public function render()
    {
        return view('livewire.company.suppliers.show');
    }

    public function mount(Request $request)
    {
        $this->object = Supplier::find($request->slug);    
    }

        
}
