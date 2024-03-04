<?php

namespace App\Http\Livewire\Company\Elevators;

use Livewire\WithFileUploads;
use Livewire\Component;
use Illuminate\Http\Response;
use App\Models\Elevator;
use App\Models\Building;
use App\Models\Document;
use App\Models\Customer;
use App\Models\Address;
use Illuminate\Http\Request;
use DB;

class Create extends Component
{
    public $elevator_id;
    public $name;
    public $place;
    public $construction_year;
    public $unit_no;
    public $nobo_no;
    public $remark;
    public $manufacture;
    public $maintenance_company;
    public $managment_id;
    public $check_date;
    public $check_date_valid;
    public $building_id;
    public $customer_id;
    public $description;
    public function render(Request $request)
    {
        return view('livewire.company.elevators.create', [
            'customers'     => Customer::select('id', 'name')->where('name', '!=', '')->get(),
            'manufactures'  => Elevator::select('manufacture')->where('manufacture', '!=', '')->groupby('manufacture')->get(),
            'addresses'     => Address::where('customer_id', $this->customer_id)->select('housenumber', 'id', 'name', 'address', 'place')->get(),
        ]);
    }

    public function store()
    {
        $validatedData = $this->validate([
        //    'name'          => 'required|min:6',
            'customer_id'   => '',
            'construction_year' => '',
            'nobo_no'=> '',
            'unit_no'=> '',
            'manufacture'=> '',
            'maintenance_company'=> '',
            'check_date'=> '',
            'check_date_valid'=> '',
            'remark'=> '',

        ]);

        // if ($this->fails()) {
       //     session()->flash('custom_message', 'Oops! Something went wrong...');
        // }


        Elevator::create($validatedData);

        $this->description = null;
        $this->customer_id = null;
        $this->construction_year = null;
        $this->nobo_no = null;
        $this->unit_no = null;
        $this->manufacture = null;
        $this->maintenance_company = null;
        $this->check_date = null;
        $this->check_date_valid = null;
        $this->remark = null;
        $this->showAddModal = false;

        toastr()->success('Lift toegevoegd ');
        return redirect()->route('elevator.index');
    }
}
