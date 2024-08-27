<div class="container-fluid">
   <div class="page-header">
      <div class="row align-items-center">
         <div class="col">
            <h1 class="page-header-title"> 
               @if($address->name)
               <b>
               {{$address->name}} </b>|
               @endif
               {{$address->address}}, {{$address->place}} 
            </h1>
         </div>
         <div class="col-auto">
            <button type="button" onclick="history.back()" style=" width: 150px; " class="btn btn-soft-primary" >
            Terug
            </button>
            <button type="button"  data-bs-toggle="offcanvas" data-bs-target="#offcanvasCrud" aria-controls="offcanvasCrud" style=" width: 150px; " class="btn btn-soft-success" >
            Wijzigen
            </button>
         </div>
      </div>
   </div>
   <div class = "row">
      <div class = "col-md-9">
         <div class = "row">
            <div class = "col-md-6">
               <div class = "card" style = "height: 150px">
                  <div class="card-header  bg-light">
                     Adres
                  </div>
                  <div class = "card-body">
                     @if($address->name)
                     {{$address->name}}
                     @endif
                     {{$address->address}}<br>
                     <small>{{$address->zipcode}}        {{$address->place}}</small>
                  </div>
               </div>
            </div>
            <div class = "col-md-6">
               <div class = "card" style = "height: 150px">
                  <div class="card-header  bg-light">
                     Beheerder
                  </div>
                  <div class = "card-body">
                     @if($address->management_id)
                     @if($address->management->name)
                     {{$address->management->name}}
                     @endif
                     {{$address->management->address}}<br>
                     <small>{{$address->management->zipcode}}        {{$address->management->place}}</small>
                     @else
                     <div class="alert alert-soft-warning" role="alert">
                        Geen beheerder gekoppeld
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
         <div class = "row pt-3">
            <div class = "col-md-12">
               <div class = "card">
                  <div class="card-header  bg-light">
                     Gekoppelde liften
                  </div>
                  <div class = "card-body">
                     @if(count($address->Elevator))
                     <table class = "table table-striped table-hover">
                        <thead>
                           <tr>
                              <th scope="col">Unit nummer</th>
                              <th scope="col">Nobonummer</th>
                              <th scope="col">Onderhoudspartij</th>
                              <th scope="col">Bouwjaar</th>
                           </tr>
                        </thead>
                        <tbody>
                           @foreach($address->Elevator as $elevator)
                           <tr>
                              <th scope="row pt-3">{{$elevator->unit_no}}</th>
                              <td>{{$elevator->nobo_no}}</td>
                              <td>{{$elevator?->maintenance_company?->name}}</td>
                              <td>{{$elevator->construction_year}}</td>
                           </tr>
                           @endforeach
                           <tr>
                        </tbody>
                     </table>
                     @else
                     <div class = "row">
                        <div class = "col-md-12">
                           <div class = "pt-3">
                              <h4>Er zijn geen liften gekoppeld aan dit adres......</h4>
                              Koppel een lift aan dit adres doot de lift eigenschappen te wijzigen.
                           </div>
                        </div>
                     </div>
                     @endif
                  </div>
               </div>
            </div>
         </div>
        
      </div>
      <div class = "col-md-3">
         <div class = "row">
            <div class = "col-md-12">
               <div class = "card">
                  <div class="card-header  bg-light">
                     Plattegrond
                  </div>
                  <div class = "card-body">
                     <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=nl&amp;q={{$address->address}},{{$address->place}},%20Netherlands+(Mijn%20bedrijfsnaam)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>