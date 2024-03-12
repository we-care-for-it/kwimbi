<aside
  class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
  <div class="navbar-vertical-container">
    <div class="navbar-vertical-footer-offset">

      <div class="navbar-vertical-content">
        <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
    
            <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="dark">
            <img class="navbar-brand-logo-mini" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo-mini" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="dark">
 
          <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler" style="opacity: 1;">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Collapse" data-bs-original-title="Menu verbergen "></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Expand" data-bs-original-title="Menu tonen"></i>
        </button>
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler" style="opacity: 1;">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Collapse" data-bs-original-title="Menu verbergen "></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Expand" data-bs-original-title="Menu tonen"></i>
        </button>

 <form method = "post" action="/search">
 @csrf
  <div class="input-group input-group-merge mt-3">
    <input type="text" class="js-form-search form-control w-100"  id = "keyword" name = "keyword" placeholder="Zoek op trefwoord..."
           data-hs-form-search-options='{
             "clearIcon": "#clearIcon2",
             "defaultIcon": "#defaultClearIconToggleEg"
           }' value = "{{request()->get('keyword')}}">
    <button type="button" class="input-group-append input-group-text">
      <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
      <i id="defaultClearIconToggleEg" class="bi-search" style="display: none;"></i>
    </button>
  </div>
          </form>

<!-- End Form -->

          <span class="dropdown-header mt-2">Hoofdmenu</span>

          <div class="nav-item ">
            <a wire:navigate class="nav-link {{  Request::path() ==   'dashboard' ? 'active' : '' }} " href="/dashboard">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Overzicht</span>
            </a>

          </div>

       <div class="nav-item ">
          <a wire:navigate  class="nav-link @if(request()->is('elevators/*') or  request()->is('elevator/*')  or request()->is('elevators'))  active @endif "
              href="/elevators">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Liften</span>
            </a>

          </div>

          <div class="nav-item ">
          <a wire:navigate  class="nav-link @if(request()->is('incidents/*') or  request()->is('incidents'))  active @endif "
                href="/incidents">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Storingen</span>
            </a>

          </div>

          
          <div class="nav-item ">
          <a wire:navigate  class="nav-link @if(request()->is('location/*') or  request()->is('locations'))  active @endif "
                href="/locations">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Locaties</span>
            </a>

          </div>


          <div class="nav-item ">
            <a wire:navigate  class="nav-link @if(request()->is('projects/*') or request()->is('project/*') or  request()->is('projects'))  active @endif "
              href="/projects">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Projecten</span>
            </a>

          </div>

          <div class="nav-item ">
            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Relaties</span>
            </a>

            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi-people nav-icon"></i>
              <span class="nav-link-title">Werkopdrachten</span>
            </a>


            <a wire:navigate  class="nav-link @if(request()->is('customers/*') or  request()->is('customers'))  active @endif "
              href="/customers">
              <i class="bi-people nav-icon"></i>
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
              <i class="bi-people nav-icon"></i>
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
