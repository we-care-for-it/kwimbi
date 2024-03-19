<aside style = "background-color: white"
  class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-md navbar-bordered bg-white  
 

  
  ">
  <div class="navbar-vertical-container">
    <div class="navbar-vertical-footer-offset">

      <div class="navbar-vertical-content">
        <div id="navbarVerticalMenu" class=" nav nav-pills nav-vertical card-navbar-nav">
 


<!-- End Form -->

          <span class="dropdown-header mt-2">Hoofdmenu</span>

          <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Dashboard">
            <a wire:navigate class="nav-link {{  Request::path() ==   'dashboard' ? 'active' : '' }} " href="/dashboard">
              <i class="bi-speedometer2 nav-icon"></i>
              <span class="nav-link-title">Overzicht</span>
            </a>

          </div>

       <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Liften">
          <a wire:navigate  class="nav-link @if(request()->is('elevators/*') or  request()->is('elevator/*')  or request()->is('elevators'))  active @endif "
              href="/elevators">
              <i class="bi-grid nav-icon"></i>
              <span class="nav-link-title">Liften</span>
            </a>

          </div>

          <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Storingen">
          <a wire:navigate  class="nav-link @if(request()->is('incidents/*') or  request()->is('incidents'))  active @endif "
                href="/incidents">
              <i class="bi bi-exclamation-triangle  nav-icon"></i>
              <span class="nav-link-title">Storingen</span>
            </a>

          </div>

          
          <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Locaties">
          <a wire:navigate  class="nav-link @if(request()->is('location/*') or  request()->is('locations'))  active @endif "
                href="/locations">
              <i class="bi bi-geo-alt-fill  nav-icon"></i>
              <span class="nav-link-title">Locaties</span>
            </a>

          </div>


          <div class="nav-item "  data-bs-toggle="tooltip" data-bs-placement="right" title="Projecten">
            <a wire:navigate  class="nav-link @if(request()->is('projects/*') or request()->is('project/*') or  request()->is('projects'))  active @endif "
              href="/projects">
              <i class="bi bi-box  nav-icon"></i>
              <span class="nav-link-title">Projecten</span>
            </a>

          </div>

          <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Relaties">
            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi bi-person  nav-icon"></i>
              <span class="nav-link-title">Relaties</span>
            </a>

            </div>
            <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Werkopdrachten">

            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi bi-body-text  nav-icon"></i>
              <span class="nav-link-title">Werkopdrachten</span>
            </a>

            </div>
            <div class="nav-item " data-bs-toggle="tooltip" data-bs-placement="right" title="Tijdregistratie">

            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi bi-clock  nav-icon"></i>
              <span class="nav-link-title">Tijdregistratie</span>
            </a>


          </div>



          <div class="nav-item ">
            <a  wire:navigate  class="nav-link

            @if(request()->is('masterdata/*')
            or request()->is('masterdata')
            or request()->is('maintenancy-companies')
            or request()->is('maintenancy-companies/*')

            or request()->is('management-companies')
            or request()->is('management-companies/*')

            or request()->is('inspection-companies')
            or request()->is('inspection-companies/*')

            or request()->is('suppliers')
            or request()->is('suppliers/*'))

            active @endif   "
              href="/masterdata">
              <i class="bi bi-gear nav-icon"></i>
              <span class="nav-link-title">Basisinstellingen</span>
            </a>

          </div>

          <!-- End Content -->

          <!-- Footer -->
        

              <!-- End Content -->

              <!-- Footer -->
              <div class="navbar-vertical-footer">
          <ul class="navbar-vertical-footer-list">
            <li class="navbar-vertical-footer-list-item">
              <!-- Style Switcher -->
              <div class="dropdown dropup">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation=""><i class="bi-brightness-high"></i></button>

                <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                  <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                    <i class="bi-moon-stars me-2"></i>
                    <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                  </a>
                  <a class="dropdown-item active" href="#" data-icon="bi-brightness-high" data-value="default">
                    <i class="bi-brightness-high me-2"></i>
                    <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                  </a>
                  <a class="dropdown-item" href="#" data-icon="bi-moon" data-value="dark">
                    <i class="bi-moon me-2"></i>
                    <span class="text-truncate" title="Dark">Dark</span>
                  </a>
                </div>
              </div>

              <!-- End Style Switcher -->
            </li>

            <li class="navbar-vertical-footer-list-item">
              <!-- Other Links -->
      <a href = "/support">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"    >
                  <i class="bi-info-circle"></i>
                </button>
          </a>

         
    
              <!-- End Other Links -->
            </li>

           
          </ul>
 
              <!-- End Footer -->
          </div>
        </div>
</aside>
