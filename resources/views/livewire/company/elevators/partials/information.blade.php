<div>

   <div class="card">
      <div class="card-header">
         Liftgegevens
      </div>
      <div class="card-body">

         <table>
            <tr>

               <td colspan="2"> <a
                     href="{{$elevator?->location?->customer?->slug}}">{{$elevator?->location?->customer?->name}}</a>
               </td>
            </tr>
            <tr>
               <td colspan="2">{{$elevator?->location?->customer?->address}}
                  {{$elevator?->location?->customer?->zipcode}} {{$elevator?->location?->customer?->place}} </td>
            </tr>
         </table>

         <ul class="list-unstyled mb-0">

            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Liftadres
                     </h5>
                     {{$elevator?->address?->address}}
                     <br>
                     <small>
                        {{$elevator?->address?->zipcode}},
                        {{$elevator?->address?->place}}
                     </small>

                  </div>
            </li>
            @if($elevator?->name)
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Liftnaam
                     </h5>
                     {{$elevator?->name}}
                  </div>
               </div>
            </li>
            @endif
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Unit no
                     </h5>
                     {{$elevator?->unit_no}}
                  </div>
               </div>
            </li>
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Nobo no
                     </h5>
                     {{$elevator?->nobo_no}}
                  </div>
               </div>
            </li>

            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Bouwjaar
                     </h5>
                     @if($elevator?->construction_year)
                     {{$elevator?->construction_year}}
                     @else
                     Nier opgegeven
                     @endif
                  </div>
               </div>
            </li>

            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Onderhoudsbedrijf
                     </h5>
                     {{$elevator?->maintenancecompany?->name}}
                  </div>
               </div>
            </li>
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Keuringsinstantie
                     </h5>
                     {{$elevator?->inspectionCompany?->name}}
                  </div>
               </div>
            </li>
            <li class="py-3">
               <div class="d-flex align-items-center">
                  <div class="flex-grow-1">
                     <h5 class="mb-0 font-size-14">Beheerder
                     </h5>
                     {{$elevator?->address?->management?->name}}
                  </div>

               </div>

      </div>

   </div>
</div>