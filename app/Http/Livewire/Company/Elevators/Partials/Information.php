<?php

namespace App\Http\Livewire\Company\Elevators\Partials;

use Livewire\Component;

class Information extends Component
{

    public $elevator;
    public function render()
    {
        return view('livewire.company.elevators.partials.information');
    }
}
