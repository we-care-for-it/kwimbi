<div>
 


<div class="page-header   ">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-header-title ">Keuring tovoegen</h1>
            </div>

            <div class="col-sm-6   text-end">
 
         
            <button type="button" onclick="history.back()"
                    class="text-danger btn btn-link btn-default btn-squared   btn-sm ">
                    <i class="fa-solid fa-rotate-left"></i> Afbreken
                </button>


            <button type="button" class="btn btn-primary   btn-120" wire:click="save()">
                    Opslaan
                </button>

            
            </div>
        </div>
    </div>
   <div class="row">



   
   <div class="col-md-3">
   
 
            @livewire('company.elevators.partials.information', ['elevator' => $elevator])
</div>
         
    

                
        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-content-md-between  ">

              Keuring gegevens
                </div>

                <div class = "card-body">
                <div class="row">
      <div class="col-md-2">
      <label class = "mb-2"> Uitvoeringsdatum </label>
      <br>
      <input wire:model = "inspection_executed_datetime" class=" @if ($errors->has('inspection_executed_datetime'))  is-invalid @endif form-control" type="date">
      </div>
      <div class="col-md-4">
      <div style = "padding-top: 30px;">
      <button type="button" class="btn btn-soft-primary" wire:click = "addMonthsInspection(12)" > + 1 jaar </button>
      <button type="button" class="btn btn-soft-primary"   wire:click = "addMonthsInspection(18)"> + 1,5 jaar </button>
      </div>
      </div>
      <div class="col-md-2">
      <label class = "mb-2"> Einddatum </label>
      <br>
      <input wire:model = "inspection_end_date" class=" @if ($errors->has('inspection_end_date'))  is-invalid @endif form-control" type="date">
      </div>
      </div>
      <br>
      <div class="row">
      <div class="col-md-6">
      <label class = "mb-2"> Status </label>
      <br>
      <select wire:model = "inspection_status_id" class="form-select">
      <option selected value="1" >Goedgekeurd</option>
      <option value="2">Goedgekeurd met acties</option>
      <option value="3">Afgekeurd</option>
      <option value="4">Onbeslist</option>
      <option value="5">Niet afgerond</option>
      </select>
      </div>
      <div class="col-md-6">
      <label class = "mb-2"> Opmerking </label>
      <br>
      <textarea wire:model = "inspection_remark" class="form-control"></textarea>
      <br> 
      </div>
      <div class="row   p-2" >
      <div class="col-md-6">
      <label class = "mb-2">Keuringsrapportage</label>
      <div wire:loading>
      </div>
      @if($attachmentDocument)
      <br>
    
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="delete_temp_document()"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('attachmentDocument'))  is-invalid @endif form-control " type="file" wire:model="attachmentDocument">
      @endif


      </div>
      <div class="col-md-6 ">
      <label  class = "mb-2" >Certificaat</label>


      @if($attachmentCertification)
      <br>
    
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="delete_temp_certification()"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('attachmentCertification'))  is-invalid @endif form-control " type="file" wire:model="attachmentCertification">
      @endif

 
 
      </div>
      </div>
      </div>
               
                                 </div>
                              </div>
                           </div>

 
                </div>
            </div>

 