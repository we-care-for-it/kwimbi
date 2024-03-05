<?php
namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;
use Illuminate\Http\Request;
 

use Illuminate\Support\Str;
use App\Models\Elevator;

 
use App\Models\Customer;
use App\Models\Management;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\managementCompany;
use App\Models\inspectionCompany;

use App\Models\maintenanceCompany;
use Livewire\WithFileUploads;
 

 


class Show extends Component
{

   
    public $object;
    public $file_attachment;
    public $file_description;
    public $file_collection;
    public $file_elevator_id;
 
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
    use WithFileUploads;
    
  
    public function mount(Request $request)
    {
   $this->object = Elevator::find($request->id);

    }


    public function render(Request $request)
    {

 
 
     
 
        return view('livewire.company.elevators.show',
        [
           
            'customers'  => Customer::orderBy('name', 'asc')->get(),
            'managements' => managementCompany::orderBy('name', 'asc')->get() ,
            'inspectionCompanys' => inspectionCompany::orderBy('name', 'asc')->get() ,
            'suppliers' => Supplier::orderBy('name', 'asc')->get() ,
            'maintenanceCompanys' => maintenanceCompany::orderBy('name', 'asc')->get() ,
            'locations' => Location::orderBy('name', 'asc')->get()
        ]);

  
    }
    public function search_loctions_by_relation() {
 
        
        $this->locations_relation =  Location::orderBy('name', 'asc')->get();
 
    }

    public function edit($id){
        $this->edit_id = $id;

        $item = Elevator::where('id', $id)->first();
        $this->name      = $item->name;
        $this->status_id      = $item->status_id;
        $this->nobo_no      = $item->nobo_no;
        // $this->place        = $item->place;
        // $this->name         = $item->name;
        // $this->place        = $item->place;
        // $this->emailaddress = $item->emailaddress;
        // $this->phonenumber  = $item->phonenumber;
        // $this->function  = $item->function;

    }

    
    public function clear(){

    }


    public function save(){

 
        $data = Elevator::updateOrCreate(
            ['id' =>$this->edit_id],
            [
                'status_id' => 2,
                'name' => $this->name,
                'nobo_no' => $this->nobo_no,
                

                
            ]
        
        );
     
        $this->dispatch('close-crud-modal');
        $this->clear();
       
 
         pnotify()->addSuccess('Lift toegevoegd');


        $this->object =$data;

 
     }
 



    public function uploadFile(){

        
        
    $filename = $this
    ->file_attachment
    ->getClientOriginalName();
    $filename = str_replace(" ", "_", $filename);

$directory = "/uploads/elevators/" . $this
    ->elevator->id . "/attachments/" . $this->file_collection;

Storage::disk('media')
    ->putFileAs($directory, $uploadedFile, $filename);

    
 
       

 
    }

}

