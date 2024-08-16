<?php

namespace App\Http\Livewire;
use App\Models\Inspection;
use Livewire\Component;

class ApiLogbook extends Component
{
    public function render()
    {

        return view('livewire.api-logbook',[
            'inspections' =>Inspection::where('if_match',1)->get(),
            ]);

 
    }
}
