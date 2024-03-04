<?php
namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;

use Livewire\WithFileUploads;

use Illuminate\Http\Response;
use App\Models\Elevator;
use App\Models\Supplier;
use App\Models\Address;
use App\Models\Document;
use App\Models\MaintenancyContracts;

use Carbon\Carbon;

use App\Models\Upload;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

use App\Models\Customer;
use App\Models\Contact;
use App\Models\managementCompany;
use App\Models\inspections;

use App\Models\Incident;
use App\Models\inspectionCompany;
use App\Models\Maintenances;
use App\Models\maintenanceCompany;
use App\Models\Inspection;

use Illuminate\Support\Facades\Mail;
use Redirect;

use Storage;
use Illuminate\Http\Request;
use DB;
use Bugsnag;

class Show extends Component
{

    use WithFileUploads;

    public $elevator;

    public $description;

    public $title;
    public $upload_filename;
    public $upload_type = 1;
    public $remark;

    public $descriptioni;
    public $stand_still = 0;
    public $type_id;
    public $subject;
    public $incident_id;
    public $contactperson_address;
    public $contactperson;
    public $contactperson_phonenumber;
    public $inspections = [];
    public $maintenancycontracts = [];
    public $maintenance_company_id;
    public $management_id;
    public $inspection_company_id;
    public $construction_year;
    public $unit_no;
    public $nobo_no;
    public $address_id;
    public $supplier_id;
    public $addresses;
    public $customers;
    public $customer_id;
    public $delete_id;
    public $install_date;
    public $maintenance_contract_document;

    public $created_at;
    public $inspection_plandate;
    public $management_elevator;
    public $last_api_sync;
    public $report_date_time;
    public $install_no;
    public $status_id;

    //Upload  inspection
    public $inspection_remark;
    public $inspection_end_date;
    public $inspection_document;
    public $inspection_certification;
    public $inspection_status_id = 1;
    public $inspection_executed_datetime;
    public $inspection_id;
    public $showInspectionConfirmDelete = false;

    public $maintenance_remark;
    public $maintenance_status_id;
    public $maintenance_executed_datetime;
    public $maintenance_planned_at;
    public $maintenance_attachment;
    public $maintenance_id;
    public $maintenance_contract_begindate;
    public $maintenance_contract_enddate;
    public $maintenance_contract_type_id;
    public $maintenance_contract_option1 = 0;
    public $maintenance_contract_option2 = 0;
    public $maintenance_contract_option3 = 0;
    public $maintenance_contract_attachment;
    public $maintenancy_companie_id;
    public $maintenance_contract_companie_id;
    

public $edit_id;


    //Meerjarenbegrotingen
    public $mjob_beginyear;
    public $mjob_endyear;
    public $mjob_attachment;
    public $speakconnection;

    public $maintenance_contract_id;

    protected $listeners = ["deleteConfirmed" => "deleteUpload", "deleteConfirmed" => "deleteElevator", "refreshComponent" => '$refresh', ];

    public $attachmentCertification;
    public $attachmentDocument;

    public function render()
    {


        $this->maintenance_status_id = 2;
        // $this->documents = Document::where('elevator_id', $this->elevator_id)->get();
        $this->created_at = date("Y-m-d H:i");

        return view("livewire.company.elevators.show", [
            "inspectionCompanies" => inspectionCompany::get() , 
            "managements" => managementCompany::select("id", "name")
            ->where("name", "!=", "")
            ->get() ,

        "suppliers" => Supplier::select("id", "name")
            ->where("name", "!=", "")
            ->get() ,

        "maintenancyCompanies" => maintenanceCompany::orderby("name")
            ->get() ,
        
        
            "maintenancycontracts" => MaintenancyContracts::where("elevator_id", $this
            ->elevator->id)
            ->orderby('enddate')
            ->get()
     ,]);



    }

  
 

