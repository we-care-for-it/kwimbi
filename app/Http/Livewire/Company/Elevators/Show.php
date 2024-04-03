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
use App\Models\inspection;
use App\Models\maintenanceContract;
use App\Models\Upload;
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
public $inspection_id;
public $attachmentDocument;
public $attachmentCertification;
 public $maintenance_attachment;
 public $maintenance_contract_document;


//Upload 
 public $upload_filename;
public $upload_type = 2;
public $title;


 
public $maintenance_contract_id;

//Onderhoudsconytracten 
public $maintenance_contract_begindate;
public $maintenance_contract_enddate;
public $maintenance_contract_type_id;
public $maintenance_contract_option1 = 0;
public $maintenance_contract_option2 = 0;
public $maintenance_contract_option3 = 0;
public $maintenance_contract_attachment;
public $maintenancy_companie_id;
public $maintenance_contract_companie_id;




 //Onderhoudsconterc
public $maintenance_status_id;


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


//Onderhoudscontracten


public function show_upload()
{

    $this->upload_filename = null;
    $this->upload_type = null;
    $this->title = null;

    $this->resetValidation();
}

public function addUpload()
{
    $validatedData = $this->validate([
        "upload_filename" => "required", 
        "upload_type" => "required", ], 
        [
            "upload_filename.required" => "The :attribute cannot be empty.", 
            "upload_type.required" => "The  format is not valid.", ]);

   $uploadedFile = $this->upload_filename;

    


   
    $attachment = Upload::create([
              "type_id"       => $this->upload_type, 
                 "filename"      => $uploadedFile, 
                 "title"         => $this->title, 
                 "elevator_id"   => $this->object->id,
                 "relation_id"   => $this->object->location->customer_id, ]

 );

    $filepath = "/uploads/".$this->object->id . "/".$attachment->id ."/";

 

 

      $filename = preg_replace('/\s+/', '_', $this
          ->upload_filename
          ->getClientOriginalName());

    //   $this
    //       ->maintenance_contract_attachment
    //       ->storePubliclyAs($filepath, $this
    //       ->maintenance_contract_attachment
    //       ->getClientOriginalName());


    $this
    ->upload_filename
    ->storePubliclyAs($filepath, $this
    ->upload_filename
    ->getClientOriginalName());



       $attachment->update(['path' => $filepath . "/" . $this
          ->upload_filename
          ->getClientOriginalName() ,
      //  'document'       => $filepath . "/".   $this->attachmentDocument->getClientOriginalName()
      ]);

  



    
    // $data = Upload::create(
    //     [
    //         "type_id"       => $this->upload_type, 
    //         "filename"      => $filename, 
    //         "title"         => $this->title, 
    //         "path"          => $filepath, 
    //         "elevator_id"   => $this->object->id,
    //         "relation_id"   => $this->object->location->customer_id, ])


    //         $maintenancie_contract->update(['attachment' => $filepath . "/" . $this
    //         ->maintenance_contract_attachment
    //         ->getClientOriginalName() ,
            
    // $filepath = "/uploads/".$this->object->id . "/attachments/".$maintenancie_contract->id ."/";

 






    // if ($this->maintenance_contract_attachment != $maintenancie_contract->attachment )
  
    // {
  
    //     $filename = preg_replace('/\s+/', '_', $this
    //         ->maintenance_contract_attachment
    //         ->getClientOriginalName());
  
    //     $this
    //         ->maintenance_contract_attachment
    //         ->storePubliclyAs($filepath, $this
    //         ->maintenance_contract_attachment
    //         ->getClientOriginalName());
  
    //     $maintenancie_contract->update(['attachment' => $filepath . "/" . $this
    //         ->maintenance_contract_attachment
    //         ->getClientOriginalName() ,
    //     //  'document'       => $filepath . "/".   $this->attachmentDocument->getClientOriginalName()
    //     ]);
  
    // }




//  ;


             pnotify()->addSuccess('Bijlage toegevoegd ');

        $this->upload_filename = NULL;
        $this->upload_type = NULL;
        $this->dispatch('close-add-attachment-modal');
}


public function deleteUpload($id)
{
    $data = Upload::where("id", $id)->first();
    $data->delete();

    $filename = $data->path . "/" . $data->filename;

    if (Storage::disk('sftp')
        ->exists($filename))
    {
        return Storage::disk('sftp')->delete($filename);
    }
    else
    {
        flasher("Bestand is niet gevonden, Mogelijk is dit bestand verwijderd");
    }

    pnotify()->addWarning('Bestand verwijderd');
    return redirect(request()
        ->header('Referer'));

    $this
        ->object->uploads = Upload::where("elevator_id", $this
        ->object
        ->id)
        ->where("group_id", 1)
        ->get();


        pnotify()->addSuccess('Bijlage verwjderd');
        return redirect('/elevator/show/' .$this
        ->object
        ->id );
 

}


function downloadUpload($path_to_file){
    if (Storage::disk('sftp')->exists($path_to_file))
    {

        return Storage::disk('sftp')->response($path_to_file);

    }
    else
    {
        pnotify()->addWarning("Bestand is niet gevonden, Mogelijk is dit bestand verwijderd");
    }

}


}