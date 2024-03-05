 

<div class="container-fluid">

   <div class="page-header  my-3">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title">

               @if($object?->fire_elevator)
               <div class="cnt_table_result">

                  <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift"
                     class="text-danger bi bi-fire"></i>
               </div>
               @else
               <div class="cnt_table_result">
                  <i style="color: #EFEFEF" class=" bi bi-fire"></i>
               </div>
               @endif

               @if($object?->stretcher_elevator)
               <div class="cnt_table_result">

                  <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brancard / Bedlift"
                     class="text-primary fa-solid fa-bed"></i>  
         </div>

         @else
         <div class="cnt_table_result">

            <i style="color: #EFEFEF" class=" fa-solid fa-bed"></i>
         </div>

         @endif

         @if($object?->address_id)
         {{$object->location?->address}} {{$object->location?->place}}
         @if($object->location?->name)
         ({{$object->location?->name}})
         @endif
         @else
         Geen relatie
         @endif

      </div>
      <div class="col-auto">

 
         <button data-bs-toggle="modal" wire:click = "edit({{$object->id}})" data-bs-target="#crudModal" type="button"
            class="btn btn btn-primary btn-sm  btn-120 ">
            Wijzig
         </button>

         <button type="button" class="btn btn-primary btn-sm dropdown-toggle btn-120  "
            id="navbarNotificationsDropdownSettings" data-bs-toggle="dropdown" aria-expanded="false">
            Toevoegen
         </button>

         <div class="dropdown-menu  navbar-dropdown-menu navbar-dropdown-menu-borderless"
            aria-labelledby="navbarNotificationsDropdownSettings">

            <a class="dropdown-item" href="/maintenance-contracts/create?elevator_id={{$object->id}}">
               <i class="bi-archive dropdown-item-icon"></i> Onderhoudscontract
            </a>
            <a class="dropdown-item" href="/maintenances/create?elevator_id={{$object->id}}">
               <i class="bi-check2-all dropdown-item-icon"></i> Onderhoudsbeurt
            </a>
            <a class="dropdown-item" href="/incidents/create?elevator_id={{$object->id}}">
               <i class="bi-toggle-off dropdown-item-icon"></i> Incident
            </a>
            <a class="dropdown-item" href="/inspections/create?elevator_id={{$object->id}}">
               <i class="bi-flag dropdown-item-icon"></i> Keuring
            </a>

            <a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#exampleModalCenteredScrollable"
               style="cursor: pointer">
               <i class="bi-gift dropdown-item-icon"></i> Bijlage
            </a>

         </div>

         <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  btn-ico">
            <i class="fa-solid fa-arrow-left"></i>
         </button>

      </div>
   </div>
</div>
<!-- End  Button trigger modal -->

<!-- Modal -->

<div wire:ignore.self class="modal fade" id="exampleModalCenteredScrollable" tabindex="-1" role="dialog"
   aria-labelledby="crudModal" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Bestand toevoegen</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

            <div class="row">
               <div class="col-md-3"><img src="/assets/img/documents.svg"></div>
               <div class="col-md-9">
 
 
    <label for="fname">Bestandsnaam</label>
                     <div class="pt-2"></div>
                     <input class="form-control" wire:model="file_description" name="description">

                     <div class="pt-2"></div>
                     <label for="fname">Categorie</label>
                     <div class="pt-2"></div>

                     <select class="form-select  "  wire:model="file_collection"  />
                     <option selected value="documens">Documenten</option>
                     <option value="image ">Afbeeldingen</option>
                     <option value="3 ">Algemeen</option>
                     </select>
                     <div class="pt-3"></div>
                     <label>Bestand</label>
                     <div class="pt-2"></div>
             
                 
                     <form wire:submit="uploadFile">
    <input type="file" wire:model="file_attachment">
 
    @error('photo') <span class="error">{{ $message }}</span> @enderror
 
    <button type="submit">Save photo</button>
</form> 
             
                     <div class="pt-2"></div>
                     <div style="float: right;  ">
 



                     
 
    <button type="submit" class="btn btn-soft-success " wire:click = "uploadFile()">Upload</button></div>
 


                  
               </div>

            </div>
         </div>

      </div>
   </div>