    public function store()
    {
        if (!$this->inspection_plandate)
        {
            $this->inspection_plandate = null;
        }

        $elevator = Elevator::find($this
            ->elevator
            ->id);
        $elevator->update(["address_id" => $this->address_id, "construction_year" => $this->construction_year, "unit_no" => $this->unit_no, "nobo_no" => $this->nobo_no, "remark" => $this->remark, "supplier_id" => $this->supplier_id, "install_no" => $this->install_no, "maintenance_company_id" => $this->maintenance_company_id, "description" => $this->description, "inspection_company_id" => $this->inspection_company_id, "management_id" => $this->management_id, "inspection_plandate" => $this->inspection_plandate, "management_elevator" => $this->management_elevator, "last_api_sync" => $this->last_api_sync, "install_date" => $this->install_date, "status_id" => $this->status_id, "speakconnection" => $this->speakconnection, ]);

        // $this->elevator = Elevator::where("id", $this
        //     ->elevator
        //     ->id)
        //     ->first();

        pnotify()
            ->addSuccess("Gegegevens succesvol opgeslagen");
    }

    public function deleteElevator()
    {
        $data = Elevator::where("id", $this->delete_id)
            ->first();
        $data->delete();

        $this->dispatchBrowserEvent("deleted", ["text" => "De lift is verwijderd", ]);

        return \Redirect::back();
    }

    public function mount(Request $request)
    {

        //Set the defaults
        $this->stand_still = 1;
        $this->report_date_time = date("Y-m-d H:i:s");;
        
 
        $this->maintenances = Maintenances::where("elevator_id", $request->id)
            ->get();
        $this->documents = Document::where("elevator_id", $request->id)
            ->get();
        $this->customers = Customer::orderBy("name")
            ->get();
        $this->addresses = Address::orderBy("address")
            ->get();


        $elevator_db = Elevator::where("id", $request->id)
            ->first();
        $this->elevator = $elevator_db;
        if ($elevator_db == null)
        {
            flasher("De opgevraagde lift is niet gevonden niet!");
            return redirect("/dashboard");
        }
        else
        {
            $this->elevator = $elevator_db;
            $this->management_id = $this
                ->elevator->address ?->management_id;
            $this->remark = $this
                ->elevator->remark;
            $this->inspection_company_id = $this->elevator ?->inspection_company_id;
            $this->construction_year = $this
                ->elevator->construction_year;
            $this->unit_no = $this
                ->elevator->unit_no;
            $this->nobo_no = $this
                ->elevator->nobo_no;
            $this->address_id = $this
                ->elevator->address_id;
            $this->customer_id = $this
                ->elevator->address ?->customer_id;
            $this->description = $this
                ->elevator->description;
            $this->maintenance_company_id = $this
                ->elevator->maintenance_company_id;

            $this->maintenancy_companie_id = $this
                ->elevator->maintenance_company_id;

            $this->inspection_plandate = $this
                ->elevator->inspection_plandate;
            $this->management_elevator = $this
                ->elevator->management_elevator;
            $this->status_id = $this
                ->elevator->status_id;
            $this->speakconnection = $this
                ->elevator->speakconnection;

            $this->last_api_sync = $this
                ->elevator->last_api_sync;
            $this->install_date = $this
                ->elevator->install_date;
            $this->last_service_date = $this
                ->elevator->last_service_date;
            $this->install_no = $this
                ->elevator->install_no;
            $this->supplier_id = $this
                ->elevator->supplier_id;

        }
    }

    protected $messages = ["subject.required" => "Vul de onderwerp van de storing in", "descriptioni.required" => "Vul een omschrijving van de storing in", ];

