<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
       Liften overzicht
         </div>
         <div class="col-auto">
            <button type="button"  data-bs-toggle="modal" data-bs-target="#crudModal"   wire:click="clear()" class="btn btn-primary btn-sm  btn-120" wire:click="clear()">
            Toevoegen
            </button>
            <button type="button" onclick="history.back()"
               class="btn btn-secondary btn-sm  ">
            <i class="fa-solid fa-arrow-left"></i>
            </button>
         </div>
      </div>
   </div>
   <div class="row">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header card-header-content-md-between  ">
               <div class="mb-2 mb-md-0">
                  <form>
                     <!-- Search -->
                     <div class="input-group input-group-merge">
                        <input type="text"  wire:model.live="filters.search" wire:change="resetPageAfterSearch()" class="js-form-search form-control" placeholder="Zoeken op trefwoord..."
                           data-hs-form-search-options='{
                           "clearIcon": "#clearIcon2",
                           "defaultIcon": "#defaultClearIconToggleEg"
                           }'>
                        <button type="button" class="input-group-append input-group-text">
                        <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                        <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
                        </button>
                     </div>
                     <!-- End Search -->
                  </form>
               </div>
               <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                  <div class="d-flex align-items-center justify-content-center">
                     <div wire:loading.delay class="loading_indicator_small"></div>
                  </div>
                  <!-- Datatable Info -->
                  <div id="datatableCounterInfo" style="display: none;">
                     <div class="d-flex align-items-center">
                        <span class="fs-5 me-3">
                        <span id="datatableCounter">0</span>
                        Selected
                        </span>
                        <a class="btn btn-outline-danger btn-sm" href="javascript:;">
                        <i class="bi-trash"></i> Delete
                        </a>
                     </div>
                  </div>
                  <!-- End Datatable Info -->
                  <!-- Dropdown -->
                  <!-- <div class="dropdown">
                     <button type="button" class="btn btn-white  dropdown-toggle w-100" id="usersExportDropdown" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi-download me-2"></i> Exporteren</button>
                     <div class="dropdown-menu dropdown-menu-sm-end" aria-labelledby="usersExportDropdown" style="">
                        <span class="dropdown-header">Opties</span>
                        <a wire:click="export('xlsx')" id="export-excel" class="dropdown-item" href="javascript:;">
                        Excel
                        </a>
                        <a id="export-csv" wire:click="export('csv')" class="dropdown-item" href="javascript:;">
                        .CSV
                        </a>
                        <a id="export-pdf" wire:click="export('pdf')" class="dropdown-item" href="javascript:;">
                        PDF
                        </a>
                        <a id="export-pdf" wire:click="export('html')" class="dropdown-item" href="javascript:;">
                        HTML
                        </a>
                     </div>
                     </div> -->
                  <!-- End Dropdown -->
                  <!-- Dropdown -->
                  <div class="dropdown">
                     <button type="button" class="btn btn-white btn-sm w-100"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                     <i class="bi-filter me-1"></i>   Filter
                     <span class="badge bg-soft-dark text-dark rounded-circle ms-1">{{$cntFilters}}</span>
                     </button>
                  </div>
                  <!-- End Dropdown -->
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div>
                     <div class="row">
                        <div  class = "loading"   wire:loading>
                           <center>
                              <img style = "height: 190px" src="/assets/img/loading_elevator.gif">
                              <br>
                              <span class="text-muted">Bezig met gegevens ophalen</span>
                           </center>
                        </div>
                        <div wire:loading.remove>
                           @if($selectPage && $elevators->count() <> $elevators->total() ) @unless($selectAll)
                           <div class = "pb-3">
                              Er zijn <strong> {{$elevators->count()}}</strong> resultaten geselecteerd wil je alle <strong> {{$elevators->total()}}</strong> resultaten selecteren ?
                              <span class="text-primary" style="cursor: pointer;" wire:click="selectAllFromDropdown">
                              Selecteer alle resultaten
                              </span>
                           </div>
                           @else
                           <div class = "pb-3">
                              {{$elevators->total()}} resultaten geselecteerd
                           </div>
                           @endif @else
                           @endif
                           @if($this->cntFilters)
                           <div class = "pb-3">
                              <i class="bi-filter me-1"></i>      Resultaten gefilterd met @if($this->cntFilters <= 1) 1 filter @else {{$this->cntFilters}} filters @endif</>
                              <span wire:click = "resetFilters()" style = "cursor: pointer" class = "text-primary">Wis alle filters</span>
                           </div>
                           @endif
                           @if($elevators->count())
                           <x-table>
                              <x-slot name="head">
                                 <x-table.heading></x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('unit_no')" :direction="$sortDirection">Type</x-table.heading>
                                 <x-table.heading>
                                    Nobonummer
                                 </x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('elevator.address_id')" :direction="$sortDirection">Complex</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('relation_id')" :direction="$sortDirection">Eigenaar  </x-table.heading>
                                 <x-table.heading>Beheerder</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('inspection_company_id')" :direction="$sortDirection">Keuring instantie</x-table.heading>
                                 <x-table.heading>Onderhoudspartij</x-table.heading>
                                 <x-table.heading>
                                    <center>Storingen</center>
                                 </x-table.heading>
                                 <x-table.heading></x-table.heading>
                              </x-slot>
                              <x-slot name="body">
                                 @forelse ($elevators as $elevator)
                                 <x-table.row onclick="window.location='/elevator/show/{{ $elevator->id }}'"  wire:key="row-{{ $elevator->id }}">
                                    <x-table.cell>
                                       
                           
                                    @if($elevator->status_id=='2')
                        <div class="cnt_table_result">
                        <i class="fa-solid fa-building-circle-xmark text-danger" data-bs-toggle="tooltip" data-bs-placement="right" title="Lift buiten gebruik"></i>
                        </div>
                        @endif
                        @if($elevator->status_id=='1')
                        <div class="cnt_table_result">
                        <i class="fa-solid fa-building-circle-check text-success" data-bs-toggle="tooltip" data-bs-placement="right" title="Operationeel"></i>
                        </div>
                        @endif
                                       @if($elevator->fire_elevator)
                                       <div class="cnt_table_result pl-0 ml-0">
                                          <i  data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift" class = "text-danger bi bi-fire"></i>
                                       </div>
                                       @else
                                       <div class="cnt_table_result">
                                          <i  style = "color: #EFEFEF" class = " bi bi-fire"></i>
                                       </div>
                                       @endif
                                       @if($elevator->stretcher_elevator)
                                       <div class="cnt_table_result">
                                          <i  data-bs-toggle="tooltip" data-bs-placement="top" title="Brancard / Bedlift" class = "text-primary fa-solid fa-bed"></i>     
                                       </div>
                        </div>
                        @else
                        <div class="cnt_table_result">
                        <i  style = "color: #EFEFEF" class = " fa-solid fa-bed"></i>
                        </div>
                        @endif
                     
                        </x-table.cell>
                        <x-table.cell>
                        @if($elevator?->object_type_id)
               <small>
               {{config('globalValues.object_types')[$elevator?->object_type_id]}}</small>
               @endif {{ $elevator->disapprovedState }} @if ($elevator->disapprovedState != null)								@if($management_elevator)
                        
                        @endif
                        <br> <span class="inline-flex items-center rounded-full bg-pink-100 px-2.5 py-0.5 text-xs font-medium text-pink-800">
                        Afgekeurd op:
                        {{ Carbon\Carbon::parse($elevator->check_valid_date)->format('d-m-Y') }}</span> 
                        @endif
                        </x-table.cell>
                        <x-table.cell>
                        {{ $elevator->nobo_no}}
                        </x-table.cell>
                        <x-table.cell> @if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>
                        <br> @endif <small>
                        {{ $elevator->address->address }}, @if ($elevator->address->housenumber)
                        {{ $elevator->address->housenumber }},
                        @endif @if ($elevator->address->zipcode)
                        {{ $elevator->address->zipcode }},
                        @endif {{ $elevator->address->place }}
                        @endif
                        @if($elevator->description)
                        <br>
                        {{$elevator->description}}
                        @endif
                        </small> 
                     </div>
                     </x-table.cell>
                     <x-table.cell> @if ($elevator->address) {{ $elevator->address?->customer?->name }} @else <span class="badge rounded-pill badge-outline-danger">Geen eigenaar  </span> @endif </x-table.cell>
                     <x-table.cell> @if ($elevator?->address) @if ($elevator?->address?->managementcompany?->name) {{$elevator?->address?->managementcompany?->name}} @endif @endif </x-table.cell>
                     <x-table.cell> @if ($elevator->inspection_company_id) {!! $elevator->inspectioncompany?->name !!} @endif </x-table.cell>
                     <x-table.cell> @if ($elevator->maintenancecompany) {{ $elevator->maintenancecompany->name }} @endif </x-table.cell>
                     <x-table.cell>
                   

             
                   
                     </x-table.cell>
                     <x-table.cell>
                     <div style="float: right">
                     <div class="btn-group" style="float: right;" role="group">
                     <div class="hs-unfold">
                     <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="settingsDropdown1" data-bs-toggle="dropdown" aria-expanded="false">
                     <i class="bi-three-dots-vertical"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end mt-1" aria-labelledby="settingsDropdown1">
                     <a class="dropdown-item" href = "/objects/{{$elevator->id}}/edit" >
                     <i class="bi-pencil-fill dropdown-item-icon"></i> Wijzigen
                     </a>
                     </div>
                     </div>
                     </div>
                     </div>
                     </x-table.cell>                           
                  </div>
                  </x-table.row> @empty
                  <x-table.row>
                  </x-table.row> @endforelse </x-slot>
                  </x-table>
                  @else
                  <div class="flex justify-center items-center space-x-2">
                     <center>
                        <div>
                           <img src='/assets/img/illu/1-1-740x592.png'
                              style="max-width: 500px; width: 100%;">
                           <h4>Geen objecten gevonden</h4>
                           @if($this->cntFilters)
                           Er zijn geen objecten gevonden met de huidige filters
                           @else
                           Er zijn nog geen objecten gevonden in de database.
                           @endif
                        </div>
                     </center>
                  </div>
                  @endif
               </div>
               <div class = "card-footer">
                  <div class="float-start">
                     @if(count($elevators))
                     <p class="float-start"> Pagina <b> {{ $elevators->currentPage()}} </b> van <b> {{ $elevators->lastPage()}} </b>
                     </p>
                     @endif
                  </div>
                  <div class="float-end"> @if($elevators->links())
                     {{ $elevators->links() }}
                     @endif
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasRightLabel">
   <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filter</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
   </div>
   <div class="offcanvas-body">
      <div class = "row" style = "">
         <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click ="resetFilters()" >Wis filters</button>
         </div>
         <div class="col-md-6">
            <button  data-bs-dismiss="offcanvas" aria-label="Close"  class="w-100 btn btn-primary btn-sm" >Sluiten</button>
         </div>
      </div>
      <small class="text-cap text-body pt-3">Trefwoord</small>
      <input  type="search" wire:model.live="filters.search" class="form-control" placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
      <small class="text-cap text-body pt-3">Plaats</small>
      <div class="tom-select-custom " wire:ignore >
         <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.place" multiple data-hs-tom-select-options='{
            "placeholder": "Alle plaatsen"
            }'>
            @foreach($locations as $address)
            <option value="{{$address->place}}">{{$address->place}}</option>
            @endforeach
         </select>
      </div>
      <small class="text-cap text-body pt-3">Beheerder</small>
      <div class="tom-select-custom " wire:ignore>
         <select class="js-select form-select " wire:model.live="filters.management_id" multiple data-hs-tom-select-options='{
            "placeholder": "Alle beheerders"
            }'>
            @foreach($managements as $management)
            <option value="{{$management->id}}">{{$management->name}}</option>
            @endforeach
         </select>
      </div>
      <small class="text-cap text-body pt-3">Eigenaar</small>
      <div class="tom-select-custom " wire:ignore>
         <select class="js-select form-select " wire:model.live="filters.customer_id" multiple data-hs-tom-select-options='{
            "placeholder": "Alle Eigenaren"
            }'>
            @foreach($customers as $customer)
            <option value="{{$customer->id}}">{{$customer->name}}</option>
            @endforeach
         </select>
      </div>
      <small class="text-cap text-body pt-3">keuringsinstanties</small>
      <div class="tom-select-custom " wire:ignore>
         <select class="js-select form-select   wire:model.live="filters.inspection_company_id" multiple     data-hs-tom-select-options='{
         "placeholder": "Alle keuringsinstanties"
         }'>
         @foreach($inspectionCompanys as $item)
         <option value="{{$item->id}}">{{$item->name}}</option>
         @endforeach
         </select>
      </div>
      <small class="text-cap text-body pt-3">Onderhoudspartijen</small>
      <div class="tom-select-custom " wire:ignore>
         <select class="js-select form-select " autocomplete="off"  wire:model.live="filters.maintenance_company_id"    multiple     data-hs-tom-select-options='{
            "placeholder": "Alle Onderhoudspartijen"
            }'>
            @foreach($maintenanceCompanys as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
         </select>
      </div>
   </div>
</div>
</div>
<!-- CrudModal  -->
<div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
      <div class="modal-content">
         <div class="modal-header">Liftgegevens
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body" wire:loading.class="loading-div" >
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
                     <div class = "float-end">
                        <button class = "btn btn-primary btn-120 float-end mt-3" wire:click = "save()"> Opslaan
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
 