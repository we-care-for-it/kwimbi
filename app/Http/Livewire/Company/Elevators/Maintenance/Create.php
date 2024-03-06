<?php

namespace App\Http\Livewire\Company\Elevators\Maintenance;

use Livewire\Component;
use Illuminate\Http\Request;
use App\Models\Elevator;
use App\Models\Maintenances;

use Livewire\WithFileUploads;




class Create extends Component
{

    public $maintenance_remark;
    public $maintenance_status_id;
    public $maintenance_executed_datetime;
    public $maintenance_planned_at;
    public $maintenance_attachment;
    public $maintenance_id;
    public $elevator_data;


    public $elevator;

    use WithFileUploads;
    public function render()
    {

        
        return view('livewire.company.elevators.maintenance.create');
    }

    public function mount(Request $request){
        $this->elevator = Elevator::where('id', $request->elevator_id)->first();
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

  pnotify()->addSuccess('Onderhoudbeurt toegeveoegd');
  return redirect('/elevator/show/' . $this->elevator->id );
 

}

public function delete_temp_attachment(){
    $this->maintenance_attachment = NULL;
}
}




 