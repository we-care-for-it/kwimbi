<div class="container-fluid">
   <div class="page-header     ">
      <div class="row align-items-center ">
         <div class="col">
 
         <h1 class="page-header-title pt-3">  {{$project->name}}  </h1>
             </div>
          
         <div class="col-auto">
         <a href = "/project/edit/{{$project->id}}">
            <button type="button" class="btn   btn-primary btn btn-sm btn-120 " >
Wijzigen
            </button></a>
         </div>
      </div>
   </div>
   
    

    <div class="row ">

        <div class="col-md-3">         
        <div class="card-header      ">

Relatie
</div>
<div class="card  bg-light">
<div class="card-body">
 
      <b>{{$project->customer?->name}}</b>
      <br>
      {{$project->customer?->address}} {{$project->customer?->place}}
 
</div>
</div>
 
 


        
        <div class = "card mt-3 ">
        <div class = "card-body p2">

        <table class= "table">
        <tr>
    <td>Startdatum</td>
    <td>@if($project->startdate)
                                          {{ \Carbon\Carbon::parse($project->startdate)->format('d-m-Y')}} @else
                                          <span class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif
</td>
</tr>


<tr>
    <td>Begindatum</td>
    <td>     @if($project->enddate)
                                          {{ \Carbon\Carbon::parse($project->enddate)->format('d-m-Y')}} @else <span
                                             class="badge bg-soft-primary-light text-primary p-1">Geen</span> @endif
   </td>
</tr>

<tr>
    <td>Status</td>
    <td>   <div class="d-flex align-items-center">
                                             <span class="fs-6 me-2" style="width: 40px ">{{$project->progress}}%</span>
                                             <div class="progress table-progress">
                                                <div class="progress-bar
                                             <!-- @if($project->progress==100)
                                             bg-success
                                             @elseif($project->progress==30)
                                             bg-primary
                                             @elseif($project->progress==40)
                                             bg-warning
                                             else
                                             bg-primary
                                             @endif -->
                                             " role="progressbar" style="width: {{$project->progress}}%" aria-valuenow="0"
                                                   aria-valuemin="0" aria-valuemax="100"></div>
                                             </div>
                                          </div>
</td>
</tr>


<tr>
<td>Aantal uren
</td>

<td>
    
@if($project->budget_hours) {{$project->budget_hours}} @else <span class=" badge bg-soft-primary text-primary ">Onbekend</span> @endif

 
</td>

</tr>

<tr>
<td>Budget
</td>

<td>@if($project->budget_costs) {{$project->budget_costs}} @else <span class=" badge bg-soft-primary text-primary ">Onbekend</span> @endif

 
</td>

</tr>
<tr>

<tr>
<td>Contactpersoon
</td>

<td>  @if($project->contact_person_name) {{$project->contact_person_name}} @else <span class=" badge bg-soft-primary text-primary ">Geen</span> @endif

 
</td>

</tr>






</table>


                                  
  


            </div> </div>
        </div>

        <div class="col-md-9">
        <div class="card-header      ">

Projectgegevens
</div>

            <div class="card">
         

                <div class="card-body p-2">
 
 
  
              
                     
@if($project->description)
                            {!! nl2br(e($project->description)) !!}
                            @else
Geen omschrijving opgegeven
                            @endif
             

     
 
                </div>
            </div>
        </div>

    </div>
</div>
 