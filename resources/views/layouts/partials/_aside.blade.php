 



   <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white navbar-vertical-aside-initialized">
    <div class="navbar-vertical-container">
      <div class="navbar-vertical-footer-offset">
     
        <button type="button" class="d-none d-md-block  js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler" style="opacity: 1;">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Collapse" data-bs-original-title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template="<div class=&quot;tooltip d-none d-md-block&quot; role=&quot;tooltip&quot;><div class=&quot;arrow&quot;></div><div class=&quot;tooltip-inner&quot;></div></div>" data-bs-toggle="tooltip" data-bs-placement="right" aria-label="Expand" data-bs-original-title="Expand"></i>
        </button>
        <div class="navbar-vertical-content">


 
   <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">

 
    <center>
          <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="dark">
          <img class="navbar-brand-logo-mini" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo-mini" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="dark">
</center>
    
      <div class="nav-item pt-3  ">
         <a class="nav-link dropdown-toggle collapsed" href="#navbarVerticalMenuPagesDefaultMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesDefaultMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceMenu">
         <i class="bi-basket nav-icon"></i>
         <span class="nav-link-title">Hoofdmenu</span>
         </a>
         <div id="navbarVerticalMenuPagesDefaultMenu" class="nav-collapse  " data-bs-parent="#navbarVerticalMenuPagesMenu" hs-parent-area="#navbarVerticalMenu" style="">
            <a wire:navigate class="nav-link {{  Request::path() ==   'dashboard' ? 'active' : '' }} " href="/dashboard" ><i class="bi-people nav-icon"></i><span class="nav-link-title">Overzicht</span></a>
            <a wire:navigate class="nav-link nav-link @if(request()->is('elevators/*') or  request()->is('elevators'))  active @endif" href="/elevators" ><i class="bi-people nav-icon"></i><span class="nav-link-title">Liften</span></a>
            <a wire:navigate class="nav-link nav-link @if(request()->is('incidents/*') or  request()->is('incidents'))  active @endif" href="/incidents" ><i class="bi-people nav-icon"></i><span class="nav-link-title">Storingen</span></a>
            <a wire:navigate class="nav-link {{  Request::path() ==   'contacts' ? 'active' : '' }} " href="/contacts" ><i class="bi-people nav-icon"></i><span class="nav-link-title">Contactpersonen</span>     </a>
            <a wire:navigate class="nav-link @if(request()->is('location/*') or  request()->is('locations'))  active @endif" href="/locations"> <i class="bi-people nav-icon"></i> Locaties</a>
            <a wire:navigate class="nav-link @if(request()->is('customers') or  request()->is('customer/*'))  active @endif" href="/customers" ><i class="bi-people nav-icon"></i><span class="nav-link-title">Relaties</span></a>
            <a wire:navigate class="nav-link @if(request()->is('projects/*') or  request()->is('projects'))  active @endif" href="/projects"> <i class="bi-people nav-icon"></i> Projecten</a>
         </div>
      </div>
      <div class="nav-item">
         <a class="nav-link dropdown-toggle collapsed" href="#navbarVerticalMenuPagesEcommerceMenu" role="button" data-bs-toggle="collapse" data-bs-target="#navbarVerticalMenuPagesEcommerceMenu" aria-expanded="false" aria-controls="navbarVerticalMenuPagesEcommerceMenu">
         <i class="bi-basket nav-icon"></i>
         <span class="nav-link-title">Basisinstellingen</span>
         </a>
         <div id="navbarVerticalMenuPagesEcommerceMenu" class="nav-collapse  @if(request()->is('suppliers*') or request()->is('supplier/*') or  request()->is('maintenancy-companie*') or  request()->is('inspection-companie*') or  request()->is('management-companies*') or  request()->is('management-companie*') or   request()->is('inspection-companies*') or  request()->is('maintenancy-companies*') )   @else collapse  @endif  " data-bs-parent="#navbarVerticalMenuPagesMenu" hs-parent-area="#navbarVerticalMenu">
            <a wire:navigate class="nav-link @if(request()->is('suppliers*') or request()->is('supplier/*') )   active  @endif  " href="/suppliers"> <i class="bi-people nav-icon"></i> Leveranciers</a>
            <a wire:navigate class="nav-link @if(request()->is('management-companies/*') or  request()->is('management-companies') or  request()->is('management-companie*')) )  active @endif " href="/management-companies"> <i class="bi-people nav-icon"></i> Beheerders</a>    
            <a wire:navigate class="nav-link @if(request()->is('maintenancy-companies/*') or  request()->is('maintenancy-companies')  or  request()->is('maintenancy-companie*') )  active @endif" href="/maintenancy-companies"> <i class="bi-people nav-icon"></i> Onderhoudspartijen</a>
            <a wire:navigate class="nav-link @if( request()->is('inspection-companie*') or request()->is('inspection-companies/*') or  request()->is('inspection-companies'))  active @endif" href="/inspection-companies"> <i class="bi-people nav-icon"></i> Keuringinstanties</a>  
         </div>
      </div>

      <div class="navbar-vertical-footer">
         <ul class="navbar-vertical-footer-list">
            <li class="navbar-vertical-footer-list-item">
               <div class="dropdown dropup">
                  <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>
                  </button>
                  <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                     <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                     <i class="bi-moon-stars me-2"></i>
                     <span class="text-truncate" title="Auto (system default)">Systeem standaard</span>
                     </a>
                     <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                     <i class="bi-brightness-high me-2"></i>
                     <span class="text-truncate" title="Default (light mode)">Standaard (Lichte modus )</span>
                     </a>
                     <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                     <i class="bi-moon me-2"></i>
                     <span class="text-truncate" title="Dark">Donker</span>
                     </a>
                  </div>
               </div>
            </li>
            <li class="navbar-vertical-footer-list-item">   
                  <a href = "/support">
                  <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="otherLinksDropdown" >
                  <i class="bi-info-circle"></i>
                  </button>
                  </a>
            </li>
         </ul>
         </div>
      </div>
   </div>
</aside>