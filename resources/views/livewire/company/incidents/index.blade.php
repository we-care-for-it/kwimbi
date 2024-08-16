<div class="container-fluid">
  
   <div class="page-header">
      <div class="row align-items-center">
 
         <div class="col">
         <img src="/assets/img/ico/users.png" class = "pageico">
            <h1 class="page-header-title">  Storingen <span class="text-muted   ms-2"> ({{ $items->Total()}})</h1>
            <span class=" mb-2 text-muted"> Toon pagina <b> {{ $items->currentPage()}} </b> van <b> {{ $items->lastPage()}} </b> met huidige filters <b> {{ $items->Total()}} </b> addressen gevonden</span>
         </div>
         <div class="col-auto">

         
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary" >
            Terug
            </button>
 
         </div>
      </div>
   </div>
   <div class="row ">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header card-header-content-md-between bg-light">
               <div class="mb-2 mb-md-0">
                  <form>
                     <!-- Search -->
                     <div class="input-group input-group-merge">
                        <input type="text"  wire:model.live="filters.keyword" class="js-form-search form-control" placeholder="Zoeken op trefwoord..."
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
                  <div class="dropdown">
                     <button type="button" class="btn btn-white btn-sm w-100"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                     <i class="bi-filter me-1"></i>   Filter
                     <span class="badge bg-soft-dark text-dark rounded-circle ms-1">{{$cntFilters}}</span>
                     </button>
                  </div>
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div>
                     <div class="row">
                        <div  class = "loading"   wire:loading  >
                           <img style = "height: 190px" src="/assets/img/loading_elevator.gif">
                           <br>
                           <span class="text-muted">Bezig met gegevens ophalen</span>
                        </div>
                        <div wire:loading.remove>
                           @if($selectPage && $items->count() <> $items->total() ) @unless($selectAll)
                           <div class = "pb-3">
                              Er zijn <strong> {{$items->count()}}</strong> resultaten geselecteerd wil je alle <strong> {{$items->total()}}</strong> resultaten selecteren ?
                              <span class="text-primary" style="cursor: pointer;" wire:click="selectAllFromDropdown">
                              Selecteer alle resultaten
                              </span>
                           </div>
                           @else
                           <div class = "pb-3">
                              {{$items->total()}} resultaten geselecteerd
                           </div>
                           @endif @else
                           @endif
                           @if($this->cntFilters)
                           <div class="alert alert-soft-warning" role="alert">
                              <i class="bi-filter me-1"></i>      Resultaten gefilterd met @if($this->cntFilters <= 1) 1 filter @else {{$this->cntFilters}} filters @endif</>
                              <span wire:click = "resetFilters()" style = "cursor: pointer" class = "text-primary">Wis alle filters</span>
                           </div>
                           @endif
                           @if($items->count())
                           <x-table>
                              <x-slot name="head">
                              <x-table.heading>Nummer
                  </x-table.heading>
                  <x-table.heading>Storingsdatum
                  </x-table.heading>
                  <x-table.heading>Liftadres
                  </x-table.heading>
                  <x-table.heading>Unit no
                  </x-table.heading>
                  <x-table.heading>Omschrijving
                  </x-table.heading>
                  <x-table.heading>Status
                  </x-table.heading>
                  <x-table.heading>
                  </x-table.heading> 
                              </x-slot>
                              <x-slot name="body">
                                 @foreach ($items as $incident)

                                 <x-table.row  wire:key="row-{{ $incident->id }}">

                                 <x-table.cell>

                                 @if($incident?->elevator?->management_elevator)
                                       <span class = "text-primary"  > <i class="fa-solid fa-user-gear" data-bs-toggle="tooltip" data-bs-placement="right" title="Beheerslift"> </i>   </span>
                                       @endif


                      {{ sprintf('%06d', $incident->id) }}
                      @if ($incident->stand_still)
                      <br>
                      <span class = "badge bg-soft-danger text-danger py-2"  >
                       Lift buiten
                        bedrijf
                      </span>
                      @endif
                    </x-table.cell>
                    <x-table.cell>
                      {{ Carbon\Carbon::parse($incident->report_date_time)->format('d-m-Y') }} -      {{ Carbon\Carbon::parse($incident->report_date_time)->format('H:i') }}
                    </x-table.cell>
                    <x-table.cell onclick="window.location='/company/incident/show/{{ $incident->id }}';" >
                      <a href="/company/elevator/show/{{ $incident?->elevator?->id }}';">
                        @if ($incident?->elevator?->address_id)
                        @if ($incident?->elevator?->address)
                        {{ $incident->elevator->address->address }}
                        <br>
                        @endif
                      </a>
                    
                  

                        @if($incident?->elevator?->address?->zipcode)
                        {{ $incident?->elevator?->address?->zipcode }},
                        @endif
                        {{ $incident?->elevator?->address?->place }}
                        @endif
                      </small>
                    </x-table.cell>
                    <x-table.cell onclick="window.location='/company/incident/show/{{ $incident->id }}';" >
                      {{ $incident?->elevator?->unit_no }}
                      @if ($incident?->elevator?->disapprovedState != null)
                      <br>
                      <span
                            class="inline-flex items-center rounded-full bg-pink-100 px-2.5 py-0.5 text-xs font-medium text-pink-800">
                        Afgekeurd op:
                        {{ Carbon\Carbon::parse($elevator->check_valid_date)->format('d-m-Y') }}
                      </span>
                      </div>
                    @endif
                    </x-table.cell>
                  <x-table.cell>
                    {{ $incident->subject }}
                  </x-table.cell>
                  <x-table.cell>
                    @if ($incident->status_id == 0)
                    <span class="badge bg-soft-primary text-primary">Nieuw
                    </span>
                    @elseif($incident->status_id == 2)
                    <span class="badge bg-soft-primary text-primary">Doorgestuurd naar
                      onderhoudsbedrijf
                    </span>
                    @elseif($incident->status_id == 99)
                    <span class="badge bg-soft-primary text-primary">Gereed
                    </span>
                    @elseif($incident->status_id == 3)
                    <span class="badge bg-soft-primary text-primary">Wacht op offerte
                    </span>
                    @elseif($incident->status_id == 4)
                    <span class="badge bg-soft-primary text-primary">Offerte naar klant gestuurt
                    </span>
                    @elseif($incident->status_id == 5)
                    <span class="badge bg-soft-primary text-primary">Niet gereed
                    </span>
                    @elseif($incident->status_id == 6)
                    <span class="badge bg-soft-primary text-primary">Onjuist gemeld
                    </span>
                    @elseif($incident->status_id == 7)
                    <span class="badge bg-soft-primary text-primary">Offerte in opdracht
                    </span>
                    @elseif($incident->status_id == 8)
                    <span class="badge bg-soft-primary text-primary">sWerkzaamheden gepland
                    </span>

                    @elseif($incident->status_id==9)
                                <span class=" text-info">  Wachten op uitvoerdatum
                                </span>



                    @endif


                  </x-table.cell>


                  <x-table.cell>
