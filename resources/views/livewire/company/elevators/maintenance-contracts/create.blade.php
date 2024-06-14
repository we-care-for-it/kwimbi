<div>

   <div class="page-header   ">
      <div class="row">
         <div class="col-sm-6">
            <h1 class="page-header-title ">Onderhoudcontract toevoegen</h1>
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

               Contractgegevens
            </div>

            <div class="card-body">

               <div class="row">
                  <div class="col-md-6">
                     <label class="pb-2">Begindatum</label>
                     <input wire:model.live="maintenance_contract_begindate"
                        class=" @if ($errors->has('maintenance_contract_begindate'))  is-invalid @endif form-control"
                        type="date">
                  </div>
                  <div class="col-md-6">
                     <label class="pb-2">Einddatum</label>
                     <input wire:model.live="maintenance_contract_enddate"
                        class=" @if ($errors->has('maintenance_contract_enddate'))  is-invalid @endif form-control"
                        type="date">
                  </div>
               </div>
               <div class="row ">

                  <div class="row pt-3">
                     <div class="col-md-12">
                        <label class="pb-2">Onderhoudscontract
                        </label>

                        @if($maintenance_contract_attachment)
                        <br>

                        <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                           wire:click="deleteMaintenaceContractDocument('{{$maintenance_contract_id}}')"
                           class="btn btn-soft-danger ">
                           <i class="fa-solid fa-trash"></i> Verwijder
                        </button>
                        @else
                        <br>
                        <input
                           class="  @if ($errors->has('maintenance_contract_attachment'))  is-invalid @endif form-control "
                           type="file" wire:model="maintenance_contract_attachment">
                        @endif

                     </div>

                  </div>

               </div>
            </div>