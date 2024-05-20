<?php

namespace App\Http\Livewire;
use App\Models\apiLog as model;
use Livewire\Component;

class ApiLog extends Component
{

   public $module;
    public function render()


    {
        
 
        return view('livewire.tenant.api-log',([
            'apilog' => model::where('api', $this->module)->get()
        ]));
    }
}
