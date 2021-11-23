@extends('layouts.frontend')

@section('page-style')
@endsection
@section('content')
<section id="account-menu">
    <div class="container">
        <ul class="ac-menu ps-0 mb-0">
            <li><a href="{{url('user/profile')}}">My account</a></li>
            <li><a href="#">My membership</a></li>
            <li><a href="#">Favorites</a></li>
            <li><a href="#" style="color: #000;"><b>Settings</b></a></li>
        </ul>
    </div>
</section>

<section id="account-content">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="ac-box">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ac-user-name">
                                <p>
                                    <b><a href="{{url('user/bikesale/create')}}">Post For Bike Sale</a></b>
                                </p>
                            </div>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="ac-user-name">
                                <p>
                                    <b><a href="{{url('user/addsale')}}">Post For Bike Buy</a></b>
                                </p>
                            </div>

                        </div>
                    </div>

                    
                   
                </div>
            </div>
        </div>


    </div>
</section>



@endsection