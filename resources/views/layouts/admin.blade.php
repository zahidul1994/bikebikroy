<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{asset('dashboardassets/css/all.min.css')}}" rel="stylesheet">
   <link href="{{asset('dashboardassets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboardassets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboardassets/css/style.css')}}" rel="stylesheet">  
    <style>
    
.breadcrumb-item {
    
    display: inline-block !important;
}
    </style>
    @yield('page-style')
</head>
<body>
    <div class="body-dark-mobile">
        <i class="fas fa-times menu-cross"></i>
    </div>
    <div id="main-dashboard" class="d-flex">
        <div class="sidebar">
            <a href="{{url('admin/dashboard')}}" class="brand-logo">
           
                   {{@Auth::user()->adminname}}
              
            </a>

            <div class="main-dashboard-menu">
                <ul class="dash-main-menu">
                    <li><a href="index.html" class="page-active"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    @can('edit articles')
                    
                 
                    <li>
                        <p class="layout-menu mb-0"><i class="far fa-copy"></i> Team Member
                            <i class="fas fa-angle-right menu-angle-one"></i></p>

                        <ul class="dash-main-menu layout-toggle">
                            <li><a href="{{url('superadmin/adminlist')}}"><i class="far fa-circle"></i> Admin List</a></li>
                            <li><a href="{{url('superadmin/rolelist')}}"><i class="far fa-circle"></i> Role List</a></li>
                            <li><a href="{{url('superadmin/adminlist')}}"><i class="far fa-circle"></i> Permission List</a></li>
                            <li>
                                <p class="sidebar-collapse-menu"><i class="far fa-circle"></i> Sidebar Collapsed</p>
                            </li>

                        </ul>
                    </li>
                    @endcan
                    <li><a href="widgets.html"><i class="fas fa-th"></i> Widgets</a></li>
                    <li><a href="https://www.chartjs.org/" target="_blank"><i class="fas fa-chart-pie"></i> Charts</a></li>
                    <li>
                        <p class="forms-menu mb-0"><i class="fab fa-wpforms"></i> Forms <i class="fas fa-angle-right menu-angle-two"></i></p>
                        <ul class="dash-main-menu forms-toggle">
                            <li><a href="general-elements.html"><i class="far fa-circle"></i> General Elements</a></li>
                            <li><a href=""><i class="far fa-circle"></i> Advanced Elements (P)</a></li>

                        </ul>
                    </li>
                    <li>
                        <p class="table-menu mb-0"><i class="fas fa-table"></i> Tables <i class="fas fa-angle-right menu-angle-three"></i></p>
                        <ul class="dash-main-menu table-toggle">
                            <li><a href="standard-tables.html"><i class="far fa-circle"></i> Standard Tables</a></li>
                            <li><a href="data-tables.html"><i class="far fa-circle"></i> Datatable (Pro)</a></li>

                        </ul>

                    </li>
                   
                    <li>
                        <p class="page-menu mb-0"><i class="far fa-star"></i> Brand And Model <i class="fas fa-angle-right menu-angle-four"></i>


                        </p>

                        <ul class="dash-main-menu page-toggle">

                            <li><a href="{{url('superadmin/bikebrandlist')}}"><i class="far fa-circle"></i>Bike Brand List</a></li>
                            <li><a href="{{url('superadmin/bikemodellist')}}"><i class="far fa-circle"></i> Model List</a></li>
                            <li><a href="sign-up.html"><i class="far fa-circle"></i> Register</a></li>
                           

                        </ul>
                    </li>
                    
                   
                    <li>
                        <p class="component-menu mb-0"><i class="fas fa-tachometer-alt"></i> Setting <i class="fas fa-angle-right menu-angle-six"></i>


                        </p>

                        <ul class="dash-main-menu component-toggle">
                            <li><a href="{{url('superadmin/packagelist')}}"><i class="far fa-circle"></i> Package List</a></li>
                           <li><a href="{{url('superadmin/commandlist')}}"><i class="far fa-circle"></i> Command</a></li>

                        </ul>
                    </li>
                    <li>
                        <p class="component-menu mb-0"><i class="fas fa-tachometer-alt"></i>Location Setting <i class="fas fa-angle-right menu-angle-six"></i>


                        </p>

                        <ul class="dash-main-menu component-toggle">
                            <li><a class="page-active" href="{{url('superadmin/autolocation')}}"><i class="far fa-circle"></i> Auto Add Location</a></li>
                           <li><a href="{{url('superadmin/commandlist')}}"><i class="far fa-circle"></i> Command</a></li>
                           <li><a href="{{url('superadmin/divisionlist')}}"><i class="far fa-circle"></i> Divison List</a></li>
                           <li><a href="{{url('superadmin/districtlist')}}"><i class="far fa-circle"></i> District List</a></li>
                           <li><a href="{{url('superadmin/thanalist')}}"><i class="far fa-circle"></i> Thana</a></li>

                        </ul>
                    </li>
                    
                </ul>
            </div>


        </div>



        <div class="main-content">
            <div class="main-header">
                <div class="row">
                    <div class="col-md-2 main-header-col-icon">
                        <ul class="menu-toggle-icon">
                            <li>
                                <i class="fas fa-bars main-toggle-btn"></i>
                                <i class="fas fa-bars main-toggle-btn-mobile"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6 main-header-col m-auto">
                        <form class="d-flex">
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">

                        </form>
                    </div>
                    <div class="col-md-4 main-header-col">
                        <ul class="profile-area">
                            <li><span class="top-message-icon"><i class="far fa-envelope" data-bs-toggle="dropdown"></i>
                                    <div class="message-box dropdown-menu">

                                        <ul>
                                            <li>You have 7 messages</li>
                                            <li>
                                                <a href="#">
                                                    <span class="prf-img">
                                                        <img src="{{url('assets/image/young-confident-handsome-man-full-260nw-1416442523.webp')}}" class="w-100" alt="">
                                                    </span>
                                                    Profile name</a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="prf-img">
                                                        <img src="{{url('assets/image/young-confident-handsome-man-full-260nw-1416442523.webp')}}" class="w-100" alt="">
                                                    </span>
                                                    Profile name</a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="prf-img">
                                                        <img src="{{url('assets/image/young-confident-handsome-man-full-260nw-1416442523.webp')}}" class="w-100" alt="">
                                                    </span>
                                                    Profile name</a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="prf-img">
                                                        <img src="{{url('assets/image/young-confident-handsome-man-full-260nw-1416442523.webp')}}" class="w-100" alt="">
                                                    </span>
                                                    Profile name</a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <span class="prf-img">
                                                        <img src="{{url('assets/image/young-confident-handsome-man-full-260nw-1416442523.webp')}}" class="w-100" alt="">
                                                    </span>
                                                    Profile name</a>
                                            </li>


                                        </ul>
                                        <p class="mb-0 ntf-view-all">
                                            View all
                                        </p>
                                    </div>

                                </span></li>
                            <li>
                                <span class="top-notification-icon">
                                    <i class="fas fa-bell" data-bs-toggle="dropdown"></i>


                                    <div class="notification-box dropdown-menu">

                                        <ul>
                                            <li>You have <strong></strong>10</strong> notifications</li>
                                            {{-- <li>You have <strong>{{ auth()->user()->unreadNotifications->count() }}</strong> notifications</li> --}}
                                            <li><a href="#"><i class="fas fa-cart-plus text-danger"></i> notifications</a></li>
                                            <li><a href="#"><i class="fas fa-cart-plus text-primary"></i> notifications</a></li>
                                            <li><a href="#"><i class="fas fa-cart-plus text-warning"></i> notifications</a></li>
                                            <li><a href="#"><i class="fas fa-cart-plus text-info"></i> notifications</a></li>
                                            <li><a href="#"><i class="fas fa-cart-plus text-success"></i> notifications</a></li>

                                        </ul>
                                        <p class="mb-0 ntf-view-all">
                                            View all
                                        </p>
                                    </div>




                                </span>

                            </li>
                            <li>

                                <div class="user-profile">
                                    <div class="top-profile-img">
                                        <img class="" src="{{@asset('storage/app/files/shares/profileimage/'.Auth::user()->image)}}" alt="" data-bs-toggle="dropdown">


                                        <div class="profile-box dropdown-menu">
                                            <ul>
                                                <li><a href="profile.html"><i class="far fa-user"></i> Profile</a></li>
                                                <li><a href="#"><i class="far fa-envelope-open"></i> Inbox</a></li>
                                            </ul>
                                            <hr>
                                            <ul>
                                                <li><a href="lock-screen.html"><i class="fas fa-lock"></i> Lock Screen</a></li>
                                               
                                                <li><a href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-key"></i> Logout</a>   </a>
                                                 <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  <input  type="hidden" name="user" value="admin">
                                                     @csrf
                                                 </form>
                                            </ul>
                                        </div>


                                    </div>

                                </div>





                            </li>
                        </ul>
                    </div>
                </div>

            </div>

            <div class="main-dashboard" id="dash-spy">
                <div class="page-location">

                    <nav aria-label="breadcrumb">
                        @if(isset($breadcrumbs))
                        <ol class="breadcrumbs mb-0">
                          @foreach ($breadcrumbs as $breadcrumb)
                          <li class="breadcrumb-item {{ !isset($breadcrumb['link']) ? 'active' :''}}">
                            @if(isset($breadcrumb['link']) && ($breadcrumb['link'] !== 'javascript:void(0)'))
                            <a href="{{url($breadcrumb['link'])}}">@endif{{$breadcrumb['name']}}@if(isset($breadcrumb['link']))</a>
                            @endif
                          </li>
                          @endforeach
                        </ol>
                        @endif
                      
                    </nav>
                </div>
                @yield('content')
              


            <div class="copyright">
                <div class="row">
                    <div class="col-md-12">
                        <p class="copy-right-text">
                            Copyright © 2016-{{date('Y')}} All rights
                            reserved.

                        </p>
                    </div>
                </div>
            </div>

        </div>




    </div>

<!--flash notification-->
@flasher_render  


    <script src="{{asset('dashboardassets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('dashboardassets/js/popper.min.js')}}"></script>
   <script src="{{asset('dashboardassets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('dashboardassets/js/main.js')}}"></script>
  
    
        <script type="text/javascript"> 
    // alert(55);

    
            var url = "{{URL::to('/')}}";
            $.ajaxSetup({
                          headers: {
                              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                          }
                      });
                      $(document).ready(function () {
 
$("#seennotify").click(function(){

 $.ajax({
     type: "post",
     url:url+'/admin/seennotification',

 });

});

$("#notificationsdropdown").click(function(){

$.ajax({
    type: "post",
    url:url+'/admin/deletenotification',
       success: function (d) {
            M.toast({
    html: 'Your Seen Your Notifcation'
});

}

});
});
});       
     
        


         
          </script>
            @yield('page-script')
    </body>
    </html>
    