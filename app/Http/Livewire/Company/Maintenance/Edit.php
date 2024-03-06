<?php

namespace App\Http\Livewire\Company\Maintenance;

use Livewire\Component;
use App\Models\Maintenances;
use App\Models\Elevator;
use Storage;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class Edit extends Component
{

    use WithFileUploads;

    public $maintenance_remark;
    public $maintenance_status_id;
    public $maintenance_executed_datetime;
    public $maintenance_planned_at;
    public $maintenance_attachment;
    public $maintenance_id;
    public $elevator;


    public function render()
    {
        return view('livewire.company.maintenance.edit');
    }


    public function mount(Request $request){
        $record = Maintenances::find($request->id);
        $this->elevator = Elevator::where('id', $record->elevator_id)->first();
    $this->maintenance_id = $request->id;
    $this->maintenance_remark = $record->remark;
    $this->maintenance_planned_at = $record->planned_at;
    $this->maintenance_status_id = $record->status_id;
    $this->maintenance_executed_datetime = $record->executed_datetime;
    $this->maintenance_attachment = $record->attachment;
    
    }

    public function save()
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
        'elevator_id' => $this->elevator->id

    ]);


      //If not a edit then upload document
      $filepath = "/uploads/".$this->elevator->id . "/maintenance/".$maintenancie->id ."/";

  //Store file
  $update = Maintenances::where("id", $maintenancie->id);
  
  $from_database = $update->first();

  if ($this->maintenance_attachment  != $from_database->attachment )
 

  {
    if($this->maintenance_attachment){
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
    }else{

        $update->update(['attachment' => NULL]);
      }
    
  } 
  pnotify()->addSuccess('Onderhoudbeurt toegevoegd');
  return redirect('/elevator/show/' . $this->elevator->id );
 

}

public function delete_attachment(){
    $this->maintenance_attachment = NULL;
}


public function delete(){

    $data = Maintenances::where('id', $this->maintenance_id)->first();
    $data->delete();
    pnotify()->addWarning("Onderhoudsbeurt verwijderd");
    
    return redirect('/elevator/show/' . $this->elevator->id );
}



}
