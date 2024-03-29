<div class="container-fluid">
   <div class="page-header     ">
      <div class="row align-items-center ">
         <div class="col">
 
         <h1 class="page-header-title pt-3">  {{$data->name}} -     {{$data->address}} {{$data->place}} </h1>
             </div>

         <div class="col-auto">
         <a href="/locations">
                    <button type="button" class="btn  btn-150  btn-link btn-sm  ">
                   Alle locaties
                    </button>
                </a>
 
                <button type="button" class="btn   btn-120 btn-primary btn-12 btn-sm"  wire:click = "save()" > 
                        Opslaan
                    </button>

                   


                
                </div>
    
         </div>
      </div>
 

 
   
   
 
 




    <div class="row  ">

        <div class="col-md-3 ">





        
      
        <div class="card-header card-header-content-md-between    ">

Afbeelding
</div>
            <div class = "card">     

            <div class = "card-body">
          
</div>

<div class = "card-body">
                <label class="avatar avatar-xxl   me-5" for="editAvatarUploaderModal">

                    @if ($image_db || $image )
                    <img class="avatar-img"
                        src="{{ $image ? $image->temporaryUrl() :  url('/storage/'.$image_db)  }}" />
                    @else
                    <img class=" avatar-img" src="/assets/img/160x160/img2.jpg" />
                    @endif

                    <input type="file" class="js-file-attach avatar-uploader-input" id="editAvatarUploaderModal"
                        data-hs-file-attach-options='{
                                 "textTarget": "#editAvatarImgModal",
                                 "mode": "image",
                                 "targetAttr": "src",
                                 "allowTypes": [".png", ".jpeg", ".jpg"]
                              }' wire:model.live="image" />

                    <span class="avatar-uploader-trigger">
                        <i class="bi-pencil-fill avatar-uploader-icon shadow-sm"></i>
                    </span>
                </label>

                <button type="button" wire:click="clearImage"
                    wire:confirm.prompt="Hiermee verwijder je de afbeelding van deze locatie. Weet je zeker dat je deze actie wilt uitvoeren?\n\nType AKKOORD om te bevestigen|AKKOORD"
                    class="js-file-attach-reset-img btn btn-white  m-4">Verwijder</button>
                    </div>       </div>


                    <div class="card mt-3 bg-light">
<div class="card-body">

      <b>{{$data->customer?->name}}</b>
      <br>
      {{$data->customer?->address}} {{$data->customer?->place}}

</div>
</div>
 



            <div class = "card mt-3">      <div class = "card-body">
            <label class="pb-2  ">Gebouwtype</label>
 
            <input   wire:model.live="building_type" class="form-control">
            

            <label class="pb-2 pt-3">Beheerder</label>

            <div class="tom-select-custom  ">
                <select wire:model.live="management_id" class="js-select form-select" autocomplete="off"
                    data-hs-tom-select-options='{
                                        "placeholder": "Selecteer een optie"
                                      }'>

                    @foreach($managementCompanies as $managementCompany).

                    <option value="{{$managementCompany?->id}}">{{$managementCompany?->name}}</option>

                    @endforeach

                    <option @if($management_id) selected @endif value="{{$management_id}}"></option>

                </select>
            </div>

            <label class="pb-2 pt-3">Complexnummer</label>
            <input style="width: 200px;" wire:model="complexnumber" class="form-control">
            </div>         </div>
        </div>

        <div class="col-md-9">


        <div class="card-header card-header-content-md-between  ">

Locatie
</div>





            <div class="card">
           

                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label class="pb-2">Naam</label>
                                <input wire:model="name"
                                    class="form-control    @error('name') is-invalid   @enderror  ">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <div class="row">
                                <div class="col-md-3">
                                    <label class="pb-2 pt-3">Postcode</label>
                                    <input
                                        class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif "
                                        wire:model.defer="zipcode"  >

                                </div>
                                <div class="col-md-4">
                                    <label class="pb-2 pt-3">Huisnummer</label>
                                    <input
                                        class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif "
                                        wire:model.defer="housenumber" >

                                </div>
                                <div class="col-md-3 ">
                                <label class="pb-2 pt-3"> </label>
                                <button class="btn btn-soft-primary btn-sm mt-7" 
                                        wire:click="checkZipcode" data-toggle="tooltip" data-placement="top"
                                        title="Zoek naar postcode" wire:keydown="checkZipcode" style="height: 40px;">
                                        <i class="bi-search"></i>
                                    </button>
                                
                                </div>
                            </div>

                            <div class="pt-3">
                                <label class="pb-2">Plaats</label>
                                <input wire:model="place" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="pt-3">
                                <label class="pb-2">Adres</label>
                                <input wire:model="address" class="form-control">
                            </div>

                            <label class="pb-2 pt-3">Provincie</label>
                            <input wire:model="province" class="form-control">

                        </div>

                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <label class="pb-2 pt-3">GPS Longitude</label>
                            <input wire:model="gps_lon" class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="pb-2 pt-3">GPS latitude</label>
                            <input wire:model="gps_lat" class="form-control">
                        </div>

                        <div class="col-md-6">
                            <label class="pb-2 pt-3">Gemeente</label>
                            <input wire:model="municipality" class="form-control">
                        </div>

                    </div>
                </div>
            </div>


            <div class="card-header card-header-content-md-between mt-3  ">

Notitie
</div>
            <div class="card  ">
            

                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">

                            <textarea wire:model="remark"  class="js-count-characters form-control"
                                wire:model="description" name="description" class="form-control" rows="5" maxlength="100"
                                data-hs-count-characters-options='{
            "output": "#maxLengthCountCharacters"
          }'>{{ old('name',@$project->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3 card-header card-header-content-md-between  ">

Toegang
</div>
            <div class="card ">
           

                <div class="card-body  ">
                    <div class="row">
                        <div class="col-md-3">
                            <label class="pb-2">Type toegang</label>
                            <div wire:ignore class="tom-select-custom ">
                                <select wire:model="building_acces_type_id" class="js-select form-select"
                                    autocomplete="off" data-hs-tom-select-options='{
                              "placeholder": "Selecteer een optie"
                            }'>

                                    <option value=""></option>
                                    @foreach(config('globalValues.building_access_types') as $key => $value)
                                    <option value="{{ $key }}">
                                        {{$value}}
                                    </option>
                                    @endforeach

                                    @if($building_access_type_id)
                                    <option @if($building_access_type_id) selected @endif
                                        value="{{$building_access_type_id}}">
                                        {{config('globalValues.building_types')[$building_access_type_id]}}</option>
                                    @endif

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <label class="pb-2">Code</label>
                            <input wire:model="access_code" class="form-control">
                        </div>
                        <div class="col-md-6">
                            <label class="pb-2">Contactpersoon</label>
                            <input wire:model="access_contact" class="form-control">
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <label class="pb-2 pt-3">Locatie sleutelkluis</label>
                            <input wire:model="location_key_lock" class="form-control">
                        </div>
                    </div>

                </div>
            </div>
            <div class="card-header mt-3 card-header-content-md-between  ">

Bouwgegevens
</div>

            <div class="card ">
        
                <div class="card-body  ">
                    <div class="row">

                        <div class="row">
                            <div class="col-md-3">
                                <label class="pb-2">Bouwjaar</label>
                                <input wire:model="construction_year" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="pb-2">Verdiepingen</label>
                                <input wire:model="levels" class="form-control">
                            </div>

                            <div class="col-md-3">
                                <label class="pb-2">Oppervlakte</label>
                                <input wire:model="surface" class="form-control">
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </div>