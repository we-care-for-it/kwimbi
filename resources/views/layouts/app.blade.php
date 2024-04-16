<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="utf-8" />
   <title> {{env('APP_NAME')}} | Liftindex</title>
   @include('layouts.partials._styles')
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   @csrf
   <script>
      window.hs_config = {
         "autopath": "@@autopath",
         "deleteLine": "hs-builder:delete",
         "deleteLine:build": "hs-builder:build-delete",
         "deleteLine:dist": "hs-builder:dist-delete",
         "previewMode": false,
         "startPath": "/index.html",
         "vars": {
            "themeFont": "https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap",
            "version": "?v=1.0"
         },
         "layoutBuilder": {
            "extend": {
               "switcherSupport": true
            },
            "header": {
               "layoutMode": "default",
               "containerMode": "container-fluid"
            },
            "sidebarLayout": "default"
         },
         "themeAppearance": {
            "layoutSkin": "default",
            "sidebarSkin": "default",
            "styles": {
               "colors": {
                  "primary": "#377dff",
                  "transparent": "transparent",
                  "white": "#fff",
                  "dark": "132144",
                  "gray": {
                     "100": "#f9fafc",
                     "900": "#1e2022"
                  }
               },
               "font": "Inter"
            }
         },
         "languageDirection": {
            "lang": "en"
         },
         "skipFilesFromBundle": {
            "dist": ["assets/js/hs.theme-appearance.js", "assets/js/hs.theme-appearance-charts.js",
               "assets/js/demo.js"
            ],
            "build": ["assets/css/theme.css",
               "assets/vendor/hs-navbar-vertical-aside/dist/hs-navbar-vertical-aside-mini-cache.js",
               "assets/js/demo.js", "assets/css/theme-dark.css", "assets/css/docs.css",
               "assets/vendor/icon-set/style.css", "assets/js/hs.theme-appearance.js",
               "assets/js/hs.theme-appearance-charts.js",
               "node_modules/chartjs-plugin-datalabels/dist/chartjs-plugin-datalabels.min.js", "assets/js/demo.js"
            ]
         },
         "minifyCSSFiles": ["assets/css/theme.css", "assets/css/theme-dark.css"],
         "copyDependencies": {
            "dist": {
               "*assets/js/theme-custom.js": ""
            },
            "build": {
               "*assets/js/theme-custom.js": "",
               "node_modules/bootstrap-icons/font/*fonts/**": "assets/css"
            }
         },
         "buildFolder": "",
         "replacePathsToCDN": {},
         "directoryNames": {
            "src": "./src",
            "dist": "./dist",
            "build": "./build"
         },
         "fileNames": {
            "dist": {
               "js": "theme.min.js",
               "css": "theme.min.css"
            },
            "build": {
               "css": "theme.min.css",
               "js": "theme.min.js",
               "vendorCSS": "vendor.min.css",
               "vendorJS": "vendor.min.js"
            }
         },
         "fileTypes": "jpg|png|svg|mp4|webm|ogv|json"
      }
   </script>

</head>