    public function storeIncident()
    {
        $validatedData = $this->validate(["subject" => "required", "descriptioni" => "required", ]);

        $this->incident_id = Incident::insertGetId(["elevator_id" => $this
            ->elevator->id, "customer_id" => $this
            ->elevator
            ->address->customer_id, "reporter_id" => auth()
            ->user()->id, "description" => $this->descriptioni, "type_id" => $this->type_id, "stand_still" => $this->stand_still, "subject" => $this->subject, "address_id" => $this
            ->elevator->address_id, "status_id" => 0, "created_at" => date("Y-m-d H:i:s") , "contactperson_address" => $this->contactperson_address, "contactperson_phonenumber" => $this->contactperson_phonenumber, "contactperson" => $this->contactperson, "report_date_time" => $this->report_date_time, ]);

        // $this->elevator = Elevator::where("id", $this
        //     ->elevator
        //     ->id)
        //     ->first();
        
        $this->incidents = Incident::where("elevator_id", $this
            ->elevator
            ->id)
            ->orderBy("id", "asc")
            ->get();

        $this->data = ["elevator_id" => $this
            ->elevator->id, "incident_id" => $this->incident_id, "elevator_address" => $this
            ->elevator
            ->address->address, "elevator_place" => $this
            ->elevator
            ->address->place, "customer_name" => $this
            ->elevator
            ->address
            ->customer->name, "insert_at" => date("d-m-Y H:i:s") , "subject" => $this->subject, "description" => $this->descriptioni, "nobo_no" => $this->nobo_no, "type_id" => $this->type_id, "stand_still" => $this->stand_still, "reporter_name" => auth()
            ->user()->name, "contactperson_address" => $this->contactperson_address, "contactperson_phonenumber" => $this->contactperson_phonenumber, "contactperson" => $this->contactperson, ];

        $this->html = preg_replace("/>\s+</", "><", $this->data);
        
        //    Mail::mailer()->send("emails.add_incident", $this->html, function (
        //      $message
        //  ) {
        //    $message->subject(
        //        "Storing #" .
        //          $this->incident_id .
        //          " | " .
        //          $this->elevator->address->customer->name .
        //        " | " .
        //        $this->elevator->address->address
        //  );
        //  $message->to("storing@lvaliftadvies.nl", "Storingen");
        //  $message->from(env("MAIL_FROM_ADDRESS"), env("MAIL_FROM_name"));
        //  });
        //Formuier nog leegmaken


        $this->dispatch('close-make-incident-modal');

        pnotify()
            ->addSuccess('Storing toegevoegd aan het systeem');
        // return redirect(request()
        //     ->header('Referer'));
    }

