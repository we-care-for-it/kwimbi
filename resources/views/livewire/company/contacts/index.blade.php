<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <img src="/assets/img/ico/users.png" class = "pageico">
            <h1 class="page-header-title">  Contactpersonen(s) <span class="text-muted   ms-2"> ({{ $items->Total()}})</h1>
            <span class=" mb-2 text-muted"> Toon pagina <b> {{ $items->currentPage()}} </b> van <b> {{ $items->lastPage()}} </b> met huidige filters <b> {{ $items->Total()}} </b> relaties gevonden</span>
         </div>
         <div class="col-auto">
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary" >
            Terug
            </button>
            <button type="button" data-bs-toggle="modal" data-bs-target="#crudModal" style=" width: 150px; " class="btn btn-soft-success" >
            Toevoegen
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
                  <!-- End Dropdown -->
               </div>
            </div>
            <div class="card-body">
               <div class="row">
                  <div>
                  <div class="row" wire:loading.class="loading-div">
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
                                 <x-table.heading sortable wire:click="sortBy('name')">Naam</x-table.heading>
                                 <x-table.heading>E-mailadres</x-table.heading>
                                 <x-table.heading>Telefoonnummer</x-table.heading>
                                 <x-table.heading>Gekoppeld aan</x-table.heading>
                                 <x-table.heading></x-table.heading>
                              </x-slot>
                              <x-slot name="body">
                                 @foreach ($items as $item)
                                 <x-table.row  wire:key="row-{{ $item->id }}">
                                    <x-table.cell>
                                       {{$item->name}} 

                                       @if($item->function)
                                       <br><b>{{$item->function}}<b>
                                       @endif

                                    </x-table.cell>
                                    <x-table.cell>
                                      <a href = "mailto:{{$item->emailadres}} "> {{$item->email}} </a>
                                    </x-table.cell>
                                    <x-table.cell>
                                    <a href = "tel:{{$item->phonenumber}} "> {{$item->phonenumber}} </a>
                             
                                    </x-table.cell>
                                    <x-table.cell>

                                    @if($item->management_id)
                                    <span class="badge bg-soft-primary text-primary py-2">{{$item?->managementCompany?->name}}</span>
                                    @endif


                                    @if($item->supplier_id)
                                    <span class="badge bg-soft-primary text-info py-2">{{$item?->supplier?->name}}</span>
                                    @endif


                                    @if($item->maintency_company_id)
                                    <span class="badge bg-soft-primary text-warning py-2">{{$item?->maintenanceCompany?->name}}</span>
                                    @endif

                                    @if($item->inspection_company_id)
                                    <span class="badge bg-soft-primary text-success py-2">{{$item?->inspectionCompany?->name}}</span>
                                    @endif

                                    @if($item->customer_id)
                                    <span class="badge bg-soft-primary text-danger py-2">{{$item?->customer?->name}}</span>
                                    @endif





           
                                    </x-table.cell>
                                    <x-table.cell>
                                       <div style = "float: right">
                                       <button type="button" wire:click = "edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#crudModal"  class="btn btn-ghost-warning btn-icon btn-sm rounded-circle" id="connectionsDropdown3" >
                            <i class="fa-solid fa-pencil"></i>  
                            </button>
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
                                       Geen addressen gevonden met de huidige
                                       filters...
                                       <hr>
                                       <h5>Mogelijke oplossingen</h5>
                                       <ul style="list-style-type: square;">
                                          <li >Voeg een <a href = "#"   data-bs-toggle="modal" data-bs-target="#crudModal">nieuwe</a> adres toe in de database</li>
                                          <li>Pas eventueel de filters aan</li>
                                       </ul>
                                       @else
                                       Geen adressen gevonden in het systeem
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
            <div wire:loading.remove class="card-footer bg-light ">
               <div class = "float-end ">
               {{ $items->links() }}
                        </div>
            </div>
            @endif
         </div>
         <div class="offcanvas offcanvas-end" wire:ignore tabindex="-1" id="offcanvasFilters" aria-labelledby="offcanvasRightLabel">
            <div class="offcanvas-header">
               <h5 id="offcanvasRightLabel"><i class="bi-filter me-1"></i> Filters</h5>
               <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body"> <div class = "row" style = "">
                  <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click ="resetFilters()" >Wis filters</button>
                  </div>
                  <div class="col-md-6">
                     <button  data-bs-dismiss="offcanvas" aria-label="Close"  class="w-100 btn btn-primary btn-sm" >Sluiten</button>
                  </div>
               </div>
               <h<
               <small class="text-cap text-body pt-3">Trefwoord</small>
               <input  type="search" wire:model.live="filters.keyword" class="form-control" placeholder="Zoek op trefwoord" aria-label="Zoek op trefwoord">
             


               <div>
               <small class="text-cap text-body pt-3">Relatie</small>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.customer_id"    multiple data-hs-tom-select-options='{
                              "placeholder": "Kies een leverancier"
                              }'>
                              <option>--------</option>
                              @foreach($customers as $customer)
                              <option value="{{$customer->id}}">{{$customer->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                     <small class="text-cap text-body pt-3">Leverancier</small>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.supplier_id"  multiple   data-hs-tom-select-options='{
                              "placeholder": "Kies een leverancier"
                              }'>
                              <option>--------</option>
                              @foreach($suppliers as $supplier)
                              <option value="{{$customer->id}}">{{$supplier->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                     <small class="text-cap text-body pt-3">Onderhoudspartij</small>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.maintency_company_id" multiple  data-hs-tom-select-options='{
                              "placeholder": "Kies een onderhoudspartij"
                              }'>
                              <option>--------</option>
                              @foreach($maintenance_companies as $maintenance_companie)
                              <option value="{{$maintenance_companie->id}}">{{$maintenance_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                     <small class="text-cap text-body pt-3">Keuringinstanties</small>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.inspection_company_id"   multiple data-hs-tom-select-options='{
                              "placeholder": "Kies een keuringinstantie"
                              }'>
                              <option>--------</option>
                              @foreach($inspection_companies as $inspection_companie)
                              <option value="{{$inspection_companie->id}}">{{$inspection_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                     <small class="text-cap text-body pt-3">Beheerder</small>

                     
                     <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="filters.management_id"     data-hs-tom-select-options='{
                              "placeholder": "Kies een beheerder"
                              }'>
                              <option selected>--------</option>
                              @foreach($management_companies as $management_companie)
                              <option value="{{$management_companie->id}}">{{$management_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>


              
            </div>
         </div>
      </div>
   </div>
   <!-- CrudModal  -->
   <div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:loading.class="loading-div" >
               <div class = "row">
                  <div class = "col-md-6">
                     <div>
                        <label class = "pb-2">Naam</label>
                        <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                     <div class = "row">
                        <div class = "col-md-12">
                           <div class  = "pt-3">
                              <label class = "pb-2">Emailadres</label>
                              <input wire:model = "emailaddress"  class  = "form-control">
                           </div>
                           <div class  = "pt-3">
                              <label class = "pb-2">Telefoonnummer</label>
                              <input wire:model = "phonenumber"  class  = "form-control">
                           </div>
                        </div>
                     </div>

                     <div class = "row">
                        <div class = "col-md-12">
                           <div class  = "pt-3">
                              <label class = "pb-2">Functie</label>
                              <input wire:model = "function"  class  = "form-control">
                           </div>
                       
                        </div>
                     </div>


                  </div>
                  <div class = "col-md-6">
                     <div>

                     
                        <label class = "pb-2">Relatie</label>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model="customer_id"   data-hs-tom-select-options='{
                              "placeholder": "Kies een leverancier"
                              }'>
                              <option>--------</option>
                              @foreach($customers as $customer)
                              <option value="{{$customer->id}}">{{$customer->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                        <label class = "pb-2">Leverancier</label>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model="supplier_id"   data-hs-tom-select-options='{
                              "placeholder": "Kies een leverancier"
                              }'>
                              <option>--------</option>
                              @foreach($suppliers as $supplier)
                              <option value="{{$customer->id}}">{{$supplier->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                        <label class = "pb-2">Onderhoudspartij</label>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model="maintency_company_id"   data-hs-tom-select-options='{
                              "placeholder": "Kies een onderhoudspartij"
                              }'>
                              <option>--------</option>
                              @foreach($maintenance_companies as $maintenance_companie)
                              <option value="{{$maintenance_companie->id}}">{{$maintenance_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                        <label class = "pb-2">Keuringinstanties</label>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model="inspection_company_id"   data-hs-tom-select-options='{
                              "placeholder": "Kies een keuringinstantie"
                              }'>
                              <option>--------</option>
                              @foreach($inspection_companies as $inspection_companie)
                              <option value="{{$inspection_companie->id}}">{{$inspection_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                     <div class = "pt-3">
                        <label class = "pb-2">Beheerder</label>
                        <div class="tom-select-custom " wire:ignore >
                           <select style = "height: 40px;" class="js-select form-select " wire:model.live="management_id"   data-hs-tom-select-options='{
                              "placeholder": "Kies een beheerder"
                              }'>
                              <option>--------</option>
                              @foreach($management_companies as $management_companie)
                              <option value="{{$management_companie->id}}">{{$management_companie->name}}</option>
                              @endforeach
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="modal-footer">

            
            <button   wire:click="delete({{$edit_id}})"     wire:confirm.prompt="Weet je zeker dat je deze beheerder wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"    type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash"></i>  
               </button> 



               <button type="button" class="btn btn-white btn-120" data-bs-dismiss="modal">Sluiten</button>
               <button class="btn btn-soft-success btn-120    " wire:click="save()" type="button">
                  <div wire:loading wire:target="save">
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>
            </div>
         </div>
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