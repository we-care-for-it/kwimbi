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
 





<div class="card  ">
         

         <div class="card-body">


 

         <label for="ernergie_label" class="pb-2 pt-2">Status</label>
                   <div class="tom-select-custom " wire:ignore>
                      <select
                         class="js-select form-select"
                         wire:model.live ="status_id"
                         data-hs-tom-select-options='{
                         "placeholder": "Selecteer een status",
                         "hidePlaceholderOnSearch" : true,
                         "hideSearch": false,
                         "allowEmptyOption": true
                         }'
                         class="ts-wrapper js-select form-select form-select-sm tom-select-form-select-ps-0 single plugin-change_listener plugin-hs_smart_position input-hidden full has-items js-select_style"
                         id="locationLabel"
                         >
                         <option value="1" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-success"></span> <span class="text-truncate">Operationeel</span></span>' @if($status_id==1) selected @endif> </option>
                         <option  value="2" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-danger"></span> <span class="text-truncate">Lift buiten gebruik</span></span>' @if($status_id==2) selected @endif> </option>
                      </select>
                   </div>




                   <label for="ernergie_label" class="pb-2 pt-2">Type</label>
                   <div class="tom-select-custom " wire:ignore>
                      <select style="height: 40px;" wire:model = "object_type_id"
                      class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een type",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'
                      @foreach(config('globalValues.object_types') as $key => $value)
                      <option 
                         value="{{ $key }}" @if($object_type_id== $key) selected @endif >
                         {{$value}}
                      </option>
                      @endforeach
                      </select>
                   </div>