</div>
<!-- End Modal -->

<!-- Modal EDIT -->

<div wire:ignore.self class="modal fade modal-xl" id="crudModal" tabindex="-1" role="dialog" aria-labelledby="crudModal"
   aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered" role="document">

      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenteredScrollableTitle">Lifteigenschappen bewerken</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
          <div class="modal-body" wire:loading.class="loading-div" >
            <div>
               <div class="row">
                  <div class="col-md-12 pb-3">
                     <label for="ernergie_label" class="pb-2 pt-2">Naam</label>
                     <input type="text" wire:model = "name" class="form-control">
                  </div>
               </div>

               <div class="row">
                  <div class="col-md-4">
                 


                   
                    
               <label class="pb-2 ">Relatie</label>
                           <div class="tom-select-custom"  wire:ignore.self>
                           <select   wire:change = "search_loctions_by_relation()" wire:model.live = "customer_id" autocomplete="off" class="js-select form-select @error('name') is-invalid   @enderror "
                           data-hs-tom-select-options='{
"placeholder": "Selecteer een relatie",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'>
          
                              <option selected value="">Selecteer een relatie</option>
                                                            @foreach($customers as $customer)
                              <option value="{{ $customer->id }}">
                              {{ $customer->name }}
                              </option>
                              @endforeach
                              </select>
                           </div>
                           
                           @error('customer_id') <span class="invalid-feedback">Relatie is een verplicht veld </span> @enderror


           
                           <label for="address_id" class="pb-2 pt-2">Adres</label>
                           <div class="tom-select-custom " wire:ignore.self  >
                              <select wire:model = "location_id"  autocomplete="off" class="js-select form-select"
                              data-hs-tom-select-options='{
"placeholder": "Selecteer een locatie",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'>
                          
            <option selected value="">Selecteer een locatie</option>
                              @foreach($locations_relation as $relatedItem)
                              <option value="{{ $relatedItem->id }}">
                              {{ $relatedItem->name }}
                              </option>
                              @endforeach
                              </select>
                           </div>

                  
                         


                  </div>

                  <div class="col-md-4">
                     

                  <label for="address_id" class="pb-2">Keuringinstantie</label>
                     <div class="tom-select-custom "   wire:ignore>
                        <select wire:model = "inspection_company_id" style="height: 40px;" autocomplete="off" class="js-select form-select"
                        data-hs-tom-select-options='{
"placeholder": "Selecteer een instantie",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'>
                           <option value="">Selecteer een keuringsinstanties</option>
                           @foreach($inspectionCompanys as $relatedItem)
                           <option value="{{ $relatedItem->id }}">
                              {{ $relatedItem->name }}
                           </option>
                           @endforeach
                        </select>
                     </div>


                     @error('inspection_company_id')
                     <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <label for="address_id" class="pb-2 pt-2">Onderhoudspartij</label>
                     <div class="tom-select-custom "   wire:ignore>
                        <select wire:model = "maintenance_company_id" style="height: 40px;" autocomplete="off" class="js-select form-select"
                        data-hs-tom-select-options='{
