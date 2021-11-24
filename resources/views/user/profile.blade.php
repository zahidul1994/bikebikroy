@extends('layouts.user')
@section('title','User')
@section('page-style')

<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" rel="stylesheet">


@endsection

@section('content')
<section id="account-menu">
    <div class="container">
        <ul class="ac-menu ps-0 mb-0">
            <li><a href="#">My account</a></li>
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
                                    <b>Settings</b>
                                </p>
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-md-12">
                            <h5>
                                Change details 
                            </h5>
                            <form class="row g-3">
                                @if(!empty(@Auth::user()->email))
                                <div class="col-12">
                                  
                                    <div class="form-check ps-0">
                                        <label for="formFile" class="form-label">Email</label>
                                     <p class="mb-0"><b>{{@Auth::user()->email}}</b></p>
                                    </div>
                                    @else
                                    <div class="form-check ps-0">
                                        <label for="formFile" class="form-label">Add Email</label>
                                        <p class="mb-0"><b><input type="email" id="email" /> <span class="button btn-primary" role="button" id="addEmail">Add</span></b></p>
                                    </div>
                                    
                                </div>
                                @endif
                                <div class="col-12">
                                    <label for="Name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="fullname" placeholder="Auto-fill" value="{{Auth::user()->fullname}}">
                                </div>
                                <div class="col-md-6">
                                    <label for="division_id" class="form-label">Select Division</label>
                                    <select class="form-select" id="division_id" name="division_id">
                                        <option  value="">Select Division *</option>
                                      </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="district_id" class="form-label">Select District</label>
                                    <select class="form-select" id="district_id" name="district_id">
                                        <option  value="">Select District *</option>
                                      </select>
                                    
                                </div>
                                <div class="col-md-6">
                                    <label for="thana_id" class="form-label">Select Thana</label>
                                    <select class="form-select" id="thana_id" name="thana_id">
                                        <option  value="">Select Thana *</option>
                                      </select>
                                    
                                </div>




                                <div class="col-12">
                                    <button type="button" id="Updatedetails" class="btn btn-primary">Update Details</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                          <div class="row">
                        <div class="col-md-12">
                            <h5 class="mt-5">
                                Change password
                            </h5>
                            <form class="row g-3">
                               
                                <div class="col-12">
                                    <label for="password" class="form-label">Current password</label>
                                    <input type="password" class="form-control" id="password" placeholder="Type current password">
                                </div>
                                   <div class="col-12">
                                    <label for="newpassword" class="form-label">New password</label>
                                    <input type="password" class="form-control" id="newponassword" placeholder="Type new password">
                                </div>
                                   <div class="col-12">
                                    <label for="confirm" class="form-label">Confirm new password</label>
                                    <input type="password" class="form-control" id="confirm" placeholder="Type confirm new password">
                                </div>
                                


                                <div class="col-12">
                                    <button type="button" class="btn btn-primary" id="">Change Password</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-12">
                            <div class="logout-btn mt-5">
                                <a class="btn btn-danger" href="{{ route('logout') }}"
                                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                                    <i class="fas fa-key"></i> Log out</a>  
                                                 <form id="logout-form"  action="{{ route('logout') }}" method="POST" style="display: none;">
                                                  <input  type="hidden" name="user" value="user">
                                                     @csrf
                                                 </form>
                               
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
</section>

<section id="quick-link">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p class="category-tittle mb-0">
                    Quick links
                </p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <div class="ql-card">
                    <h3 class="ql-head">
                        63,209 ads in Electronics
                    </h3>
                    <a href="#">Computers</a>|<a href="#">Laptops</a>|<a href="#">TVs</a>|<a href="#">Cameras, Camcorders & Accessories</a>|<a href="#">Desktop Computers</a>|<a href="#">Audio & Sound Systems</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ql-card">
                    <h3 class="ql-head">
                        63,209 ads in Electronics
                    </h3>
                    <a href="#">Computers</a>|<a href="#">Laptops</a>|<a href="#">TVs</a>|<a href="#">Cameras, Camcorders & Accessories</a>|<a href="#">Desktop Computers</a>|<a href="#">Audio & Sound Systems</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ql-card">
                    <h3 class="ql-head">
                        63,209 ads in Electronics
                    </h3>
                    <a href="#">Computers</a>|<a href="#">Laptops</a>|<a href="#">TVs</a>|<a href="#">Cameras, Camcorders & Accessories</a>|<a href="#">Desktop Computers</a>|<a href="#">Audio & Sound Systems</a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="ql-card">
                    <h3 class="ql-head">
                        63,209 ads in Electronics
                    </h3>
                    <a href="#">Computers</a>|<a href="#">Laptops</a>|<a href="#">TVs</a>|<a href="#">Cameras, Camcorders & Accessories</a>|<a href="#">Desktop Computers</a>|<a href="#">Audio & Sound Systems</a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
