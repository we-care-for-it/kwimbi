<?php

namespace App\Http\Livewire\Company\Inspections;


use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Elevator;
use App\Models\Inspection;
use Livewire\WithFileUploads;
use Carbon\Carbon;


class Edit extends Component
{


    public $inspection_remark;
    public $inspection_end_date;
    public $inspection_document;
    public $inspection_certification;
    public $inspection_status_id = 1;
    public $inspection_executed_datetime;
    public $inspection_id;
    public $attachmentDocument;
    public $attachmentCertification;

    public $elevator;

use WithFileUploads;


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


public function mount(Request $request){
    
    
    $record = Inspection::find($request->id);
        $this->elevator = Elevator::where('id', $record->elevator_id)->first();
 
 
    $this->inspection_id                    = $request->id;
    $this->inspection_remark                = $record->remark;
    $this->inspection_end_date              = $record->end_date;
    $this->inspection_document              = $record->document;
    $this->attachmentCertification          = $record->certification;
    $this->inspection_status_id             = $record->status_id;
    $this->attachmentDocument               = $record->document;
    $this->inspection_executed_datetime     = date('Y-m-d', strtotime($record->executed_datetime));   
    $this->edit_id  = $request->id;



}



    public function render()
    {
        return view('livewire.company.inspections.edit');
    }


    public function save()
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
        $filepath = "/uploads/".$this->elevator->id . "/inspections/".$inspection->id ."/";

    
        //Store file
        $update = Inspection::where("id", $inspection->id);
    
    
        $from_database = $update->first();
     
    
        if ($this->attachmentCertification  != $from_database->certification )
        {
            if($this->attachmentCertification){
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

            }else{

                $update->update(['certification' => NULL]);
            }
    
            }
     
    
     
     
        if ($this->attachmentDocument  != $from_database->document )
        {
    
            if($this->attachmentDocument){
            $this
                ->attachmentDocument
                ->storePubliclyAs($filepath, $this
                ->attachmentDocument
                ->getClientOriginalName());
    
            $update->update([
       
            'document' => $filepath . "/" . $this
                ->attachmentDocument
                ->getClientOriginalName()
    
            ]);
        }else{

            $update->update(['document' => NULL]);
        }
    
        } 
    
        $this->inspection_executed_datetime = null;
        $this->inspection_end_date = null;
        $this->inspection_status_id = null;
        $this->inspection_remark = null;
        $this->attachmentCertification = null;
        $this->attachmentDocument = null;
    
        pnotify()->addSuccess('Keuring gewijzgd aan het systeem');
        return redirect('/elevator/show/' . $this->elevator->id );
 
    
    
    }


    public function delete_temp_certification(){
        $this->attachmentCertification = NULL;
    }
    public function delete_temp_document(){
        $this->attachmentDocument = NULL;
    }


    public function delete(){

        $data = Inspection::where('id', $this->inspection_id)->first();
        $data->delete();
        pnotify()->addWarning("Keuring verwijderd");
        
        return redirect('/elevator/show/' . $this->elevator->id );
    }
    
}