"placeholder": "Selecteer een onderhoudspartij",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'>
                           <option value="">Selecteer een keuringsinstanties</option>
                           @foreach($maintenanceCompanys as $relatedItem)
                           <option @if($relatedItem->id  == $maintenance_company_id) selected @endif value="{{ $relatedItem->id }}">
                           {{ $relatedItem->name }}
                           </option>
                           @endforeach
                        </select>
                     </div>
                  </div>

                  <div class="col-md-4">
                    

                  <div class="row">
                        <div class="col-md-6">
                           

                        <label for="construction_year" class="pb-2">Bouwjaar</label>
                           <input class="form-control @error('construction_year') is-invalid @enderror"
                              wire:model="construction_year" type="text"
                              >
                           @error('construction_year')
                           <div class="invalid-feedback">{{ $message }}</div>
                           @enderror

                        
                           <label for="ernergie_label" class="pb-2 pt-2">Stopplaatsen</label>
                           <input type="number" wire:model = "stopping_places" class="form-control">
                 

                  </div>

                  <div class="col-md-6">
                  <label for="ernergie_label" class="pb-2 ">Energielabel</label>
                           <div class="tom-select-custom " wire:ignore>
                              <select wire:model = "energy_label" style="height: 40px;" class="js-select form-select ">
                                 <option value="A" > A </option>
                                 <option value="B" > B </option>
                                 <option value="C" > C </option>
                                 <option value="D" > D </option>
                                 <option value="E" > E </option>
                                 <option value="F" > F </option>
                                 <option value="G" > G </option>
                              </select>
                           </div>


                           <label for="ernergie_label" class="pb-2 pt-2">Nobo nummer</label>
                        <input type="text" wire:model = "nobo_no" class="form-control">
                        <label for="ernergie_label" class="pb-2 pt-2">Unit nummer</label>
                        <input type="text" wire:model = "unit_no" class="form-control">
                  
                  </div>

                  </div>

                  </div>
               </div>

               <div class="row pt-3">
                  <hr>
                 
                  <div class= "row">

                  <div class = "col-md-4">
         
         
          
 
               <label class="pb-2 ">Leverancier</label>
                       
                           <div class="tom-select-custom " wire:ignore.self  >
                              <select wire:model = "supplier_id"  autocomplete="off" class="js-select form-select"
                              data-hs-tom-select-options='{
"placeholder": "Selecteer een leverancier",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'>
            <option value="">Selecteer een leverancier</option>
                              @foreach($suppliers as $supplier)
                              <option value="{{ $supplier->id }}">
                              {{ $supplier->name }}
                              </option>
                              @endforeach
                              </select>
                           </div>
                           <label for="ernergie_label" class="pb-2 pt-2">Status</label>

                          
              <div class="tom-select-custom " wire:ignore>

                           <select
                                    class="js-select form-select"
                                    wire:model="status_id"
                                    data-hs-tom-select-options='{
"placeholder": "Selecteer een status",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'
                                    class="ts-wrapper js-select form-select form-select-sm tom-select-form-select-ps-0 single plugin-change_listener plugin-hs_smart_position input-hidden full has-items js-select_style"
                                    id="locationLabel"
                                >
<option  value="1"   @if($status_id=='1') selected @endif  data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-success"></span> <span class="text-truncate">Operationeel</span></span>' > </option>
<option    value="2"  @if($status_id=='2') selected @endif  data-option-template='<span class="d-flex align-items-center">  <span class="legend-indicator bg-danger"></span> <span class="text-truncate">Lift buiten gebruik</span></span>'> </option>
                                        </select>


 
                           </div>



                           <label for="ernergie_label" class="pb-2 pt-2">Type</label>
                           <div class="tom-select-custom " wire:ignore>

                           
 

                              <select style="height: 40px;" wire:model = "object_type_id"
                              class="js-select form-select"
                              data-hs-tom-select-options='{
"placeholder": "Selecteer een type",
"hidePlaceholderOnSearch" : true,
"hideSearch": false,
"allowEmptyOption": true

}'
                                 @foreach(config('globalValues.object_types') as $key => $value)
                                 <option 
                                    value="{{ $key }}">
                                    {{$value}}
                                 </option>
                                 @endforeach
                              </select>
                           </div>
     </div>





                     <div class = "col-md-4">
                        <div class="form-check form-switch mb-4">
                           <input  wire:model="stretcher_elevator"  value="1" type="checkbox" class="form-check-input" id="formSwitch2"  >
                           <label class="form-check-label" for="formSwitch2">Brancardlift</label>
                        </div>
                        <div class="form-check form-switch mb-4">
                           <input  value = "1" wire:model.live="fire_elevator" type="checkbox" class="form-check-input" id="formSwitch2"  >
                           <label class="form-check-label" for="formSwitch2">Brandweerlift</label>
                        </div>
                        <div class="form-check form-switch mb-4">
                           <input  value = "1" wire:model="speakconnection" type="checkbox" class="form-check-input" id="formSwitch2"  >
                           <label class="form-check-label" for="formSwitch2">Spreek / luister</label>
                        </div>
                     </div>
                     <div class = "col-md-4">
                        <label for="ernergie_label" wire:model = "remark" class="pb-2  ">Opmerking</label>
                        <textarea wire:model = "remark" class="form-control"></textarea>
                        </div>
                     <br>
                     <div class = "float-end">
                        <button class = "btn btn-primary btn-120 float-end mt-3" wire:click = "save()"> Opslaan
                     </div>
                  </div>
               </div>     </div>
            </div>
      </div>
   </div>
