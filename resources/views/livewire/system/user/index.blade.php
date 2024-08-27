<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
 
         <div class="col">
         <img src="/assets/img/ico/users.png" class = "pageico">
            <h1 class="page-header-title">  Gebruikers <span class="text-muted   ms-2"> ({{ $items->Total()}})</h1>
            <span class=" mb-2 text-muted"> Toon pagina <b> {{ $items->currentPage()}} </b> van <b> {{ $items->lastPage()}} </b> met huidige filters <b> {{ $items->Total()}} </b> addressen gevonden</span>
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
                  <!-- <div class="dropdown">
                     <button type="button" class="btn btn-white btn-sm w-100"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasFilters" aria-controls="offcanvasFilters">
                     <i class="bi-filter me-1"></i>   Filter
                     <span class="badge bg-soft-dark text-dark rounded-circle ms-1">{{$cntFilters}}</span>
                     </button>
                  </div> -->
                  <!-- End Dropdown -->
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
                        <x-table.heading>#</x-table.heading>
                        <x-table.heading>Naam</x-table.heading>
                        <x-table.heading>Emailadres</x-table.heading>
                        <x-table.heading>
                          Laatste login     
                        </x-table.heading>
                        <x-table.heading>
                           <center>
                              Logintype
                           </center>
                        </x-table.heading>
                        <x-table.heading></x-table.heading>
                     </x-slot>
                              <x-slot name="body">
                                 @foreach ($items as $item)
                                 <x-table.row wire:key="row-{{ $item->id }}">
                           <x-table.cell> {{sprintf('%04d', $item->id)}}
                           </x-table.cell>
                           <x-table.cell>{{$item->name}}

                           @if(Auth::user()->id == $item->id)
                           <span class = "badge bg-info rounded-pill"  style = "float: right"> Eigenaccount </span>
@endif

                           </x-table.cell>
                           <x-table.cell>{{$item->email}}
                           </x-table.cell>
                           <x-table.cell>
                   
                                 @if($item->last_login_at)
                                 <small>{{ Carbon\Carbon::parse($item->last_login_at)->format('d M Y - H:i') }} </small>
                                 @else
                                 <span class = "badge bg-warning rounded-pill" > Geen<span>
                                 @endif
                            
                           </x-table.cell>
                           <x-table.cell>
                              <center>
                                 @if($item->login_type==1)
                                 <img class="avatar-xss me-2" src="/assets/img/svg/brands/ms.png" style = "height: 20px; 	width: 20px" alt="Microsoft logo">
                                 @elseif($item->login_type==2)
                                 <img class="avatar-xss me-2" src="/assets/img/svg/brands/chrome-icon.svg" style = "height: 20px; 	width: 20px"  alt="Web logo ">
                                 @elseif($item->login_type==3)
                                 <img class="avatar-xss me-2" src="/assets/img/svg/brands/google-icon.svg" style = "height: 20px; 	width: 20px"  alt="Google logo ">
                                 @else
                                 -
                                 @endif
                              </center>
                           </x-table.cell>
                        

                                    
                                  
                          

                                    <x-table.cell>
                                       <div style = "float: right">
                                          <div class="dropdown">
                                             <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle" id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                             <i class="bi-three-dots-vertical"></i>
                                             </button>
                                   
                             

                                                      

                                             <div class="dropdown-menu dropdown-menu-sm dropdown-menu-end" aria-labelledby="connectionsDropdown3">
                                                <span wire:click = "edit({{$item->id}})" data-bs-toggle="modal" data-bs-target="#crudModal"  class="dropdown-item"><i class="bi bi-pencil-square"></i> Wijzig</span>

                                                @if(Auth::user()->id != $item->id)
                                                <div class="dropdown-divider"></div>
                                                <span  wire:click="delete({{$item->id}})"     wire:confirm.prompt="Weet je zeker dat je de adres {{$item->name}} wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD"   class="dropdown-item text-danger"  ><i class="bi bi-trash"></i> Verwijder</span>
                                                @endif
                                             </div>     
                                             
                                        
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
               <small class="text-cap text-body pt-3">Plaats</small>
              

          
       


    

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


   <!-- CrudModal  -->
   <div wire:ignore.self class="modal fade" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
         <div class="modal-content">
            <div class="modal-header">
  
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class = "row">
                  <div class = "col-md-12">
                     <div>
                        <label class = "pb-2">Naam</label>
                        <input wire:model = "name"  class  = "form-control    @error('name') is-invalid   @enderror  " >
                        @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>


             
               <div class = "row pt-3">
                  <div class = "col-md-12">
               
                     <div class  = "pt-3">
                        <label class = "pb-2">E-mailadres</label>
                        <input wire:model = "email"  class  = "form-control    @error('email') is-invalid   @enderror  " >
                        @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
                 
               </div>
               <hr>



               <div class="col-sm-9">          <label class = "pb-2">Logintype</label>
                     <div class="radio-vertical-list">
                        <div class="radio-theme-default custom-radio ">
                           <input class="radio"  wire:model = "login_type" type="radio" name="radio-vertical" value="1" id="radio-vl5">
                           <label for="radio-vl5">
                           <span class="radio-text">Office365</span>
                           </label>
                        </div>
                        <div class="radio-theme-default custom-radio ">
                           <input class="radio"  wire:model = "login_type" type="radio" name="radio-vertical" value="2" id="radio-vl6">
                           <label for="radio-vl6">
                           <span class="radio-text">Website</span>
                           </label>
                        </div>
                        <div class="radio-theme-default custom-radio ">
                           <input class="radio"   wire:model = "login_type"type="radio" name="radio-vertical" value="3" id="radio-vl7">
                           <label for="radio-vl7">
                           <span class="radio-text">Gmail / Google</span>
                           </label>
                        </div>
                     </div>
                  </div>



            

            </div>
            <div class="modal-footer">
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