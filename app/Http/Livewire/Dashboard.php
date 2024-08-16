<?php

namespace App\Http\Livewire;

use Livewire\Component;

use App\Models\Address;
use App\Models\Document;
use App\Models\Elevator;
use App\Models\Customer;
use App\Models\Inspection;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Incident;

use DB;

class Dashboard extends Component
{
    public $cnt_managment_elevators;
    public $cnt_all_elevators;

    public $elevator_open_incidents = [];
    public $elevator_standing_still = [];
    public $elevator_expired_inspections = [];
    public $elevator_rejected_inspections = [];

    public $elevators = [];


    public function render()
    {

        $this->elevator_open_incidents = Incident::where('status_id', '!=', '99') ->where('status_id', '!=', '6')->orderby('report_date_time', 'desc')->get();
        $this->elevator_standing_still = Incident::where('status_id', '!=', '99') ->where('status_id', '!=', '6')->where('stand_still', 1)->orderby('report_date_time', 'desc')->get();
  
        $this->elevator_expired_inspections = Elevator::where('inspection_status_id',3)->get();


         

        $this->elevator_rejected_inspections = Incident::get();

        return view('livewire.dashboard');
    }


    public function mount()
    {

        $this->elevators = Elevator::whereNULL('archive')->count();
        $this->cnt_all_elevators         =  Elevator::whereNULL('archive')->count();
        $this->cnt_managment_elevators   =  Elevator::where('management_elevator', 1)->count();
    }
}





// return