<div class = "clear-fix pt-4"></div>
 
                   <div class="form-check form-switch mb-4">
                      <input @if($stretcher_elevator) checked @endif  wire:model="stretcher_elevator"  value="1" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Brancardlift</label>
                   </div>
                   <div class="form-check form-switch mb-4">
                      <input @if($fire_elevator) checked @endif  value = "1" wire:model.live="fire_elevator" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Brandweerlift</label>
                   </div>
                   <div class="form-check form-switch mb-4">
                      <input  @if($speakconnection) checked  @endif value = "1" wire:model="speakconnection" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Spreek / luister</label>
                   </div>



                   <label for="construction_year" class="pb-2">Bouwjaar</label>
                      <input class="form-control @error('construction_year') is-invalid @enderror"
                         wire:model="construction_year" type="text"
                         >
                      @error('construction_year')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <label for="ernergie_label" class="pb-2 pt-2">Stopplaatsen</label>
                      <input type="number" wire:model = "stopping_places" class="form-control">

         </div></div>   
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
          
                  <div class="row">
             <div class="col-md-4">
                <label class="pb-2 ">Relatie</label>
 
                <div class="tom-select-custom"   >
                   <select   wire:change = "search_locations_by_relation()" wire:model.live = "customer_id" autocomplete="off" class="js-select form-select @error('customer_id') is-invalid   @enderror "
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een relatie",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'>
                      <option selected value="">Selecteer een relatie</option>
                      @foreach($customers as $customer)
                      <option value="{{ $customer->id }}"  @if($customer_id==$customer->id) selected  @endif >
                         {{ $customer->name }}
                      </option>
                      @endforeach
                   </select>
                </div>

                <label class="pb-2   pt-2">Locatie</label>
 
 <div class="tom-select-custom" w >
    <select   wire:model = "address_id" autocomplete="on" class="js-select form-select @error('address_id') is-invalid   @enderror "
       data-hs-tom-select-options='{
       "placeholder": "Selecteer een locatie",
       "hidePlaceholderOnSearch" : true,
       "hideSearch": false,
       "allowEmptyOption": true
       }'>
       <option selected value="">Selecteer een locatie</option>
       @foreach($locations as $location)

       <option value="{{ $location->id }}" data-option-template='<div class="d-flex align-items-start"><div class="flex-shrink-0"><div class="flex-grow-1 ms-2"><span class="d-block fw-semibold">@if($location->name)      {{ $location->name }} @else Geen naam @endif</span><span class="tom-select-custom-hide small">{{ $location->address }} {{ $location->housenumber }} {{ $location->place }} </span></div></div>' @if($address_id==$location->id) selected  @endif >@if($location->name)      {{ $location->name }} @else Geen naam @endif</option>


 
       @endforeach
    </select>
 </div>

 <label class="pb-2   pt-2">Leverancier</label>
 
 <div class="tom-select-custom" wire:ignore.self>
    <select   wire:model = "supplier_id" autocomplete="on" class="js-select form-select @error('address_id') is-invalid   @enderror "
       data-hs-tom-select-options='{
       "placeholder": "Selecteer een locatie",
       "hidePlaceholderOnSearch" : true,
       "hideSearch": false,
       "allowEmptyOption": true
       }'>
       <option selected value="">Selecteer een locatie</option>
       @foreach($suppliers as $supplier)

       <option value="{{ $supplier->id }}"  @if($supplier==$supplier_id) selected  @endif >
                         {{ $supplier->name }}
                      </option>
 
       @endforeach
    </select>
 </div>


 
            
                
             </div>
             <div class="col-md-4">
                <label for="address_id" class="pb-2">Keuringinstantie</label>
                <div class="tom-select-custom "   wire:ignore>
                   <select wire:model = "inspection_company_id" style="height: 40px;" autocomplete="off" class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een instantie",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'>
                      <option value="">Selecteer een keuringsinstanties</option>
                      @foreach($inspectionCompanys as $relatedItem)
                      <option value="{{ $relatedItem->id }}" @if($relatedItem->id == $inspection_company_id ) selected @endif>
                         {{ $relatedItem->name }}
                      </option>
                      @endforeach
                   </select>
                </div>
                @error('inspection_company_id')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="address_id" class="pb-2 pt-2">Onderhoudspartij</label>
                <div class="tom-select-custom "   wire:ignore>
                   <select wire:model = "maintenance_company_id" style="height: 40px;" autocomplete="off" class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een onderhoudspartij",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'>
                      <option value="">Selecteer een keuringsinstanties</option>
                      @foreach($maintenanceCompanys as $relatedItem)
                      <option   value="{{ $relatedItem->id }}" @if($relatedItem->id == $maintenance_company_id ) selected @endif>
                      {{ $relatedItem->name }}
                      </option>
                      @endforeach
                   </select>
                </div>
             </div>
             <div class="col-md-4">
                <div class="row">
                   
                   <div class="col-md-6">
                      <label for="ernergie_label" class="pb-2 ">Energielabel</label>


                      <div class="tom-select-custom "   wire:ignore>
                   <select wire:model = "energy_label" style="height: 40px;" autocomplete="off" class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een onderhoudspartij",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }' >
                        <option  value="" >-</option>
                        <option @if($energy_label  == 'A') selected @endif value="A" > A </option>
                        <option @if($energy_label  == 'B') selected @endif value="B" > B </option>
                        <option @if($energy_label  == 'C') selected @endif value="C" > C </option>
                        <option @if($energy_label  == 'D') selected @endif value="D" > D </option>
                        <option @if($energy_label  == 'E') selected @endif value="E" > E </option>
                        <option @if($energy_label  == 'F') selected @endif value="F" > F </option>
                        <option @if($energy_label  == 'G') selected @endif value="G" > G </option>
                   </select>
           
                      </div>
                      <label for="ernergie_label" class="pb-2 pt-2">Nobo nummer</label>
                      <input type="text" wire:model = "nobo_no" class="form-control">
                      <label for="ernergie_label" class="pb-2 pt-2">Unit nummer</label>
                      <input type="text" wire:model = "unit_no" class="form-control">
                   </div>
                </div>
             </div>
          </div>
 

                  </div>
           
               </div>
                </div>
            </div>

<div class="card-header py-4  ">

Opmerking
</div>
<div class="card  ">
 
    <div class="card-body ">
        <div class="row">
            <div class="col-md-12">

                <textarea wire:model.live="remark" class="js-count-characters form-control"
                     rows="4" maxlength="100"
                    data-hs-count-characters-options='{
"output": "#maxLengthCountCharacters"
}'>{{$remark}}</textarea>
            </div>
        </div>
    </div>
</div>
        </div>

    </div>
</div>
 