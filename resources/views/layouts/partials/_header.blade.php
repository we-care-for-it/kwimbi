<header id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered bg-white">

 <div class="navbar-nav-wrap">
    <!-- Logo -->
    <a class="navbar-brand" href="/dahboard" aria-label="Front">
    <img class="navbar-brand-logo"  src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo"   src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
          <img class="navbar-brand-logo-mini"   src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo-mini"   src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
         </a>
    <!-- End Logo -->
    <div class="navbar-nav-wrap-content-start">
      <!-- Navbar Vertical Toggle -->
      <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
        <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
        <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
      </button>

      <!-- End Navbar Vertical Toggle -->

      <!-- Search Form -->
      <div class="dropdown ms-2">
        <!-- Input Group -->


        <form action = "/search" method= "GET">
        <div class="d-none d-lg-block">
          <div class="input-group input-group-merge input-group-borderless input-group-hover-light navbar-input-group">
            <div class="input-group-prepend input-group-text">
              <i class="bi-search"></i>
            </div>


            <input type="search" id = "keyword" class="js-form-search form-control" placeholder="Zoeken in de database" aria-label="" data-hs-form-search-options='{
                   "clearIcon": "#clearSearchResultsIcon",
                   "dropMenuElement": "#searchDropdownMenu",
                   "dropMenuOffset": 20,
                   "toggleIconOnFocus": true,
                   "activeClass": "focus"
                 }'>
            <a class="input-group-append input-group-text" href="javascript:;">
              <i id="clearSearchResultsIcon" class="bi-x-lg" style="display: none;"></i>
            </a>
            </div>

          </div>
        </div>
                </form>

        <button class="js-form-search js-form-search-mobile-toggle btn btn-ghost-secondary btn-icon rounded-circle d-lg-none" type="button" data-hs-form-search-options='{
                   "clearIcon": "#clearSearchResultsIcon",
                   "dropMenuElement": "#searchDropdownMenu",
                   "dropMenuOffset": 20,
                   "toggleIconOnFocus": true,
                   "activeClass": "focus"
                 }'>
          <i class="bi-search"></i>
        </button>
        <!-- End Input Group -->



      </div>

      <!-- End Search Form -->
    </div>

    <div class="navbar-nav-wrap-content-end">
      <!-- Navbar -->
      <ul class="navbar-nav">


        <li class="nav-item">
          <!-- Account -->
          <div class="dropdown">
            <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
              <div class="avatar avatar-sm avatar-circle">



             <span class="avatar avatar-soft-success avatar-circle mb-1">
            <span class="avatar-initials"> {{ Auth::user()->getInitialsAttribute() }}</span>
          </span>
                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
              </div>
            </a>

            <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
              <div class="dropdown-item-text">
                <div class="d-flex align-items-center">
                <span class="avatar avatar-soft-success avatar-circle mb-1">
            <span class="avatar-initials"> {{ Auth::user()->getInitialsAttribute() }}</span>
          </span>





                  <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">{{ Auth::user()->name}}</h5>
                    <p class="card-text text-body">{{ Auth::user()->email}}</p>
                  </div>
                </div>
              </div>


              <!-- End Dropdown -->

              <a class="dropdown-item" href="#">Mijn profiel </a>
              <a class="dropdown-item" href="#">Basis gegevens</a>


              <a class="dropdown-item" href="/system/users">Gebruikers</a>
              <a class="dropdown-item" href="/system/users">Koppelingen</a>




              <div class="dropdown-divider"></div>







              <form method="POST" action="{{ route('logout') }}">
                  @csrf
                  <div class="nav-item">
                      <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                  this.closest('form').submit(); " role="button">
                        Loguit
                      </a>
                  </div>
                  </form>
            </div>
          </div>
          <!-- End Account -->
        </li>
      </ul>
      <!-- End Navbar -->
    </div>
  </div>
</header>
