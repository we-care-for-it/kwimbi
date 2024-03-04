<!-- ========== HEADER ========== -->

<header style = "background-color: #7952B3 "  id="header" class="navbar navbar-expand-lg navbar-fixed navbar-height navbar-container navbar-bordered  "
  >
  <div  class="navbar-nav-wrap">
      <div class="navbar-nav-wrap-content-start">
      <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
        <i class="bi-arrow-bar-left navbar-toggler-short-align"
          data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
        <i class="bi-arrow-bar-right navbar-toggler-full-align"
          data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
          data-bs-toggle="tooltip" data-bs-placement="right" title="Menu"></i>
      </button>

  </div>

    <div class="navbar-nav-wrap-content-end">


      <ul class="navbar-nav">


        <!-- <li class="nav-item">
          <div class="dropdown">
            <a style="color: white!important" class="navbar-dropdown-account-wrapper" href="javascript:;"
              id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
              data-bs-dropdown-animation>
              <i class="fa-solid fa-plus"></i> Toevoegen
            </a>
            <div
              class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
              aria-labelledby="accountNavbarDropdown" style="width: 16rem;">

              <a class="dropdown-item" href="/management-companies/create">Beheerder</a>
              <a class="dropdown-item" href="/inspection-companies/create">Keuringinstantie</a>
              <a class="dropdown-item" href="/customers/add">Relatie</a>
              <a class="dropdown-item" href="/suppliers/create">Leverancier</a>
              <a class="dropdown-item" href="/location/create">Locatie</a>
              <a class="dropdown-item" href="/maintenancy-companies">Onderhoudspartij</a>
              <a class="dropdown-item" href="/contacts/create">Contactpersoon</a>

            </div>
          </div>
        </li> -->

        <li class="nav-item">
          <div class="dropdown">
            <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
              data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation>
              <div class="avatar avatar-sm avatar-circle">
                <img class="avatar-img" src="/assets/img/160x160/img1.jpg" alt="Image Description">
                <span class="avatar-status avatar-sm-status avatar-status-success"></span>
              </div>
            </a>

            <div
              class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
              aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
              <div class="dropdown-item-text">
                <div class="d-flex align-items-center">
                  <div class="avatar avatar-sm avatar-circle">
                    <img class="avatar-img" src="/assets/img.160x160/img1.jpg" alt="Image Description">
                  </div>
                  <div class="flex-grow-1 ms-3">
                    <h5 class="mb-0">{{ Auth::user()->name}}</h5>
                    <p class="card-text text-body">{{ Auth::user()->email}}</p>
                  </div>
                </div>
              </div>

              <!-- End Dropdown -->

              <a class="dropdown-item" href="">Mijn profiel </a>
 

              <div class="dropdown-divider"></div>

              <div class="nav-item">

              
                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                  Loguit
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                  {{ csrf_field() }}
                </form>

              </div>

            </div>
          </div>
          <!-- End Account -->
        </li>
      </ul>
      <!-- End Navbar -->
    </div>
  </div>
</header>
