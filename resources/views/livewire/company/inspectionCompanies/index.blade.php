<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
               Keuringsinstanties
         </div>

         <div class="col-auto">

            <button type="button" class="btn btn-primary btn-sm  btn-120" wire:click="clear()" data-bs-toggle="modal"
               data-bs-target="#crudModal" type="button">
               Toevoegen
            </button>

            <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  btn-ico">
               <i class="fa-solid fa-arrow-left"></i>
            </button>

         </div>

      </div>
   </div>
   <div class="row p-0 ">
      <div class="col-xl-12">
         <div class="card">
            <div class="card-header card-header-content-md-between  ">
               <div>
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
                     <!-- End Search -->
                  </form>
               </div>
               <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                  <div class="d-flex align-items-center justify-content-center">
                     <div wire:loading.delay class="loading_indicator_small"></div>
                  </div>

                  <!-- End Dropdown -->
               </div>
            </div>
            <div class="card-body pt-0">
               <div class="row">
                  <div>
                     <div class="row" wire:loading.class="loading-div">
                        <div class="col-md-12">
                           @if($this->cntFilters)
                           <div class="alert alert-soft-warning" role="alert">
                              <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                              <= 1) 1 filter @else {{$this->cntFilters}} filters @endif 
                              <span wire:click="resetFilters()" style="cursor: pointer" class="text-primary">Wis alle
                                 filters</span>
                           </div>
                           @endif

                           @if($items->count())
                           <x-table>
                              <x-slot name="head">
                                 <x-table.heading sortable wire:click="sortBy('name')">Naam</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('address')" :direction="$sortDirection">
                                    Adres</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('zipcode')" :direction="$sortDirection">
                                    Postcode</x-table.heading>
                                 <x-table.heading sortable wire:click="sortBy('place')" :direction="$sortDirection">
                                    Plaats
                                 </x-table.heading>
                                 <x-table.heading></x-table.heading>
                                 <x-table.heading></x-table.heading>
                              </x-slot>
                              <x-slot name="body">

                                 @foreach ($items as $item)
                                 <x-table.row wire:key="row-{{ $item->id }}">
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
                                       {{$item->address}}
                                    </x-table.cell>
                                    <x-table.cell>

                                       <button style="float: right"
                                          class="btn btn-ghost-warning text-warning btn-icon btn-sm rounded-circle"
                                          wire:click="edit({{$item->id}})" data-bs-toggle="modal"
                                          data-bs-target="#crudModal">
                                          <i class="bi bi-pencil"></i>
                                       </button>

                                    </x-table.cell>
                                 </x-table.row>
                                 @endforeach
                              </x-slot>
                           </x-table>
                           @else
                           <div class="flex justify-center items-center space-x-2">
                              <center>
                                 <div>
                                    <img src='/assets/img/illu/1-1-740x592.png' style="max-width: 500px; width: 100%;">
                                    <h4>Geen Keuringsinstanties gevonden</h4>
                                    @if($this->cntFilters)
                                    Er zijn geen Keuringsinstanties gevonden met de huidige filters
                                    @else
                                    Er zijn nog geen Keuringsinstanties gevonden in de database.
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
            <div class="card-footer">

               <div class="clearfix  ">
                  <div class="float-start">@if(count($items))
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
   <!-- CrudModal  -->
   <div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">Gegevens
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" wire:loading.class="loading-div">
               <div class="row">
                  <div class="col-md-12">
                     <div>
                        <label class="pb-2">Naam</label>
                        <input wire:model="name" class="form-control    @error('name') is-invalid   @enderror  ">
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
               <div class="row pt-3">
                  <div class="col-md-6">
                     <div class="pt-3">
                        <label class="pb-2">Postcode</label>
                        <div class="input-group  ">
                           <input class="form-control required  @if ($errors->has('zipcode'))  is-invalid @endif "
                              wire:model.defer="zipcode">
                           <div class="input-group-append">
                              <button class="btn btn-soft-primary" style="height: 43px" wire:click="checkZipcode"
                                 data-toggle="tooltip" data-placement="top" title="Zoek naar postcode"
                                 wire:keydown="checkZipcode" style="height: 40px;">
                                 <i class="bi-search"></i>
                              </button>
                           </div>
                           @if ($errors->has('zipcode')) <span class="text-danger">Postcode formaat niet juist</span>
                           @endif
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
                        <input wire:model="address" class="form-control    @error('address') is-invalid   @enderror  ">
                        @error('address') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>
               <hr>
            </div>
            <div class="modal-footer">

            @if($edit_id)
               <button wire:click="delete({{$edit_id}})"
                  wire:confirm.prompt="Weet je zeker dat je de dit adres wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"
                  type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle" id="connectionsDropdown3"
                  data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fa-solid fa-trash"></i>
               </button>
@endif

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