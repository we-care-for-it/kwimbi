<div>
    <div class="page-header">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">Voortuigen</h1>
            </div>
            <div class="col-auto">
                <a href="/vehicle/add">
                    <button type="button" class="btn btn-sm btn-primary btn-120">
                        Toevoegen
                    </button>
                </a>
            </div>
        </div>
    </div>
    <div class="row ">
        <div class="col-xl-12">
            <div class="card ">
                <div class="card-header card-header-content-md-between bg-light">
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
                    <div class="d-grid d-sm-flex justify-content-md-end align-items-sm-center gap-2">
                        <div class="d-flex align-items-center justify-content-center">
                            <div wire:loading.delay class="loading_indicator_small"></div>
                        </div>

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
                <div class="card-body p-0 mt-3">
                    <div class="col-md-12">

                        @if($items->count())
                        <x-table>
                            <x-slot name="head">
                                <x-table.heading> </x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('kenteken')">kenteken</x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('voortuigsoort')">Voortuigsoort</x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('merk')">Merk</x-table.heading>
                                <x-table.heading>handelsbenaming</x-table.heading>
                                <x-table.heading sortable wire:click="sortBy('eerste_kleur')">Kleur</x-table.heading>
                                <x-table.heading></x-table.heading>
                            </x-slot>
                            <x-slot name="body">
                                @foreach ($items as $item)
                                <x-table.row wire:key="row-{{ $item->id }}">
                                <x-table.cell>
                                @if($item->image)
                     <img class="avatar-img " style="max-height: 40px; max-width: 40px"" src="/storage/{{$item->image}}">
                  @else
                     <img class="avatar-img  " style="max-height:40px; max-width: 40px"" src="/assets/img/160x160/img2.jpg">
                  @endif
                                    </x-table.cell>



                                    <x-table.cell>
                                        {{formatLicensePlate($item->kenteken)}}
                                    </x-table.cell>

                                    <x-table.cell>
                                        {{$item->voertuigsoort}}
                                    </x-table.cell>

                                    <x-table.cell>
                                        {{$item->merk}}
                                    </x-table.cell>
                                    <x-table.cell>
                                        {{$item->handelsbenaming}} {{$item->type}} {{$item->variant}}
                                    </x-table.cell>

                                    <x-table.cell>
                                        {{$item->eerste_kleur}} @if($item?->tweede_kleur) / {{$item?->tweede_kleur}}
                                        @endif
                                    </x-table.cell>

                                    <x-table.cell>
                                        <div style="float: right">

                                            <div class="dropdown">
                                                <button type="button" class="btn btn-icon btn-sm  " id="apiKeyDropdown1"
                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="bi-three-dots-vertical"></i>
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end"
                                                    aria-labelledby="apiKeyDropdown1">
                                                    <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                        wire:click="edit({{$item->id}})"
                                                        data-bs-target="#crudModal">Wijzig</a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item text-danger" href="#"
                                                        wire:click="delete({{$item->id}})"
                                                        wire:confirm.prompt="Weet je zeker dat je de deze rij wilt verwijderen?\n\nType AKKOORD voor bevestiging |AKKOORD">Verwijderen</a>
                                                </div>
                                            </div>

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
                <div class="modal-body" wire:loading.class="loading-div">
                    <div class="row">
                        <div class="col-md-12">
                            <div>
                                <label class="pb-2">Naam</label>
                                <input wire:model="name"
                                    class="form-control    @error('name') is-invalid   @enderror  ">
                                @error('name') <span class="invalid-feedback">{{ $message }}</span> @enderror
                            </div>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-sm btn-link btn-120" data-bs-dismiss="modal">Sluiten</button>
                    <button class="btn btn-primary btn-sm btn-120    " wire:click="save()" type="button">
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