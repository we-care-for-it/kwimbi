<?php

namespace App\Http\Livewire\Company\Incidents;


use Livewire\Component;
use App\Http\Livewire\DataTable\WithSorting;
use App\Http\Livewire\DataTable\WithCachedRows;
use App\Http\Livewire\DataTable\WithBulkActions;
use App\Http\Livewire\DataTable\WithPerPagePagination;
use Illuminate\Support\Facades\Auth;

use App\Models\Incident;
use App\Models\IncidentReplies;
use App\Models\Upload;
use Livewire\WithFileUploads;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Redirect;

class Show extends Component
{
    use WithFileUploads;
    public $incident = [];

    public $incident_reply_id;

    public $incident_id;
    public $message;
    public $status_id;
    public $replyMessage;
    public $replyInternalMessage;

    public $replyStatus;
    public $replyDate;
    public $title;
    public $delete_id;
    public $upload_filename;
    public $upload_type  = 7;
    public $showConfirmDelete = false;
    public $showAttachmentConfirmDelete = false;
    public $editMode = false;
    public $description;
    public $report_date_time;
    public $showReplyConfirmDelete = false;
    public $stand_still = NULL;
 








    public function render()
    {
     //   $this->upload_type = 1;

    
        return view("livewire.company.incidents.show", []);
    }

    public function mount(Request $request)
    {
 


        $this->incident          = Incident::where("id", $request->id)->first();
        $this->description       = $this->incident->description;
        $this->report_date_time  = $this->incident->report_date_time;

     
    }

    public function saveIncident()
    {
        $this->editMode = false;


        $incident = Incident::find($this->incident->id);
        $incident->description = $this->description;
        $incident->report_date_time = $this->report_date_time; 





        $incident->update();


        $this->incident          = Incident::where("id", $this->incident->id)->first();
        $this->description       = $this->incident->description;
        $this->report_date_time  = $this->incident->report_date_time;


        



        pnotify()->addWarning('Gegevens opgeslagen');
    }
    public function deleteIncident($id)
    {
        $data = Incident::where('id', $id)->first();

        $data->delete();

        return redirect('/company/incidents');


    }


    public function deleteReply($id)
    {
        $data = IncidentReplies::where('id', $id)->first();

        $data_incident =  Incident::where("id", $this->incident->id)->first();
        $data_incident->update(['status_id' => 5]);
        $data->delete();

        $this->incident          = Incident::where("id", $this->incident->id)->first();


        $this->showReplyConfirmDelete = false;
        return back();
    }




    public function addIncidentReply(Request $request)
    {
        // $validatedData = $this->validate(
        //     ["replyMessage" => "required"],
        //     [
        //         "replyMessage.required" => "Vul een bericht in",
        //     ]
        // );
        if(!$this->replyDate) {
            $this->replyDate = date('Y-m-d H:i:s');
        }

        IncidentReplies::insert([
            "incident_id" => $this->incident->id,
            "user_id" => auth()->user()->id,
            "message" => $this->replyMessage,
            "internalmessage" => $this->replyInternalMessage,
            

            "created_at" => $this->replyDate,
            "status_id" => $this->replyStatus,
          
            
        ]);

        $this->incident->replys = IncidentReplies::orderby("id", "desc")->get();

    if($this->stand_still){
        $this->stand_still = 0;
    }else{
        $this->stand_still = 1;
    }

        Incident::where("id", $this->incident->id)->update([
            "status_id" => $this->replyStatus,
            "stand_still" => $this->stand_still,
            
        ]);

        if ($this->replyStatus == 99) {
            Incident::where("id", $this->incident->id)->update([
                "stand_still" => false,
                "status_id" => $this->replyStatus,
            ]);
        }

     
        

        $this->replyStatus = null;
        $this->replyMessage = null;
        $this->replyInternalMessage = null;
        


        $this->incident = Incident::where("id", $this->incident->id)->first();

        pnotify()->addWarning('Gegevens opgeslagen');
    }

    public function show_upload()
    {
 
        $this->upload_filename = null;
        $this->upload_type = null;
        $this->resetValidation();
    }





    public function addUpload()
    {


        if ($this->upload_filename) {


            $uploadedFile = $this->upload_filename;











            $filename = $this->upload_filename->getClientOriginalName();

            $directory = $this->incident->elevator->address->customer_id .
                         "/" .
                         $this->incident->elevator->id .
                         "/incidents/" .
                         $this->incident->id;



            Storage::disk('sftp')->putFileAs(
                $directory,
                $uploadedFile,
                $filename
            );

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
                "path" => $directory,
                "group_id"  => 2,
            //    "add_by_user_id" => Auth::id(),
                "elevator_id" => $this->incident->elevator->id,
                "incident_id" => $this->incident->id,
                "relation_id" =>
                    $this->incident->elevator->address->customer_id,
            ]);


        }

        $this->incident->uploads = Upload::where("incident_id", $this->incident->id)->where("group_id", 2)->get();
 
      pnotify()->addWarning('Bijlage toegevoegd');
      return redirect(request()->header('Referer'));
    }

    public function store(Request $request)
    {
        // $this->validate();

        pnotify()->addWarning('Gegevens opgeslagen');

        $this->emit("closeoffcanvas");
        // $this->resetValidation();
        // $this->clear();
        // $this->updateMode = false;
        $this->emit("closeoffcanvas");
    }


 

    public function deleteUpload($id)
    {
        $data = Upload::where('id', $id)->first();
        $data->delete();

          $filename = $data->path . "/" . $data->filename;
        $this->incident->uploads = Upload::where("incident_id", $this->incident->id)->get();


        if(Storage::exists($filename)) {
            pnotify()->addSuccess('Bestand verwijderd');
            return Storage::delete($filename);
        } else {
            pnotify()->addWarning('Bestand niet gevonden, Mogelijk is het bestand al verwijderd');
        }

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






}