</div>
<!-- End Modal -->

@if($object->countIncident)
<div class=" bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
   <strong class="font-bold">Melding! </strong>
   <span class="block sm:inline">Er is een storing gemeld op deze lift, Kijk bij storingen voor meer informatie
   </span>
</div>
<br> @endif @if($object->stand_still)
<div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
   <strong class="font-bold">Melding! </strong>
   <span class="block sm:inline">Lift buitengebruik vanaf:
      {{ Carbon\Carbon::parse($object->stand_still_date)->format('d-m-Y') }}
   </span>
</div>
<br> @endif

<div class="row ">
   <div class="col-md-4">
      <div class="card " style="background-color: e8eafa">
         <table class="table">
            <tr>

               <td colspan="2"> <a
                     href="{{$object?->location?->customer?->slug}}">{{$object?->location?->customer?->name}}</a>
               </td>
            </tr>
            <tr>
               <td colspan="2">{{$object?->location?->customer?->address}}
                  {{$object?->location?->customer?->zipcode}} {{$object?->location?->customer?->place}} </td>
            </tr>
         </table>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card ">
         <table class="table">
            <tr>
               <td>Keuringstatus</td>
               <td> @if(count($object->inspections))

                  @if($object?->latestInspection?->status_id==1)
                  <span class="badge bg-soft-success text-success "> Goedgekeurd </span>
                  @endif
                  @if($object?->latestInspection?->status_id==2)
                  <span class="badge bg-soft-primary text-primary ">
                     Goedgekeurd met acties </span>
                  @endif
                  @if($object?->latestInspection?->status_id==3)
                  <span class="badge bg-soft-danger text-danger  "> Afgekeurd </span>
                  @endif
                  @if($object?->latestInspection?->status_id==4)
                  <span class="badge bg-soft-primary text-primary"> Onbeslist </span>
                  @endif
                  @if($object?->latestInspection?->status_id==4)
                  <span class="badge bg-soft-warning text-warning "> Niet afgerond </span>
                  @endif

                  @else
                  Geen keuring uitgevoerd

                  @endif</td>

            </tr>
            <tr>
               <td>Aantal Stopplaatsen</td>
               <td> @if($object->stopping_places)
                  {{$object->stopping_places}}
                  @else
                  <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span>
                  @endif </td>
            </tr>
         </table>
      </div>
   </div>
   <div class="col-md-4">
      <div class="card ">
         <table class="table">
            <tr>
               <td>Nobo nr.</td>
               <td>

                  @if($object->nobo_no) {{$object->nobo_no}} @else <span
                     class="badge bg-soft-primary-light text-primary p-1">Geen</span>@endif
               </td>

            </tr>
            <tr>
               <td>UNitnr</td>
               <td>@if($object->unit_no) {{$object->unit_no}} @else <span
                     class="badge bg-soft-primary-light text-primary p-1">Geen</span>@endif
               </td>
            </tr>
         </table>
      </div>
   </div>
</div>

