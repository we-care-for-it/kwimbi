<div class="container-fluid">
  <div class="row">
                      <div class="col-lg-12">

                          <div class="breadcrumb-main user-member justify-content-sm-between ">
                              <div class=" d-flex flex-wrap justify-content-center breadcrumb-main__wrapper">
                                  <div class="d-flex align-items-center user-member__title justify-content-center mr-sm-25">
                                      <h4 class="text-capitalize fw-500 breadcrumb-title">Locaties</h4>
                                      <span class="sub-title ml-sm-25 pl-sm-25">{{count($items)}} locaties</span>
                                  </div>


                              </div>
<div class="breadcrumb-action justify-content-center flex-wrap">

  <form action="/" class="d-flex align-items-center user-member__form my-sm-0 my-2">
      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
      <input wire:model.live="filters.keyword" class="form-control mr-sm-2 border-0 box-shadow-none" type="search" placeholder="Zoek naar gegevens" aria-label="Search">
  </form>

</div>
                          </div>


                      </div>
                  </div>


                  <div class="row">

@if(count($items))


                     @foreach ($items as $location)

                                      <div class="col-xxl-3 col-lg-4 col-md-6 mb-25">
                                          <!-- Profile Acoount -->
                                          <div class="card">
                                              <div class="card-body text-center pt-30 px-25 pb-0">

                                                  <div class="account-profile-cards  ">
                                                      <div class="ap-img d-flex justify-content-center">
                                                          <!-- Profile picture image-->

                                                          @if($location->image)
                                           <img class="ap-img__main bg-opacity-primary  wh-120 rounded-circle mb-3 "
                                              src="/storage/{{$location->image}}">

                                           @else
                                           <img class="ap-img__main bg-opacity-primary  wh-120 rounded-circle mb-3 "
                                              src="/img/building.jpg">

                                           @endif




                                                      </div>
                                                      <div class="ap-nameAddress">
                                                          <h6 class="ap-nameAddress__title">  <a class="text-dark" href="/location/{{$location->slug}}">
                            @if($location->name)
                            {{$location->name}} @else Geen naam @endif</a></h6>
                                                          <p class="ap-nameAddress__subTitle  fs-14 pt-1 m-0 ">{{$location->address}},
                                          {{$location->zipcode}} {{$location->place}}
</p>
                                                      </div>
                                                      <div class="ap-button account-profile-cards__button button-group d-flex justify-content-center flex-wrap pt-20">
                                                        <a href="/customer/{{$location?->customer?->slug}}">
                                                {{$location?->customer?->name}}</a>
                                                      </div>
                                                  </div>

                                                  <div class="card-footer mt-20 pt-20 pb-20 px-0">

                                                      <div class="profile-overview d-flex justify-content-between flex-wrap">
                                                          <div class="po-details">
                                                              <h6 class="po-details__title"> {{count($location->objects)}}


                                                              <span class="po-details__sTitle">Objecten</span>
                                                          </div>

                                                          <div class="po-details">
                                                            @if($location->building_type_id)
                                                    <span
                                                       class="  text-primary "><small>{{config('globalValues.building_types')[$location->building_type_id]}}</small></span>
                                                    @else
                                                    <span class="  text-danger "><small>Onbekend</small></span>

                                                    @endif
                                                          </div>
                                                      </div>

                                                  </div>
                                              </div>
                                          </div>
                                          <!-- Profile Acoount End -->
                                      </div>
                                   @endforeach
                                   @else
      @include('layouts.partials._empty')


                                   @endif

                                  </div>



      </div>
