<?php
namespace App\Http\Livewire\Company\Elevators\MaintenanceContracts;
use Illuminate\Http\Request;

use App\Models\Elevator;
use App\Models\Inspection;
use App\Models\maintenanceCompany;
use App\Models\maintenanceContract;


use Livewire\WithFileUploads;
use Carbon\Carbon;



use Livewire\Component;



class Create extends Component
{

    public $maintenance_contract_begindate;
    public $maintenance_contract_enddate;
    public $maintenance_contract_document;

    public $maintenance_contract_type_id;
    public $maintenance_contract_option1 = 0;
    public $maintenance_contract_option2 = 0;
    public $maintenance_contract_option3 = 0;
    public $maintenance_contract_attachment;
    public $maintenancy_companie_id;
    public $maintenance_contract_id;
    public $maintenance_attachment;
    public $maintenance_status_id;
    public $elevator;
    public $maintenance_contract_companie_id;
    use WithFileUploads;
    
public $edit_id;


protected $rules = [
    'maintenance_contract_begindate' => 'required|date',
    'maintenance_contract_enddate' => 'required|date',

];




    public function render()
    {
        return view('livewire.company.elevators.maintenance-contracts.create',[
            "maintenancyCompanies" => maintenanceCompany::orderby("name")
            ->get() ,
        
        ]);
    }

    public function mount(Request $request){
        $this->elevator = Elevator::where('id', $request->elevator_id)->first();
    }


    
public function save()
{


    $this->validate();
 
 
        $this->maintenance_contract_companie_id = $this->elevator->maintenance_company_id;
 

   
    $maintenancie_contract = maintenanceContract::updateOrCreate(['id' => $this->maintenance_contract_id, ], ['enddate' => $this->maintenance_contract_enddate, 'begindate' => $this->maintenance_contract_begindate, 'elevator_id' => $this
        ->elevator->id

    ]);
    $filepath = "/uploads/".$this->elevator->id . "/maintenance_contracts/".$maintenancie_contract->id ."/";

 


  if ($this->maintenance_contract_attachment != $maintenancie_contract->attachment )

  {

      $filename = preg_replace('/\s+/', '_', $this
          ->maintenance_contract_attachment
          ->getClientOriginalName());

      $this
          ->maintenance_contract_attachment
          ->storePubliclyAs($filepath, $this
          ->maintenance_contract_attachment
          ->getClientOriginalName());

      $maintenancie_contract->update(['attachment' => $filepath . "/" . $this
          ->maintenance_contract_attachment
          ->getClientOriginalName() ,
      //  'document'       => $filepath . "/".   $this->attachmentDocument->getClientOriginalName()
      ]);

  }

  noty()
  ->layout('bottomRight')
  ->addInfo('Onderhoudscontract toegevoegd');
  return redirect('/elevator/show/' . $this->elevator->id );
 
 
    
}


}