<body>

   <script src="/assets/js/hs.theme-appearance.js"></script>

   <!-- ========== HEADER ========== -->
   <header id="header" style="background-color: #EFEFEF" class="navbar navbar-expand-lg bg-white   ">
      <div class="container">
         <nav class="js-mega-menu navbar-nav-wrap">
            <!-- Logo -->
            <a class="navbar-brand" href="./index.html" aria-label="Logo">
               <img class="navbar-brand-logo" src="/storage/tenant/logo.png" data-hs-theme-appearance="default">
               <img class="navbar-brand-logo" src="/storage/tenant/logo.png" data-hs-theme-appearance="dark">
            </a>

            <!-- End Logo -->

            <!-- Secondary Content -->
            <div class="navbar-nav-wrap-secondary-content">
               <!-- Navbar -->
               <ul class="navbar-nav">

                  <li class="nav-item">

                     <!-- Style Switcher -->
                     <div class="dropdown ">
                        <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                           id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                           data-bs-dropdown-animation>

                        </button>

                        <div
                           class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless"
                           aria-labelledby="selectThemeDropdown">
                           <a class="dropdown-item" href="#" data-icon="bi-moon-stars" data-value="auto">
                              <i class="bi-moon-stars me-2"></i>
                              <span class="text-truncate" title="Auto (system default)">Systeem standaard</span>
                           </a>
                           <a class="dropdown-item" href="#" data-icon="bi-brightness-high" data-value="default">
                              <i class="bi-brightness-high me-2"></i>
                              <span class="text-truncate" title="Default (light mode)">Standaard (licht)</span>
                           </a>
                           <a class="dropdown-item active" href="#" data-icon="bi-moon" data-value="dark">
                              <i class="bi-moon me-2"></i>
                              <span class="text-truncate" title="Dark">Donker</span>
                           </a>
                        </div>
                     </div>

                     <!-- End Style Switcher -->
                  </li>

                  <li class="nav-item">

                     <button type="button" onclick="history.back()" class="btn btn-soft-secondary    btn-icon    ">
                        <i class="fa-solid fa-arrow-left"></i>
                     </button>
                  </li>

                  <!-- Account -->
                  <div class="dropdown">
                     <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown"
                        data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside"
                        data-bs-dropdown-animation>
                        <div class="avatar avatar-sm avatar-circle">
                           <img class="avatar-img" src="/assets/img/160x160/img6.jpg" alt="Image Description">
                           <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                        </div>
                     </a>

                     <div
                        class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account"
                        aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                        <div class="dropdown-item-text">
                           <div class="d-flex align-items-center">
                              <div class="avatar avatar-sm avatar-circle">
                                 <img class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">
                              </div>
                              <div class="flex-grow-1 ms-3">
                                 <h5 class="mb-0">Mark Williams</h5>
                                 <p class="card-text text-body">mark@site.com</p>
                              </div>
                           </div>
                        </div>

                        <div class="dropdown-divider"></div>

                        <!-- Dropdown -->
                        <div class="dropdown">
                           <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;"
                              id="navSubmenuPagesAccountDropdown1" data-bs-toggle="dropdown" aria-expanded="false">Set
                              status</a>

                           <div
                              class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu"
                              aria-labelledby="navSubmenuPagesAccountDropdown1">
                              <a class="dropdown-item" href="#">
                                 <span class="legend-indicator bg-success me-1"></span> Available
                              </a>
                              <a class="dropdown-item" href="#">
                                 <span class="legend-indicator bg-danger me-1"></span> Busy
                              </a>
                              <a class="dropdown-item" href="#">
                                 <span class="legend-indicator bg-warning me-1"></span> Away
                              </a>
                              <div class="dropdown-divider"></div>
                              <a class="dropdown-item" href="#"> Reset status
                              </a>
                           </div>
                        </div>
                        <!-- End Dropdown -->

                        <a class="dropdown-item" href="#">Profile &amp; account</a>
                        <a class="dropdown-item" href="#">Settings</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#">
                           <div class="d-flex align-items-center">
                              <div class="flex-shrink-0">
                                 <div class="avatar avatar-sm avatar-dark avatar-circle">
                                    <span class="avatar-initials">HS</span>
                                 </div>
                              </div>
                              <div class="flex-grow-1 ms-2">
                                 <h5 class="mb-0">Htmlstream <span
                                       class="badge bg-primary rounded-pill text-uppercase ms-1">PRO</span></h5>
                                 <span class="card-text">hs.example.com</span>
                              </div>
                           </div>
                        </a>

                        <div class="dropdown-divider"></div>

                        <!-- Dropdown -->
                        <div class="dropdown">
                           <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;"
                              id="navSubmenuPagesAccountDropdown2" data-bs-toggle="dropdown"
                              aria-expanded="false">Customization</a>

                           <div
                              class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu"
                              aria-labelledby="navSubmenuPagesAccountDropdown2">
                              <a class="dropdown-item" href="#">
                                 Invite people
                              </a>
                              <a class="dropdown-item" href="#">
                                 Analytics
                                 <i class="bi-box-arrow-in-up-right"></i>
                              </a>
                              <a class="dropdown-item" href="#">
                                 Customize Front
                                 <i class="bi-box-arrow-in-up-right"></i>
                              </a>
                           </div>
                        </div>
                        <!-- End Dropdown -->

                        <a class="dropdown-item" href="#">Manage team</a>

                        <div class="dropdown-divider"></div>

                        <a class="dropdown-item" href="#">Sign out</a>
                     </div>
                  </div>
                  <!-- End Account -->
                  </li>
               </ul>
               <!-- End Navbar -->
            </div>
            <!-- End Secondary Content -->

            <!-- Toggler -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
               data-bs-target="#navbarContainerNavDropdown" aria-controls="navbarContainerNavDropdown"
               aria-expanded="false" aria-label="Toggle navigation">
               <span class="navbar-toggler-default">
                  <i class="bi-list"></i>
               </span>
               <span class="navbar-toggler-toggled">
                  <i class="bi-x"></i>
               </span>
            </button>
            <!-- End Toggler -->

            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="navbarContainerNavDropdown">
               <ul class="navbar-nav">
                  <!-- Dashboards -->

                  <li class="nav-item">
                     <a class="nav-link " href="/dashboard" data-placement="left">
                        Overzicht
                     </a>
                  </li>

                  <li class="nav-item">
                     <a class="nav-link " href="/elevators" data-placement="left">
                        Objecten
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="/masterdata" data-placement="left">
                        Basisgegevens
                     </a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link " href="/locations" data-placement="left">
                        Locaties
                     </a>
                  </li>
               </ul>

            </div>
         </nav>

      </div>
   </header>
   <main id="content" role="main" class="main pt-0 ">
      <div style="height: 50px; background-color: #5F63F2;" class="w-100 mt-0 pt-0">
         <div class="container content s  pt-3 mt-0  ">
            <div class=" p-3 pt-0 mt-0 " style="background-color: white; border-radius: 10px;">
               @if( request()->is('settings*') or request()->is('settings/*') or request()->is('masterdata'))
               @else
               <form>
                  <center>

                     <div class="row pt-3">

                        <div class="col-md-2">

                           <select class="form-select">
                              <option value="Alles">Zoek in alles</option>
                              <option value="Alles">Locaties</option>
                              <option value="Alles">Objecten</option>
                           </select>
                        </div>
                        <div class="col-md-10">

                           <div class="input-group input-group-merge w-100">
                              <input wire:model.live="filters.keyword" type="text" wire:model.live="filters.keyword"
                                 class="js-form-search form-control" placeholder="Zoeken op trefwoord..."
                                 data-hs-form-search-options="{
 &quot;clearIcon&quot;: &quot;#clearIcon2&quot;,
 &quot;defaultIcon&quot;: &quot;#defaultClearIconToggleEg&quot;
 }">
                              <button type="button" class="input-group-append input-group-text">
                                 <i id="clearIcon2" class="bi-x-lg" style="display: none;"></i>
                                 <i id="defaultClearIconToggleEg" class="bi-search"
                                    style="display: block; opacity: 1.03666;"></i>
                              </button>
                           </div>

                        </div>

                     </div>
                  </center>@endif
               </form>

               {{$slot}}

            </div>

         </div>
   </main>

   @include('layouts.partials._scripts')
</body>

</html>