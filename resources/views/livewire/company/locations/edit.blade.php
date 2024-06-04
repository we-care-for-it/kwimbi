<div>
    <div class="page-header   ">
        <div class="row">
            <div class="col-sm-6">
            <h1 class="page-header-title  "> @if($name)
                    {{$name}} @else Geen naam @endif
                    </h1>         </div>

            <div class="col-sm-6   text-end">
                <button type="button" onclick="history.back()"
                    class="text-danger btn btn-link btn-default btn-squared   ">
                    <i class="fa-solid fa-rotate-left"></i> Afbreken
                </button>

                <button wire:click="save()" wire:loading.attr="disabled" class="btn   btn-primary   btn-120" " 
         wire:click=" addUpload()" type="button">
                    <div wire:loading>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    </div>
                    Opslaan
                </button>

            </div>
        </div>
    </div>

    <div class="row  ">

        <div class="col-md-3 ">

            <div class="card">
                <div class="card-header card-header-content-md-between    ">

                    Afbeelding
                </div>

                <div class="card-body text-center">
                    <label class="avatar avatar-xxl">

                        @if ($image_db || $image )
                        <img class="avatar-img border p-1 pb-0 mb-0" style="height: 100%px;"
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

                        <span class="avatar-uploader-trigger ">
                            <i class="bi-pencil-fill avatar-uploader-icon shadow-sm mr-4 mb-2 "></i>
                        </span>
                    </label>

                </div>

                <button type="button" wire:click="clearImage"
                    wire:confirm.prompt="Hiermee verwijder je de afbeelding van deze locatie. Weet je zeker dat je deze actie wilt uitvoeren?\n\nType AKKOORD om te bevestigen|AKKOORD"
                    class=" btn btn-link  ">Verwijder afbeelding</button>
            </div>

            <div class="card mt-3 bg-light">
                <div class="card-body">
                <label class = "required pb-2">Relatie</label>
                <div class="tom-select-custom  ">
                <select wire:ignore.self wire:model="customer_id" class="js-select form-select required" autocomplete="off"
                    data-hs-tom-select-options='{
                                        "placeholder": "Selecteer een relatie"
                                      }'>


                    <option selected value=""></option>
                    @foreach($customers as $customer)

                    <option value="{{$customer?->id}}"  @if($customer?->id == $customer_id) selected @endif >{{$customer?->name}}</option>

                    @endforeach


                </select>
            </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-body">
                    <label class="pb-2  ">Gebouwtype</label>

                    <input wire:model.live="building_type" class="form-control">

                    <label class="pb-2 pt-3">Beheerder</label>

                    <div class="tom-select-custom  ">
                        <select wire:model="management_id" class="js-select form-select" autocomplete="off"
                            data-hs-tom-select-options='{
                                        "placeholder": "Selecteer een optie"
                                      }'>

                                      <option value = ""></option>
                            @foreach($managementCompanies as $managementCompany).

                            <option value="{{$managementCompany?->id}}">{{$managementCompany?->name}}</option>

                            @endforeach

                            <option @if($management_id) selected @endif value="{{$management_id}}"></option>

                        </select>
                    </div>

                    <label class="pb-2 pt-3">Complexnummer</label>
                    <input style="width: 200px;" wire:model="complexnumber" class="form-control">
                </div>
            </div>
        </div>

        <div class="col-md-9">

            <div class="card">

                <div class="card-header   ">

                    Locatie
                </div>

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
                                        wire:model.defer="zipcode">

                                </div>
                                <div class="col-md-4">
                                    <label class="pb-2 pt-3">Huisnummer</label>
                                    <input
                                        class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif "
                                        wire:model.defer="housenumber">

                                </div>
                                <div class="col-md-3 ">
                                    <label class="pb-2 pt-3"> </label>
                                    <button class="btn btn-soft-primary btn-sm mt-7" wire:click="checkZipcode"
                                        data-toggle="tooltip" data-placement="top" title="Zoek naar postcode"
                                        wire:keydown="checkZipcode" style="height: 40px;">
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

            <div class="card   mt-3  ">

                <div class="card-header   ">

                    Notitie
                </div>
                <div class="card-body ">
                    <div class="row">
                        <div class="col-md-12">

                            <textarea wire:model="remark" class="js-count-characters form-control"
                                wire:model="description" name="description" rows="4" maxlength="100"
                                data-hs-count-characters-options='{
            "output": "#maxLengthCountCharacters"
          }'>{{ old('name',@$project->description) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card   mt-3  ">

                <div class="card-header   ">

                    Toegang</div>

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

            <div class="card   mt-3  ">

                <div class="card-header   ">

                    Bouwgegevens</div>

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