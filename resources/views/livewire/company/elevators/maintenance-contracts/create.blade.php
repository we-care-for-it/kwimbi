<div>
 
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
            Onderhoudscontract
         </div>
         <div class="col-auto">
            <button type="button"     class="btn btn-soft-success   btn-120" wire:click="save()">
            Opslaan
            </button>
            <button type="button" onclick="history.back()"
               class="btn btn-soft-secondary    ">
            <i class="fa-solid fa-arrow-left"></i>
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

              Contractgegevens
                </div>

                <div class = "card-body">

                <div class="row">
               <div class="col-md-6">
                  <label class = "pb-2">Begin datum</label>
                  <input wire:model.live = "maintenance_contract_begindate" class=" @if ($errors->has('maintenance_planned_at'))  is-invalid @endif form-control" type="date">
               </div>
               <div class="col-md-6">
                  <label class = "pb-2">Einddatum</label>
                  <input wire:model.live = "maintenance_contract_enddate" class=" @if ($errors->has('maintenance_executed_datetime'))  is-invalid @endif form-control" type="date">
               </div>
            </div>
            <div class="row ">
             

            
            <div class="row pt-3">
               <div class="col-md-12">
                  <label class = "pb-2">Onderhoudscontract  
                  </label>


@if($maintenance_contract_attachment)
      <br>
      
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="deleteMaintenaceContractDocument('{{$maintenance_contract_id}}')"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('maintenance_contract_attachment'))  is-invalid @endif form-control " type="file" wire:model="maintenance_contract_attachment">
      @endif


               
               </div>


</div>
    

</div>
                </div>
                       