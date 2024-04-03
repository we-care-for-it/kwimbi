<div class="container-fluid">
   <div class="page-header     ">
      <div class="row align-items-center ">
         <div class="col">
 
         <h1 class="page-header-title pt-3">  Leveranciers  </h1>
             </div>
         <div class="col-auto">
            <form>
               <!-- Search -->
               <div class="input-group input-group-merge">
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
               <!-- End Search -->
            </form>
         </div>
         <div class="col-auto">
            <button type="button" class="btn   btn-primary btn btn-sm btn-120 " data-bs-toggle="modal"
               data-bs-target="#crudModal">
       Toevoegen
            </button>
         </div>
      </div>
   </div>
   <div class="row ">
      <div class="col-xl-12">
         <div class="card  p-0 m-0">
            <div class="card-body ">
               <div class="row ">
                  <div class="loading" wire:loading>
                     <img style="height: 190px" src="/assets/img/loading_elevator.gif">
                     <br>
                     <span class="text-muted">Bezig met gegevens ophalen</span>
                  </div>
                  <div class="col-md-12 " wire:loading.remove>
                     @if($this->cntFilters)
                     <div class="p-3 alert alert-soft-warning" role="alert">
                        <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                        <= 1) 1 filter @else {{$this->cntFilters}} filters @endif <span wire:click="resetFilters()"
                           style="cursor: pointer" class="text-primary">Wis alle
                        filters</span>
                     </div>
                     @endif
                     <div wire:loading.remove>
                        @if($items->count())
                        <x-table >
                           <x-slot name="head">
                              <x-table.heading sortable wire:click="sortBy('name')">Naam</x-table.heading>
                              <x-table.heading sortable wire:click="sortBy('address')" :direction="$sortDirection">
                                 Adres
                              </x-table.heading>
                              <x-table.heading sortable wire:click="sortBy('zipcode')" :direction="$sortDirection">
                                 Postcode
                              </x-table.heading>
                              <x-table.heading sortable wire:click="sortBy('place')" :direction="$sortDirection">
                                 Plaats
                              </x-table.heading>
                        
                           </x-slot>
                           <x-slot name="body">
                              @foreach ($items as $item)
                              <x-table.row onclick="location='/supplier/{{$item->id}}'" wire:key="row-{{ $item->id }}">
                                 <x-table.cell >
                                 <a href = "/supplier/{{$item->id}}">   {{$item->name}}</a>
                                 </x-table.cell>
                                 <x-table.cell>
                                    {{$item->address}}<br>
                                 </x-table.cell>
                                 <x-table.cell>
                                    {{$item->zipcode}}
                                 </x-table.cell>
                                 <x-table.cell>
                                    {{$item->place}}
                                 </x-table.cell>
                           
                        
                              </x-table.row>
                              @endforeach
                           </x-slot>
                        </x-table>
                        @else
                        <div>
                           <div class="empty-state-container ">
                              <div class="empty-state-content">
                                 <div class="empty-state-content-background new">
                                    <img class="empty-state-illustration" src="/assets/img/emptydocument.svg">
                                    <p class="empty-state-text"><span class="strong">
                                   <b> Geen gegevens gevonden</b>
                                    <br>Voeg een leverancier toe of pas het trefwoord aan.</span> 
                                          
                                    </p>
                                 </div>
                                 <!--empty-state-content-background-->
                              </div>
                              <!--empty-state-content-->
                           </div>
                        </div>
                        @endif
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="clearfix pt-3  ">
            <div class="float-end wire:loading.remove"> @if($items->links())
               {{ $items->links() }}
               @endif
            </div>
         </div>
         <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters"
            aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
               <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filters</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
               <small class="text-cap text-body pt-3">Trefwoord</small>
               <input type="search" wire:model.live="filters.keyword" class="form-control"
                  placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
               <small class="text-cap text-body pt-3">Plaats</small>
               <div class="row pt-4" style="">
                  <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click="resetFilters()">Wis
                     filters</button>
                  </div>
                  <div class="col-md-6">
                     <button data-bs-dismiss="offcanvas" aria-label="Close"
                        class="w-100 btn btn-primary btn-sm">Sluiten</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>

   @livewire('company.suppliers.crudmodal',['object' => ''] ))
    
</div>
 