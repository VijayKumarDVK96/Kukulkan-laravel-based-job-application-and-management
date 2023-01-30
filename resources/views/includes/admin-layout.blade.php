<!DOCTYPE html>
<html lang="en">

<head>
  <title>@yield('title')</title>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <link rel="icon" href="{{url('img/favicon.ico')}}" type="image/x-icon">
  <link href="{{url('admin-assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/bootstrap.min.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/animate.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/icons.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/sidebar-menu.css')}}" rel="stylesheet" />
  <link href="{{url('admin-assets/css/app-style.css')}}" rel="stylesheet" />
  @yield('styles')
</head>

<body onload="checkFirstVisit()">

  <!-- Start wrapper-->
  <div id="wrapper">

    <!--Start sidebar-wrapper-->
    <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true" class="bg-body border-right border-light shadow-none">
        <div class="brand-logo">
            <a href="{{route('dashboard')}}">
                <img src="{{url('img/logo.png')}}" class="logo-icon" alt="Kukulkan">
            </a>
        </div>
        <ul class="sidebar-menu do-nicescrol">
            <li>
                <a href="{{route('dashboard')}}" class="waves-effect">
                    <i class="icon-home"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/staffs')}}" class="waves-effect">
                    <i class="icon-user"></i> <span>Staffs</span>
                </a>
            </li>
            <li>
                <a href="javascript::void()" class="waves-effect">
                    <i class="icon-user-follow"></i> <span>Apply Online Candidates</span> <i class="icon-arrow-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{url('admin/approved-online-reports')}}"><i class="fa fa-circle-o"></i> Approved Candidates</a></li>
                    <li><a href="{{url('admin/pending-online-reports')}}"><i class="fa fa-circle-o"></i> New Candidates</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript::void()" class="waves-effect">
                    <i class="icon-people"></i> <span>Candidates</span> <i class="icon-arrow-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{url('admin/candidates')}}"><i class="fa fa-circle-o"></i> Approved Candidates</a></li>
                    <li><a href="{{url('admin/new-candidates')}}"><i class="fa fa-circle-o"></i> New Candidates</a></li>
                    <li><a href="{{url('admin/add-candidate')}}"><i class="fa fa-circle-o"></i> Add Candidate</a></li>
                </ul>
            </li>
            <li>
                <a href="javascript::void()" class="waves-effect">
                    <i class="icon-briefcase"></i> <span>Employers</span> <i class="icon-arrow-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li><a href="{{url('admin/employers')}}"><i class="fa fa-circle-o"></i> Approved Employers</a></li>
                    <li><a href="{{url('admin/new-employers')}}"><i class="fa fa-circle-o"></i> New Employers</a></li>
                    <li><a href="{{url('admin/add-employer')}}"><i class="fa fa-circle-o"></i> Add Employer</a></li>
                </ul>
            </li>
            <li>
                <a href="{{url('admin/jobs')}}" class="waves-effect">
                    <i class="icon-tag"></i> <span>Jobs</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/seo')}}" class="waves-effect">
                    <i class="icon-chart"></i> <span>SEO</span>
                </a>
            </li>
            <li>
                <a href="{{url('admin/configuration')}}" class="waves-effect">
                    <i class="icon-wrench"></i> <span>Site Configuration</span>
                </a>
            </li>
            @if(Auth::user()->roles[0]->role=="Admin")
            <li>
                <a href="{{url('admin/imported-candidates')}}" class="waves-effect">
                    <i class="icon-user-following"></i> <span>Imported Candidates</span>
                </a>
            </li>
            @endif
            <!-- <li>
                <a href="sms.php" class="waves-effect">
                    <i class="icon-envelope"></i> <span>SMS</span>
                </a>
            </li> -->
        </ul>

    </div>
    <!--End sidebar-wrapper-->

    <!--Start topbar header-->
    <header class="topbar-nav">
        <nav class="navbar navbar-expand fixed-top bg-body border-bottom border-light shadow-none">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link toggle-menu" href="javascript:void();">
                        <i class="icon-menu menu-icon"></i>
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav align-items-center right-nav-link">
                <!-- <li class="nav-item dropdown-lg">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void();">
                        <i class="icon-bell"></i><span class="badge badge-primary badge-up">10</span></a>
                    <div class="dropdown-menu dropdown-menu-right">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                You have 10 Notifications
                                <span class="badge badge-primary">10</span>
                            </li>
                            <li class="list-group-item">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <i class="icon-people fa-2x mr-3 text-info"></i>
                                        <div class="media-body">
                                            <h6 class="mt-0 msg-title">New Registered Users</h6>
                                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <i class="icon-cup fa-2x mr-3 text-warning"></i>
                                        <div class="media-body">
                                            <h6 class="mt-0 msg-title">New Received Orders</h6>
                                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javaScript:void();">
                                    <div class="media">
                                        <i class="icon-bell fa-2x mr-3 text-danger"></i>
                                        <div class="media-body">
                                            <h6 class="mt-0 msg-title">New Updates</h6>
                                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item"><a href="javaScript:void();">See All Notifications</a></li>
                        </ul>
                    </div>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                        <span class="user-profile"><img src="{{url('admin-assets/images/avatar.jpg')}}" class="img-circle" alt="user avatar"></span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-right">
                        <li class="dropdown-item user-details">
                            <a href="{{url('admin/view-profile')}}">
                                <div class="media">
                                    <div class="avatar"><img class="align-self-start mr-3" src="{{url('admin-assets/images/avatar.jpg')}}" alt="user avatar"></div>
                                    <div class="media-body">
                                        {{-- {{\Debugbar::info($auth)}} --}}
                                        <h6 class="user-title">{{ucwords(Auth::user()->name)}}</h6>
                                        <p class="user-subtitle">{{Auth::user()->email}}</p>
                                        <p class="user-subtitle">{{Auth::user()->roles[0]->role}}</p>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <!-- <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li> -->
                        <!-- <li class="dropdown-divider"></li>
                        <li class="dropdown-item"><i class="icon-wallet mr-2"></i> Account</li> -->
                        <!-- <li class="dropdown-divider"></li> -->
                        <!-- <li class="dropdown-item pointer"><i class="icon-settings mr-2"></i> Change Password</li> -->
                        <li class="dropdown-divider"></li>
                        <a href="javascript::void()" onclick="document.getElementById('logout-form').submit();">
                            <li class="dropdown-item"><i class="icon-power mr-2"></i> Logout</li>
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </ul>
                </li>
            </ul>
        </nav>
    </header>
    <!--End topbar header-->

    <div class="clearfix"></div>
    
    @yield('content')

    <!--Start Back To Top Button-->
    <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
    <!--End Back To Top Button-->

    <!--Start footer-->
    <footer class="footer bg-transparent border-light">
        <div class="container">
            <div class="text-center">
                Copyright © 2019 Kukulkan
            </div>
        </div>
    </footer>
    <!--End footer-->
  </div>
  <!--End wrapper-->

  <script src="{{url('admin-assets/js/jquery.min.js')}}"></script>
  <script src="{{url('admin-assets/js/popper.min.js')}}"></script>
  <script src="{{url('admin-assets/js/bootstrap.min.js')}}"></script>
  <script src="{{url('admin-assets/plugins/simplebar/js/simplebar.js')}}"></script>
  <script src="{{url('admin-assets/js/waves.js')}}"></script>
  <script src="{{url('admin-assets/js/sidebar-menu.js')}}"></script>
  <script src="{{url('admin-assets/js/app-script.js')}}"></script>
  @yield('scripts')

</body>

</html>