<div class="row pt-3">
   <div class="col-8">

      <div class="row">
         <div class="col-md-4">
            <div class="card">

               <div class="p-3 bg-light" style="height: 80px;">
                  @if($object->maintenance_company_id)
                  <ul class="list-unstyled mb-0">
                     <li ">
                           <div class=" d-flex align-items-center">
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Onderhoudbedrijf</p>
                           <span class="mb-0 font-size-14">{{$object->maintenanceCompany->name}}</span>
                        </div>
               </div>
               </li>

               </ul>
               @else
               <div class="alert alert-soft-warning border-0 d-flex align-items-center" role="alert">
                  <i class="uil uil-exclamation-triangle font-size-16 text-warning me-2"></i>
                  <div class="flex-grow-1 text-truncate">
                     Geen onderhoudsbedrijf
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card">

            <div class="p-3 bg-light" style="height: 80px;">

               @if($object?->address?->management)
               <ul class="list-unstyled mb-0">
                  <li class="pb-3">
                     <div class="d-flex align-items-center">
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Beheerder
                           </p>
                           <span class="mb-0 font-size-14">{{$object?->address?->management?->name}}
                           </span>
                        </div>
                     </div>
                  </li>
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
               </ul>
               @else
               <div class="alert alert-soft-warning border-0 d-flex align-items-center" role="alert">
                  <i class="uil uil-exclamation-triangle font-size-16 text-warning me-2">
                  </i>
                  <div class="flex-grow-1 text-truncate">
                     Geen beheerder
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
      <div class="col-md-4">
         <div class="card">

            <div class="p-3 bg-light" style="height: 80px;">
               @if($object?->inspection_company_id)
               <ul class="list-unstyled mb-0">
                  <li>
                     <div class="d-flex align-items-center">
                        <div class="font-size-20 text-primary flex-shrink-0 me-3">
                           <i class="uil uil-hospital"></i>
                        </div>
                        <div class="flex-grow-1">
                           <p class="text-muted mb-1 font-size-13">Keuringinstantie</p>
                           <span class="mb-0  ">{{$object?->inspectioncompany?->name}}</span>
                        </div>
                     </div>
                  </li>
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
                  <!-- end li -->
               </ul>
               @else
               <div class="alert alert-soft-warning border-0 d-flex align-items-center" role="alert">
                  <i class="uil uil-exclamation-triangle font-size-16 text-warning me-2"></i>
                  <div class="flex-grow-1 text-truncate">
                     Geen Keuringinstantie
                  </div>
               </div>
               @endif
            </div>
         </div>
      </div>
   </div>

   @if($object->AllElevatorOnThisAddress)

   <div class="row pt-3">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header card-header-content-md-between bg-light">
               Liften op deze locatie

            </div>
            <div class="card-body">
               <table class="table  table-sm  table-hover ">
                  <thead>

                     <th scope="col">Unit No </th>
                     <th scope="col">Opmerking </th>
                     <th scope="col">Categorie </th>
                     <th scope="col">Energielabel </th>
                     <th scope="col">Nobo nr. </th>
                     <th scope="col"> </th>
                     </tr>
                  </thead>
                  <tbody>
                     @foreach($object->AllElevatorOnThisAddress as $elevator_item )
                     <tr onclick="location: '/objects/show/{{$elevator_item->id}}' " style="cursor:pointer">

                        <td class="align-middle">
                           @if($elevator_item->fire_elevator)
                           <div class="cnt_table_result">

                              <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brandweerlift"
                                 class="text-danger bi bi-fire"></i>
                           </div>
                           @else
                           <div class="cnt_table_result">
                              <i style="color: #EFEFEF" class=" bi bi-fire"></i>
                           </div>
                           @endif

                           @if($elevator_item->stretcher_elevator)
                           <div class="cnt_table_result">

                              <i data-bs-toggle="tooltip" data-bs-placement="top" title="Brancard / Bedlift"
                                 class="text-primary fa-solid fa-bed"></i> 
            </div>

            @else
            <div class="cnt_table_result">

               <i style="color: #EFEFEF" class=" fa-solid fa-bed"></i>
            </div>

            @endif

            {{$elevator_item->unit_no}}

            </td>
            <td class="align-middle">
               {{$elevator_item->remark}}
            </td>
            <td class="align-middle">

               @if($elevator_item?->object_type_id)
               <small>
                  {{config('globalValues.object_types')[$elevator_item?->object_type_id]}}
               </small>
               @endif
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

               @if($object->id == $elevator_item->id)
               <span style="float: right" class="badge bg-soft-primary-light text-primary p-1">Deze
                  lift</span>
               @else
               <a style="float: right" href="/elevator/show/{{$elevator_item->id}}">
                  <button type="button" class="btn btn-ghost-warning btn-icon btn-sm rounded-circle">
                     <i class="bi-eye"></i>
                  </button>
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

