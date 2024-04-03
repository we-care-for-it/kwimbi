<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
               Standaard foutmeldingen</h1>
               <p>Standaard foutmeldingen kunnen gebruikt worden bij het aanmaken een storing of een ticket</p>
             
         </div>

         <div class="col-auto">

            <button type="button" style = "float: right"class="btn   btn btn-soft-primary btn-sm" wire:click="clear()" data-bs-toggle="modal"
               data-bs-target="#crudModal" type="button">
               Toevoegen
            </button>

            <button type="button" onclick="history.back()" class="btn   btn-link btn-sm">
               Terug
            </button>

         </div>

      </div>
   </div>
   <div class="row pt-5 ">
      <div class="col-xl-12">
         <div class="  card-header-content-md-between   pt-0 card-header-form ">
            <div class="mb-3 mb-md-0 pb-2">
               <form>
                  <!-- Search -->
                  <div class="input-group input-group-merge">
                     <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                        placeholder="Zoeken op trefwoord..." data-hs-form-search-options="{
                           &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
                           &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
                           }">
                     <button type="button" class="input-group-append input-group-text ">
                        <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                        <i id="defaultClearIconToggleEg" class="bi-search"
                           style="display: block; opacity: 1.03666;"></i>
                     </button>
                  </div>
                  <!-- End Search -->
               </form>
            </div>

   
                         
         </div>
         <div class="card ">

            <div class="">
               <div class="row">
                  <div>
                     <div class="row" wire:loading.class="loading-div">
                        <div class="col-md-12">
                           @if($this->cntFilters)
                           <div class="alert alert-soft-warning" role="alert">
                              <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                              <= 1) 1 filter @else {{$this->cntFilters}} filters @endif <span
                                 wire:click="resetFilters()" style="cursor: pointer" class="text-primary">Wis alle
                                 filters</span>
                           </div>
                           @endif

                           @if($items->count())

                           <table class="table">
                              <thead class="bg-light">
                                 <tr>
                                    <th style="width: 120px;">Code</th>
                                    <th>Oplossing</th>
                                    <th></th>

                                 </tr>
                              </thead>
                              <tbody>

                                 @foreach ($items as $item) 

                                 <tr style = "cursor: pointer"  wire:click="edit({{$item->id}})"  data-bs-toggle="modal"
                                          data-bs-target="#crudModal">
                                    <th class = "bg-light" scope="row"> {{$item->code}} </th>  
                                    <td> {{$item->error}}</td>
                                    <td class="p-0 m-0"> <button style="float: right"
                                          class="btn btn-ghost-warning text-warning btn-icon btn-sm rounded-circle m-1"
                                          wire:click="edit({{$item->id}})" data-bs-toggle="modal"
                                          data-bs-target="#crudModal">
                                          <i class="bi bi-pencil"></i>
                                       </button>

                                    </td>

                                 </tr>
                                 @endforeach
                              </tbody>
                           </table>

                           @else
                           <div class="flex justify-center items-center space-x-2">
                              <center>
                                 <div>
                                    <img src='/assets/img/illu/1-1-740x592.png' style="max-width: 500px; width: 100%;">
                                    <h4>Geen standaard foutmelding gevonden</h4>
                                    @if($this->cntFilters)
                                    Er zijn geen standaard foutmelding gevonden met de huidige filters
                                    @else
                                    Er zijn nog geen foutmelding gevonden in de database.
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

         </div>
         <div class="clearfix pt-3  ">

            <div class="float-end"> @if($items->links())
               {{ $items->links() }}
               @endif</div>
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
                        <label class="pb-2">Code</label>
                        <input wire:model="code" wire:change = "updateCode()" class="form-control    @error('code') is-invalid   @enderror  ">
                        @error('code') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <div>
                        <label class="pt-2 pb-2">Omschrijving</label>
                        <textarea wire:model="error"
                           class="form-control    @error('error') is-invalid   @enderror  "></textarea>
                        @error('error') <span class="invalid-feedback">{{ $message }}</span> @enderror
                     </div>
                  </div>
               </div>

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