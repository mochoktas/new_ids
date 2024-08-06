        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.html"><img src="{{asset('assets/images/logo/logo.png')}}" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">Menu</li>

                        <li class="sidebar-item {{request ()->is('/') ? 'active' :'' }} ">
                            <a href="/" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{request ()->is('map') ? 'active' :'' }}">
                            <a href="/map" class='sidebar-link'>
                                <i class="bi bi-map-fill"></i>
                                <span>Maps</span>
                            </a>
                        </li>

                        <li class="sidebar-item  {{request ()->is('payment') ? 'active' :'' }}">
                            <a href="/payment" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Payment</span>
                            </a>
                        </li>



                        <li class="sidebar-item has-sub {{request ()->is('sse','console') ? 'active' :'' }}">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-stack"></i>
                                <span>Components</span>
                            </a>
                            <ul class="submenu {{request ()->is('sse','console') ? 'active' :'' }}">
                                <li class="submenu-item {{request ()->is('console') ? 'active' :'' }}">
                                    <a href="/console">Console</a>
                                </li>
                                <li class="submenu-item {{request ()->is('sse') ? 'active' :'' }}">
                                    <a href="/sse">View</a>
                                </li>

                            </ul>
                        </li>

                        <li class="sidebar-item  {{request ()->is('weather') ? 'active' :'' }}">
                            <a href="/weather" class='sidebar-link'>
                                <i class="bi bi-cash"></i>
                                <span>Weather</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>