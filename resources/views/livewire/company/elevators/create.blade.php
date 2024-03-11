<div>
    <div class="container-fluid">


    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach


    <form wire:submit="save">
       <div class="page-header  my-3">
          <div class="row align-items-center">
             <div class="col">
                <h1 class="page-header-title">
             Contactpersoon toevoegen
             </div>
             <div class="col-auto">
                <a href = "/elevator/create">
                <button type="button"   class="btn btn-primary btn-sm  btn-120"  type="submit">
                Opslaan
                </button></a>
                <button type="button" onclick="history.back()"
                   class="btn btn-secondary btn-sm  ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>      
             </div>
          </div>
       </div>

       <div>
          <div class="row">
             <div class="col-md-12 pb-3">
                <label for="ernergie_label" class="pb-2 pt-2">Naam</label>
                <input type="text" wire:model = "name" class="form-control">
             </div>
          </div>
          <div class="row">
             <div class="col-md-4">
                <label class="pb-2 ">Relatie</label>
                <div class="tom-select-custom"  wire:ignore.self>
                   <select   wire:change = "search_loctions_by_relation()" wire:model.live = "customer_id" autocomplete="off" class="js-select form-select @error('name') is-invalid   @enderror "
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een relatie",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'>
                      <option selected value="">Selecteer een relatie</option>
                      @foreach($customers as $customer)
                      <option value="{{ $customer->id }}">
                         {{ $customer->name }}
                      </option>
                      @endforeach
                   </select>
                </div>
                @error('customer_id') <span class="invalid-feedback">Relatie is een verplicht veld </span> @enderror
                <label for="address_id" class="pb-2 pt-2">Adres</label>
                <div class="tom-select-custom " wire:ignore.self  >
                   <select wire:model = "location_id"  autocomplete="off" class="js-select form-select"
                      data-hs-tom-select-options='{
                      "placeholder": "Selecteer een locatie",
                      "hidePlaceholderOnSearch" : true,
                      "hideSearch": false,
                      "allowEmptyOption": true
                      }'>
                      <option selected value="">Selecteer een locatie</option>
                      @foreach($locations_relation as $relatedItem)
                      <option value="{{ $relatedItem->id }}">
                         {{ $relatedItem->name }}
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
                      <option value="{{ $relatedItem->id }}">
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
                      <option @if($relatedItem->id  == $maintenance_company_id) selected @endif value="{{ $relatedItem->id }}">
                      {{ $relatedItem->name }}
                      </option>
                      @endforeach
                   </select>
                </div>
             </div>
             <div class="col-md-4">
                <div class="row">
                   <div class="col-md-6">
                      <label for="construction_year" class="pb-2">Bouwjaar</label>
                      <input class="form-control @error('construction_year') is-invalid @enderror"
                         wire:model="construction_year" type="text"
                         >
                      @error('construction_year')
                      <div class="invalid-feedback">{{ $message }}</div>
                      @enderror
                      <label for="ernergie_label" class="pb-2 pt-2">Stopplaatsen</label>
                      <input type="number" wire:model = "stopping_places" class="form-control">
                   </div>
                   <div class="col-md-6">
                      <label for="ernergie_label" class="pb-2 ">Energielabel</label>
                      <div class="tom-select-custom " wire:ignore>
                         <select wire:model = "energy_label" style="height: 40px;" class="js-select form-select ">
                            <option value="A" > A </option>
                            <option value="B" > B </option>
                            <option value="C" > C </option>
                            <option value="D" > D </option>
                            <option value="E" > E </option>
                            <option value="F" > F </option>
                            <option value="G" > G </option>
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
          <div class="row pt-3">
             <hr>
             <div class= "row">
                <div class = "col-md-4">
                   <label class="pb-2 ">Leverancier</label>
                   <div class="tom-select-custom " wire:ignore.self  >
                      <select wire:model = "supplier_id"  autocomplete="off" class="js-select form-select"
                         data-hs-tom-select-options='{
                         "placeholder": "Selecteer een leverancier",
                         "hidePlaceholderOnSearch" : true,
                         "hideSearch": false,
                         "allowEmptyOption": true
                         }'>
                         <option value="">Selecteer een leverancier</option>
                         @foreach($suppliers as $supplier)
                         <option value="{{ $supplier->id }}">
                            {{ $supplier->name }}
                         </option>
                         @endforeach
                      </select>
                   </div>
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
                         <option value="1" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-success"></span> <span class="text-truncate">Operationeel</span></span>'> </option>
                         <option value="2" data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-danger"></span> <span class="text-truncate">Lift buiten gebruik</span></span>'> </option>
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
                         value="{{ $key }}">
                         {{$value}}
                      </option>
                      @endforeach
                      </select>
                   </div>
                </div>
                <div class = "col-md-4">
                   <div class="form-check form-switch mb-4">
                      <input  wire:model="stretcher_elevator"  value="1" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Brancardlift</label>
                   </div>
                   <div class="form-check form-switch mb-4">
                      <input  value = "1" wire:model.live="fire_elevator" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Brandweerlift</label>
                   </div>
                   <div class="form-check form-switch mb-4">
                      <input  value = "1" wire:model="speakconnection" type="checkbox" class="form-check-input" id="formSwitch2"  >
                      <label class="form-check-label" for="formSwitch2">Spreek / luister</label>
                   </div>
                </div>
                <div class = "col-md-4">
                   <label for="ernergie_label" wire:model = "remark" class="pb-2  ">Opmerking</label>
                   <textarea wire:model = "remark" class="form-control"></textarea>
                </div>
                <br>
             </div>
          </div>
        </div>
    </form>
    </div> </div>