<div class="row  pt-3">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-content-md-between bg-light">
            Onderhoudscontracten

         </div>

         <div class="card-body p-2">

            @if(count($object->maintenance_contracts))

            <table class="table  table-sm  table-hover " style="cursor: pointer">
               <thead class="bg-light">
                  <tr>
                     <th scope="col">Status </th>
                     <th scope="col">Begindatum </th>
                     <th scope="col">Einddatum </th>
                     <th scope="col">Onderhoudsbedrijf </th>

                  </tr>
               </thead>
               <tbody>

                  @foreach($object->maintenance_contracts as $item)

                  <tr>
                     <td class="align-middle" style="width: 120px">

                        @if(!$item->isValid)
                        <span class="badge   bg-soft-success text-success  p-2"> Geldig </span>
                        @else
                        <span class="badge   bg-soft-danger text-danger  p-2"> Verlopen </span>
                        @endif

                     </td>
                     <td class="align-middle" style="width: 120px">
                        @if($item->begindate)
                        {{ \Carbon\Carbon::parse($item->begindate)->format('d-m-Y')}}
                        @endif
                     </td>
                     <td class="align-middle" style="width: 120px">
                        @if($item->enddate)
                        {{ \Carbon\Carbon::parse($item->enddate)->format('d-m-Y')}}
                        @endif

                     </td>

                     <td class="align-middle">
                        @if($item->maintenancie_companie_id)
                        {{ $item?->maintenancyCompany?->name}}
                        @endif

                     </td>

                  </tr>

                  @endforeach

                  <!--[if ENDBLOCK]><![endif]-->
               </tbody>
            </table>

            @else
            <div class="p-3">
               <center>Geen onderhoudscontracten geregisteerd</center>
            </div>
            @endif

         </div>
      </div>
   </div>
</div>
<div class="row pt-3">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-content-md-between bg-light">
            Onderhoudsbeurten

            </a>
         </div>

         <div class="card-body p-2">

            @if(count($object->maintenance))

            <table class="table  table-sm  table-hover   " onclick="location " style="cursor: pointer">
               <thead class="bg-light">
                  <tr>
                     <th scope="col">Status </th>

                     <th scope="col">Begindatum </th>
                     <th scope="col">Einddatum </th>
                     <th scope="col">Opmerking </th>

                  </tr>
               </thead>
               <tbody>

                  @foreach($object->maintenance as $item)

                  <!--[if BLOCK]><![endif]-->
                  <tr>
                     <td class="align-middle" style="width: 120px">

                        <span class="badge   bg-soft-primary text-primary  p-2"> Uitgevoerd </span>

                     </td>
                     <td class="align-middle" style="width: 150px">
                        @if($item->plan_date)
                        {{ \Carbon\Carbon::parse($item->plan_date)->format('d-m-Y')}}
                        @endif
                     </td>
                     <td class="align-middle" style="width: 150px">
                        @if($item->plan_date)
                        {{ \Carbon\Carbon::parse($item->plan_date)->format('d-m-Y')}}
                        @endif

                     </td>

                     <td class="align-middle">
                        @if($item->remark)
                        <small>{{$item->remark}}</small>
                        @else
                        -
                        @endif
                     </td>

                  </tr>

                  @endforeach

                  <!--[if ENDBLOCK]><![endif]-->
               </tbody>
            </table>

            @else
            <div class="p-3">
               <center>Geen onderhoudsbeurten geregisteerd</center>
            </div>
            @endif

         </div>
      </div>
   </div>
