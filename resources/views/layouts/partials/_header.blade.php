<header id="header" class="navbar navbar-expand-lg navbar-bordered bg-white  ">
    <div class="container-fluid">
      <nav class="js-mega-menu navbar-nav-wrap hs-menu-initialized hs-menu-horizontal">
        <!-- Logo -->

        <a class="navbar-brand" href="./index.html" aria-label="Front">
          <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="default">
          <img class="navbar-brand-logo" src="/storage/tenant/logo.png" alt="Logo" data-hs-theme-appearance="dark">
        </a>

        <!-- End Logo -->

        <!-- Secondary Content -->
        <div class="navbar-nav-wrap-secondary-content" >
          <!-- Navbar -->
          <ul class="navbar-nav" >
  
            <li class="nav-item">
              <!-- Style Switcher -->
              <div class="dropdown ">
                <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle" id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-dropdown-animation=""><i class="bi-brightness-high"></i></button>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless" aria-labelledby="selectThemeDropdown">
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

            <li class="nav-item">
              <!-- Account -->
              <div class="dropdown">
                <a class="navbar-dropdown-account-wrapper" href="javascript:;" id="accountNavbarDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-auto-close="outside" data-bs-dropdown-animation="">
                  <div class="avatar avatar-sm avatar-circle">
                    <img class="avatar-img" src="./assets/img/160x160/img6.jpg" alt="Image Description">
                    <span class="avatar-status avatar-sm-status avatar-status-success"></span>
                  </div>
                </a>

                <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-account" aria-labelledby="accountNavbarDropdown" style="width: 16rem;">
                  <div class="dropdown-item-text">
                    <div class="d-flex align-items-center">
                      <div class="avatar avatar-sm avatar-circle">
                        <img class="avatar-img" src="/assets/img/160x160/img6.jpg" alt="Image Description">
                      </div>
                      <div class="flex-grow-1 ms-3">
                        <h5 class="mb-0">{{ Auth::user()->name}}</h5>
                        <p class="card-text text-body">{{ Auth::user()->email}}</p>
                      </div>
                    </div>
                  </div>

                  <div class="dropdown-divider"></div>

                  <!-- Dropdown -->
                  <div class="dropdown">
                    <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown1" data-bs-toggle="dropdown" aria-expanded="false">Set status</a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown1">
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
                        <h5 class="mb-0">Htmlstream <span class="badge bg-primary rounded-pill text-uppercase ms-1">PRO</span></h5>
                        <span class="card-text">hs.example.com</span>
                      </div>
                    </div>
                  </a>

                  <div class="dropdown-divider"></div>

                  <!-- Dropdown -->
                  <div class="dropdown">
                    <a class="navbar-dropdown-submenu-item dropdown-item dropdown-toggle" href="javascript:;" id="navSubmenuPagesAccountDropdown2" data-bs-toggle="dropdown" aria-expanded="false">Customization</a>

                    <div class="dropdown-menu dropdown-menu-end navbar-dropdown-menu navbar-dropdown-menu-borderless navbar-dropdown-sub-menu" aria-labelledby="navSubmenuPagesAccountDropdown2">
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
        <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContainerNavDropdown" aria-controls="navbarContainerNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-default">
            <i class="bi-list"></i>
          </span>
          <span class="navbar-toggler-toggled">
            <i class="bi-x"></i>
          </span>
        </button>
        <!-- End Toggler -->

        <!-- Collapse -->
        <div class="navbar-collapse collapse" id="navbarContainerNavDropdown"   >
          <ul class="navbar-nav" >
            <!-- Dashboards -->
            <li class="hs-has-sub-menu nav-item "   >
              <a id="dashboardsMegaMenu" class="hs-mega-menu-invoker nav-link  " href="#" role="button"><i class="bi-house-door dropdown-item-icon"></i> Dashboards</a>
 
              <!-- End Mega Menu -->
            </li>
            <!-- End Dashboards -->

            <!-- Pages -->
            <li class="hs-has-sub-menu nav-item">
              <a id="pagesMegaMenu" class="hs-mega-menu-invoker nav-link " href="#" role="button"><i class="bi-files-alt dropdown-item-icon"></i> Locaties</a>

            
            </li>
            <!-- End Pages -->

             
 
          </ul>

        </div>
        <!-- End Collapse -->
      </nav>
    </div>
  </header>