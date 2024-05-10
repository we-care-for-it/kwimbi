<div>
<div class="page-header">
      <div class="row align-items-center">
 
         <div class="col">
        
            <h1 class="page-header-title"> Keuringsinstanties</h1>
            </div>
         <div class="col-auto">
         
            <button type="button" data-bs-toggle="modal" data-bs-target="#crudModal"   class="btn btn-sm btn-primary   btn-120" >
            Toevoegen
            </button>


        

         </div>
      </div>
   </div>
  
   <div class="row ">
      <div class="col-xl-12">

         <div class="card ">
            <div class="card-header card-header-content-md-between">
               <div class="mb-2 mb-md-0">

                  <form>
                     <!-- Search -->
                     <div class="input-group input-group-merge">
                        <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                           placeholder="Zoeken op trefwoord..." data-hs-form-search-options='{
                           "clearIcon": "#clearIcon2",
                           "defaultIcon": "#defaultClearIconToggleEg"
                           }'>
                        <button type="button" class="input-group-append input-group-text">
                           <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                           <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
                        </button>
                     </div>
                  </form>
               </div>
               <!-- End Col -->

               <div>

                  @if($this->cntFilters)
                  <div role="alert">
                     <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                     <= 1) 1 filter @else {{$this->cntFilters}} filters @endif 
                     <span wire:click="resetFilters()" style="cursor: pointer" class="text-primary">Wis alle
                        filters</span>
                  </div>
                  @endif

               </div>

            </div>
            <div class="card-body2">
          


                  
   <div class="loading" wire:loading>
      @include('layouts.partials._loading')
   </div>


             
                     <div class="col-md-12" wire:loading.remove wire:loading.class="loading-div">
                           
                 
                        
                           @if($this->cntFilters)
                           <div class="alert alert-soft-warning" role="alert">
                              <i class="bi-filter me-1"></i>      Resultaten gefilterd met @if($this->cntFilters <= 1) 1 filter @else {{$this->cntFilters}} filters @endif</>
                              <span wire:click = "resetFilters()" style = "cursor: pointer" class = "text-primary">Wis alle filters</span>
                           </div>
                           @endif

                           @if($items->count())
                           <x-table>
                              <x-slot name="head">
                                 <x-table.heading sortable wire:click="sortBy('name')">Naam</x-table.heading>
                                 <x-table.heading  sortable wire:click="sortBy('address')" :direction="$sortDirection">Adres</x-table.heading>
                                 <x-table.heading  sortable wire:click="sortBy('zipcode')" :direction="$sortDirection">Postcode</x-table.heading>
                                 <x-table.heading  sortable wire:click="sortBy('place')" :direction="$sortDirection">Plaats</x-table.heading>
               
                                 <x-table.heading></x-table.heading>
                              </x-slot>
                              <x-slot name="body">
                                 @foreach ($items as $item)
                                 <x-table.row  wire:key="row-{{ $item->id }}">
                                    <x-table.cell>
                                       {{$item->name}} 
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
                                  
                                    <x-table.cell>
                                       <div style = "float: right">
 
                                   
                                           <a class="dropdown-item" href="/settings/inspection-companie/{{$item->id}}"  >
                                           <i class="bi-eye"></i></a>
                                                              
                             


 
                                       </div>
                                    </x-table.cell>
                                 </x-table.row>
                                 @endforeach 
                              </x-slot>
                           </x-table>
                           @else
                           @include('layouts.partials._empty')
                           @endif
                     
           
               </div>
            </div>
            @if($items->links())
          
               <div class = "float-end ">
               {{ $items->links() }}
                        </div>
         
            @endif
         </div>
         
      </div>
 
 
   </div>
  
   @livewire('company.suppliers.crudmodal', ['object' => ''])
</div>
 