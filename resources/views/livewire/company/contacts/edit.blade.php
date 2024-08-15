<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                    Contactpersoon toevoegen
            </div>
            <div class="col-auto">
                <button type="button" class="btn btn-primary btn-sm  btn-120" wire:click="save()">
                    Opslaan
                </button>
                <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  ">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">         
            
        <div class="row">

<div class="col-md-12">

 
<div class="card-header   ">

Relatie
</div>

<div class="card  bg-light">
<div class="card-body">
 
      <b>{{$data?->customer?->name}}</b>
      <br>
      {{$data?->customer?->address}} {{$data->customer?->place}}
 
</div>
</div>
</div>
</div>
        </div>

        <div class="col-md-9">
        <div class="card-header    ">

Gegevens
</div>

            <div class="card">
         

                <div class="card-body">
                <div class = "row">
                  <div class = "col-md-12">
                     <div>
                        <label class = "pb-2">Naam</label>
                        <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>


                     <div class = "row">
                        <div class = "col-md-12">
                           <div class  = "pt-3">
                              <label class = "pb-2">Emailadres</label>
                              <input wire:model = "email"  class  = "form-control">
                           </div>
                       
                        </div>
                     </div>

                     <div class = "row">
                        <div class = "col-md-3">
                           <div class  = "pt-3">
                              <label class = "pb-2">Functie</label>
                              <input wire:model = "function"  class  = "form-control">
                           </div>
                       
                        </div>
                        <div class = "col-md-3">
                        <div class  = "pt-3">
                              <label class = "pb-2">Telefoonnummer</label>
                              <input wire:model = "phonenumber"  class  = "form-control">
                           </div>  </div>

                     </div>


                  </div>
           
               </div>
                </div>
            </div>
        </div>

    </div>
</div>
 