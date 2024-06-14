<?php

namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;
use App\Models\Elevator;
use App\Models\Customer;
use App\Models\Management;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\managementCompany;
use App\Models\Auth;
use App\Models\inspectionCompany;
use App\Models\maintenanceCompany;


class Edit extends Component
{

    public $description;
    public $customer_id;
    public $construction_year;
    public $nobo_no;
    public $unit_no;
    public $manufacture;
    public $maintenance_company;
    public $check_date;
    public $check_date_valid;
    public $remark;
    public $showAddModal;
    public $edit_id;

  
    public $supplier_id;
    public $address_id;
    public $inspection_company_id;
    public $maintenance_company_id;
    public $stopping_places;
    public $carrying_capacity;
    public $energy_label;
    public $stretcher_elevator;
    public $fire_elevator;
    public $name;
    public $speakconnection;
    public $object_type_id;
    public $status_id;
    public $location_id;
    public $data;
    public $locations_relation = [];
    public $locations = [];


    protected $rules = ['address_id' => 'required', 'customer_id' => 'required' ];

    public function render()
    {

        $this->locations_relation =  Location::orderBy('name', 'asc')->get();
        $this->locations =  Location::where('customer_id', $this->customer_id)->orderBy('name', 'asc')->get();
 
        return view('livewire.company.elevators.edit',
   
        [
            'customers'             => Customer::orderBy('name', 'asc')->get(),
            'managements'           => managementCompany::orderBy('name', 'asc')->get() ,
            'inspectionCompanys'    => inspectionCompany::orderBy('name', 'asc')->get() ,
            'suppliers'             => Supplier::orderBy('name', 'asc')->get() ,
            'maintenanceCompanys'   => maintenanceCompany::orderBy('name', 'asc')->get() ,
           
           ]);
   
    }

    public function mount($id)
    {

        
    
        $this->data = Elevator::findOrFail($id);
        $this->edit_id      = $id;
        $this->status_id      = $this->data->status_id;
        $this->object_type_id      = $this->data->object_type_id;
 
       $this->supplier_id      = $this->data->supplier_id;

        $this->stretcher_elevator      = $this->data->stretcher_elevator;
        $this->speakconnection      = $this->data->speakconnection;
        $this->fire_elevator      = $this->data->fire_elevator;
        $this->customer_id      = $this->data->customer_id;
        $this->inspection_company_id      = $this->data->inspection_company_id;
        $this->maintenance_company_id      = $this->data->maintenance_company_id;
        $this->stopping_places      = $this->data->stopping_places;
        $this->construction_year      = $this->data->construction_year;
        $this->nobo_no      = $this->data->nobo_no;
        $this->unit_no      = $this->data->unit_no;
        $this->energy_label      = $this->data->energy_label;
        $this->address_id      = $this->data->address_id;
        $this->remark  = $this->data->remark;

    }


    public function save()
    {
        $this->validate();
 
       
        try {
            $this->data->update($this->all());
        } catch (QueryException $e) {
            
        }
        $this->data->update($this->all());
        noty()
        ->layout('bottomRight')
        ->addInfo('Liftgegevens opgeslagen');
    

        return redirect('/elevator/show/' .  $this->data->id);

    }
 

    
    public function search_locations_by_relation() {
 
 
    }




}
