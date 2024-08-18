<div class="container-fluid">

   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title"> @if($elevator->address_id)
               {{$elevator->address?->address}} {{$elevator->address?->place}}
               @if($elevator->address?->name)
               ({{$elevator->address?->name}})
               @endif
               @else
               Geen relatie
               @endif
            </h1>
         </div>
         <div class="col-auto">

            @if($elevator->archive==1)
            <button wire:loading.attr="disabled" type="button"
               wire:confirm="Weet je zeker dat je deze lift wil de-activeren ?" class="btn    btn-link"
               wire:click="DeArchiveElevator({{$elevator->id}})">
               de-archiveer
            </button>

            @else
            <button wire:loading.attr="disabled" type="button"
               wire:confirm="Weet je zeker dat je deze lift wil archiveren ?" class="btn    btn-link"
               wire:click="archiveElevator({{$elevator->id}})">
               Archiveer
            </button>
            @endif

            <button id="btn1" type="button" data-bs-toggle="modal" data-bs-target="#add_incident_modal"
               style=" width: 190px; " class="btn btn-soft-primary">
               <i class="uil uil-exclamation-triangle me-2"></i> Storing aanmelden </button>
            <div wire:ignore.self id="add_incident_modal" class="modal fade add_incident_modal" tabindex="-1"
               role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
               <div class="modal-dialog modal-dialog-centered modal-lg">
                  <div class="modal-content">
                     <div class="modal-header">
                        <h5 class="modal-title">Storing aanmelden </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                     </div>
                     <div class="modal-body">
                        @if($elevator->countIncident)
                        <div class=" bg-orange-100 border border-orange-400 text-orange-700 px-4 py-3 rounded relative"
                           role="alert">
                           <span class="block sm:inline">Er is een storing aangemeld op deze lift, Controleer of er geen
                              storing aangemaakt word die al aanwezig is </span>
                        </div>
                        <br> @endif
                        <div class="row">
                           <div class="col-md-4">
                              <div class=" bg-gray-100">
                                 <div class="col-sm-12">
                                    <div class="mb-3">
                                       <label class="pb-2">Melddatum</label>
                                       <input wire:model.defer="report_date_time" class="form-control"
                                          type="datetime-local">
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="mb-3">
                                       <label class="pb-2">Liftstilstand</label>
                                       <x-input.select wire:model.defer="stand_still">
                                          <option value="1">Ja </option>
                                          <option value="0">Nee </option>
                                       </x-input.select>
                                    </div>
                                 </div>
                                 <div class="mb-3">
                                    <label class="pb-2">Type storing</label>
                                    <x-input.select wire:model.defer="type_id">
                                       <option value="1">Technisch </option>
                                       <option value="2">Extern </option>
                                    </x-input.select>
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-8">
                              @if ($errors->any())
                              <div class="alert alert-danger" role="alert"> @foreach ($errors->all() as $error) -
                                 {{ $error }}
                                 <br> @endforeach
                              </div>
                              @endif
                              <div class="mb-3">
                                 <label class="pb-2">Onderwerp</label>
                                 <input class="form-control" wire:model.defer="subject"
                                    placeholder="Onderwerp van de storing">
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Omschrijving</label>
                                 <textarea class="form-control" rows="4" cols="50" wire:model.defer="descriptioni"
                                    placeholder="Beschrijf zo goed mogelijk de storing"></textarea>
                                 @error('descriptioni') <span class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Contactpersoon</label>
                                 <input class="form-control" rows="4" cols="50" wire:model.defer="contactperson">
                                 @error('contactperson') <span class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Telefoonnummer</label>
                                 <input wire:model.defer="contactperson_phonenumber" type="text" class="form-control"
                                    id="inlineFormInputGroupUsername">
                              </div>
                              <div class="mb-3">
                                 <label class="pb-2">Adres</label>
                                 <input class="form-control" rows="4" cols="50"
                                    wire:model.defer="contactperson_address"> @error('contactperson_address') <span
                                    class="invalid-feedback">{{ $message }}
                                 </span> @enderror
                              </div>
                           </div>
                        </div>
                        <div style="float: right">
                           <br>
                           <button type="button" wire:click="storeIncident()" class="btn btn-soft-primary">
                              <i class="uil uil-exclamation-triangle me-2"></i> Storing aanmelden </button>
                        </div>
                     </div>
                  </div>
                  <!-- /.modal-content -->
               </div>
               <!-- /.modal-dialog -->
            </div>

            <button type="button" data-bs-toggle="modal" data-bs-target="#add_attachment_modal"
               wire:click="show_upload()" style=" width: 150px; " class="btn btn-soft-primary">
               Bijlage </button>

            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary">
               <i class="fa-solid fa-angle-left"></i> Terug </button>
            <button type="button" wire:click="store()" style=" width: 150px; " class="btn btn-soft-success"> Opslaan
            </button>
         </div>
      </div>
   </div>

   @if($elevator->archive)
   <div class="alert alert-soft-warning" role="alert">
      <strong class="font-bold">Melding! </strong>
      <span class="block sm:inline">Deze lift is ge-archiveerd</span>
   </div>
   <br>@endif

   @if($elevator->countIncident)
   <div class="alert alert-soft-warning" role="alert"> <strong class="font-bold">Melding! </strong>
      <span class="block sm:inline">Er is een storing gemeld op deze lift, Kijk bij storingen voor meer informatie
      </span>
   </div>
   <br> @endif @if($elevator->stand_still)
   <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
      <strong class="font-bold">Melding! </strong>
      <span class="block sm:inline">Lift buitengebruik vanaf:
         {{ Carbon\Carbon::parse($elevator->stand_still_date)->format('d-m-Y') }}
      </span>
   </div>
   <br> @endif
   <div class="row">
      <div class="col-8">
         <div class="card">
            <div class="card-body">
               <div class="row">
                  <div class="col-md-5">
                     <x-input.select wire:model="customer_id">
                        <option value="0">Selecteer </option>
                        @foreach ($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->name }}
                        </option>
                        @endforeach
                     </x-input.select>
                  </div>
                  <div class="col-md-6">

                     <select class="form-select" @if(!$customer_id) disabled @endif wire:model="address_id">
                        <option selected value="0">Selecteer adres </option>
                        @if(count($addresses)==0)
                        <option selected value="0">Geen object addressen gevonden </option>
                        @else @foreach ($addresses as $address)
                        <option selected value="{{ $address->id }}">{{ $address->address }}
                           {{ $address->zipcode }} {{ $address->place }}
                        </option>
                        @endforeach @endif
                     </select>
                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-3 ">
            <div class="col-md-4">
               <div class="card ">
                  <div class="card-header card-header-content-md-between bg-light">
                     Onderhoudsbedrijf
                  </div>
                  <div class="card-body" style="height: 150px;">
                     @if($elevator->maintenance_company_id)
                     <ul class="list-unstyled mb-0">
                        <li class="pb-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-hospital"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">Naam </p>
                                 <h5 class="mb-0 font-size-14">{{$elevator?->maintenancecompany?->name}}
                                 </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <li class="py-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-envelope-alt"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">E-mail </p>
                                 <h5 class="mb-0 font-size-14">{{$elevator?->maintenanceCompany?->email}}
                                 </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <!-- end li -->
                        <!-- end li -->
                     </ul>
                     @else
                     <div class="alert alert-soft-warning" role="alert">
                        Geen gegevens gevonden
                     </div>
                     @endif
                  </div>
                  <div class="card-footer">
                     <x-input.select wire:model="maintenance_company_id">
                        <option value="0">Selecteer </option>
                        @foreach ($maintenancyCompanies as $maintenancyCompanie)
                        <option value="{{ $maintenancyCompanie->id }}">{{ $maintenancyCompanie->name }}
                        </option>
                        @endforeach
                     </x-input.select>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Beheerder
                  </div>
                  <div class="card-body" style="height: 150px;">
                     @if($elevator?->address?->management)
                     <ul class="list-unstyled mb-0">
                        <li class="pb-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-hospital"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">Naam </p>
                                 <h5 class="mb-0 font-size-14">{{$elevator?->address?->management?->name}}
                                    @if($elevator?->address?->contact)
                                    {{$elevator?->address?->contact?->name}}
                                    @endif
                                 </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <li class="py-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-envelope-alt"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">E-mail </p>
                                 <h5 class="mb-0 font-size-14"> @if($elevator->address?->management?->email)
                                    {{$elevator->address?->management?->email}} @else - @endif </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <!-- end li -->
                        <!-- end li -->
                     </ul>
                     @else
                     <div class="alert alert-warning border-0 d-flex align-items-center" role="alert">
                        <i class="uil uil-exclamation-triangle font-size-16 text-warning me-2"></i>
                        <div class="flex-grow-1 text-truncate"> Geen beheerder aan het adres gekoppeld </div>
                     </div>
                     @endif
                  </div>
                  <div class="card-footer">
                     <x-input.select disabled>
                        @if($elevator->address_id)
                        <option value="0">{{$elevator->address?->management?->name}}
                        </option>
                        @else
                        <option selected>Kies adres </option>
                        @endif
                     </x-input.select>
                  </div>
               </div>
            </div>
            <div class="col-md-4">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Keuringinstantie
                     @if($elevator->inspection_plandate ) <span class="badge badge-soft-primary py-2 m-0"
                        style="float: right"> Gepland:
                        {{ Carbon\Carbon::parse($elevator->inspection_plandate)->format('d-m-Y') }}
                     </span> @endif
                  </div>
                  <div class="card-body" style="height: 150px;">
                     @if($elevator->inspection_company_id)
                     <ul class="list-unstyled mb-0">
                        <li class="pb-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-hospital"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">Naam </p>
                                 <h5 class="mb-0 font-size-14">{{$elevator->inspectionCompany?->name}}
                                 </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <li class="py-3">
                           <div class="d-flex align-items-center">
                              <div class="font-size-20 text-primary flex-shrink-0 me-3">
                                 <i class="uil uil-envelope-alt"></i>
                              </div>
                              <div class="flex-grow-1">
                                 <p class="text-muted mb-1 font-size-13">E-mail </p>
                                 <h5 class="mb-0 font-size-14"> @if($elevator->inspectionCompany?->email)
                                    {{$elevator->inspectionCompany?->email}} @else - @endif </h5>
                              </div>
                           </div>
                        </li>
                        <!-- end li -->
                        <!-- end li -->
                        <!-- end li -->
                     </ul>
                     @else
                     <div class="alert alert-soft-warning" role="alert">
                        Geen gegevens gevonden
                     </div>
                     @endif
                  </div>
                  <div class="card-footer">
                     <x-input.select wire:model="inspection_company_id">
                        <option value="0">Selecteer </option>
                        @foreach ($inspectionCompanies as $inspectionCompanie)
                        <option value="{{ $inspectionCompanie->id }}">{{ $inspectionCompanie->name }}
                        </option>
                        @endforeach
                     </x-input.select>
                  </div>
               </div>
            </div>
         </div>

         @if($elevator->AllElevatorOnThisAddress)
         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Liften op deze locatie
                     </span>
                  </div>
                  <div class="card-body">
                     <table class="table tabel-sm">
                        <thead>
                           <th scope="col">Address </th>
                           <th scope="col">Unit No </th>
                           <th scope="col">Omschrijving </th>
                           <th scope="col">Categorie </th>
                           <th scope="col">Energielabel </th>
                           <th scope="col">Nobo nr. </th>
                           <th scope="col"> </th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($elevator->AllElevatorOnThisAddress as $elevator_item )
                           <tr>
                              <td class="align-middle">
                                 {{$elevator_item?->address->address}}

                              </td>
                              <td class="align-middle">
                                 @if($elevator_item->fire_elevator)
                                 <span class=" text-danger  " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Brandweerlift">
                                    <i class=" fa-solid fa-fire"></i>
                                 </span>
                                 @endif
                                 @if($elevator_item->stretcher_elevator)
                                 <span style="width: 40px; @if($elevator->fire_elevator) margin-right: 3px; @endif"
                                    class=" text-primary    " data-bs-toggle="tooltip" data-bs-placement="bottom"
                                    title="Brancard / Bedlift">
                                    <i class="fa-solid fa-bed"></i>
                                 </span>
                                 @endif
                                 {{$elevator_item->unit_no}}
                              </td>
                              <td class="align-middle">
                                 {{$elevator_item->description}}
                              </td>
                              <td class="align-middle">
                                 <small> @if($elevator_item?->type_id)

                                    {{config('globalValues.object_types')[$elevator_item?->type_id]}}

                                    @else
                                    -

                                    @endif </small>
                              </td>
                              <td class="align-middle">
                                 <div class="energy-class">
                                    @if($elevator_item->energy_label=='A')
                                    <div class="a"></div>
                                    @elseif($elevator_item->energy_label=='B')
                                    <div class="b"></div>
                                    @elseif($elevator_item->energy_label=='C')
                                    <div class="c"></div>
                                    @elseif($elevator_item->energy_label=='D')
                                    <div class="d"></div>
                                    @elseif($elevator_item->energy_label=='E')
                                    <div class="e"></div>
                                    @elseif($elevator_item->energy_label=='F')
                                    <div class="f"></div>
                                    @elseif($elevator_item->energy_label=='G')
                                    <div class="g"></div>
                                    @else
                                    Onbekend
                                    @endif
                                 </div>
                              </td>
                              <td class="align-middle"> {{$elevator_item->nobo_no}}</td>
                              <td class="align-middle">
                                 @if($elevator->id == $elevator_item->id)
                                 <div style="float: right"> Geopend</div>
                                 @else
                                 <a style="float: right" href="/company/elevator/show/{{$elevator_item->id}}">
                                    <button class="btn btn-soft-primary btn-sm">Open lift</button>
                                 </a>
                                 @endif
                              </td>
                           <tr>
                              @endforeach
                        </tbody>
                     </table>
                  </div>
               </div>
            </div>
         </div>
         @endif

         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Onderhoudscontracten <span wire:click="addMaintenanceContractAction()" data-bs-toggle="modal"
                        data-bs-target="#maintenanceContractCrudModal" class="btn btn-soft-secondary btn-sm">Toevoegen
                        <i class="mdi mdi-plus ms-1"></i>
                     </span>
                  </div>
                  <div class="card-body">
                     @if(count($elevator->MaintenancyContracts))
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col">Van datum </th>
                              <th scope="col">Tot datum </th>
                              <th scope="col">Type </th>
                              <th scope="col">Opties</th>
                              <th scope="col">Partij</th>
                              <th scope="col">Onderhoudscontract</th>
                              <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($elevator->MaintenancyContracts as $maintenancycontract)
                           <tr>
                              <td class="align-middle">
                                 {{ Carbon\Carbon::parse($maintenancycontract->begindate)->format('d-m-Y') }}
                              </td>
                              <td class="align-middle">
                                 {{ Carbon\Carbon::parse($maintenancycontract->enddate)->format('d-m-Y') }}
                              </td>
                              <td class="align-middle">
                                 @if($maintenancycontract->type_id==1)
                                 <span class="badge  bg-soft-info text-info p-2">Eenvoudig </span>
                                 @elseif($maintenancycontract->type_id==2)
                                 <span class="badge  bg-soft-info text-info p-2">Uitgebreid </span>
                                 @elseif($maintenancycontract->type_id==3)
                                 <span class="badge   bg-soft-info text-info p-2">All in </span>
                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenancycontract->option1)
                                 <span class="badge  bg-soft-primary text-primary p-2"> Spreek / Luisterverbinding
                                 </span>
                                 @endif
                                 @if($maintenancycontract->option2)
                                 <span class="badge  bg-soft-primary text-primary p-2"> Keuring </span>
                                 @endif
                                 @if($maintenancycontract->option3)
                                 <span class="badge   bg-soft-primary text-primary p-2"> Assistentie keuring </span>
                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenancycontract->maintenancecompany)
                                 {{$maintenancycontract?->maintenancecompany?->name}}
                                 @else
                                 {{$elevator?->maintenancecompany?->name}}

                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenancycontract->document)
                                 <button
                                    wire:click="downloadDocument('maintenancycontract','{{$maintenancycontract->id}}')"
                                    type="button" class="btn btn-soft-success  btn-sm" id="connectionsDropdown3"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa-solid fa-file-pdf"></i> Download
                                 </button>
                                 @else
                                 -@endif

                              </td>
                              <td class="align-middle">
                                 <div style="float: right">
                                    <div style="float:right">
                                       <button wire:click="editMaintenancyContract({{$maintenancycontract->id}})"
                                          type="button" data-bs-toggle="modal"
                                          data-bs-target="#maintenanceContractCrudModal"
                                          class="btn btn-ghost-warning btn-icon btn-sm rounded-circle"
                                          id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="fa-solid fa-pencil"></i>
                                       </button>
                                       <button wire:click="deleteMaintenanceContract({{$maintenancycontract->id}})"
                                          wire:confirm.prompt="Weet je zeker dat je dit onderhoudcontract wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD"
                                          type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle"
                                          id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                          <i class="fa-solid fa-trash"></i>
                                       </button>
                                    </div>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     @else Geen onderhoudscontracten gevonden @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Onderhoudsbeurten ( {{count($elevator->maintenance)}} )
                     <span data-bs-toggle="modal" data-bs-target="#maintenanceCrudModal"
                        class="btn btn-soft-secondary btn-sm">Toevoegen <i class="mdi mdi-plus ms-1"></i>

                  </div>

                  <div class="card-body">

                     @if(count($elevator->maintenance))
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col">Status </th>
                              <th scope="col">Opmerking </th>
                              <th scope="col">Plandatum </th>
                              <th scope="col">Uitvoeringsdatum </th>
                              <th scope="col"></th>
                              <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($elevator->maintenance as $maintenance)
                           <tr>
                              <td class="align-middle">
                                 @if($maintenance->status_id==2)
                                 <span class="badge   bg-soft-primary text-primary  p-2"> Uitgevoerd </span>
                                 @elseif($maintenance->status_id==1)
                                 <span class="badge   bg-soft-primary text-primary p-2">Gepland </span>
                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenance->remark)
                                 <small>{{$maintenance->remark}}</small>
                                 @endif
                              <td class="align-middle">
                                 @if($maintenance->planned_at)
                                 {{ Carbon\Carbon::parse($maintenance->planned_at)->format('d-m-Y') }}
                                 @else
                                 -
                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenance->executed_datetime)
                                 {{ Carbon\Carbon::parse($maintenance->executed_datetime)->format('d-m-Y') }}
                                 @else
                                 -
                                 @endif
                              </td>
                              <td class="align-middle">
                                 @if($maintenance->attachment)
                                 <button class="btn btn-soft-primary btn-sm"
                                    wire:click="downloadDocument('maintenance','{{$maintenance->id}}')"
                                    style="float: right; ">
                                    <i class="fa-solid fa-paperclip"></i> Download </button>
                                 @endif
                              </td>
                              <td>

                                 <div style="float:right">
                                    <button wire:click="editMaintenancy({{$maintenance->id}})" type="button"
                                       data-bs-toggle="modal" data-bs-target="#maintenanceCrudModal"
                                       class="btn btn-ghost-warning btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-pencil"></i>
                                    </button>
                                    <button wire:click="deleteMaintenance({{$maintenance->id}})"
                                       wire:confirm.prompt="Weet je zeker dat je dit onderhoudcontract wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD"
                                       type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                                 </div>

                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     @else Geen onderhoudsbeurten gevonden @endif

                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Storingen
                ( {{count($elevator->incidents)}} )
                     <span data-bs-toggle="modal" data-bs-target="#add_incident_modal"
                        class="btn btn-soft-secondary btn-sm">Toevoegen <i class="mdi mdi-plus ms-1"></i>

                  </div>
                  <div class="card-body">
                     @if(count($elevator->incidents))
                     <table class="table table-striped">
                        <thead>
                           <tr>
                              <th scope="col" style="width: 20px;"># </th>
                              <th scope="col" style="width: 200px;">Datum/ tijd </th>
                              <th scope="col">Status </th>
                              <th scope="col">Bijlage's </th>
                              <th scope="col">Omschrijving </th>
                              <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($elevator->incidents as $incident)
                           <tr>
                              <td class="align-middle">{{printf("%06d", $incident->id)}}
                              </td>
                              <td class="align-middle">
                                 {{ Carbon\Carbon::parse($incident->report_date_time)->format('d-m-Y - H:i') }}
                              </td>
                              <td class="align-middle"> @if($incident->status_id==0)
                                 <span class="badge  bg-soft-primary text-primary p-2 py-2">Nieuw </span>
                                 @elseif($incident->status_id==2)
                                 <span class="badge  bg-soft-primary text-primary p-2  py-2 ">Doorgestuurd naar
                                    onderhoudsbedrijf </span> @elseif($incident->status_id==3)
                                 <span class="badge  bg-soft-primary text-primary p-2 py-2">Wacht op offerte </span>
                                 @elseif($incident->status_id==4)
                                 <span class="badge  bg-soft-primary text-primary p-2 py-2">Offerte naar klant gestuurd
                                 </span> @elseif($incident->status_id==5) <span
                                    class="badge  bg-soft-primary text-primary p-2 ">Niet gereed </span>
                                 @elseif($incident->status_id==99) <span
                                    class="badge  bg-soft-success text-success p-2  ">Gereed </span> @endif
                                 @if($incident->stand_still) <span style="margin-top: 5px; "
                                    class=" badge rounded-pill badge-outline-danger  p-2 pl-2">
                                    <i class="uil-exclamation-triangle"></i> Lift buitenbedrijf </span> @endif
                              </td>
                              <td class="align-middle">
                                 @forelse ($incident->uploads as $item)
                                 <div class="pb-2 border-bottom: 1px solid #EFEFEF">
                                    <a href="#"
                                       wire:click="downloadIncidentUpload('{{$item->path}}/{{$item->filename}}')">
                                       {{ \Illuminate\Support\Str::limit($item->filename, 34, $end='...') }}
                                 </div>
                                 @empty Geen @endforelse
                              </td>
                              <td class="align-middle">
                                 {{$incident->description}} @if($incident->stand_still) <br>
                                 <q>
                                    <span class="text-danger">Door deze storing is de lift buiten bedrijf </span>
                                 </q> @endif
                              </td>
                              <td class="align-middle">
                                 <div style="float:right">
                                    <button type="button"
                                       onclick="window.location='/company/incident/show/{{ $incident->id }}';"
                                       class="btn btn-ghost-warning btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-regular fa-eye"></i>
                                    </button>
                                 </div>
                              </td>
                           </tr>
                           @endforeach
                        </tbody>
                     </table>
                     @else Geen storing gevonden @endif
                  </div>
               </div>
            </div>
         </div>
         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Keuringen <span href="/lva/elevators" wire:click="addInspection()" data-bs-toggle="modal"
                        data-bs-target="#inpectionCrudModal" class="btn btn-soft-secondary btn-sm">Toevoegen <i
                           class="mdi mdi-plus ms-1"></i>
                  </div>
                  <div class="card-body">
                     @if(count($elevator->inspections))
                     <table class="table table-striped">
                        <thead>
                           <tr>

                              <th scope="col" style="width: 120px;">Status </th>
                              <th scope="col" style="width: 120px;">Begindatum </th>
                              <th scope="col" style="width: 120px;">Einddatum </th>
                              <th scope="col" style="width: 220px;">Type </th>

                              <th scope="col"></th>
                              <th scope="col"></th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach ($elevator->inspections as $inspection)
                           <tr>

                              <td style=" width: 140px;" class="align-middle">

                                 @if($inspection->status_id==1)
                                 <span class="badge bg-soft-success text-success py-2"> Goedgekeurd </span>
                                 @endif
                                 @if($inspection->status_id==2)
                                 <span class="badge bg-soft-warning text-warning py-2"> Goedgekeurd met acties </span>
                                 @endif @if($inspection->status_id==3)
                                 <span class="badge bg-soft-danger text-danger py-2 "> Afgekeurd </span>
                                 @endif @if($inspection->status_id==4)
                                 <span class="badge bg-soft-info text-info py-2"> Onbeslist </span>
                                 @endif @if($inspection->status_id==5)
                                 <span class=" badge bg-soft-primary text-primary py-2">
                                    Niet afgerond
                                 </span> @endif

                                 @if($inspection?->RepetitionCount)
                                 <span class="badge bg-soft-primary  text-primary py-2 pt-2"> H</span>
                                 @endif

                              </td>
                              <td class="align-middle">
                                 {{ Carbon\Carbon::parse($inspection->executed_datetime)->format('d-m-Y') }}
                              </td>
                              <td class="align-middle">
                                 {{ Carbon\Carbon::parse($inspection->end_date)->format('d-m-Y') }}
                              </td>

                              <td class="align-middle">
                                 @if($inspection->type)

                                 {!! str_replace('machine periodiek', ' ',$inspection->type) !!}

                                 @endif
 
                              </td>

                              <td class="align-middle "  >

                       
                                 @if($inspection->document)

                                 @if($inspection->if_match == 1)
                                 <button class="btn btn-soft-primary btn-sm" 
                                    wire:click="downloadBase64('{{$inspection->document}}','{{ Carbon\Carbon::parse($inspection->executed_datetime)->format('d-m-Y') }} - {{ Carbon\Carbon::parse($inspection->end_date)->format('d-m-Y') }}')">  Rapportage
                                 </button>
                                 @else
                                 <button class="btn btn-soft-primary btn-sm "
                                    wire:click="downloadDocument('inspection','{{$inspection->id}}')"
                               >
                                Rapportage
                              </button>
                                 @endif

                              
                                 @endif
                                 @if($inspection->certification)
                                 @if($inspection->if_match == 1)
                                 <button class="btn btn-soft-primary btn-sm"
                                    wire:click="downloadBase64('{{$inspection->certification}}','{{ Carbon\Carbon::parse($inspection->executed_datetime)->format('d-m-Y') }} - {{ Carbon\Carbon::parse($inspection->end_date)->format('d-m-Y') }}')"> 
                                      Certificaat</button>
                                 @else
                               
                                 <button class="btn btn-soft-primary btn-sm "
                                    wire:click="downloadDocument('certification','{{$inspection->id}}')"
                            >
                             Certificaat </button>
                             
                             @endif


                                 @endif

                              </td>
                              <td class="align-middle ">

                              @if($inspection->remark)
 
      {{$inspection->remark}}
      @endif
 

                              </td>

                              <td class="align-middle">
                                 <div style="float:right">
                                   

                                    @if(count($inspection->details))
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle"
                                       data-bs-toggle="modal" data-bs-target="#inspectionDataModal{{$inspection->id}}">
                                       <i class="fa-solid fa-circle-info"></i>
                                    </button>
                                    @endif

                                    <button type="button" wire:click="editInspection({{$inspection->id}})"
                                       data-bs-toggle="modal" data-bs-target="#inpectionCrudModal"
                                       class="btn btn-ghost-warning btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-pencil"></i>
                                    </button>
                             

                                    <!-- Modal -->
                                    @if($inspection->details)
                                    <div class="modal fade" id="inspectionDataModal{{$inspection->id}}" tabindex="-1"
                                       aria-labelledby="inspectionDataModal{{$inspection->id}}" aria-hidden="true">
                                       <div class="modal-dialog  modal-dialog-centered modal-xl ">
                                          <div class="modal-content">
                                             <div class="modal-header">
                                                <h5 class="modal-title" id="inspectionDataModal">Keuringspunten
                                                   #{{$inspection->external_uuid}}</small></h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                   aria-label="Close"></button>
                                             </div>
                                             <div class="modal-body">
                                                <table class="table table-striped">

                                                   <thead>
                                                      <tr>
                                                         <th scope="col" style="width: 120px;">Code</th>

                                                         <th scope="col">Omschrijving </th>
                                                         <th scope="col" style="width: 120px;">Type </th>
                                                         <th scope="col" style="width: 120px;">Status </th>
                                                   </thead>

                                                   <tbody>

                                                      @foreach($inspection->details as $detail)
                                                      <tr>
                                                         <td class="align-baseline">{{$detail?->zin_code}}</td>

                                                         <td class="align-baseline">{{$detail?->comment}}</td>
                                                         <td class="align-baseline">{{$detail?->type}}</td>
                                                         <td class="align-baseline">

                                                            @if($detail->status=='Herhaling')
                                                            <span class="badge bg-soft-warning  text-warning py-2 pt-2">
                                                               Herhaalpunten</span>

                                                            @else
                                                            -
                                                            @endif

                                                         </td>
                                                      </tr>
                                                      @endforeach

                                                   </tbody>
                                                </table>
                                             </div>
                                             <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary btn-120 btn-sm"
                                                   data-bs-dismiss="modal">Sluiten</button>

                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    @endif

                          
                                    <button wire:click="deleteInspection({{$inspection->id}})"
                                       wire:confirm.prompt="Weet je zeker dat je deze onderhoudsbeurt wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD"
                                       type="button" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle"
                                       id="connectionsDropdown3" data-bs-toggle="dropdown" aria-expanded="false">
                                       <i class="fa-solid fa-trash"></i>
                                    </button>
                                 </div>
                              </td>

                           </tr>

                          
           
                           @endforeach
                        </tbody>
                     </table>
                     @else Geen keuringen geregisteerd @endif
                     <!-- Button trigger modal -->
                     <!-- keuringen MODAL  -->
                     <div class="modal fade" wire:ignore.self id="inpectionCrudModal" tabindex="-1"
                        aria-labelledby="inpectionCrudModal" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered  modal-xl">
                           <div class="modal-content">
                              <div class="modal-header">
                                 @if($inspection_id)
                                 Keuring wijzigen
                                 @else
                                 Keuring toevoegen
                                 @endif<button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                 <div class="row">
                                    <div class="col-md-2">
                                       <label class="mb-2"> Uitvoeringsdatum </label>
                                       <br>
                                       <input wire:model="inspection_executed_datetime"
                                          class=" @if ($errors->has('inspection_executed_datetime'))  is-invalid @endif form-control"
                                          type="date">
                                    </div>
                                    <div class="col-md-4">
  

                                       <div style="padding-top: 30px;">
                                          <button type="button" class="btn btn-soft-primary"
                                             wire:click="addMonthsInspection(12)"> + 1 jaar </button>
                                          <button type="button" class="btn btn-soft-primary"
                                             wire:click="addMonthsInspection(18)"> + 1,5 jaar </button>
                                       </div>
                                    </div>
                                    <div class="col-md-2">
                                       <label class="mb-2"> Einddatum </label>
                                       <br>
                                       <input wire:model="inspection_end_date"
                                          class=" @if ($errors->has('inspection_end_date'))  is-invalid @endif form-control"
                                          type="date">
                                    </div>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="mb-2"> Status </label>
                                       <br>
                                       <select wire:model="inspection_status_id" class="form-select">
                                          <option selected value="1">Goedgekeurd</option>
                                          <option value="2">Goedgekeurd met acties</option>
                                          <option value="3">Afgekeurd</option>
                                          <option value="4">Onbeslist</option>
                                          <option value="5">Niet afgerond</option>
                                       </select>
                                    </div>
                                    <div class="col-md-6">
                                       <label class="mb-2"> Opmerking </label>
                                       <br>
                                       <textarea wire:model="inspection_remark" class="form-control"></textarea>
                                       <br><br>
                                    </div>
                                    <div class="row   p-2">
                                       <div class="col-md-6">
                                          <label class="mb-2">Keuringsrapportage</label>
                                          <div wire:loading>
                                          </div>
                                          @if($attachmentDocument)
                                          <br>
                                          @if($inspection_id)
                                          <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                             wire:click="deleteInspectionDocument('document','{{$inspection?->id}}')"
                                             class="btn btn-soft-danger ">
                                             <i class="fa-solid fa-trash"></i> Verwijder
                                          </button>
                                          @else
                                          <b>Bestand toegevoegd</b>
                                          @endif
                                          @else
                                          <br>
                                          <input
                                             class="  @if ($errors->has('attachmentDocument'))  is-invalid @endif form-control "
                                             type="file" wire:model="attachmentDocument">
                                          @endif
                                       </div>
                                       <div class="col-md-6 ">
                                          <label class="mb-2">Certificaat</label>
                                          @if($attachmentCertification)
                                          <br>
                                          @if($inspection_id)
                                          <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                             wire:click="deleteInspectionDocument('certification','{{$inspection->id}}')"
                                             class="btn btn-soft-danger ">
                                             <i class="fa-solid fa-trash"></i> Verwijder
                                          </button>
                                          @else
                                          <b>Bestand toegevoegd</b>

                                          @endif

                                          @else
                                          <br>
                                          <input
                                             class="  @if ($errors->has('attachmentCertification'))  is-invalid @endif form-control "
                                             type="file" wire:model="attachmentCertification">
                                          @endif
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="modal-footer">
                                 <button type="button" class="btn btn-soft-warning"
                                    data-bs-dismiss="modal">Sluiten</button>
                                 <button wire:loading.attr="disabled" class="btn btn-soft-success    "
                                    wire:click="saveInspection()" type="button">
                                    <div wire:loading>
                                       <span class="spinner-border spinner-border-sm" role="status"
                                          aria-hidden="true"></span>
                                    </div>
                                    Opslaan
                                 </button>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         @if(count($elevator->uploads->where('type_id','!=',99)->whereNotIn('type_id', [99,4,2])))
         <div class="row pt-3">
            <div class="col-md-12">
               <div class="card">
                  <div class="card-header card-header-content-md-between bg-light">
                     Bijlages ( {{count($this->elevator->uploads->whereNotIn('type_id', [99,4,2]))  }} )
                     <span data-bs-toggle="modal" data-bs-target="#add_attachment_modal" wire:click="show_upload()"
                        class="btn btn-soft-secondary btn-sm">Toevoegen <i class="mdi mdi-plus ms-1"></i>
                     </span>
                  </div>

                  <table class="table table-striped">
                     @foreach ($elevator->uploads->whereNotIn('type_id', [99,4,2])->groupby('type_id')
                     as $key => $upload)

                     <body>
                        @forelse ($upload as $item)
                        <tr>
                           <td style="width: 20px;">
                              <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                 wire:click.prevent='deleteUpload({{ $item->id }})' class="btn btn-soft-danger ">
                                 <i class="fa-solid fa-trash"></i>
                              </button>
                           </td>
                           <td>
                              <span class="text-primary" style="cursor: pointer"
                                 wire:click="downloadUpload('{{$item->path . "/" . $item->filename}}')">
                                 {{$item->filename}} </span><br>
                              <small>Toegevoegd op: {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}} om
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s')}} </small>
                           </td>
                           <td>
                              @if($item?->title) {{$item?->title}} @else @endif </td>

                           <td>
                              @if($item?->type_id)
                              {{Config::get('global.upload_elevator_types')[$item?->type_id]}}
                              @endif
                           <td>
                        </tr>
                        @empty @endforelse
                     </body>
                     @endforeach
                  </table>

               </div>
            </div>
         </div>
   

      @endif

      @if(count($elevator->uploads->where('type_id',4)))

      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between bg-light">
                  Offertes ( {{count($this->elevator->uploads->where('type_id',4))}} )
                  <span data-bs-toggle="modal" data-bs-target="#add_attachment_modal" wire:click="show_upload()"
                     class="btn btn-soft-secondary btn-sm">Toevoegen <i class="mdi mdi-plus ms-1"></i>
                  </span>
               </div>
               <div class="card-body">

                  <table class="table table-striped">
                     @foreach ($elevator->uploads->where('type_id',4)->groupby('type_id') as $key => $upload)

                     <body>
                        @forelse ($upload as $item)
                        <tr>
                           <td style="width: 20px;">
                              <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                 wire:click.prevent='deleteUpload({{ $item->id }})' class="btn btn-soft-danger ">
                                 <i class="fa-solid fa-trash"></i>
                              </button>
                           </td>
                           <td>
                              <span class="text-primary" style="cursor: pointer"
                                 wire:click="downloadUpload('{{$item->path . "/" . $item->filename}}')">
                                 {{$item->filename}} </span><br>
                              <small>Toegevoegd op: {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}} om
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('H:i:s')}} </small>
                           </td>
                           <td>
                              @if($item?->title) {{$item?->title}} @else @endif </td>

                           <td>
                              @if($item?->type_id)
                              {{Config::get('global.upload_elevator_types')[$item?->type_id]}}
                              @endif
                           <td>
                        </tr>
                        @empty @endforelse
                     </body>
                     @endforeach
                  </table>

               </div>
            </div>
         </div>
      </div>
 
      @endif

      <div class="row pt-3">
         <div class="col-md-12">
            <div class="card">
               <div class="card-header card-header-content-md-between bg-light">
                  Meerjarenbegrotingen
                  <span wire:click="clearInspectionFields()" data-bs-toggle="modal" data-bs-target="#MJOBCrudModal"
                     class="btn btn-soft-secondary btn-sm">Toevoegen <i class="mdi mdi-plus ms-1"></i>
                  </span>
               </div>
               <div class="card-body">
                  @if(count($elevator->uploads->where('type_id',99)))
                  <table class="table table-striped">

                     <body>
                        @foreach ($elevator->uploads->where('type_id',99) as $key => $item)
                        <tr>
                           <td style="width: 20px;">
                              <button wire:confirm="Weet je zeker dat je deze meerjaren begroting wilt verwijderen ?"
                                 wire:click.prevent='deleteUpload({{ $item->id }})' class="btn btn-soft-danger ">
                                 <i class="fa-solid fa-trash"></i>
                              </button>
                           </td>
                           <td>
                              <a href="#" wire:click="downloadUpload('{{$item->path . "/" . $item->filename}}')">
                                 {{$item->filename}} </a> <br> <small>Toegevoegd op:
                                 {{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y')}}</small>
                           </td>
                           <td> @if($item?->title) {{$item?->title}} @else - @endif </td>
                        </tr>
                        @endforeach
                     </body>
                  </table>
                  @else Geen bijlages toegevoegd @endif
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="col-4">
      <div class="card">
         <div class="card-body">
            <div>
               @if($elevator->inspection_company_id==1)
               <div style="height: 40px;">
                  @if($elevator->last_api_sync)
                  <div wire:loading wire:target="get_from_liftinstituut">
                     <img src="\img\loading2.gif" style="margin-right: 10px; height: 20px; float: left; width: 20px;">
                     Gegegevens ophalen bij het <b>Liftinstituut B.V.</b>
                     <br>
                  </div>
                  <div wire:loading.remove>
                     <img data-bs-toggle="tooltip" data-placement="top"
                        title=" Gegevens gesyncroniseerd op {{ Carbon\Carbon::parse($elevator->last_api_sync)->format('d-m-Y') }} om {{ Carbon\Carbon::parse($elevator->last_api_sync)->format('H:i') }}"
                        wire:click="get_from_liftinstituut()" src="\assets\img\external\li-32x32.png"
                        style="margin-right: 10px; height: 20px; float: left; width: 20px;"> Gegevens gesyncroniseerd
                     <b>Liftinstituut B.V.</b>
                  </div>
                  <br> @else <img src="\assets\\img\external\li-32x32.png" style="margin-right: 10px;">
                  <span> Er kunnen geen gegevens opgehaald worden bij het <b>Liftinstituut B.V.</b>
                  </span> @if(!$elevator->nobo_no) (Nobonummer niet ingevuld) <br>
                  <br> @else (Nobonummer niet bekend) <br>
                  <br> @endif <span style="float: right" class="text-primary  cursor: pointer"
                     wire:click="get_from_liftinstituut()" type="button">Opnieuw proberen </a> @endif
               </div>
               @endif
               <table class="table table-striped" style="margin: 1px;">
                  <tr>
                     <td class="align-middle">Omschrijving </td>
                     <td>
                        <input class="form-control" wire:model="description">
                     </td>
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Leverancier </td>
                     <td>
                        <select class="form-control" wire:model="supplier_id">
                           @foreach($suppliers as $supplier)
                           <option value="{{$supplier->id}}">{{$supplier->name}}</option>
                           @endforeach
                        </select>
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Bouwjaar </td>
                     <td>
                        <input class="form-control" wire:model="construction_year">
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Installatienummer </td>
                     <td>
                        <input class="form-control" wire:model="install_no">
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Unit nr ohb. </td>
                     <td>
                        <input class="form-control" wire:model="unit_no">
                     </td>
                  </tr>
                  </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Nobo nr. </td>
                     <td>
                        <input class="form-control" wire:model="nobo_no">
                     </td>
                  </tr>
                  </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Status </td>
                     <td>
                        <select class="form-select" wire:model="status_id">
                           <option value="">Onbekend</option>
                           <option value="1">Operationeel</option>
                           <option value="2">Buiten gebruik</option>
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Keuringstatus </td>
                     <td>
                        @if(count($elevator->inspections))
                        @if($elevator->inspections->first()['status_id']==1)
                        <span class="badge bg-soft-success text-success py-2"> Goedgekeurd </span>
                        @endif
                        @if($elevator->inspections->first()['status_id']==2)
                        <span class="badge bg-soft-secondary text-secondary py-2">
                           Goedgekeurd met acties </span>
                        @endif
                        @if($elevator->inspections->first()['status_id']==3)
                        <span class="badge bg-soft-danger text-danger  p-2 py-2 "> Afgekeurd </span>
                        @endif
                        @if($elevator->inspections->first()['status_id']==4)
                        <span class="badge bg-soft-secondary text-secondary  p-2"> Onbeslist </span>
                        @endif
                        @if($elevator->inspections->first()['status_id']==5)
                        <span class="badge bg-soft-secondary text-secondary p-2"> Niet afgerond </span>
                        @endif
                        @endif
                     </td>
                  <tr>
                     <td class="align-middle">Keuringsplandatum </td>
                     <td>
                        <input class="form-control" type="date" wire:model="inspection_plandate">
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Speek luister/verbinding </td>
                     <td>
                        <input class="form-control" wire:model="speakconnection">
                     </td>
                  </tr>
                  <tr>
                     <td class="align-middle">Beheerlift </td>
                     <td>
                        <select class="form-select" wire:model="management_elevator">
                           <option value="0">Nee</option>
                           <option value="1">Ja</option>
                        </select>
                     </td>
                  </tr>

                  <tr>
                     <td class="align-middle">Type </td>
                     <td>
                        <div class="tom-select-custom " wire:ignore>
                           <select style="height: 40px;" wire:model="type_id" class="js-select form-select"
                              data-hs-tom-select-options='{
                           "placeholder": "Selecteer een type",
                           "hidePlaceholderOnSearch" : true,
                           "hideSearch": false,
                           "allowEmptyOption": true
                           }' @foreach(config('globalValues.object_types') as $key=> $value)

                              <option value="">Onbekend</option>
                              <option value="{{ $key }}" @if($type_id==$key) selected @endif>
                                 {{$value}}
                              </option>
                              @endforeach
                           </select>
                        </div>
                     </td>
                  </tr>

                  <tr>
                     <td>Opmerking </td>
                     <td>
                        <textarea class="form-control" style="height: 300px" wire:model="remark"></textarea>
                     </td>
                  </tr>
               </table>
               <hr>
               @if($elevator->address)
               <div style="width: 100%">
                  <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                     src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=nl&amp;q={{$elevator->address->address}},{{$elevator->address->place}},%20Netherlands+(Mijn%20bedrijfsnaam)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
               </div>
               @endif
            </div>
         </div>
      </div>
      <div style="float: right">
         <button
            wire:confirm.prompt="Weet je zeker dat je dit onderhoudcontract wilt verwijderen ?\n\nType AKKOORD om te bevestigen|AKKOORD"
            wire:click.prevent='deleteElevator({{ $elevator->id }})' class="btn btn-soft-danger btn-small "
            style="float: right">Verwijder</button>
      </div>
   </div>
</div>
<div class="row">
   <div class="col-12">

      <div class=" page-title-box d-flex align-items-center justify-content-between">
         <h4 class="mb-0">
         </h4>
         <br> @if($management_elevator) <span class="badge badge-soft-primary py-2 m-0" style="float: left">LVA
            Liftbeheer</span> @endif
         <div class="page-title-right">
         </div>
      </div>
   </div>
</div>
<div class="card">
   <div class="card-body">
      <div class="d-flex justify-content-between">
         <div>
            <h6 class="font-size-xs text-uppercase"></h6>
            <h4 class="mt-4 font-weight-bold mb-2 d-flex align-items-center"></h4>
         </div>
         <div>
            <div>
               <div class="view">
                  <!-- Button trigger modal -->
                  <!-- keuringen MODAL  -->
                  <div class="modal fade" wire:ignore.self id="maintenanceCrudModal" tabindex="-1"
                     aria-labelledby="maintenanceCrudModal" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered  modal-xl" wire:ignore.self>
                        <div class="modal-content">
                           <div class="modal-header"> <button type="button" class="btn-close" data-bs-dismiss="modal"
                                 aria-label="Close"></button>
                           </div>
                           <div class="modal-body">
                              <div class="row">
                                 <div class="col-md-4">
                                    <label class="mb-3"> Plandatum </label>
                                    <br>
                                    <input wire:model.defer="maintenance_planned_at"
                                       class=" @if ($errors->has('maintenance_planned_at'))  is-invalid @endif form-control"
                                       type="date">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="mb-3"> Uitvoeringsdatum </label>
                                    <br>
                                    <input wire:model.defer="maintenance_executed_datetime"
                                       class=" @if ($errors->has('maintenance_executed_datetime'))  is-invalid @endif form-control"
                                       type="date">
                                 </div>
                                 <div class="col-md-4">
                                    <label class="mb-3"> Status </label>
                                    <br>
                                    <select wire:model.defer="maintenance_status_id" class="form-select">
                                       <option value="1">Gepland</option>
                                       <option value="2" selected>Uitgevoerd</option>
                                    </select>
                                 </div>
                              </div>
                              <br>
                              <div class="row">
                                 <div class="col-md-12">
                                    <label class="mb-3"> Opmerking </label>
                                    <br>
                                    <textarea wire:model="maintenance_remark" class="form-control"></textarea>
                                 </div>
                                 <br>
                                 <div class="row">
                                    <div class="col-md-6">
                                       <label class="mb-3"> <br>Bijlage</label>

                                       @if($maintenance_attachment)
                                       <br>

                                       <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                                          wire:click="deleteMaintenaceContractDocument('{{$maintenance_contract_id}}')"
                                          class="btn btn-soft-danger ">
                                          <i class="fa-solid fa-trash"></i> Verwijder
                                       </button>
                                       @else
                                       <br>
                                       <input
                                          class="  @if ($errors->has('maintenance_attachment'))  is-invalid @endif form-control "
                                          type="file" wire:model="maintenance_attachment">
                                       @endif

                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="modal-footer">
                              <button type="button" class="btn btn-soft-warning"
                                 data-bs-dismiss="modal">Sluiten</button>

                              <button wire:loading.attr="disabled" class="btn btn-soft-success    "
                                 wire:click="saveMaintenance()" type="button">
                                 <div wire:loading>
                                    <span class="spinner-border spinner-border-sm" role="status"
                                       aria-hidden="true"></span>
                                 </div>
                                 Opslaan
                              </button>

                           </div>
                        </div>
                     </div>
                  </div>

               </div>
            </div>
         </div>
      </div>
   </div>
   <!-- keuringen Meerjaren begrtoing  -->
   <div class="modal fade" wire:ignore.self id="MJOBCrudModal" tabindex="-1" aria-labelledby="#MJOBCrudModal"
      aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered  ">
         <div class="modal-content">
            <div class="modal-header">
               Selecteer een meerjaren begroting
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-12">
                     <label class="mb-3"> <br>Bijlage</label>
                     <input class="   form-control " type="file" wire:model.live="mjob_attachment">
                     @error('mjob_attachment') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
               <div class="row">
                  <div class="col-md-6">
                     <label class="mb-3"> <br>Van jaar</label>
                     <input class="   form-control " wire:change="enterEndYear" type="number"
                        wire:model="mjob_beginyear">
                     @error('mjob_beginyear') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
                  <div class="col-md-6">
                     <label class="mb-3"> <br>Eind jaar</label>
                     <input class="   form-control " type="number" wire:model.defer="mjob_endyear">
                     @error('mjob_endyear') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-soft-warning" data-bs-dismiss="modal">Sluiten</button>

               <button wire:loading.attr="disabled" class="btn btn-soft-success    " wire:click="saveMJOB()"
                  type="button">
                  <div wire:loading>
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>

            </div>
         </div>
      </div>
   </div>
   <!-- Upload attchment modal -->
   <div wire:ignore.self id="add_attachment_modal" class="modal fade bs-example-modal-center" tabindex="-1"
      role="dialog" aria-labelledby="add_attachment_modal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
         <div class="modal-content">
            <div class="modal-header">
               <h5 class="modal-title">Bijlage toevoegen </h5>
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form wire:submit.prevent="addUpload">

                  <div class="mb-3">
                     <label class="pb-2">Type</label>
                     <select class="form-select @if ($errors->has('upload_type'))  is-invalid @endif"
                        wire:model="upload_type">
                        <option value=""> Selecteer een bijlage type </option>
                        @foreach (Config::get('global.upload_elevator_types') as $key => $value)
                        <option value="{{$key}}">{{$value}}</option>
                        @endforeach
                     </select>
                  </div>
                  <div class="mb-3">
                     <label class="pb-2">Bijlage</label>
                     <input class=" form-control " type="file" wire:model="upload_filename">
                  </div>

                  <div class="mb-3">
                     <label class="pb-2">Titel</label>
                     <input class=" form-control " type="text" wire:model="title">
                  </div>

               </form>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-soft-warning" data-bs-dismiss="modal">Sluiten</button>

               <button wire:loading.attr="disabled" class="btn btn-soft-success    " wire:click="addUpload()"
                  type="button">
                  <div wire:loading>
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>

            </div>
         </div>
      </div>
   </div>
   <!-- keuringen Meerjaren begrtoing  -->
   <div class="modal fade" wire:ignore.self id="maintenanceContractCrudModal" tabindex="-1"
      aria-labelledby="MJOBCrudModal" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg  " wire:ignore.self>
         <div class="modal-content ">

            <div class="modal-header">
               Onderhoudscontract
               <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <div class="row">
                  <div class="col-md-6">
                     <label class="pb-2">Begin datum</label>
                     <input wire:model.live="maintenance_contract_begindate"
                        class=" @if ($errors->has('maintenance_planned_at'))  is-invalid @endif form-control"
                        type="date">
                  </div>
                  <div class="col-md-6">
                     <label class="pb-2">Einddatum</label>
                     <input wire:model.live="maintenance_contract_enddate"
                        class=" @if ($errors->has('maintenance_executed_datetime'))  is-invalid @endif form-control"
                        type="date">
                  </div>
               </div>
               <div class="row pt-3">
                  <div class="col-md-6">
                     <label class="pb-2">Type</label>
                     <select wire:model.live="maintenance_contract_type_id" class="form-select">
                        <option value="">Selecteer een optie</option>
                        <option value="1">
                           Eenvoudig
                        </option>
                        <option value="2">
                           Uitgebreid
                        </option>
                        <option value="3">
                           All in
                        </option>
                     </select>

                     <div class="pb-3">
                        <label class="pb-2 pt-3">Onderhoudspartij</label>
                        <select class="form-select " wire:model.live="maintenance_contract_companie_id">
                           @foreach($maintenancyCompanies as $maintenancy_companie)
                           <option value="{{$maintenancy_companie->id}}">
                              {{$maintenancy_companie->name}}
                           </option>
                           @endforeach
                        </select>

                     </div>
                  </div>

                  <div class="col-md-6">
                     <label class="pb-2">Opties</label>
                     <br>
                 
                     <input type="checkbox" value="1" class="form-checkbox" wire:model.defer="maintenance_contract_option1"
                        name="maintenance_contract_option1" @if($maintenance_contract_option1) checked @endif> Spreek / Luisterverbinding <br>
                     <input type="checkbox" value="1" wire:model="maintenance_contract_option2"
                        name="maintenance_contract_option2" @if($maintenance_contract_option2) checked @endif> Keuring<br>
                     <input type="checkbox" value="1" wire:model="maintenance_contract_option3"
                        name="maintenance_contract_option3" @if($maintenance_contract_option3) checked @endif> Assistentie keuring <br>
                     <br>
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-12">
                     <label class="pb-2">Onderhoudscontract
                     </label>

                     @if($maintenance_contract_document)
                     <br>

                     <button wire:confirm="Weet je zeker dat je deze bijlage wilt verwijderen ?"
                        wire:click="deleteMaintenaceContractDocument('{{$maintenance_contract_id}}')"
                        class="btn btn-soft-danger ">
                        <i class="fa-solid fa-trash"></i> Verwijder
                     </button>
                     @else
                     <br>
                     <input
                        class="  @if ($errors->has('maintenance_contract_document'))  is-invalid @endif form-control "
                        type="file" wire:model="maintenance_contract_document">
                     @endif

                  </div>
               </div>

            </div>
            <div class="modal-footer">
               <button type="button" class="btn btn-soft-warning" data-bs-dismiss="modal">Sluiten</button>

               <button wire:loading.attr="disabled" class="btn btn-soft-success    "
                  wire:click="savemaintenanceContractAction()" type="button">
                  <div wire:loading>
                     <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                  </div>
                  Opslaan
               </button>

            </div>
         </div>
      </div>
   </div>
   <script>
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-crud-inspection-modal', (event) => {
            $('#inpectionCrudModal').modal('hide');
         });
      });
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-make-incident-modal', (event) => {
            $('#add_incident_modal').modal('hide');
         });
      });
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-crud-mjob-modal', (event) => {
            $('#MJOBCrudModal').modal('hide');
         });
      });
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-add-attachment-modal', (event) => {
            $('#add_attachment_modal').modal('hide');
         });
      });
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-crud-maintenance-contract-modal', (event) => {
            $('#maintenanceContractCrudModal').modal('hide');
         });
      });
      document.addEventListener('livewire:init', () => {
         Livewire.on('close-crud-maintenance-modal', (event) => {
            $('#maintenanceCrudModal').modal('hide');
         });
      });
      $('.modal-content').resizable({
         minHeight: 300,
         minWidth: 300
      });
      $('.modal-dialog').draggable({
         handle: ".modal-header"
      });
   </script>