</div>
<div class="row pt-3">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-content-md-between bg-light">
            Storingen

         </div>
         <div class="card-body p-2">

            @if(count($object->incidents))

            <table class="table  table-sm  table-hover   ">
               <thead class="bg-light">
                  <tr>
                     <th scope="col">Prioriteit </th>
                     <th scope="col">Status</th>
                     <th scope="col">Datum / Tijd </th>
                     <th scope="col">Onderwerp </th>

                     <th scope="col"> </th>
                  </tr>
               </thead>
               <tbody>

                  @foreach($object->incidents as $item)

                  <!--[if BLOCK]><![endif]-->
                  <tr onclick="location='/incidents/{{$item->id}}'" style="cursor: pointer">
                     <td class="align-middle" style="width: 120px">

                        @if($item->priority_id==1)
                        <span class="badge   bg-soft-danger text-danger  p-2"> Hoog </span>
                        @elseif($item->priority_id==2)
                        <span class="badge   bg-soft-warning text-warning  p-2"> Hoog </span>
                        @elseif($item->priority_id==3)
                        <span class="badge   bg-soft-success text-success  p-2"> Laag </span>
                        @endif
                     </td>

                     <td class="align-middle">

                        {{$item->status_id}}
                     </td>

                     <td class="align-middle" style="width: 150px">
                        {{ \Carbon\Carbon::parse($item->report_date_time)->format('d-m-Y H:m')}}
                     </td>

                     <td class="align-middle">

                        {{$item->subject}}
                        <br><small> {{$item->description}}</small>

                     </td>

                     <td class="align-middle">

                        <div style="float: right">

                           <button type="button" class="btn btn-ghost-secondary btn-icon btn-sm rounded-circle">
                              <i class="bi-eye"></i>
                           </button>

                        </div>

                     </td>

                  </tr>

                  @endforeach

                  <!--[if ENDBLOCK]><![endif]-->
               </tbody>
            </table>

            @else
            <div class="p-3">
               <center>Geen storingen geregisteerd</center>
            </div>
            @endif

         </div>
      </div>
   </div>
</div>

<div class="row pt-3">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-content-md-between bg-light">
            Keuringen

         </div>
         <div class="card-body p-2">

            @if(count($object->inspections))

            <table class="table  table-sm  table-hover   " onclick="location " style="cursor: pointer">
               <thead class="bg-light">
                  <tr>
                     <th scope="col">Status </th>
                     <th scope="col">Begindatum </th>
                     <th scope="col">Einddatum </th>
                     <th scope="col">Opmerking </th>

                  </tr>
               </thead>
               <tbody>

                  @foreach($object->inspections as $item)

                  <!--[if BLOCK]><![endif]-->
                  <tr>
                     <td class="align-middle" style="width: 120px">

                        @if($item->status_id==1)
                        <span class="badge   bg-soft-success text-success  p-2"> Goedgekeurd </span>

                        @elseif($item->status_id==2)
                        <span class="badge   bg-soft-warning text-warning  p-2"> Goedgekeurd met acties </span>

                        @elseif($item->status_id==3)
                        <span class="badge   bg-soft-danger text-danger  p-2"> Afgekeurd </span>

                        @elseif($item->status_id==4)
                        <span class="badge   bg-soft-primary text-primary  p-2"> Onbeslist </span>

                        @elseif($item->status_id==5)
                        <span class="badge   bg-soft-info text-info  p-2"> Niet afgerond </span>

                        @endif
                     </td>

                     <td class="align-middle" style="width: 150px">
                        {{ \Carbon\Carbon::parse($item->begindate)->format('d-m-Y')}}
                     </td>

                     <td class="align-middle" style="width: 150px">
                        {{ \Carbon\Carbon::parse($item->enddate)->format('d-m-Y')}}
                     </td>

                     <td>
                        {{$item->remark}}
                     </td>

                  </tr>

                  @endforeach

                  <!--[if ENDBLOCK]><![endif]-->
               </tbody>
            </table>

            @else
            <div class="p-3">
               <center>Geen keuringen geregisteerd</center>
            </div>
            @endif
         </div>
      </div>
   </div>

</div>


@if(count($object->getMedia("*")))
<div class="row pt-3">
   <div class="col-md-12">
      <div class="card">
         <div class="card-header card-header-content-md-between bg-light">
            Bijlages
         </div>
         <div class="card-body p-2">

            <table class="table  table-sm  table-hover   " onclick="location " style="cursor: pointer">
               <thead class="bg-light">
                  <tr>
                     <th scope="col"> </th>
                     <th scope="col">Omschrijving </th>
                     <th scope="col">Categorie </th>
                     <th scope="col"> </th>
                     <th scope="col"> </th>
                  </tr>
               </thead>
               <tbody>

                  @foreach($object->getMedia("*") as $item)
                  <tr style="cursor: pointer">
                     <td onclick="location = '/download/{{$item->uuid}}'" class="align-middle" style="width: 20px">
                        <img style="height: 20px; padding-right: 3px;"
                           src="\assets\img\extentions\{{substr($item->file_name, strrpos($item->file_name, '.') + 1)}}.svg">

                     </td>
                     <td onclick="location = '/download/{{$item->uuid}}'" class="align-middle">
                        {{ucfirst($item->getCustomProperty('description', "geen"))}}
                     </td>

                     <td onclick="location = '/download/{{$item->uuid}}'" class="align-middle">
                        {{ucfirst($item->file_name)}}
                     </td>
                     <td onclick="location = '/download/{{$item->uuid}}'" class="align-middle">
                        {{ucfirst($item->collection_name)}}
                     </td>
                     <td class="align-middle">
                        <form action="/file.destroy" method="POST">
                           <input type="hidden" name="hash" id="hash" value="{{$item->uuid}}">

                           @csrf
                           @method('POST')
                           <button style="float: right"
                              onclick="return confirm('Weet je zeker dat je dit deze bijlage wilt verwijderen?')"
                              type="submit" class="btn btn-ghost-danger btn-icon btn-sm rounded-circle">
                              <i class="bi bi-trash"></i>
                           </button>
                        </form>

                     </td>

                  </tr>

                  @endforeach </tbody>
            </table>
            </div>
         </div>
      </div>
   </div>
 