<div style = "float: right">
<div class="dropdown">
<button type="button" onclick="window.location='/company/incident/show/{{ $incident->id }}';"  class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
<i class="bi-eye"></i>
</button>
 
                                          </div>
                                       </div>
                                    </x-table.cell>


                                    </x-table.row>
                                 @endforeach 
                              </x-slot>
                           </x-table>
                           @else
                           <div class="flex justify-center items-center space-x-2">
                              <div class = "row">
                                 <div class = "col-md-2">
                                    <img src = "/assets/img/empty_state_search_not_found.svg" style = "height: 200px">
                                 </div>
                                 <div class = "col-md-10">
                                    <div class = "pt-3">
                                       <h4>Helaas......</h4>
                                       @if($this->cntFilters)
                                       Geen gegevens gevonden met de huidige
                                       filters...
                                       <hr>
                                       <h5>Mogelijke oplossingen</h5>
                                       <ul style="list-style-type: square;">
                                          <li >Voeg een <a href = "#"   data-bs-toggle="modal" data-bs-target="#crudModal">nieuwe</a> adres toe in de database</li>
                                          <li>Pas eventueel de filters aan</li>
                                       </ul>
                                       @else
                                       Geen gegevens gevonden in het systeem
                                       <hr>
                                       <h5>Mogelijke oplossingen</h5>
                                       <ul style="list-style-type: square;">
                                          <li>Voeg een <a href = "#"   data-bs-toggle="modal" data-bs-target="#crudModal" >nieuw</a> adres toe in de database</li>
                                       </ul>
                                       @endif
                                    </div>
                                 </div>
                              </div>
                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            @if($items->links())
            <div wire:loading.remove class="card-footer bg-light">
               {{ $items->links() }}
            </div>
            @endif
         </div>
         <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
               <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filters</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <small class="text-cap text-body pt-3">Trefwoord</small>
               <input  type="search" wire:model.live="filters.keyword" class="form-control" placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
               
               <small class="text-cap text-body pt-3">Status</small>
               <div class="tom-select-custom " wire:ignore >
                  <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.status_id" multiple data-hs-tom-select-options='{
                     "placeholder": "Alle statussen"
                     }'>
         


          <option value="0">Nieuw
          </option>


          <option value="2">Doorgestuurd naar onderhoudsbedrijf
          </option>
          <option value="3">Wacht op offerte
          </option>
          <option value="4">Offerte naar klant
          </option>
          <option value="5">Niet gereed
          </option>
          <option value="6">Onjuist gemeld
         </option>
         <option value="7"> Offerte in opdracht
         </option>
         <option value="8"> Werkzaamheden gepland
         </option>
         <option value="9"> Wachten op uitvoerdatum
         </option>
          <option value="99">Gereed
          </option>
                  </select>
               </div>


               <small class="text-cap text-body pt-3">Onderhoudspartij</small>
  
               <div class="tom-select-custom " wire:ignore>
                     <select class="js-select form-select " autocomplete="off"  wire:model.live="filters.maintenance_company_id"    multiple     data-hs-tom-select-options='{
                        "placeholder": "Alle Onderhoudspartijen"
                        }'>
                        @foreach($maintenanceCompanys as $item)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endforeach
                     </select>
             
               </div>


               <div class = "row pt-4" style = "">
                  <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click ="resetFilters()" >Wis filters</button>
                  </div>
                  <div class="col-md-6">
                     <button  data-bs-dismiss="offcanvas" aria-label="Close"  class="w-100 btn btn-primary btn-sm" >Sluiten</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>


    
</div>