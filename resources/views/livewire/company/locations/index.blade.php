<div>
   <div class="page-header  my-3">


   <div class="row">
        <div class="col-sm-6">
            <h1 class=" float-start page-header-title pt-2">Locaties</h1>
        </div>
        <div class="col-sm-6 ">
            <div class = " float-end">    <button wire:loading.attr="disabled" type="button" class="btn    btn-soft-success   btn-120" data-bs-toggle="modal"
                data-bs-target="#crudModal">
                Toevoegen
                </button> <button type="button" onclick="history.back()" class="  btn btn-soft-secondary    btn-icon    ">
                <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </div>

 
   </div>
  


   <div class="row ">
      <div class="col-xl-12">
         <div class="card  ">
 
            <div class="card-body ">

            <div class = "filter_bar ">

<div class="row">
<div class="col">

    <form class = "float-start">
            <div class="input-group input-group-merge ">
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
         </form> 
      </div>  

</div>



 
</div>

 

   <div class="loading" wire:loading>
      @include('layouts.partials._loading')
   </div>

   @if($items->count())

   <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 " wire:loading.remove>
      @foreach ($items as $location)
      <div class="col mb-3 mb-lg-5" onclick = "location='/location/{{$location->slug}}'">
         <div class="card h-80 card-hover">
            <div class="card-pinned">
               <div class="card-pinned-top-end">
                  <div class="dropdown">
                     <button type="button"
                        class="btn btn-ghost-secondary btn-icon btn-sm card-dropdown-btn rounded-circle"
                        id="projectsGridDropdown8" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi-three-dots-vertical"></i>
                     </button>
                     <div class="dropdown-menu dropdown-menu-end" aria-labelledby="projectsGridDropdown8">
                        <a class="dropdown-item" href="/location/edit/{{$location->id}}">Wijzigen </a>
                     </div>
                  </div>
               </div>
            </div>


            <div class="card-body text-center">
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