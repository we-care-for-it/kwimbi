<div>
    <div class="page-header   ">
        <div class="row">
            <div class="col-sm-6">
                <h1 class="page-header-title "> Locaties</h1>
            </div>


            <div class="col">
            <form>
               <!-- Search -->
               <div class="input-group input-group-merge">
                  <input type="text" wire:model.live="filters.keyword" class="js-form-search form-control"
                     placeholder="Zoeken op trefwoord..." data-hs-form-search-options="{
                     &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
                     &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
                     }">
                  <button type="button" class="input-group-append input-group-text">
                  <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                  <i id="defaultClearIconToggleEg" class="bi-search" style="display: block; opacity: 1.03666;"></i>
                  </button>
               </div>
               <!-- End Search -->
            </form>
         </div>
       


            <div class="col-auto">
 
         
             
<a href = "/location/create">

                <button      wire:loading.attr="disabled"  class="btn   btn-primary    btn-120"    " 
       type="button">
 
      Toevoegen
      </button>
</a>

            
            </div>
        </div>
    </div>
    


   <div class="row ">
      <div class="col-xl-12">
       

 
@if($items->count())

   <div class="loading" wire:loading>
      @include('layouts.partials._loading')
   </div>
   @endif

   @if($items->count())

   <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 " wire:loading.remove>
      @foreach ($items as $location)
      <div class="col mb-3 mb-lg-5" >
         <div class="card h-80 card-hover">
          

            <div class="card-body text-center" onclick = "location='/location/{{$location->slug}}'">
               <span class="avatar avatar-xxl avatar-4x3"  style="height: 100px">
                  @if($location->image)
                     <img class="avatar-img " style="max-height: 100px" src="/storage/{{$location->image}}">
                  @else
                     <img class="avatar-img  " style="max-height:100px" src="/assets/img/160x160/img2.jpg">
                  @endif
               </span>


               <h3 class="mb-2  pt-3">
                  <a class="text-dark" href="/location/{{$location->slug}}">
                            @if($location->name)
                            {{$location->name}} @else Geen naam @endif</a> </h3>
                            
                     
                      
                      
                      
                      <div class=" d-flex justify-content-between pb-3">
                     <div class=" badge bg-soft-secondary text-secondary py-1">
                        {{count($location->objects)}}

                        @if(count($location->objects) == 1)
                        object
                        @else
                        objecten
                        @endif
                     </div>
                     <div>
                        @if($location->building_type_id)
                        <span
                           class=" badge bg-soft-primary text-primary py-1">{{config('globalValues.building_types')[$location->building_type_id]}}</span>
                        @else
                        <span class=" badge bg-soft-danger text-danger py-1 ">Onbekend</span>

                        @endif
                     </div>
            </div>

            <span> {{$location->address}},
               {{$location->zipcode}} {{$location->place}}
            </span>
            <div class="pt-2 row justify-content-between align-items-center">

               <div class="col-auto  " style = "height: 20px;">
                  <!-- Form Check -->
                  <div class="clearfix"></div>
          
                  @if($location?->customer?->name)
                  <a href="/customer/{{$location?->customer?->slug}}">
                     {{$location?->customer?->name}}</a>
               
               @else
              
               
                     @endif

                  <!-- End Form Check -->
               </div>
            </div>
         </div>
         <!-- End Body -->

      </div>
      <!-- End Card -->
   </div>
   <!-- End Col -->

   @endforeach

</div>

@else
@include('layouts.partials._empty')
@endif

<div wire:loading.remove class="card-footer">
   @if($items->links())

   {{ $items->links() }}
   @endif
</div>

</div>