<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                    locatie wijzigen
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
 

        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-content-md-between  ">

                    Gegevens
                </div>
                <div class="card-body">
                    <div class = "row">
                        <div class = "col-md-12">
                           <div>
                              <label class = "pb-2">Naam</label>
                              <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                              @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                           </div>
                        </div>
                     </div>
                     <div class = "row">
                        <div class = "col-md-6">
                           <div class  = "pt-3">
                              <label class = "pb-2">Postcode</label>
                              <div class="input-group  ">
                                 <input class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif " wire:model.defer="zipcode">
                                 <div class="input-group-append">
                                    <button class = "btn btn-soft-primary" style = "height: 43px" wire:click = "checkZipcode"  data-toggle="tooltip" data-placement="top" title="Zoek naar postcode" wire:keydown="checkZipcode" style = "height: 40px;">
                                    <i class="bi-search"></i>
                                    </button>
                                 </div>
                                 @if ($errors->has('zipcode')) <span class="text-danger">Postcode formaat niet juist</span> @endif
                              </div>
                           </div>
                           <div class  = "pt-3">
                              <label class = "pb-2">Plaats</label>
                              <input wire:model = "place"  class  = "form-control">
                           </div>
                        </div>
                        <div class = "col-md-6">
                           <div class  = "pt-3">
                              <label class = "pb-2">Adres</label>
                              <input wire:model = "address"  class  = "form-control">
                           </div>
                        </div>
                     </div>
                     <hr>
                     <div class = "row">
                         
                </div>
            </div>
        </div>

    </div>
</div>
 