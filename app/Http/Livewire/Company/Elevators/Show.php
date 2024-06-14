<?php
namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;
use Illuminate\Http\Request;
 

use Illuminate\Support\Str;
use App\Models\Elevator;

 
use App\Models\Customer;
use App\Models\Management;
use App\Models\Upload;
use App\Models\Supplier;
use App\Models\Location;
use App\Models\managementCompany;
use App\Models\inspectionCompany;
use App\Models\inspection;
use App\Models\maintenanceContract;

use App\Models\maintenanceCompany;
use Livewire\WithFileUploads;
use App\Models\Maintenances;

use Storage;

 


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
    public $upload_type;
    public $title;


  
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
    public $upload_filename;



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
        $this->supplier_id      = $item->supplier_id;
        $this->nobo_no      = $item->nobo_no;
        $this->fire_elevator        = $item->fire_elevator;
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
                'supplier_id' => $this->supplier_id,
                


                
            ]
        
        );
     
        $this->dispatch('close-crud-modal');
        $this->clear();
       
 
         pnotify()->addSuccess('Lift toegevoegd');


        $this->object =$data;

 
     }
 



    public function addUpload(){

        $this->

        $filepath = "/uploads/".$this->object->id . "/attachments/";

        $filename = preg_replace('/\s+/', '_', $this
        ->upload_filename
        ->getClientOriginalName());


        $this
        ->upload_filename
        ->storePubliclyAs($filepath, $this
        ->upload_filename
        ->getClientOriginalName());
        
 
        pnotify()->addWarning('Bijlage toegevoegd');

        //   $upload_filename = $this->upload_filename->storePubliclyAS(
        //      $directory,
        //      $filename,
        //     "sftp"
        //   );
        //
        $data = Upload::updateOrCreate([
            "type_id" => $this->upload_type,
            "filename" => $filename,
            "title" => $this->title,
            "path" => $filepath,
            "group_id"  => 3,
        //    "add_by_user_id" => Auth::id(),
            "elevator_id" => $this->object->id,
 
        ]);


        pnotify()->addSuccess('Bijlage toegeveoegd');
        return redirect('/elevator/show/' . $this->onject->id );
       
 
       

 
    }


    public function downloadUpload($path_to_file)
    {
        if (Storage::disk('sftp')->exists($path_to_file))
        {
    
            return Storage::disk('sftp')->response($path_to_file);
    
        }
        else
        {
            pnotify()->addWarning("Bestand is niet gevonden, Mogelijk is dit bestand verwijderd");
        }
    }

    public function downloadDocument($type, $id)
    {

        switch ($type)
        {
            case "inspection" : 
                $data = Inspection::where("id", $id)->first();

            $filename = $data->document;

        

        break;

        case "maintenance" : $data = Maintenances::where("id", $id)->first();
        $filename = $data->attachment;
         
    break;

    case "maintenancycontract" : 
    
        $data = maintenanceContract::where("id", $id)->first();
    $filename = $data->attachment;

 
 
 
break;

case "certification":
    $data = Inspection::where("id", $id)->first();
    $filename = $data->certification;
    

break;

 

}

if (Storage::disk('media')->exists($filename))
{
    return Storage::disk('media')->download($filename);
}
else
{
    flasher("Bestand is niet gevonden, Mogelijk is dit bestand verwijderd");
}
}



    //Functies verwijderen
    public function deleteMaintenance($id) {
 
 
        $item= Maintenances::find($id);
        $item->delete();  
        
        noty()
        ->layout('bottomRight')
        ->addInfo('Onderhoudsbeurt verwijderd');
 

}


    //Functies verwijderen
    public function deletemaintenanceContract($id) {
 
 
        $item=maintenanceContract::find($id);
        $item->delete();  
        
        noty()
        ->layout('bottomRight')
        ->addInfo('Onderhoudscontract verwijderd');
 

}



}