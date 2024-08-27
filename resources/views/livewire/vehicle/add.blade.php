<div>
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Voertuig toevoegen</h1>
            </div>
            <div class="col-auto">
            <button type="button" onclick="history.back()"
                    class="text-danger btn btn-link btn-default btn-squared   btn-sm ">
                    <i class="fa-solid fa-rotate-left"></i> Afbreken
                </button>
            
                <button class="btn btn-primary btn-sm btn-120    disabled" wire:click="save()" type="button"
                  wire:dirty.remove.class="disabled">
                  <div wire:loading wire:target="save">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan</button>

            </div>
        </div>
    </div>

    <div class="row ">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-body">

                <center>
<div class="kenteken2">
  <div class="inset2">
    <div class="blue2"></div>
    <input class = "@error('kenteken') is-invalid   @enderror" wire:model="kenteken"  type="text" placeholder="XP-004-T" value="" /> 
    @error('kenteken') <span class="invalid-feedback">{{ $message }}</span> @enderror
                 

  </div>
</div>
</center>         
                   
<center> 
<button class="btn btn-sm btn-primary mt-5    " wire:click="getDataFromRDW()" type="button"
                  >
                  <div wire:loading wire:target="getDataFromRDW">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Gegevens ophalen
            </div>

            </center> 
 
 
            </div>

        </div>
        <div class="col-md-9">
            <div class="card ">
                <div class="card-header">
                    Algemeen
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <label class="pb-2 ">Voertuigcategorie</label>
                            <input class="form-control required   " wire:model.defer="voertuigsoort">

                            <label class="pb-2 pt-3">Inrichtng</label>
                            <input class="form-control required   " wire:model.defer="inrichting">

                        </div>

                        <div class="col-md-4">
                            <label class="pb-2 ">Merk</label>
                            <input class="form-control required   " wire:model.defer="merk">
                            <label class="pb-2 pt-3 ">Type</label>
                            <input class="form-control required   " wire:model.defer="type">
                            <label class="pb-2 pt-3 ">Variant</label>
                            <input class="form-control required   " wire:model.defer="variant">

                        </div>

                        <div class="col-md-4">
                            <label class="pb-2 ">Handelsbenaming</label>
                            <input class="form-control required   " wire:model.defer="handelsbenaming">
                            <label class="pb-2 pt-3 ">Kleur</label>
                            <input class="form-control required   " wire:model.defer="eerste_kleur">
                            <label class="pb-2 pt-3 ">Uitvoering</label>
                            <input class="form-control required   " wire:model.defer="uitvoering">

                        </div>

                    </div>
                </div>
            </div>

            <div class="card mt-3 ">
                <div class="card-header">
                    Fiscaal
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4"> <label class="pb-2  ">Catalogusprijs</label>
                            <input class="form-control required   " wire:model.defer="catalogusprijs">

                        </div>
                        <div class="col-md-4">

                            <label class="pb-2   ">Bruto BPM</label>
                            <input class="form-control required   " wire:model.defer="bruto_bpm">

                        </div>
                    </div>

                </div>
            </div>

            <div class="card mt-3 ">
                <div class="card-header">
                    Eigenschappen
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">

                            <label class="pb-2   ">Aantal zitplaatsen</label>
                            <input class="form-control required   " wire:model.defer="aantal_zitplaatsen">

                            <label class="pb-2  pt-3 ">Aantal rolstoelplaatsen</label>
                            <input class="form-control required   " wire:model.defer="aantal_rolstoelplaatsen">

                        </div>

                        <div class="col-md-4">

                            <label class="pb-2    ">Wielbasis</label>
                            <input class="form-control required   " wire:model.defer="wielbasis">

                            <label class="pb-2  pt-3  ">Aantal wielen </label>
                            <input class="form-control required   " wire:model.defer="aantal_wielen">
                            <label class="pb-2   pt-3">Aantal deuren</label>
                            <input class="form-control required   " wire:model.defer="aantal_deuren">

                        </div>

                        <div class="col-md-4">

                            <label class="pb-2   ">lengte</label>
                            <input class="form-control required   " wire:model.defer="lengte">

                            <label class="pb-2  pt-3 ">Breedte</label>
                            <input class="form-control required   " wire:model.defer="breedte">

                        </div>
                    </div>

                </div>
            </div>

            <div class="card mt-3 ">
                <div class="card-header">
                    Vervaldata en historie
                </div>
                <div class="card-body">

                </div>
            </div>

            <div class="card mt-3 ">
                <div class="card-header">
                    Gewichten
                </div>
                <div class="card-body">

                </div>
            </div>

        </div>
    </div>