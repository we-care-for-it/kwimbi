 
  <div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Liften</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">  

     

   
 

            <button type="button" onclick="history.back()" class="  btn  btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>


                <a href = "/elevator/create">
            <button type="button" class="btn btn-primary  btn-120 " >
           Toevoegen
            </button></a>


            </div>
        </div>
    </div>

 
   </div>
   
   <div>
 

 
 
 
   <div class="row  ">
      <div class="col-xl-12">
         <div class="card  ">





            <div class="card-body  "> 
              <div class="row ">
                  <div class="loading" wire:loading>
                     <img style="height: 190px" src="/assets/img/loading_elevator.gif">
                     <br>
                     <span class="text-muted">Bezig met gegevens ophalen</span>
                  </div>
                  <div class="col-md-12 " wire:loading.remove>
                     @if($this->cntFilters)
                     <div class="p-3" role="alert">
                        <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                        <= 1) 1 filter @else {{$this->cntFilters}} filters @endif <span wire:click="resetFilters()"
                           style="cursor: pointer" class="text-primary">Wis alle
                        filters</span>
                     </div>
                     @endif
                     <div wire:loading.remove>
                        
                     
                     
                     
                     
                     
                     
                     
                     
                      
      
 
    
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
                                 <x-table.row   onclick="window.location='/elevator/show/{{ $elevator->id }}'" >
                                    <x-table.cell onclick="window.location='/elevator/show/{{ $elevator->id }}'" >
                                       
                           
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
                     <a class="dropdown-item" href = "/objects/show/{{$elevator->id}}/edit" >
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
              
      
      
   
   </div>
</div>

<div>

<div class = "card-footer pt-3">
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
 
 
<script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('close-crud-modal', (event) => {
         $('#crudModal').modal('hide');
      });
   });
</script>