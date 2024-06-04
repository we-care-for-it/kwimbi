<div>
 


@if(count($objects))

 @foreach($objects as $object)


 
<div class="row pt-3 pb-3">
 

 <div class="col-4">
   <div class="card card-button" onclick="window.location = '/locations'">

   <a href = "/object/{{$object->object_id}}">
     <div class="card-body">
       <img style="height: 70px; float: left; padding-right: 10px" src="/assets/img/160x160/img2.jpg">
       <h1> {{$object->results?->name}}</h1>
       <p class="p-0 m-0">{{$object->results?->location->address}}<br>
       {{$object->results?->location->zipcode}} {{$object->results?->location->place}}</p>


               


     </div>

     </a>


   </div>
 </div>


 </div>

 @endforeach

 
@else

<div class="flex justify-center items-center pt-3">
                      <center>
                        <div>

                      
                          <h4>Geen objecten gekoppeld aan dit project</h4>
                       Om een object te koppelen aan dit project ga naar <a href = "/objects" >objecten </a> en koppel 1 of meerdere objecten
                    
                        </div>
                      </center>
                    </div>

@endif

 

</div>
