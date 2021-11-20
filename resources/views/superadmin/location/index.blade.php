@extends('layouts.superadmin')
@section('title',' Superadmin Dashboard')
@section('page-style')
@endsection
@section('content')



<div class="dashboard-social-card">
    <div class="row">
        <div class="col-md-4">
            <div class="card" style="">
                <div class="social-card-top text-center" style="background: #3b5998;">
                    <i class="fas fa-flag"></i>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center" style="border-right: 1px solid #ddd;">
                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                               {{$country}}
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                country
                            </p>
                        </div>
                        <div class="col-md-6 text-center">

                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                                {{$division}}
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                Division
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="social-card-top text-center" style="background: #00aced;">
                 
                    <i class="fab fa-accessible-icon"></i>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center" style="border-right: 1px solid #ddd;">
                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                                {{$district}}
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                District
                            </p>
                        </div>
                        <div class="col-md-6 text-center">

                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                                {{$thana}}
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                Thana
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card" style="">
                <div class="social-card-top text-center" style="background: #4875b4;">
                    <i class="fab fa-linkedin-in"></i>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 text-center" style="border-right: 1px solid #ddd;">
                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                                500+
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                contacts
                            </p>
                        </div>
                        <div class="col-md-6 text-center">

                            <h3 class="mb-0 fw-bold social-card-couter-lg">
                                292
                            </h3>
                            <p class="mb-0 social-card-couter-text">
                                feeds
                            </p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br/>
<!-- area end-->
<div class="top-control-card">
    <div class="row">
        <div class="col-md-3">
            <div class="card dash-top-card-one mb-3" style="">

                <div class="card-body">
                    <div class="tc-main-cont d-flex">
                        <div class="tc-single">
                            <h2 class="tc-tittle">
                                World 
                            </h2>
                            <p class="tc-text">
                              All  Country  
                            </p>
                        </div>
                        <div class="tc-single text-end">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                    <a href="{{url('superadmin/addcountry')}}" class="tc-more">Create</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dash-top-card-two mb-3" style="">

                <div class="card-body">
                    <div class="tc-main-cont d-flex">
                        <div class="tc-single">
                            <h2 class="tc-tittle">
                               Bangl..
                            </h2>
                            <p class="tc-text">
                              All  Division Info
                            </p>
                        </div>
                        <div class="tc-single text-end">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                    <a href="{{url('superadmin/adddivision')}}" class="tc-more">Create</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dash-top-card-three mb-3" style="">

                <div class="card-body">
                    <div class="tc-main-cont d-flex">
                        <div class="tc-single">
                            <h2 class="tc-tittle">
                               Dhaka 
                            </h2>
                            <p class="tc-text">
                                Division  Area Info 
                            </p>
                        </div>
                        <div class="tc-single text-end">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                    <a href="{{url('superadmin/adddistrict/dhaka')}}" class="tc-more">Create</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card dash-top-card-four mb-3" style="">

                <div class="card-body">
                    <div class="tc-main-cont d-flex">
                        <div class="tc-single">
                            <h2 class="tc-tittle">
                                Barish..
                            </h2>
                            <p class="tc-text">
                               Division Area info
                            </p>
                        </div>
                        <div class="tc-single text-end">
                            <i class="fas fa-shopping-bag"></i>
                        </div>
                    </div>
                    <a href="{{url('superadmin/adddistrict/barishal')}}" class="tc-more">Create</a>
                </div>
            </div>
        </div>
    </div>
    </div>

    <div class="top-control-card">
        <div class="row">
            <div class="col-md-3">
                <div class="card dash-top-card-one mb-3" style="">
    
                    <div class="card-body">
                        <div class="tc-main-cont d-flex">
                            <div class="tc-single">
                                <h2 class="tc-tittle">
                                    Myme..
                                </h2>
                                <p class="tc-text">
                                    Division Area info
                                </p>
                            </div>
                            <div class="tc-single text-end">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <a href="{{url('superadmin/adddistrict/mymensingh')}}" class="tc-more">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dash-top-card-two mb-3" style="">
    
                    <div class="card-body">
                        <div class="tc-main-cont d-flex">
                            <div class="tc-single">
                                <h2 class="tc-tittle">
                                    Chatto..
                                </h2>
                                <p class="tc-text">
                                   Division Area Info
                                </p>
                            </div>
                            <div class="tc-single text-end">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <a href="{{url('superadmin/adddistrict/chattogram')}}" class="tc-more">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dash-top-card-three mb-3" style="">
    
                    <div class="card-body">
                        <div class="tc-main-cont d-flex">
                            <div class="tc-single">
                                <h2 class="tc-tittle">
                                    Khulna 
                                </h2>
                                <p class="tc-text">
                                    Division  Area Info 
                                </p>
                            </div>
                            <div class="tc-single text-end">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <a href="{{url('superadmin/adddistrict/khulna')}}" class="tc-more">Create</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card dash-top-card-four mb-3" style="">
    
                    <div class="card-body">
                        <div class="tc-main-cont d-flex">
                            <div class="tc-single">
                                <h2 class="tc-tittle">
                                    Rajsha..
                                </h2>
                                <p class="tc-text">
                                   Division District
                                </p>
                            </div>
                            <div class="tc-single text-end">
                                <i class="fas fa-shopping-bag"></i>
                            </div>
                        </div>
                        <a href="{{url('superadmin/adddistrict/rajshahi')}}" class="tc-more">Create</a>
                    </div>
                </div>
            </div>
        </div>
        </div>

        <div class="top-control-card">
            <div class="row">
                <div class="col-md-3">
                    <div class="card dash-top-card-one mb-3" style="">
        
                        <div class="card-body">
                            <div class="tc-main-cont d-flex">
                                <div class="tc-single">
                                    <h2 class="tc-tittle">
                                        Rang..
                                    </h2>
                                    <p class="tc-text">
                                        Division Area info
                                    </p>
                                </div>
                                <div class="tc-single text-end">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <a href="{{url('superadmin/adddistrict/rangpur')}}" class="tc-more">Create</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dash-top-card-two mb-3" style="">
        
                        <div class="card-body">
                            <div class="tc-main-cont d-flex">
                                <div class="tc-single">
                                    <h2 class="tc-tittle">
                                        Sylhet
                                    </h2>
                                    <p class="tc-text">
                                       Division Area Info
                                    </p>
                                </div>
                                <div class="tc-single text-end">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <a href="{{url('superadmin/adddistrict/sylhet')}}" class="tc-more">Create</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dash-top-card-three mb-3" style="">
        
                        <div class="card-body">
                            <div class="tc-main-cont d-flex">
                                <div class="tc-single">
                                    <h2 class="tc-tittle">
                                        Upcom ..
                                    </h2>
                                    <p class="tc-text">
                                          Area Info 
                                    </p>
                                </div>
                                <div class="tc-single text-end">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            {{-- <a href="{{url('superadmin/adddistrict/khulna')}}" class="tc-more">Create</a> --}}
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card dash-top-card-four mb-3" style="">
        
                        <div class="card-body">
                            <div class="tc-main-cont d-flex">
                                <div class="tc-single">
                                    <h2 class="tc-tittle">
                                       Drop 
                                    </h2>
                                    <p class="tc-text">
                                      All Loccation data
                                    </p>
                                </div>
                                <div class="tc-single text-end">
                                    <i class="fas fa-shopping-bag"></i>
                                </div>
                            </div>
                            <a href="{{url('superadmin/dropalldata')}}" class="tc-more">Drop Now</a>
                        </div>
                    </div>
                </div>
            </div>
            </div>
    
    
    


    @endsection