@section('page-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       
$(document).ready(function () {
     var loggedIn = '{!! (auth()->user()->fullname) !!}';
     console.log(loggedIn);
     var divisionid ='{!! (auth()->user()->division_id) !!}';
    var districtid = '{!! (auth()->user()->district_id) !!}';
    var thanaid = '{!! (auth()->user()->thana_id) !!}';
  
    $.ajax({
        type: "GET",
        url: url + '/location/',
             dataType: "JSON",
        success:function(data) {
           if(data){
         
                   $.each(data.division, function(key, value){
                      // console.log(districtid);
                       if(value._id==divisionid){
                        $('#division_id').append('<option value="'+value._id+'" selected>' + value.division + '</option>');
                       }else{
                        $('#division_id').append('<option value="'+value._id+'">' + value.division + '</option>');
                       }
 
                    });
                    $.each(data.district, function(key, value){
                       // console.log(thanaid)
                        if(value._id==districtid){
                        $('#district_id').append('<option value="'+value._id+'" selected>' + value.district + '</option>');
                       }else{
                        $('#district_id').append('<option value="'+value._id+'">' + value.district + '</option>');
                       }
                       
                    });
                   
                    $.each(data.than, function(key, value){
                       // console.log(thanaid)
                        if(value._id==thanaid){
                        $('#thana_id').append('<option value="'+value._id+'" selected>' + value.thana + '</option>');
                       }else{
                        $('#thana_id').append('<option value="'+value._id+'">' + value.thana + '</option>');
                       }
                       
                    });
                   
                }

            },
    });

    $('#division_id').change(function(){
            $('#district_id').empty();

    var divisionid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/getdistrict/'+divisionid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                      $('#district_id').append('<option value="'+value._id+'">' + value.district + '</option>');

                    });
                }

            },
    });

});

//for thana
        $('#district_id').change(function(){
            $('#thana_id').empty();

    var districtid = $(this).val();

    $.ajax({
        type: "GET",
        url: url + '/getthana/'+districtid,
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#thana_id').append('<option value="'+value._id+'">' + value.thana + '</option>');

                    });
                }

            },
    });
    });
    $('#addEmail').click(function(){
        $.ajax({
    url: url + '/user/updateemail',
    method: "PUT",
    type: "PUT",
    data: {
        email:$('#email').val()
    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
            icon: 'success',
            title: "Email Add Successfully",
                timer: 2000,
                showConfirmButton: false,
                });
           
             location.reload();



        }else {
            console.log(d);
            Swal.fire({
            icon: 'warning',
            title: d.errors[0],
                timer: 2000,
                showConfirmButton: false,
                });
        }
    },
    error: function(d) {
        console.log(d);
    }
});
    })


    $('#Updatedetails').click(function(){
        $.ajax({
    url: url + '/user/updateprofileinfo',
    method: "PATCH",
    type: "PATCH",
    data: {
        fullname:$('#fullname').val(),
        division:$('#division_id').val(),
        district:$('#district_id').val(),
        thana:$('#thana_id').val(),
       
    },
    success: function(d) {
        if (d.success) {
            Swal.fire({
            icon: 'success',
            title: "Info Update Successfully",
                timer: 2000,
                showConfirmButton: false,
                });
           
             location.reload();



        }else {
            console.log(d);
            Swal.fire({
            icon: 'warning',
            title: d.errors[0],
                timer: 2000,
                showConfirmButton: false,
                });
        }
    },
    error: function(d) {
        console.log(d);
    }
});
    })



});


    </script>
@endsection