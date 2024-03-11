<?php

namespace App\Http\Livewire\Company\Elevators\Incidents;

use Livewire\Component;
use Illuminate\Http\Request;

use App\Models\Elevator;
use App\Models\Incident;
class Create extends Component
{

    
    public $elevator;


    public function render()
    {
        return view('livewire.company.elevators.incidents.create');
    }

    public function mount(Request $request){
        $this->elevator = Elevator::where('id', $request->elevator_id)->first();
    }


}