@endif

<!--  -->
 

</div>
<div class="col-4">
   <div class="card">
      <div class="card-bosdy">
         <div>

            <div>

               <table class="table " style="margin: 1px;">

                  <tr>

                     <td colspan=2>

                        @if($object?->address?->naam)
                        <b>{{$object?->address?->naam}}</b>
                        @endif @if($object?->address?->complexnumber)
                        ({{$object?->address?->complexnumber}})
                        @endif
                        <br>

                        {{$object?->address?->address}} <br>
                        {{$object?->address?->zipcode}} {{$object?->address?->place}}

                     </td>

                  </tr>

                  <tr>
                     <td>Leverancier</td>
                     <td>@if($object?->supplier?->name)
                        {{$object?->supplier?->name}}
                        @else <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span> @endif
                     </td>
                  </tr>
                  <tr>
                     <td>Bouwjaar</td>
                     <td>

                        @if($object->construction_year)
                        {{$object->construction_year}}
                        @else
                        <span class="badge bg-soft-primary-light text-primary p-1">Geen</span>
                        @endif

                     </td>
                  </tr>

                  <tr>
                     <td class="align-middle">Status </td>
                     <td>
                        <span class="badge bg-soft-primary-light text-primary p-1">

                    
                           @if($object->status_id==1)

                           <span class="badge bg-soft-success text-succes p-2">Operationeel</span>

                           @else
                           <span class="badge bg-soft-danger text-danger p-2">Buitendienst</span>

                           @endif

                        </span></td>

                  </tr>

                  <tr>
                     <td class="align-middle">Speek luister/verbinding </td>
                     <td>
                        <span class="badge bg-soft-primary-light text-primary p-1">Onbekend</span>
                     </td>
                  </tr>

                  <tr>
                     <td>Opmerking </td>
                     <td>

                        {{$object->remark}}

                     </td>
                  </tr>

                  <tr>

                     <td class="align-middle">Energielabel</td>
                     <td class="align-middle">

                        <div class="energy-class">

                           @if($object->energy_label=='A')

                           <div class="a"></div>
                           @elseif($object->energy_label=='B')
                           <div class="b"></div>
                           @elseif($object->energy_label=='C')
                           <div class="c"></div>
                           @elseif($object->energy_label=='D')
                           <div class="d"></div>
                           @elseif($object->energy_label=='E')
                           <div class="e"></div>
                           @elseif($object->energy_label=='F')
                           <div class="f"></div>
                           @elseif($object->energy_label=='G')
                           <div class="g"></div>
                           @else
                           Onbekend
                           @endif

                        </div>

                     </td>

                  </tr>

               </table>
               <hr>
               @if($object->address)
               <div style="width: 100%">
                  <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"
                     src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=nl&amp;q={{$object->address->address}},{{$object->address->place}},%20Netherlands+(Mijn%20bedrijfsnaam)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
               </div>
               @endif
            </div>
         </div>
      </div>

   </div>



 

 
</div>





</div><script>
   document.addEventListener('livewire:init', () => {
      Livewire.on('close-crud-modal', (event) => {
         $('#crudModal').modal('hide');
      });
   });
</script>

 