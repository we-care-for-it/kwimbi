<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
            Onderhoudsbeurt toevoegen
         </div>
         <div class="col-auto">

         

                        <button type="button" onclick="history.back()"
               class="btn   btn-link btn-sm   ">
            <i class="fa-solid fa-arrow-left"></i>
            </button>
            <button type="button"     class="btn btn-soft-success btn-sm  btn-120" style = "pull-right" wire:click="save()">
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

              Onderhoudgegevens
                </div>

                <div class = "card-body">

                <div class="row">
                              <div class="col-md-4">
                                 <label  class = "mb-3"> Plandatum </label>
                                 <br>
                                 <input wire:model.defer = "maintenance_planned_at" class=" @if ($errors->has('maintenance_planned_at'))  is-invalid @endif form-control" type="date">
                              </div>
                              <div class="col-md-4">
                                 <label  class = "mb-3"> Uitvoeringsdatum </label>
                                 <br>
                                 <input wire:model.defer = "maintenance_executed_datetime" class=" @if ($errors->has('maintenance_executed_datetime'))  is-invalid @endif form-control" type="date">
                              </div>
                              <div class="col-md-4">
                                 <label  class = "mb-3"> Status </label>
                                 <br>
                                 <select wire:model.defer = "maintenance_status_id" class="form-select">
                                    <option value="1" >Gepland</option>
                                    <option value="2" selected>Uitgevoerd</option>
                                 </select>
                              </div>
                           </div>
                           <br>
                           <div class="row">
                              <div class="col-md-12">
                                 <label class = "mb-3"> Opmerking </label>
                                 <br>
                                 <textarea wire:model = "maintenance_remark" class="form-control"></textarea>
                              </div>
                              <br> 
                              <div class="row">
                                 <div class="col-md-6">
                                    <label class = "mb-3"> <br>Bijlage</label>
                                   

                                    @if($maintenance_attachment)
      <br>
    
      <button wire:confirm = "Weet je zeker dat je deze bijlage wilt verwijderen ?"    wire:click="delete_temp_attachment()"  class="btn btn-soft-danger ">
      <i class="fa-solid fa-trash"></i> Verwijder
      </button>
      @else
      <br>
      <input class="  @if ($errors->has('maintenance_attachment'))  is-invalid @endif form-control " type="file" wire:model="maintenance_attachment">
      @endif


 
                                 </div>
                              </div>
                           </div>

</div>
                </div>
                </div>
            </div>

</div> 