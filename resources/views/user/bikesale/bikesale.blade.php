@extends('layouts.frontend')
@section('page-style')
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@10.10.1/dist/sweetalert2.min.css" rel="stylesheet">
@endsection

@section('content')
<section id="product-main">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h3 class="ad-post-head mb-0 pt-5 text-center">
                    Welcome {{Auth::user()->fullname}} Let's post an ad.
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="similar-head pt-5">
                    <div class="row">
                        <div class="col-md-6">
                            <h3 class="mb-0 smlr-head">
                                Fill in the details
                            </h3>

                        </div>
                        <div class="col-md-6">
                            <div class="product-share">
                                <ul class="mb-0 ps-0">
                                    <li><a href="#" class="text-primary">See our posting rules</a></li>

                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="row">
                <h5> @include('errors.formerror')</h5>
                <div class="col-md-12">
                    <div class="ad-form">
                        {!! Form::open(['route' => 'bikesale.store', 'class' => 'row g-3', 'files'=>'true']) !!}
                        <div class="col-md-12">
                            {!! Form::label('title', 'Title/Bike Name *') !!}
                            {!! Form::text('title',null,   array('id'=>'title','required','class'=>'form-control','placeholder'=>'Ex: I Will Sale A Bike')) !!}
                           
                           
                        </div>
                      <div class="col-md-6">
                                <label for="division_id" class="form-label">Select Division *</label>
                                {!!Form::select('division_id',CommonFx::Divisionname(),null, array('id'=>'division_id','required','class'=>'form-control','placeholder'=>'Select Division'))!!}
                            </div>
                            <div class="col-md-6">
                                <label for="district_id" class="form-label">Select District  *</label>
                                <select class="form-select" id="district_id" name="district_id">
                                    <option  value="">Select District *</option>
                                  </select>
                            </div>
                            <div class="col-md-12">
                                <label for="condition" class="form-label">Condition  *</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condition" id="new" value="new">
                                    <label class="form-check-label" for="new">New</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="condition" id="condition" checked value="used">
                                    <label class="form-check-label" for="condition">Used</label>
                                </div>

                            </div>
                            <div class="col-md-12">
                                <label for="inputState" class="form-label">Bike Type  *</label> <br>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="biketype" id="Motorcycle" checked value="Motorcycle">
                                    <label class="form-check-label" for="Motorcycle">Motorcycle</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="biketype" id="Scooters" value="Scooters">
                                    <label class="form-check-label" for="Scooters">Scooters</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="biketype" id="E-bikes" value="E-bikes">
                                    <label class="form-check-label" for="E-bikes">E-bikes</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Select Brand  *</label>
                                  {!!Form::select('bikebrand_id',CommonFx::BikeBrand(),null, array('id'=>'bikebrand_id','required','class'=>'form-control','placeholder'=>'Select Brand'))!!}
                            </div>
                            <div class="col-md-6">
                                <label for="inputState" class="form-label">Select Model  *</label>
                                {!!Form::select('bikemodel_id',CommonFx::BikeModel(),null, array('id'=>'bikemodel_id','required','class'=>'form-control','placeholder'=>'Select Brand'))!!}
                            </div>

                            <div class="col-12">
                                {!! Form::label('edition', 'Edition (optional) *') !!}
                                {!! Form::text('edition',null,   array('id'=>'edition','required','class'=>'form-control','placeholder'=>'Ex: What is the edition of your bike?')) !!}
                               
                            </div>
                            <div class="col-12">
                                {!! Form::label('manufacture', 'Year of Manufacture *') !!}
                                {!! Form::text('manufacture',null,   array('id'=>'manufacture','required','class'=>'form-control','placeholder'=>'Ex: When was your bike manufactured?')) !!}
                               </div>
                            <div class="col-md-6">
                                {!! Form::label('kilometerrun', 'Kilometers run (km) *') !!}
                                {!! Form::number('kilometerrun',null,   array('id'=>'kilometerrun','required','class'=>'form-control','placeholder'=>'Ex: What is the mileage of your bike?')) !!}
                                
                            </div>
                            <div class="col-md-6">
                                {!! Form::label('cc', 'Engine capacity (cc) *') !!}
                                {!! Form::number('cc',null,   array('id'=>'cc','required','class'=>'form-control','placeholder'=>'Ex: What is the engine capacity of your bike?')) !!}
                            </div>
                            <div class="col-md-12">
                                {!! Form::label('description', 'Description  * (Not More Than 500 Word)') !!}
                                {!! Form::textarea('description',null,   array('id'=>'cc','required','class'=>'form-control','placeholder'=>'Ex: What is the engine capacity of your bike?')) !!}
                                 </div>
                            <div class="col-12">

                                {!! Form::label('price', 'Price (Tk) *') !!}
                                {!! Form::number('price',null, array('id'=>'price','required','class'=>'form-control', 'min'=>'1','placeholder'=>'Ex: Pick a good price - what would you pay?')) !!}
                            </div>
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="negotiable" name="negotiable">
                                    <label class="form-check-label" for="negotiable">
                                        Negotiable
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-check ps-0">
                                    <label for="formFile" class="form-label"><b>Add upto 5 photos  *</b> (You must upload at least one photo)</label>
                                    <input class="form-control" type="file" id="formFile" name="photo[]" multiple min="1" max="5"   accept="image/png,image/jpg, image/jpeg">
                                </div>
                            </div>
                                 <div class="col-6">
                                <div class="form-check ps-0">
                                    <label for="formFile" class="form-label">Name  *</label>
                                    <p class="mb-0"><b>{{Auth::user()->fullname}}</b></p>
                                </div>
                            </div>
                                 <div class="col-6">
                                <div class="form-check ps-0">
                                    <label for="formFile" class="form-label">Email  *</label>
                                    <p class="mb-0"><b>{{Auth::user()->email}}</b></p>
                                </div>
                            </div>
                                 <div class="col-12">
                                    {!! Form::label('phonenumber', 'Add phone number *') !!}
                                    {!! Form::number('phonenumber[]',Auth::user()->phone, array('id'=>'price','required','class'=>'form-control', 'min'=>'1','placeholder'=>'Ex: Enter phone number')) !!}
                                
                            </div>

                          
                        
                         
                            <div class="col-12">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="gridCheck" required>
                                    <label class="form-check-label" for="gridCheck">
                                        I have read and accept the Terms and Conditions 
                                    </label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn post-ad-btn">Post ad</button>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>


    </div>
</section>

@endsection
@section('page-script')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
       const input = document.querySelector('#formFile');

// Listen for files selection
input.addEventListener('change', (e) => {
    // Retrieve all files
    const files = input.files;

    // Check files count
    if (files.length > 2) {
        alert(`Only 5 files are allowed to upload.`);
        return;
    }

    // TODO: continue uploading on server
});
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

    $('#bikebrand_id').change(function(){
    $('#bikemodel').empty();
    $.ajax({
        type: "GET",
        url: url + '/getbikebrand/'+$(this).val(),
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                       // alert(key);
                        $('#bikemodel_id').append('<option value="'+value._id+'">' + value.bikemodel + '</option>');

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