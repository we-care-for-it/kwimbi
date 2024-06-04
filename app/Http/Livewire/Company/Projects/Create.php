<?php

namespace App\Http\Livewire\Company\Projects;

use Livewire\Component;

//Inlcude models
    use App\Models\Project;
    use App\Models\projectObject;
    use App\Models\Customer;
    use App\Models\Statuses;


use Illuminate\Http\Request;

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
    public $progress;

    public function render()
    {

        $this->status_id = 1;
        return view('livewire.company.projects.create',
    
        [
            'statuses'  => Statuses::where('module_id',1)->get(),
            'debtors'   => Customer::get(),
        ]
    
    );
    }

    public function save(){
        $validatedData = $this->validate(
            [
                "name" => "required", 
           
    ], [
        "name.required" => "Naam is een verplicht veld", 
    ]
);



    $data = Project::create($this->all());
 
    noty()
    ->layout('bottomRight')
    ->addInfo('Project'. $Request->input('name') . ' toegevoegd');

    return redirect('/projects');
}

}
