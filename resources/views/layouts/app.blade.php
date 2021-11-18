<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
  
    <link href="{{asset('dashboardassets/css/all.min.css')}}" rel="stylesheet">
   <link href="{{asset('dashboardassets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('dashboardassets/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('dashboardassets/css/style.css')}}" rel="stylesheet">  
</head>
<body style="background: #ddd;">
    

    <div class="main-user">
<div class="container">
      @yield('content')
</div>
      



    </div>


    <script src="{{asset('dashboardassets/js/jquery-3.6.0.min.js')}}"></script>
    <script src="{{asset('dashboardassets/js/popper.min.js')}}"></script>
   <script src="{{asset('dashboardassets/js/bootstrap.min.js')}}"></script>
      <script src="{{asset('dashboardassets/js/main.js')}}"></script>

</html>
