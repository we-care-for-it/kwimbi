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
use App\Models\inspectionCompany;

use App\Models\managementCompany;
use App\Models\maintenanceCompany;


 
 
use App\Models\Management;
use App\Models\Supplier;
use App\Models\Location;



use DB;

class Create extends Component
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

    public $locations_relation = [];

 


 

      public function search_loctions_by_relation() {
 
        
        $this->locations_relation =  Location::orderBy('name', 'asc')->get();
 
    }




    public function render(Request $request)
    {
        return view('livewire.company.elevators.create', [
        
        'customers'  => Customer::orderBy('name', 'asc')->get(),
        'managements' => managementCompany::orderBy('name', 'asc')->get() ,
        'inspectionCompanys' => inspectionCompany::orderBy('name', 'asc')->get() ,
        'suppliers' => Supplier::orderBy('name', 'asc')->get() ,
        'maintenanceCompanys' => maintenanceCompany::orderBy('name', 'asc')->get() ,
        'locations' => Location::orderBy('name', 'asc')->get() ,       ]);
    } 

    public function save(){
        pnotify()->addSuccess('Lift toegevoegd');


       
        $this->validate();
        $elevator = [
            'name' => $this->name,
            'stretcher_elevator' => $this->stretcher_elevator,
            'fire_elevator' => $this->fire_elevator,
            'energy_label' => $this->energy_label,
            'speakconnection' => $this->speakconnection,
            'stopping_places' => $this->stopping_places,
            'nobo_no' => $this->nobo_no,
            'unit_no' => $this->unit_no,
            'object_type_id' => $this->object_type_id,
            'status_id' => $this->status_id,
            'maintenance_company_id' => $this->maintenance_company_id,
            'construction_year' => $this->construction_year,
            'inspection_company_id' =>$this->inspection_company_id,
            'customer_id' =>$this->customer_id,
            'address_id' =>$this->location_id,
        ];
         



        $insert_elevator = Elevator::create($elevator); 

        pnotify()->addSuccess('Lift toegevoegd');


        

        return redirect('/elevator/show/' . $insert_elevator->id );

}}




