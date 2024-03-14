<?php

namespace App\Http\Livewire\Company\Projects;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\projectObject;
use App\Models\Customer;
use App\Models\Statuses;


class Edit extends Component
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

    public $project;
    public $data;
    protected $rules = ['name' => 'required', ];


    public function render()
    {
        return view('livewire.company.projects.edit',  [
            'statuses' => Statuses::where('module_id',1)->get(),
            'debtors' => Customer::get(),
        ]);
    }


    public function mount($id)
    {
   
        $this->data = Project::findOrFail($id);
        $this->edit_id      = $id;
        $this->name      = $this->data->name;
        $this->enddate      = $this->data->enddate;
        $this->startdate      = $this->data->startdate;
        $this->description      = $this->data->description;
        $this->status_id      = $this->data->status_id;
        $this->customer_id      = $this->data->customer_id;
        $this->contact_person_name      = $this->data->contact_person_name;
        $this->budget_hours      = $this->data->budget_hours;
        $this->budget_costs      = $this->data->budget_costs;
        $this->progress      = $this->data->progress;
    }

    public function save()
    {

        
        $this->validate();
 
        try {
            $this->data->update($this->all());
            return redirect('/project/' .  $this->data->slug);
        } catch (QueryException $e) {
           // dd('Ioe fout');
        }
        
    }


}
