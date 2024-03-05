<?php
namespace App\Http\Livewire\Company\Elevators;

use Livewire\Component;
use Illuminate\Http\Request;
 

use Illuminate\Support\Str;
use App\Models\Elevator;
use App\Models\Debtor;
use App\Models\Statuses;
use App\Models\Address;
use App\Models\Supplier;
use App\Models\Incident;
use App\Models\Inspection;
use App\Models\Maintenance;
use App\Models\maintenanceContract;
use App\Models\InspectionCompany;


use Spatie\MediaLibraryPro\Livewire\Concerns\WithMedia;



class Show extends Component
{

   
    public $object;
    public $file_attachment = [];
    public $file_description;
    public $file_collection;
    use WithMedia;

    public function render(Request $request)
    {

 
 
        $this->object = Elevator::find($request->id);
 
        return view('livewire.company.elevators.show',
        [
            'object' => $this->object,
         
        ]);
    }
 

    
    public function uploadFile(Request $request){

        $formSubmission = YourModel::create([
            'name' => $this->name,
        ]);

        $formSubmission
            ->addFromMediaLibraryRequest($this->file_attachment)
            ->toMediaCollection($this->collection);

            
        // $yourModel = Elevator::find($this->object->id);
        // $yourModel->addMedia($this->)->withCustomProperties(['description' => $this->file_attachment])->toMediaCollection($this->);
       pnotify()->addSuccess('Bestand toegevoegd');
    }

}

