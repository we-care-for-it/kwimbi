<div class="container-fluid">
    <div class="page-header  my-3">
        <div class="row align-items-center">
            <div class="col">
                <h1 class="page-header-title">
                @if($location->name)
                            {{$location->name}} @else Geen naam @endif
            </div>
            <div class="col-auto">
                
            <a href="/locations">
                    <button type="button" class="btn   btn-link btn-sm  ">
                        Alle locaties
                    </button></a>
                    
                <a href = "/location/edit/{{$location->id}}">
                <button type="button" class="btn btn-primary btn-sm  btn-120" wire:click="save()">
                    Wijzig
                </button>
                </a>
                
                <button type="button" onclick="history.back()" class="btn btn-secondary btn-sm  ">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>

            </div>
        </div>
    </div>
    <div class="row">

        <div class="col-md-3">
 

                  
      <center> 
                
                          </a>
                            
                    <span class="mb-2   " style = "width: 100%; ">
 
 @if($location->image)
 <a class="text-body" >
           
<img class="avatar-img   " style = "max-height: 220px;  width: 100%; " src="/storage/{{$location->image}}"  >
</a>
@else
<img class="avatar-img   "  style = "max-height: 220px; width: 100%;" src="/assets/img/160x160/img2.jpg"  >

@endif
</span>
                   

         <div class = "clearfix mt-3 "></div>    

                      
                      
         <span  > {{$location->address}}, 
                      {{$location->zipcode}} {{$location->place}}
                        </span>
                
                        <div class = "clearfix"></div>    

              
@if($location->building_type_id)
                  <span
                     class="  mt-3  badge bg-soft-primary text-primary py-2 ">{{config('globalValues.building_types')[$location->building_type_id]}}</span>
                  @else
                  <span class="     mt-3  badge bg-soft-danger text-danger  py-2 ">Onbekend</span>

                  @endif



</center>
<hr>
<table class= "table">
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
    <td>@if($location->managementcompany) {{$location->managementcompany->name}}  @else <span class=" badge bg-soft-primary text-primary ">Geen</span>  @endif</td>
</tr>

<tr>
<td colspan="2">@if($location->remark) {{$location->remark}}  @endif</td>
 
</tr>




</table>

                 

                 
        </div>

        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-content-md-between  ">

                    Aanwezig objecten
                </div>

                <div class="card-body">
                    <div class = "row">
                        <div class = "col-md-12">
                           <div>

                           @if(count($location->objects))

                           <table class="table tabel-striped table-hover">
  <thead>
    <tr>
 
      <th scope="col">Adres</th>
      <th scope="col">Nobonummer</th>
      <th scope="col">Onderhoudspartij</th>
 
      <th scope="col">Type</th>

    </tr>
  </thead>
  <tbody>
    

                           @forelse ($location->objects  as $elevator)
                           <tr>
      <tr onclick="window.location='/elevator/show/{{ $elevator->id }}'"  wire:key="row-{{ $elevator->id }}">
    
      <td> @if ($elevator->address) @if ($elevator->address->name) <b>{{ $elevator->address->name }}</b>
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
                        </small> </td>
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


@else
Geen objecten gevonden op deze locatie
@endif 

    
                        </div>
                     </div>
                     
       
            </div>
        </div>

    </div>
</div>
 