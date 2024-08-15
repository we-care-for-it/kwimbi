<div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Stoeringen</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">
            <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>


   </div>



   <div class="row ">
      <div class="col-xl-12">
         <div class="card  p-0 m-0">
            <div class="card-body  ">


            <div class = "filter_bar ">

<div class="row">
<div class="col">

    <form class = "float-start">
            <div class="input-group input-group-merge ">
               <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                  placeholder="Zoeken op trefwoord..." data-hs-form-search-options="{
                     &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
                     &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
                     }">
               <button type="button" class="input-group-append input-group-text">
                  <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                  <i id="defaultClearIconToggleEg" class="bi-search" style="display: block; opacity: 1.03666;"></i>
               </button>
            </div>
         </form>
      </div>

</div>




</div>

               <div class="row ">
                  <div class="loading" wire:loading>
                     <img style="height: 190px" src="/assets/img/loading_elevator.gif">
                     <br>
                     <span class="text-muted">Bezig met gegevens ophalen</span>
                  </div>
                  <div class="col-md-12 " wire:loading.remove>
                     @if($this->cntFilters)
                     <div class="pt-3 alert alert-soft-warning" role="alert">
                        <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                        <= 1) 1 filter @else {{$this->cntFilters}} filters @endif <span wire:click="resetFilters()"
                           style="cursor: pointer" class="text-primary">Wis alle
                        filters</span>
                     </div>
                     @endif
                     <div wire:loading.remove>
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

                                 <x-table.row  wire:key="row-{{ $incident->id }}"  onclick="window.location='/incident/{{ $incident->id }}';" >

                                 <x-table.cell onclick="window.location='/incident/{{ $incident->id }}';">
                      {{ sprintf('%06d', $incident->id) }}
                      @if ($incident->stand_still)
                      <br>
                      <span style="margin-top: 5px; "
                            class=" badge rounded-pill badge-outline-danger">
                        <i
                           class="uil-exclamation-triangle">
                        </i> Lift buiten
                        bedrijf
                      </span>
                      @endif
                    </x-table.cell>
                    <x-table.cell onclick="window.location='/incident/{{ $incident->id }}';">
                      {{ Carbon\Carbon::parse($incident->report_date_time)->format('d-m-Y') }} -      {{ Carbon\Carbon::parse($incident->report_date_time)->format('H:i') }}
                    </x-table.cell>
                    <x-table.cell onclick="window.location='/incident/{{ $incident->id }}';" >
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
                    <x-table.cell onclick="window.location='/incident/{{ $incident->id }}';" >
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
         <span class="badge bg-soft-primary text-primary py-2">Nieuw
         </span>
         @elseif($incident->status_id == 2)
         <span class="badge bg-soft-primary text-primary  py-2">Doorgestuurd naar
         onderhoudsbedrijf
         </span>
         @elseif($incident->status_id == 99)
         <span class="badge bg-soft-primary text-primary py-2">Gereed
         </span>
         @elseif($incident->status_id == 3)
         <span class="badge bg-soft-primary text-primary py-2">Wacht op offerte
         </span>
         @elseif($incident->status_id == 4)
         <span class="badge bg-soft-primary text-primary py-2">Offerte naar klant gestuurd
         </span>
         @elseif($incident->status_id == 5)
         <span class="badge bg-soft-primary text-primary py-2">Niet gereed
         </span>
         @elseif($incident->status_id == 6)
         <span class="badge bg-soft-primary text-primary py-2">Onjuist gemeld
         </span>
         @elseif($incident->status_id == 7)
         <span class="badge bg-soft-primary text-primary py-2">Offerte in opdracht
         </span>
         @elseif($incident->status_id == 8)
         <span class="badge bg-soft-primary text-primary py-2"> Werkzaamheden gepland
         </span>
         @elseif($incident->status_id == 9)
         <span class="badge bg-soft-primary text-primary py-2"> Wachten op uitvoerdatum
         </span>
         @endif


                  </x-table.cell>




                                    </x-table.row>
                                 @endforeach
                              </x-slot>
                           </x-table>
                           @else
                           <div class="flex justify-center items-center space-x-2">

                                 <center>
                                    <div>
                                       <img src='/assets/img/illu/1-1-740x592.png'
                                          style="max-width: 500px; width: 100%;">

                                       <h4>Geen storingen gevonden......</h4>
                                       @if($this->cntFilters)
                                       Geen gegevens gevonden met de huidige filters...
                                       <hr>

                                       @else
                                       Geen storingen gevonden in het systeem. Een storing aanmaken kan via het liften overzicht
                                       @endif


                                    </div>
                                 </center>



                           </div>
                           @endif
                        </div>
                     </div>
                  </div>
               </div>
            </div>

            <div class="card-footer pt-3">

<div class="clearfix  ">
   <div class="float-start">

   @if($items->links())
      <p class="float-start"> Pagina <b> {{ $items->currentPage()}} </b> van <b> {{ $items->lastPage()}}
         </b>
      </p>
      @endif</div>
   <div class="float-end"> @if($items->links())
      {{ $items->links() }}
      @endif</div>
</div>

</div>


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
