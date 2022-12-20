========== Left Sidebar Start ========== -->
<div class="left-side-menu">

    <div class="h-100" data-simplebar>

        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{asset('assets/images/users/user-1.jpg')}}" alt="user-img" title="Mat Helme"
                class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-toggle="dropdown">Geneva Kennedy</a>
                <div class="dropdown-menu user-pro-dropdown">

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-user mr-1"></i>
                        <span>My Account</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-settings mr-1"></i>
                        <span>Settings</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-lock mr-1"></i>
                        <span>Lock Screen</span>
                    </a>

                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item notify-item">
                        <i class="fe-log-out mr-1"></i>
                        <span>Logout</span>
                    </a>

                </div>
            </div>
            <p class="text-muted">Admin Head</p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">

                <li class="menu-title">Navigation</li>
                
                <li>
                    <!-- <a href="#sidebarDashboards" data-toggle="collapse">
                        <i data-feather="airplay"></i>
                        <span class="badge badge-success badge-pill float-right">4</span>
                        <span> Admin </span>
                    </a> -->
                    <!-- <div class="collapse" id="sidebarDashboards">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{route('admin.dashboard')}}">Dashboard</a>
                            </li>
                        </ul>
                    </div> -->
                </li>

                <!-- <li class="menu-title mt-2">Apps</li> -->

                <!-- <li>
                    <a href="{{route('admin.dashboard')}}">
                        <i data-feather="home"></i>
                        <span> Dashboard </span>
                    </a>
                </li> -->

                <li>
                    <a href="{{route('country.index')}}">
                        <i data-feather="clipboard"></i>
                        <span> Country </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('language.index')}}">
                        <i data-feather="clipboard"></i>
                        <span> Languages </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('page.index')}}">
                        <i data-feather="clipboard"></i>
                        <span> Pages </span>
                    </a>
                </li>

                <li>
                    <a href="{{route('admin.setting')}}">
                        <i data-feather="clipboard"></i>
                        <span> Settings </span>
                    </a>
                </li>

                
                <li>
                    <a href="{{url('admin/category')}}">
                        <i data-feather="clipboard"></i>
                        <span>Category</span>
                    </a>
                </li>


               <!--  <li>
                    <a href="{{route('services.index')}}">
                        <i data-feather="clipboard"></i>
                        <span>Service Types</span>
                    </a>
                </li> -->
               

                <li style="display:none">
                    <a href="#sidebarContacts" data-toggle="collapse">
                        <i data-feather="cpu"></i>
                        <span> Configuration </span>
                        <span class="menu-arrow"></span>
                    </a>
                    <div class="collapse" id="sidebarContacts">
                        <ul class="nav-second-level">
                            <li>
                                <a href="{{url('admin/category')}}">
<!--                                 <i data-feather="clipboard"></i> -->
                                <span>Category</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{route('services.index')}}">
<!--                                 <i data-feather="clipboard"></i> -->
                                <span>Service Types</span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('symptoms.index')}}">
<!--                                 <i data-feather="clipboard"></i> -->
                                <span>Symptoms</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

                

                

                
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>
<!-- Left Sidebar End