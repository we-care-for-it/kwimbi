<?php

namespace App\Http\Livewire\Company\Customers\Project;

use Livewire\Component;
use Illuminate\Http\Request;

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
    public $progress;
    public $customer;

    protected $rules = ['name' => 'required', ];

    public function render()


    {
        $this->status_id = 1;


        return view('livewire.company.customers.project.create',
        [
            'statuses' => Statuses::where('module_id',1)->get(),
            'debtors' => Customer::get(),
        ]);
    }

    
    public function mount(Request $request)
    {
        $this->customer = Customer::where('id', $request->customer_id)
            ->first();;
    }
    public function save(){

        $this->validate();
        $data = Project::create([
       
            'name' => $this->name,
            'description' => $this->description,
            'startdate' => $this->startdate,
            'progress' => $this->progress,
            
            'enddate' => $this->enddate,
            'status_id' => $this->status_id,
            'customer_id' => $this->customer_id,
            'contact_person_name' => $this->contact_person_name,
            'budget_hours' => $this->budget_hours,
            'budget_costs' => $this->budget_costs,
            
        ]
    );
 

    pnotify()
            ->addWarning('Gegevens opgeslagen');
        return redirect('/customer/' . $this
            ->customer
            ->slug);
        $this->reset();

    }

 


}
