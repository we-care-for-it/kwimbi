<aside class="sidebar-wrapper">

    <div class="sidebar sidebar-collapse" id="sidebar">

        <div class="sidebar__menu-group">

            <ul class="sidebar_nav">
                <center><img style="max-height: 80px" src="/storage/tenant/logo.png" alt="img"></center>

                <br><br>
                <li class="menu-title">
                    <span>Hoofdmenu</span>
                </li>

                <li>
                    <a href="/locations"
                        class=" @if(request()->is('dashboard/*') or  request()->is('dashboard'))  active @endif">
                        <span data-feather="home" class="nav-icon"></span>
                        <span class="menu-text">Overzicht</span>

                    </a>
                </li>

                <li>
                    <a href="/locations"
                        class=" @if(request()->is('location/*') or  request()->is('locations'))  active @endif">
                        <span data-feather="home" class="nav-icon"></span>
                        <span class="menu-text">Locaties</span>

                    </a>
                </li>

                <li>
                    <a href="/locations"
                        class=" @if(request()->is('elevators/*') or  request()->is('elevators'))  active @endif">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Objecten</span>

                    </a>
                </li>

                <li>
                    <a href="/locations"
                        class=" @if(request()->is('incidents/*') or  request()->is('incidents'))  active @endif">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Incidenten</span>

                    </a>
                </li>
                <li>
                    <a href="/locations"
                        class=" @if(request()->is('contacts/*') or  request()->is('contact'))  active @endif">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Contactpersonen</span>

                    </a>
                </li>

                <li>
                    <a href="/locations"
                        class=" @if(request()->is('customer/*') or  request()->is('customer'))  active @endif">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Relaties</span>

                    </a>
                </li>
                <li>
                    <a href="/locations"
                        class=" @if(request()->is('project/*') or  request()->is('project'))  active @endif">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Projecten</span>

                    </a>
                </li>

                <li>
                    <a href="changelog.html" class="">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Changelog</span>
                        <span class="badge badge-primary menuItem">2.1.6</span>
                    </a>
                </li>

                <li>
                    <a href="/masterdata" class="">
                        <span data-feather="activity" class="nav-icon"></span>
                        <span class="menu-text">Instellingen</span>
                      
                    </a>
                </li>

            </ul>
        </div>
    </div>
</aside>