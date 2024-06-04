 
<div>
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title"> Projecten</h1>
      </div>

      <div class="col-sm-6   text-end">

      <a href="/project/create" wire:navigate>
<button class="btn   btn-primary   btn-120" >
    

        Toevoegen
        </button>    </a>

      </div>
    </div>
  </div>
 
  <div class="row ">
    <div class="col-md-12">
      <div class="card ">

        <div class="  ">
          <div class="row">
            <div>
            <div  wire:loading>
            @include('layouts.partials._loading')
</div>

              <div class="row" wire:loading.remove >
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
                      <= 1) 1 filter @else {{$this->cntFilters}} filters @endif<br><span wire:click="resetFilters()"
                          style="cursor: pointer" class="text-primary">Wis alle
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

                            @if($item?->customer?->name) <a href="/debtors/{{$item->customer_id}}">
                              {{$item?->customer?->name}}</a> @else <span
                              class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif

                          </x-table.cell>

                          <x-table.cell>

                            <span class=" {{$item?->status?->status_color}} "> {{$item?->status?->name}}</span>

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

                            @if($item->startdate) {{ \Carbon\Carbon::parse($item->startdate)->format('d-m-Y')}} @else
                            <span class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif

                          </x-table.cell>
                          <x-table.cell>
                            @if($item->enddate) {{ \Carbon\Carbon::parse($item->enddate)->format('d-m-Y')}} @else <span
                              class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif

                          </x-table.cell>


                          <x-table.cell>
                                        <div style="float: right">

                                          <a href="/project/{{$item->slug}}">
                                            open</a>

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
          </div>
        </div>
        @if($items->links())
        <div wire:loading.remove class="card-footer  ">
          <div class="float-end ">
            {{ $items->links() }}
          </div>
        </div>
        @endif
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
      <input type="search" wire:model.live="filters.keyword" class="form-control" placeholder="Zoek op trefwoord"
        aria-label="Zoek op trefwoord">
      <small class="text-cap text-body pt-3">Plaats</small>
      <div class="tom-select-custom " wire:ignore>
        <select style="height: 40px;" class="js-select form-select " wire:model.live="filters.place" multiple
          data-hs-tom-select-options='{
            "placeholder": "Alle plaatsen"
            }'>
          @foreach($items as $projects)
          <option value="{{$projects->place}}">{{$projects->place}}</option>
          @endforeach
        </select>
      </div>
      <div class="row pt-4" style="">
        <div class="col-md-6"><button class="btn btn-white btn-sm w-100 " wire:click="resetFilters()">Wis
            filters</button>
        </div>
        <div class="col-md-6">
          <button data-bs-dismiss="offcanvas" aria-label="Close" class="w-100 btn btn-primary btn-sm">Sluiten</button>
        </div>
      </div>
    </div>

  </div>
</div>