<?php

namespace App\Http\Livewire\Company\Elevators\Inspections;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Elevator;
class Create extends Component
{
    public function render(Request $request)
    {

        $elevator = Elevator::where('id', $request->elevator_id)->first();
        return view('livewire.company.elevators.inspections.create',[
            'elevator_data' =>  $elevator
        ]);
    }
}
