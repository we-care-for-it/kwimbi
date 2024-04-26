<div>
    <div class="page-header ">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-header-title  "> @if($location->name)
                    {{$location->name}} @else Geen naam @endif
                    </h1>
             

            </div>

            <div class="col-sm-6  float-end text-end">

                <a href="/locations">
                    <button type="button" class="btn btn-link btn-default btn-squared btn-120  btn-sm ">
                        Alle locaties
                    </button>
                </a>
            
        

                <a href="/location/edit/{{$location->id}}" class="btn    btn-primary   btn-120 ">
                    </i>Wijzigen</a>


            </div>
        </div>
    </div>








                  <div class="row">

                      <div class="col-md-4">
                      <div class="card">
                      <div class="card-body">

                    <center>



                                  <span class="mb-2   " style = "width: 100%; ">

               @if($location->image)
               <a class="text-body" >

              <img class="avatar-img   " style = "max-height: 220px;   " src="/storage/{{$location->image}}"  >
              </a>
              @else
              <img class="avatar-img   "  style = "max-height: 220px;  " src="/assets/img/160x160/img2.jpg"  >

              @endif
              </span>


                       <div class = "clearfix mt-3 "></div>



                       <span  > {{$location->address}}  {{$location->housenumber}},
                                    {{$location->zipcode}} {{$location->place}}
                                      </span>

                                      <div class = "clearfix"></div>


              @if($location->building_type)
                                <span
                                   class="  mt-3  badge bg-soft-primary text-primary py-2 ">{{$location->building_type}}</span>

                                @endif



              </center>
              </div></div>


              <div class="row mt-3">

              <div class="col-md-12">



              <div class="card  ">
              <div class="card-body">

                    <b>{{$location->customer?->name}}</b>
                    <br>
                    {{$location->customer?->address}} {{$location->customer?->place}}

              </div>
              </div>
              </div>
              </div>


               <div class = "card mt-3">
              <table class= "table">
              @if($location->remark)
              <tr>
              <td colspan="2">

              {{$location->remark}}  </td>

              </tr>
              @endif

              <tr>
                  <td>Complexnummer</td>
                  <td>@if($location->complexnumber) {{$location->complexnumber}} @else <span class=" badge bg-soft-primary text-primary ">Geen</span> @endif</td>
              </tr>

              <tr>
                  <td>Relatie</td>
                  <td>    <a href = "/customer/{{$location?->customer?->slug}}">   {{$location?->customer?->name}}</a>
                                     </td>
              </tr>



              <tr>
                  <td>Beheerder</td>
                  <td>@if($location->managementcompany) {{$location->managementcompany->name}}  @else -  @endif</td>
              </tr>



              <tr>
                  <td>Type toegang</td>
                  <td> @if($location->building_access_type_id)  {{config('globalValues.building_access_types')[$location->building_access_type_id]}}  @endif</td>
              </tr>

              <tr>
                  <td>Code</td>
                  <td>  @if($location->access_code) {{$location->access_code}}  @endif</td>
              </tr>

              <tr>
                  <td>Contactpersoon</td>
                  <td>  @if($location->access_contact) {{$location->access_contact}}  @endif</td>
              </tr>

              <tr>
                  <td>Locatie sleutelkleus</td>
                  <td> @if($location->location_key_lock) {{$location->location_key_lock}}  @endif</td>
              </tr>





              </table>
              </div>
              </div>


                      <div class="col-md-8">



                      @if($location->gps_lon)

                      <div class="card p-1 mb-3 ">

               <iframe class = "p-1" width="100%" height="219 " style = "border-radius: 10px" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=200&amp;hl=en&amp;q={{$location->gps_lat}},{{$location->gps_lon}}+(My%20Business%20Name)&amp;t=&amp;z=16&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>


              </div>

              @endif

                      <div class="card  p-1">



                      <div class="card-body p-2">
                                  <div class = "row">
                                  <div class="col-md-3">
                                          <label class="pb-2  ">GPS Longitude</label>
                                          <div class = "clear-fix"></div>
                                              @if($location->gps_lon) {{$location->gps_lon}} @else - @endif



                                      </div>

                                      <div class="col-md-3">
                                          <label class="pb-2  ">GPS latitude</label>
                                          <div class = "clear-fix"></div>
                                              @if($location->gps_lat) {{$location->gps_lat}} @else - @endif



                                      </div>

                                      <div class="col-md-6">
                                          <label class="pb-2  ">Gemeente</label>
                                          <div class = "clear-fix"></div>
                                              @if($location->municipality) {{$location->municipality}} @else - @endif


                                      </div>


                                  </div>       </div>
                              </div>

                              <div class="card mt-3 p-1">



                              <div class="card-body p-2">
                                  <div class = "row">
                                  <div class="col-md-3">
                                              <label class="pb-2">Bouwjaar</label>
                                              <div class = "clear-fix"></div>
                                              @if($location->construction_year) {{$location->construction_year}} @else - @endif

                                                      </div>

                                          <div class="col-md-3">
                                              <label class="pb-2">Verdiepingen</label>
                                              <div class = "clear-fix"></div>
                                              @if($location->levels) {{$location->levels}} @else - @endif


                                          </div>

                                          <div class="col-md-3">
                                              <label class="pb-2">Oppervlakte</label>
                                              <div class = "clear-fix"></div>
                                              @if($location->surface) {{$location->surface}} @else - @endif


                                          </div>
                              </div>

                              </div>       </div>


                <div class="card mt-3">
                <div class="card-header  ">

              Aanwezig objecten
              </div>
                              <div class="card-body   p-2 ">
                                  <div class = "row gx-2">
                                      <div class = "col-md-12">
                                         <div>

                                         @if(count($location->objects))
                                         <div class="table   p-25 bg-white mb-30">
                                                                    <div class="table-responsive">


                                           <table class="table table-hover">
                                         <thead class = "thead-light">
                                             <tr class="userDatatable-header">

                                                 <th>
                                                     <span class="userDatatable-title">Nobonummer</span>
                                                 </th>
                                                 <th>
                                                     <span class="userDatatable-title">Onderhoudspartij</span>
                                                 </th>     <th>
                                                          <span class="userDatatable-title">Type</span>
                                                      </th>
                                             </tr>

                <tbody>


                                         @forelse ($location->objects  as $elevator)
                                         <tr>
                    <tr style = "cursor:pointer" onclick="window.location='/elevator/show/{{ $elevator->id }}'"  wire:key="row-{{ $elevator->id }}">


                                        <td>{{ $elevator->nobo_no}}</td>

                    <td>@if ($elevator->maintenancecompany) {{ $elevator->maintenancecompany->name }} @endif</td>

                    <td>  @if($elevator?->object_type_id)
                             <small>
                             {{config('globalValues.object_types')[$elevator?->object_type_id]}}</small>
                             @endif {{ $elevator->disapprovedState }} @if ($elevator->disapprovedState != null)								@if($management_elevator)

                                      @endif</td>
                                      <td>@if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>
                                      <br> @endif <small>
                                      {{ $elevator->address->address }}, @if ($elevator->address->housenumber)
                                      {{ $elevator->address->housenumber }},
                                      @endif @if ($elevator->address->zipcode)
                                      {{ $elevator->address->zipcode }},
                                      @endif {{ $elevator->address->place }}
                                      @endif
                                      @if($elevator->description)
                                      <br>
                                      {{$elevator->description}}
                                      @endif
                                      </small>

                                      @endif
                                   </div></td>

                  </tr>
                                         @endforeach


                </tbody>
              </table>
            </div>
          </div>


              @else
 


<div class="  text-center p-5">
 

<img src="/assets/img/folders/1.svg">
                                 
                                        

                                            <p class="">Geen objecten</p>

                                   
                                
                            </div>
              @endif


                                      </div>
                                   </div>



                  </div>



      </div>
