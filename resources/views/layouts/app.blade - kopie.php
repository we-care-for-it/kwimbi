<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>    {{env('APP_NAME')}} |  {{env('TENANT_NAME')}}</title>
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css" />
  <meta content='width=device-width, initial-scale=1' name='viewport' />
  <link rel="stylesheet" href="/assets/vendor/tom-select/dist/css/tom-select.bootstrap5.css" />
 
  <link rel="preload" href="/assets/css/theme.css" data-hs-appearance="default" as="style">
  <link rel="preload" href="/assets/css/theme-dark.css" data-hs-appearance="dark" as="style">
  <link rel="stylesheet" href="/assets/css/custom.css" />
 

<script src="./node_modules/dropzone/dist/min/dropzone.min.js"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
  <!-- Font -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

  <!-- CSS Implementing Plugins -->
  <link rel="stylesheet" href="/assets/vendor/bootstrap-icons/font/bootstrap-icons.css">


  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  @csrf
  <script>
            window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","assets/js/demo.js"],"build":["assets/css/theme.css","assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js","assets/js/demo.js","assets/css/theme-dark.css","assets/css/docs.css","assets/vendor/icon-set/style.css","assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js","assets/js/demo.js"]},"minifyCSSFiles":["assets/css/theme.css","assets/css/theme-dark.css"],"copyDependencies":{"dist":{"*assets/js/theme-custom.js":""},"build":{"*assets/js/theme-custom.js":"","node_modules/bootstrap-icons/font/*fonts/**":"assets/css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}
           
      </script>

@livewireStyles


</head>

<script>
            window.hs_config = {"autopath":"@@autopath","deleteLine":"hs-builder:delete","deleteLine:build":"hs-builder:build-delete","deleteLine:dist":"hs-builder:dist-delete","previewMode":false,"startPath":"/index.html","vars":{"themeFont":"https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap","version":"?v=1.0"},"layoutBuilder":{"extend":{"switcherSupport":true},"header":{"layoutMode":"default","containerMode":"container-fluid"},"sidebarLayout":"default"},"themeAppearance":{"layoutSkin":"default","sidebarSkin":"default","styles":{"colors":{"primary":"#377dff","transparent":"transparent","white":"#fff","dark":"132144","gray":{"100":"#f9fafc","900":"#1e2022"}},"font":"Inter"}},"languageDirection":{"lang":"en"},"skipFilesFromBundle":{"dist":["assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","assets/js/demo.js"],"build":["assets/css/theme.css","assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js","assets/js/demo.js","assets/css/theme-dark.css","assets/css/docs.css","assets/vendor/icon-set/style.css","assets/js/hs.theme-appearance.js","assets/js/hs.theme-appearance-charts.js","node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js","assets/js/demo.js"]},"minifyCSSFiles":["assets/css/theme.css","assets/css/theme-dark.css"],"copyDependencies":{"dist":{"*assets/js/theme-custom.js":""},"build":{"*assets/js/theme-custom.js":"","node_modules/bootstrap-icons/font/*fonts/**":"assets/css"}},"buildFolder":"","replacePathsToCDN":{},"directoryNames":{"src":"./src","dist":"./dist","build":"./build"},"fileNames":{"dist":{"js":"theme.min.js","css":"theme.min.css"},"build":{"css":"theme.min.css","js":"theme.min.js","vendorCSS":"vendor.min.css","vendorJS":"vendor.min.js"}},"fileTypes":"jpg|png|svg|mp4|webm|ogv|json"}
            window.hs_config.gulpRGBA = (p1) => {
  const options = p1.split(',')
  const hex = options[0].toString()
  const transparent = options[1].toString()

  var c;
  if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(hex)){
    c= hex.substring(1).split('');
    if(c.length== 3){
      c= [c[0], c[0], c[1], c[1], c[2], c[2]];
    }
    c= '0x'+c.join('');
    return 'rgba('+[(c>>16)&255, (c>>8)&255, c&255].join(',')+',' + transparent + ')';
  }
  throw new Error('Bad Hex');
}
            window.hs_config.gulpDarken = (p1) => {
  const options = p1.split(',')

  let col = options[0].toString()
  let amt = -parseInt(options[1])
  var usePound = false

  if (col[0] == "#") {
    col = col.slice(1)
    usePound = true
  }
  var num = parseInt(col, 16)
  var r = (num >> 16) + amt
  if (r > 255) {
    r = 255
  } else if (r < 0) {
    r = 0
  }
  var b = ((num >> 8) & 0x00FF) + amt
  if (b > 255) {
    b = 255
  } else if (b < 0) {
    b = 0
  }
  var g = (num & 0x0000FF) + amt
  if (g > 255) {
    g = 255
  } else if (g < 0) {
    g = 0
  }
  return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
}
            window.hs_config.gulpLighten = (p1) => {
  const options = p1.split(',')

  let col = options[0].toString()
  let amt = parseInt(options[1])
  var usePound = false

  if (col[0] == "#") {
    col = col.slice(1)
    usePound = true
  }
  var num = parseInt(col, 16)
  var r = (num >> 16) + amt
  if (r > 255) {
    r = 255
  } else if (r < 0) {
    r = 0
  }
  var b = ((num >> 8) & 0x00FF) + amt
  if (b > 255) {
    b = 255
  } else if (b < 0) {
    b = 0
  }
  var g = (num & 0x0000FF) + amt
  if (g > 255) {
    g = 255
  } else if (g < 0) {
    g = 0
  }
  return (usePound ? "#" : "") + (g | (b << 8) | (r << 16)).toString(16)
}
            </script>
<body class="has-navbar-vertical-aside navbar-vertical-aside-show-xl">

  <script src="/assets/js/hs.theme-appearance.js"></script>
 
  <!-- ========== HEADER ========== -->
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

  <!-- ========== END HEADER ========== -->

  <!-- ========== MAIN CONTENT ========== -->
  <main id="content" role="main" class="main">
    <!-- Navbar Vertical -->
    <aside class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
      <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
          <!-- Logo -->

   
          <!-- End Logo -->
 
          <!-- End Navbar Vertical Toggle -->
        <!-- Navbar Vertical Toggle -->
        <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
          <i class="bi-arrow-bar-left navbar-toggler-short-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
          <i class="bi-arrow-bar-right navbar-toggler-full-align" data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>' data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
        </button>

        <!-- End Navbar Vertical Toggle -->
          <!-- Content -->
          <div class="navbar-vertical-content">
            <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
              <!-- Collapse -->
              
              <!-- End Collapse -->

<center>
              <img class="navbar-brand-logo"   src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo" src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
            <img class="navbar-brand-logo-mini"      src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="default">
            <img class="navbar-brand-logo-mini" src="{{asset('assets/img/lvalogo.webp')}}" alt="Logo" data-hs-theme-appearance="dark">
                  </center>



              <span class="dropdown-header mt-4">Hoofdmenu</span>
              <small class="bi-three-dots nav-subtitle-replacer"></small>

              <!-- Collapse -->
            

              <div class="nav-item ">
                <a class="nav-link {{  Request::path() ==   'dashboard' ? 'active' : '' }} " href="/dashboard" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Overzicht</span>
                  </a>
 
                </div>  

         
 

                <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/elevators' ? 'active' : '' }} " href="/company/elevators" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Liften</span>
                  </a>
 
                </div>

                <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/elevators/archive' ? 'active' : '' }} " href="/company/elevators/archive" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Gearchiveerde Liften</span>
                  </a>
 
                </div>

                




                


          

                <div class="nav-item ">
                <a class="nav-link {{  Request::path() ==   'company/incidents' ? 'active' : ''  }} " href="/company/incidents" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Storingen</span>
                  </a>
 
                </div>   






                <!-- End Collapse -->
                <span class="dropdown-header mt-4">Basisgegevens</span>
                <!-- Collapse -->
         
                    <div class="nav-item ">
                    <a wire:navigate class="nav-link {{  Request::path() ==   'company/inspection.companies' ? 'active' : '' }} " href="/company/inspection.companies"> <i class="bi-people nav-icon"></i> Keuringinstanties</a>
                    </div>
                    
                    <div class="nav-item ">
                      <a wire:navigate class="nav-link {{  Request::path() ==   'company/management.companies' ? 'active' : '' }} " href="/company/management.companies"> <i class="bi-people nav-icon"></i> Beheerders</a>
                      </div>
                   
                      <div class="nav-item ">
                        
                      <a wire:navigate class="nav-link {{  Request::path() ==   'company/maintenance.companies' ? 'active' : '' }} " href="/company/maintenance.companies"> <i class="bi-people nav-icon"></i> Onderhoudspartijen</a>
               
 

               
          </div>


          <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/customers' ? 'active' : '' }} " href="/company/customers" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Eigenaren</span>
                  </a>
 
                </div>


          <div class="nav-item ">
                        
                        <a wire:navigate class="nav-link {{  Request::path() ==   'company/suppliers' ? 'active' : '' }} " href="/company/suppliers"> <i class="bi-people nav-icon"></i> Leveranciers</a>
                 
   
  
                 
            </div>

            <div class="nav-item ">
                <a class="nav-link {{  Request::path() ==   'company/contacts' ? 'active' : '' }} " href="/company/contacts" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Contactpersonen</span>
                  </a>
 
                </div>  


            <div class="nav-item ">
                        
                        <a wire:navigate class="nav-link {{  Request::path() ==   'company/addresses' ? 'active' : '' }} " href="/company/addresses"> <i class="bi-people nav-icon"></i> Adressen </a>
                 
   
  
                 
            </div>










            <span class="dropdown-header mt-4">Nog te maken</span>

            <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/tickets' ? 'active' : '' }} " href="/company/contact" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Tickets</span>
                  </a>
 
                </div>
                <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/inspections' ? 'active' : '' }} " href="/company/inspections" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Keuringen</span>
                  </a>
 
                </div>

                <div class="nav-item ">
                  <a class="nav-link {{  Request::path() ==   'company/projects' ? 'active' : '' }} " href="/company/projects" >
                    <i class="bi-people nav-icon"></i>
                    <span class="nav-link-title">Projecten</span>
                  </a>
 
                </div>

          <!-- End Content -->

          <!-- Footer -->
          <div class="navbar-vertical-footer">
            <ul class="navbar-vertical-footer-list">
              <li class="navbar-vertical-footer-list-item">
                <!-- Style Switcher -->
                <div class="dropdown dropup">
                  <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation>

                  </button>

                  <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
                    <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                      <i class="bi-moon-stars me-2"></i>
                      <span class="text-truncate" title="Auto (system default)">Auto (system default)</span>
                    </a>
                    <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                      <i class="bi-brightness-high me-2"></i>
                      <span class="text-truncate" title="Default (light mode)">Default (light mode)</span>
                    </a>
                    <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                      <i class="bi-moon me-2"></i>
                      <span class="text-truncate" title="Dark">Dark</span>
                    </a>
                  </div>
                </div>

                <!-- End Style Switcher -->
              </li>

           
            </ul>
          </div>
          <!-- End Footer -->
        </div>
      </div>
    </aside>

    <!-- End Navbar Vertical -->

    <!-- Content -->
    <div class="content">
 
       {{$slot}}
 
      <!-- End Row -->
    </div>
    <!-- End Content -->

    
  </main>
  <!-- ========== END MAIN CONTENT ========== -->
 

 
 @livewireScripts
 <!-- JS Global Compulsory  -->
 <script src="/assets/vendor/jquery/dist/jquery.min.js"></script>
  <script src="/assets/vendor/jquery-migrate/dist/jquery-migrate.min.js"></script>
  <script src="/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
  <script src="/assets/vendor/tom-select/dist/js/tom-select.complete.min.js"></script>
  <!-- JS Implementing Plugins -->
  <script src="/assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside.min.js"></script>
  <script src="/assets/vendor/hs-form-search/dist/hs-form-search.min.js"></script>
  <script src="/assets/js/hs.tom-select.js"></script>
  <!-- JS Front -->
  <script src="/assets/js/theme.min.js"></script>

  <!-- JS Plugins Init. -->
  <script>
    (function() {
      // INITIALIZATION OF NAVBAR VERTICAL ASIDE
      // =======================================================
      new HSSideNav('.js-navbar-vertical-aside').init()


      // INITIALIZATION OF BOOTSTRAP DROPDOWN
      // =======================================================
      HSBsDropdown.init()
 
      HSCore.components.HSTomSelect.init(".js-select");
      // INITIALIZATION OF FORM SEARCH
      // =======================================================
      new HSFormSearch('.js-form-search')
    })()
  </script>

  <!-- Style Switcher JS -->

  <script>
      (function () {
        // STYLE SWITCHER
        // =======================================================
        const $dropdownBtn = document.getElementById('selectThemeDropdown') // Dropdowon trigger
        const $variants = document.querySelectorAll(`[aria-labelledby="selectThemeDropdown"] [data-icon]`) // All items of the dropdown

        // Function to set active style in the dorpdown menu and set icon for dropdown trigger
        const setActiveStyle = function () {
          $variants.forEach($item => {
            if ($item.getAttribute('data-value') === HSThemeAppearance.getOriginalAppearance()) {
              $dropdownBtn.innerHTML = `<i class="${$item.getAttribute('data-icon')}" />`
              return $item.classList.add('active')
            }

            $item.classList.remove('active')
          })
        }

        // Add a click event to all items of the dropdown to set the style
        $variants.forEach(function ($item) {
          $item.addEventListener('click', function () {
            HSThemeAppearance.setAppearance($item.getAttribute('data-value'))
          })
        })

        // Call the setActiveStyle on load page
        setActiveStyle()

        // Add event listener on change style to call the setActiveStyle function
        window.addEventListener('on-hs-appearance-change', function () {
          setActiveStyle()
        })
      })()
    </script>

  <!-- End Style Switcher JS -->
</body>

</html>   