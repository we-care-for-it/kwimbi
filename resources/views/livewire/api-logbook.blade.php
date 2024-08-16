<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <img src="/assets/img/ico/users.png" class="pageico">
            <h1 class="page-header-title">Logboek</h1>

            <span class=" mb-2 text-muted"> Externe kopplingen logboek</span>
         </div>
         <div class="col-auto">
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary">
               Terug
            </button>

         </div>
      </div>
   </div>

   <div class="card">
      <div class="card-header bg-light">
      Chex keuringen
      </div>
      <div class="card-body">

         <div class="accordion" id="accordionExample">

            @foreach ($inspections->where('inspection_company_id',3) as $inspection)

            <div class="accordion-item"  >
               <div class="accordion-header"  id="heading{{$inspection->id}}">
                  <span class="accordion-button collapsed"  role="button" data-bs-toggle="collapse"
                     data-bs-target="#collapse{{$inspection->id}}" aria-expanded="false"
                     aria-controls="collapse{{$inspection->id}}">
                     <table class="table">

                        <tbody>
                           <tr>

                           <td style="font-style: normal; width: 220px;"> 
                           {{ Carbon\Carbon::parse($inspection->created_at)->format('d-m-Y H:i') }}
                           </td>
                              <td class="align-middle" style="font-style: normal; width: 220px;">
 

                                 @if ($inspection->elevator->address) @if ($inspection->elevator->address->name)
                                 <b>{{ $inspection->elevator->address->name }}</b>

                                 <br> @endif

                                 <small>

                                  
{{ $inspection->elevator->address->address }}, @if ($inspection->elevator->address->housenumber)
{{ $inspection->elevator->address->housenumber }},
@endif 
 
@endif
 
</small> 



</td>


 

      <td  class = " align-middle"  style="font-style: normal; width: 320px;">

 



      @if($inspection->status_id==1)
      <span class=" badge bg-soft-success text-success py-2" > Goedgekeurd </span>
                                       @endif
                                       @if($inspection->status_id==2)
                                       <span class="badge bg-soft-warning text-warning py-2"> Goedgekeurd met acties
                                       </span>
                                       @endif @if($inspection->status_id==3)
                                       <span class="badge bg-soft-danger text-danger py-2 "> Afgekeurd </span>
                                       @endif @if($inspection->status_id==4)
                                       <span class="badge bg-soft-info text-info py-2"> Onbeslist </span>
                                       @endif @if($inspection->status_id==5)
                                       <span class=" badge bg-soft-primary text-primary py-2">
                                          Niet afgerond
                                       </span> @endif

                                       @if($inspection?->RepetitionCount)
                                       <span class="badge bg-soft-warning  text-warning py-2 pt-2"> Herhaalpunten</span>
                                          @endif

                              </td>
                              <td class="align-middle" style=" width: 120px;">
                                 {{ Carbon\Carbon::parse($inspection->executed_datetime)->format('d-m-Y') }}
                              </td>
                              <td class="align-middle" style=" width: 120px;">
                                 {{ Carbon\Carbon::parse($inspection->end_date)->format('d-m-Y') }}
                              </td>

                              <td class="align-middle"  >
                                 @if($inspection->type)
                                 {{$inspection->type}}
                                 @endif

                              </td>

                           </tr>

                        </tbody>
                     </table>
                  </span>
               </div>

               <div id="collapse{{$inspection->id}}" class="accordion-collapse collapse"
                  aria-labelledby="heading{{$inspection->id}}" data-bs-parent="#accordionExample">
                  <div class="accordion-body">


                     <table class="table">
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
                              <td>{{$detail?->zin_code}}</td>

                              <td>{{$detail?->comment}}</td>
                              <td>{{$detail?->type}}</td>
                              <td>

                                 @if($detail->status=='Herhaling')
                                 <span class="badge bg-soft-warning  text-warning py-2 pt-2"> Herhaling</span>

                               @else
                               -
                                 @endif
                               
                              </td>
                           </tr>
                           @endforeach

                        </tbody>
                     </table>
                 
   
   <a href="/company/elevator/show/{{$inspection->elevator_id}}"  >
                       <button class = "btn btn-soft-primary btn-120">Open lift</button>
                     </a>  
 
                  </div>
               </div>
            </div>
            @endforeach

         </div>
         <!-- End Accordion -->

      </div>

   </div>
</div>