<div class="container-fluid">
   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">
               Projecten
         </div>
         <div class="col-auto">

            <a href="/projects/create">
               <button type="button" class="btn btn-primary btn-sm  btn-120" wire:click="clear()">
                  Toevoegen
               </button>
            </a>

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

               </div>
            </div>
            <div class="card-body pt-0">
               <div class="row">
                  <div>
                     <div class="row" wire:loading.class="loading-div">
                        <div class="col-md-12">
                           @if($selectPage && $items->count() <> $items->total() ) @unless($selectAll)
                              <div class="pb-3">
                                 Er zijn <strong> {{$items->count()}}</strong> resultaten geselecteerd wil je alle
                                 <strong> {{$items->total()}}</strong> resultaten selecteren ?
                                 <span class="text-primary" style="cursor: pointer;" wire:click="selectAllFromDropdown">
                                    Selecteer alle resultaten
                                 </span>
                              </div>
                              @else
                              <div class="pb-3">
                                 {{$items->total()}} resultaten geselecteerd
                              </div>
                              @endif @else
                              @endif
                              @if($this->cntFilters)
                              <div class="alert alert-soft-warning" role="alert">
                                 <i class="bi-filter me-1"></i> Resultaten gefilterd met @if($this->cntFilters
                                 <= 1) 1 filter @else {{$this->cntFilters}} filters @endif< />
                                 <span wire:click="resetFilters()" style="cursor: pointer" class="text-primary">Wis alle
                                    filters</span>
                              </div>
                              @endif
                              @if($items->count())
                              <x-table>
                                 <x-slot name="head">
                                    <x-table.heading>Project</x-table.heading>
                                    <x-table.heading>Relatie</x-table.heading>
                                    <x-table.heading>
                                       Status
                                    </x-table.heading>
                                    <x-table.heading>
                                       Voortgang
                                    </x-table.heading>
                                    <x-table.heading>
                                       Begindatum
                                    </x-table.heading>
                                    <x-table.heading>
                                       Einddatum
                                    </x-table.heading>
                                    <x-table.heading>
                                    </x-table.heading>
                                 </x-slot>
                                 <x-slot name="body">
                                    @foreach ($items as $item)
                                    <x-table.row wire:key="row-{{ $item->id }}">
                                       <x-table.cell>
                                          <b><a href="/projects/{{ $item->slug }}">{{$item->name}}</a></b><br>
                                          {{$item->description}}
                                       </x-table.cell>
                                       <x-table.cell>
                                          @if($item?->customer?->name) <a href="/debtors/{{$item?->customer?->slug}}">
                                             {{$item?->customer?->name}}</a> @else <span
                                             class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif
                                       </x-table.cell>
                                       <x-table.cell>
                                          <span class=" {{$item?->status?->status_color}} ">
                                             {{$item?->status?->name}}</span>
                                       </x-table.cell>
                                       <x-table.cell>
                                          <div class="d-flex align-items-center">
                                             <span class="fs-6 me-2" style="width: 40px ">{{$item->progress}}%</span>
                                             <div class="progress table-progress">
                                                <div class="progress-bar
                                             @if($item->progress == 100)
                                             bg-success
                                             @elseif($item->progress ==30)
                                             bg-primary
                                             @elseif($item->progress==40)
                                             bg-warning
                                             else
                                             bg-primary
                                             @endif
                                             " role="progressbar" style="width: {{$item->progress}}%" aria-valuenow="0"
                                                   aria-valuemin="0" aria-valuemax="100"></div>
                                             </div>
                                          </div>
                                       </x-table.cell>
                                       <x-table.cell>
                                          @if($item->startdate)
                                          {{ \Carbon\Carbon::parse($item->startdate)->format('d-m-Y')}} @else
                                          <span class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif
                                       </x-table.cell>
                                       <x-table.cell>
                                          @if($item->enddate)
                                          {{ \Carbon\Carbon::parse($item->enddate)->format('d-m-Y')}} @else <span
                                             class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif
                                       </x-table.cell>
                                       <x-table.cell>
                                       <a href="/projects/{{$item->slug}}"> 
                                       <button style="float: right"
                                          class="btn btn-ghost-success text-success btn-icon btn-sm rounded-circle"                                  >
                                          <i class="bi bi-eye"></i>
                                       </button>
                                       </a>



                                       <a href="/projects/{{$item->id}}/edit"> 
                                       <button style="float: right"
                                          class="btn btn-ghost-warning text-warning btn-icon btn-sm rounded-circle"                                  >
                                          <i class="bi bi-pencil"></i>
                                       </button>
                     </a>


                                        
                                       </x-table.cell>
                                    </x-table.row>
                                    @endforeach
                                 </x-slot>
                              </x-table>
                              @else
                              <div class="flex justify-center items-center">
                                 <center>
                                    <div>
                                       <img src='/assets/img/illu/1-1-740x592.png'
                                          style="max-width: 500px; width: 100%;">
                                       <h4>Geen projecten gevonden</h4>
                                       Maak een project aan om de objecten, Taken, etc te organiseren in een project
                                       <div class="clear-fix pb-3"></div>
                                        
                                          <button class="btn btn-soft-success mb-10  btn-sm">
                                             Project aanmaken
                                          </button> 
                                    </div>
                                 </center>
                              </div>
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
   </div>
</div>