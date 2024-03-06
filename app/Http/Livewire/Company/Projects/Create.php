<?php

namespace App\Http\Livewire\Company\Projects;

use Livewire\Component;
use App\Models\Project;
use App\Models\projectObject;
use App\Models\Customer;
use App\Models\Statuses;


class Create extends Component
{

    public $name;
    public $description;
    public $startdate;
    public $enddate;
    public $status_id;
    public $customer_id;
    public $contact_person_name;
    public $budget_hours; 
    public $budget_costs;

    public function render()
    {
        return view('livewire.company.projects.create',
    
        [
            'statuses' => Statuses::where('module_id',1)->get(),
            'debtors' => Customer::get(),
        ]
    
    );
    }

    public function save(){
        
    $data = Project::create([
       
            'name' => $this->name,
            'description' => $this->description,
            'startdate' => $this->startdate,
            
            'enddate' => $this->enddate,
            'status_id' => $this->status_id,
            'customer_id' => $this->customer_id,
            'contact_person_name' => $this->contact_person_name,
            'budget_hours' => $this->budget_hours,
            'budget_costs' => $this->budget_costs,
            
        ]
    );
 

  
 
    return redirect('/projects');
 
    pnotify()->addWarning('Gegevens opgeslagen');

    }
}