    public function updatedCustomerId()
    {
        $this->addresses = Address::where("customer_id", $this->customer_id)
            ->get();
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

    public function downloadDocument($type, $id)
    {

        switch ($type)
        {
            case "inspection" : $data = Inspection::where("id", $id)->first();

            $filename = $data->document;

            return Storage::disk('sftp')->download($filename);

        break;

        case "maintenance" : $data = Maintenances::where("id", $id)->first();
        $filename = $data->attachment;
    break;

    case "maintenancycontract" : $data = MaintenancyContracts::where("id", $id)->first();
    $filename = $data->document;
 
break;

case "certification":
    $data = Inspection::where("id", $id)->first();
    dd($data);
    $filename = $data->certification;
break;

 

}

if (Storage::disk('sftp')->exists($filename))
{
    return Storage::disk('sftp')->download($filename);
}
else
{
    flasher("Bestand is niet gevonden, Mogelijk is dit bestand verwijderd");
}
}

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

 


    $filename = $this
        ->upload_filename
        ->getClientOriginalName();
        $filename = str_replace(" ", "_", $filename);

    $directory = $this
        ->elevator
        ->address->customer_id . "/" . $this
        ->elevator->id . "/uploads/" . $this->upload_type;

    Storage::disk('sftp')
        ->putFileAs($directory, $uploadedFile, $filename);

    $data = Upload::updateOrCreate(["type_id" => $this->upload_type, "filename" => $filename, "title" => $this->title, "path" => $directory, "group_id" => 1,
    //  "add_by_user_id" => Auth::id(),
    "elevator_id" => $this
        ->elevator->id,
    //"incident_id" => $this->incident->id,
    "relation_id" => $this
        ->elevator
        ->address->customer_id, ]);

    $this
        ->elevator->uploads = Upload::where("elevator_id", $this
        ->elevator
        ->id)
        ->where("group_id", 1)
        ->get();

        pnotify()->addSuccess('Bijlage toegevoegd ');

        $this->upload_filename = NULL;
        $this->upload_type = NULL;
        $this->dispatch('close-add-attachment-modal');
}

public function deleteConfirmation($id)
{
    $this->delete_id = $id;

    $this->dispatchBrowserEvent("show-delete-confirmation", ["text" => "Weet je zeker dat je dit wilt ?", ]);
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
        ->elevator->uploads = Upload::where("elevator_id", $this
        ->elevator
        ->id)
        ->where("group_id", 1)
        ->get();

    return \Redirect::route('lva.elevator', ['id' => $this
        ->elevator
        ->id])
        ->with('success', 'Bijlage verwijderd');

}

public function addMonthsInspection($months)
{

    if ($this->inspection_executed_datetime)
    {
        $newDateTime = Carbon::parse($this->inspection_executed_datetime)
            ->addMonths($months);
        $this->inspection_end_date = $newDateTime->format('Y-m-d');
    }
    else
    {

        pnotify()
            ->addWarning("Vul een Uitvoeringsdatum in");
    }
}

public function get_from_liftinstituut()
{
    if (!$this->nobo_no)
    {
        pnotify()
            ->addWarning("Nobo nummer is niet ingevuld. Vul een geldig nobo nummer in om gegevens op te halen");
    }
    else
    {
        $i = 0;

        $url = "https://liftinstituutapi.azurewebsites.net/api/v1/objects/" . $this->nobo_no . "?code=NDQ2MDVjMDgtYjg3MC00OGVhLWE0ZTMtMWU3M2E1MWFjNDc0";

        $response = Http::get($url);

        $object = json_decode($response->body());

        if (!empty($object))
        {
            $i++;

            $elevator = Elevator::where("nobo_no", $this->nobo_no);
            $elevator->update(["construction_year" => $object->lastServiceDate, "last_revision_Date" => $object->lastRevisionDate, "last_service_date" => $object->lastServiceDate, "elevator_type" => $object->itemNumber,
            //  'description'           => $object->description,
            "description2" => $object->description2, "liftinstituut_api" => 1, "last_api_sync" => date("Y-m-d H:i:s") , ]);

            pnotify()
                ->addSuccess("Gegegevens succesvol opgehaald");

            // $this->elevator  =Elevator::where('id', $this->elevator->id)->first();
            $this->emit("refreshComponent");
            $elevator_db = Elevator::where("id", $this
                ->elevator
                ->id)
                ->first();

            $this->install_date = $this
                ->elevator->install_date;
            $this->last_service_date = $this
                ->elevator->last_service_date;
        }
        else
        {
            pnotify()
                ->addWarning("Gegevens niet gevonden bij het Liftinstituut");
        }
    }
}

public function addMaintenanceContractAction(){

    
    $this->maintenance_contract_companie_id  = $this->maintenance_company_id;

}
 

public function savemaintenanceContractAction()
{

    if (!$this->maintenance_status_id)
    {
        $this->maintenance_status_id = 2;
    }

    $maintenancie = MaintenancyContracts::updateOrCreate(['id' => $this->maintenance_contract_id, ], ['enddate' => $this->maintenance_contract_enddate, 'begindate' => $this->maintenance_contract_begindate, 'option1' => $this->maintenance_contract_option1, 'option2' => $this->maintenance_contract_option2, 'option3' => $this->maintenance_contract_option3, 'type_id' => $this->maintenance_contract_type_id, 'elevator_id' => $this
        ->elevator->id, 'maintenancy_companie_id' => $this->maintenancy_companie_id

    ]);


    

     //Store file
     $update = MaintenancyContracts::where("id", $maintenancie->id);
     $from_database = $update->first();

    if ($this->maintenance_contract_document != $from_database->document ){


    //If not a edit then upload document
    $filepath = $this
        ->elevator
        ->address->customer_id . "/" . $this
        ->elevator->id . "/";



        $uploadedFile = $this->maintenance_contract_document;

        $filename = $this
            ->maintenance_contract_document
            ->getClientOriginalName();
    
        $directory = $this
            ->elevator
            ->address->customer_id . "/" . $this
            ->elevator->id . "/maintenancecontract/";
    
        Storage::disk('sftp')
            ->putFileAs($directory, $uploadedFile, $filename);

     
        $update->update(['document' => $filepath . "maintenancecontract/" . $this
            ->maintenance_contract_document
            ->getClientOriginalName() ,
        //  'document'       => $filepath . "/".   $this->attachmentDocument->getClientOriginalName()
        ]);
 

    }

    pnotify()
        ->addSuccess('Onderhoudscontract geupload');

           //  $this->dispatch('close-crud-maintenance-contract-modal');
             return redirect(request()
               ->header('Referer'));
     
    
}

public function saveMaintenance()
{

    if (!$this->maintenance_status_id)
    {
        $this->maintenance_status_id = 2;
    }

    $maintenancie = Maintenances::updateOrCreate([
        'id' => $this->maintenance_id, ], 
        ['remark' => $this->maintenance_remark, 
        'status_id' => $this->maintenance_status_id, 
        'executed_datetime' => $this->maintenance_executed_datetime, 
        'planned_at' => $this->maintenance_planned_at,
    //  'attachment' => $this->maintenance_attachment,
    'elevator_id' => $this
        ->elevator->id

    ]);

    //If not a edit then upload document
    $filepath = $this
        ->elevator
        ->address->customer_id . "/" . $this
        ->elevator->id . "/maintenance";

    //Store file
    $update = Maintenances::where("id", $maintenancie->id);
    
    $from_database = $update->first();
 

    if ($this->maintenance_attachment != $from_database->attachment )
 
    {

        $filename = preg_replace('/\s+/', '_', $this
            ->maintenance_attachment
            ->getClientOriginalName());

        $this
            ->maintenance_attachment
            ->storePubliclyAs($filepath, $this
            ->maintenance_attachment
            ->getClientOriginalName());

        $update->update(['attachment' => $filepath . "/" . $this
            ->maintenance_attachment
            ->getClientOriginalName() ,
        //  'document'       => $filepath . "/".   $this->attachmentDocument->getClientOriginalName()
        ]);

    }
    $this->dispatch('close-crud-maintenance-modal');
    pnotify()->addSuccess('Gegevens opgeslagen');

}


public function editMaintenancy($id)
{

    $record = Maintenances::find($id);

    $this->maintenance_id = $id;
    $this->maintenance_remark = $record->remark;
    $this->maintenance_planned_at = $record->planned_at;
    $this->maintenance_status_id = $record->status_id;
    $this->maintenance_executed_datetime = $record->executed_datetime;
    $this->maintenance_contract_document = $record->document;


    
}

public function clearInspectionFields()
{

    $this->inspection_remark = NULL;
    $this->inspection_id = NULL;
    $this->inspection_end_date = NULL;
    $this->inspection_document = NULL;
    $this->inspection_certification = NULL;
    $this->inspection_status_id = NULL;
    $this->inspection_executed_datetime = NULL;
    $this->inspection_status_id = NULL;

}

public function editMaintenancyContract($id)
{

    $record = MaintenancyContracts::where('id',$id)->first();
 
    $this->maintenance_contract_id = $id;
    $this->maintenance_contract_option1 = $record->option1;
    $this->maintenance_contract_option2 = $record->option2;
    $this->maintenance_contract_option3 = $record->option3;
    $this->maintenance_contract_begindate = $record->begindate;
    $this->maintenance_contract_enddate = $record->enddate;
    $this->maintenance_contract_type_id = $record->type_id;

    $this->maintenance_contract_document = $record->document;
 


 if($record->maintenancy_companie_id){
    $this->maintenance_contract_companie_id = $record->maintenancy_companie_id;
}else{

    $this->maintenance_contract_companie_id  =  $this->maintenance_company_id;
 

}}


public function deleteMaintenance($id)
{

    $data = Maintenances::where('id', $id)->first();
    $data->delete();
    pnotify()->addWarning("Onderhoudsbeurt verwijderd");


}

public function downloadIncidentUpload($path_to_file)
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

public function deleteMaintenaceContractDocument($id)
{

    $maintenancie_contract = MaintenancyContracts::where("id", $id);

    $maintenancie_contract->update([
         
     'document'       => null
    ]);

    $this->maintenance_contract_document = null;

    $data = Maintenances::where('id', $id)->delete();
    pnotify()->addWarning('Gegevens verwijderd');

}

public function deleteMaintenanceContract($id)
{

    $data = MaintenancyContracts::where('id', $id)->first();
    $data->delete();

    pnotify()->addWarning('Gegevens verwijderd');

}

public function saveMJOB()
{

    $validatedData = $this->validate([

    "mjob_attachment" => "required", "mjob_endyear" => "required", "mjob_beginyear" => "required",

    ], ["mjob_attachment.required" => "Bijlage is verplicht", "mjob_endyear.required" => "Eind jaar is verplicht", "mjob_beginyear.required" => "Begin jaar is verplciht ", ]);

    $uploadedFile = $this->mjob_attachment;

    $filename = $this
        ->mjob_attachment
        ->getClientOriginalName();

    $directory = $this
        ->elevator
        ->address->customer_id . "/" . $this
        ->elevator->id . "/uploads/" . 5;

    Storage::disk('sftp')
        ->putFileAs($directory, $uploadedFile, $filename);

    $data = Upload::updateOrCreate(["type_id" => 5, "filename" => $filename, "title" => "Meerjarenbegroting " . $this->mjob_beginyear . ' - ' . $this->mjob_endyear, "path" => $directory, "group_id" => 1,

    "elevator_id" => $this
        ->elevator->id,
    "relation_id" => $this
        ->elevator
        ->address->customer_id, ]);

    pnotify()
        ->addSuccess('Meerjaren begroting opgeslagen');
        $this->dispatch('close-crud-mjob-modal');

    
}

public function enterEndYear()
{
    if (strlen($this->mjob_beginyear) == 4) $this->mjob_endyear = $this->mjob_beginyear + 9;
}


//Keuringen 
public function addInspection(){
    $this->inspection_executed_datetime = null;
    $this->inspection_end_date = null;
    $this->inspection_status_id = null;
    $this->inspection_remark = null;
    $this->attachmentCertification = null;
    $this->attachmentDocument = null;

}


public function saveInspection()
{


    
    $validatedData = $this->validate(["inspection_executed_datetime" => "required", "inspection_end_date" => "required",
    ], ["inspection_executed_datetime.required" => "Begin datum is verplicht.", "inspection_end_date.required" => "Einddatum is verplicht.", "inspection_document.required" => "Keuringsdocument is verplicht", ]);

    if ($this->inspection_status_id)
    {
        $inspection_status_id = $this->inspection_status_id;
    }
    else
    {
        $inspection_status_id = 1;
    };

    $inspection = Inspection::updateOrCreate(["id" => $this->inspection_id, ], ["executed_datetime" => $this->inspection_executed_datetime, "end_date" => $this->inspection_end_date, "status_id" => $inspection_status_id, "remark" => $this->inspection_remark, "elevator_id" => $this
        ->elevator->id, ]);

    //If not a edit then upload document
    $filepath = $this
        ->elevator
        ->address->customer_id . "/" . $this
        ->elevator->id . "/inspections";

    //Store file
    $update = Inspection::where("id", $inspection->id);


    $from_database = $update->first();
 

    if ($this->attachmentCertification != $from_database->certification )
    {

        $filename = preg_replace('/\s+/', '_', $this
            ->attachmentCertification
            ->getClientOriginalName());

        $this
            ->attachmentCertification
            ->storePubliclyAs($filepath, $this
            ->attachmentCertification
            ->getClientOriginalName());

        $update->update(['certification' => $filepath . "/" . $this
            ->attachmentCertification
            ->getClientOriginalName() ,
           ]);

    }
 

 
 
    if ($this->attachmentDocument != $from_database->document )
    {

        $this
            ->attachmentDocument
            ->storePubliclyAs($filepath, $this
            ->attachmentDocument
            ->getClientOriginalName());

        $update->update([
        //
        'document' => $filepath . "/" . $this
            ->attachmentDocument
            ->getClientOriginalName()

        ]);

    }

    $this->inspection_executed_datetime = null;
    $this->inspection_end_date = null;
    $this->inspection_status_id = null;
    $this->inspection_remark = null;
    $this->attachmentCertification = null;
    $this->attachmentDocument = null;

    pnotify()->addSuccess('Keuring toegevoegd aan het systeem');
    $this->dispatch('close-crud-inspection-modal');


}


public function deleteInspection($id)
{
    $data = Inspection::where('id', $id)->first();
    $data->delete();
    pnotify()->addSuccess('Keuring verwijderd');
}



public function editInspection($id)
{
    $record = Inspection::find($id);
    $this->inspection_id                    = $id;
    $this->inspection_remark                = $record->remark;
    $this->inspection_end_date              = $record->end_date;
    $this->inspection_document              = $record->document;
    $this->attachmentCertification          = $record->certification;
    $this->inspection_status_id             = $record->status_id;
    $this->attachmentDocument               = $record->document;
    $this->inspection_executed_datetime     = date('Y-m-d', strtotime($record->executed_datetime));   
    $this->edit_id;
}






public function deleteInspectionDocument($type,$inspection_id)
{
 
    $update = Inspection::where("id", $inspection_id);
        if($type =='document'){
            $this->attachmentDocument = null;
            $update->update(['document' => NULL]);
        }elseif($type =='certification'){
            $this->attachmentCertification = null;
            $update->update(['certification' => NULL]);
        }
    }


 
    
   //Einde keuringen 

}

