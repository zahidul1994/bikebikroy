@extends('layouts.user')
@section('title','Bike Sale Form')
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
                                <select class="form-select" id="district_id" name="district_id" required>
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
                                <select class="form-select" id="bikemodel_id" name="bikemodel_id" required>
                                    <option  value="">Select Model *</option>
                                  </select>
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
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="file" name="imageone" required  id="image1">
                                     
                                </div>
                                <img id="preview1" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                alt="preview image" style="max-height: 250px;">
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="file" name="imagetwo"  id="image2" class="d-none">
                                    
                                </div>
                                <img id="preview2" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                alt="preview image" style="max-height: 250px;">
                            </div>
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="file" name="imagethree"  id="image3" class="d-none">
                                     
                                </div>
                                <img id="preview3" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                alt="preview image" style="max-height: 250px;">
                            </div>
                            
                            <div class="col-3">
                                <div class="form-group">
                                    <input type="file" name="imagefour"  id="image4" class="d-none">
                                     
                                </div>
                                <img id="preview4" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                                alt="preview image" style="max-height: 250px;">
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
                               
                                   
                            <table class="table table-bordered" id="dynamic_field">   

                                <tr>  
            
                                    <td><input type="tel" name="phonenumber[]" value="{{Auth::user()->phone}}" placeholder="phone number *" class="form-control name_list" /></td>  
            
                                    <td><button type="button" name="add" id="add" class="btn btn-success">Add Another Number</button></td>  
            
                                </tr>  
            
                            </table>  
                       
                         
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
              var i=1;  


$('#add').click(function(){  

     i++;  

     $('#dynamic_field').append('<tr id="row'+i+'" class="dynamic-added"><td><input type="number" name="phonenumber[]" placeholder="Enter your New Phone Number" class="form-control name_list" /><span id="error" class="text-danger"></span></td><td><button type="button" required name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button> <input type="number" id="Otp" class="d-none"> <button type="button" class="btn-sm btn-info d-none" id="Otpvefiry">OTP Verify</button></td></tr>');  
     $('#add').addClass('d-none');
});  


$(document).on('click', '.btn_remove', function(){  

     var button_id = $(this).attr("id");   

     $('#row'+button_id+'').remove();  
     $('#add').removeClass('d-none');
});  


$('#image1').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview1').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
            // $('#image1').addClass('d-none');
            $('#image2').removeClass('d-none');
           
           });
           $('#image2').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview2').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
            $('#image3').removeClass('d-none');
           
           });
           $('#image3').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview3').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
           
            $('#image4').removeClass('d-none');
           
           });
           $('#image4').change(function(){
            let reader = new FileReader();
            reader.onload = (e) => { 
              $('#preview4').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
                      
           });
$(document).ready(function () {
    $(document).on('keyup', '.name_list', function(){  
if($(this).val().length<11){
    $('#error').html('Number Must Be 11 Digit'); 
    $('#Otp').addClass('d-none');
    $('#Otpvefiry').addClass('d-none');
    return false;
}
else{
    $('#error').html(null);

       
                number = $(this).val();
                $.ajax({
                    type: "post",
                    url: url + '/user/searchphonenumber',
                    data: {
                        id:number

                    },

                    success: function(data) {
                        $('#error').html('Number Verify'); 
                    }, 
                    error:function(data){
                        $('#error').html('Number Not Verify, Please Check Your Phone To Get Otp'); 
                       $('#Otp').removeClass('d-none');
                       $('#Otpvefiry').removeClass('d-none');
                    }
                    
                });
            }
                });
     var loggedIn = '{!! (auth()->user()->fullname) !!}';
    //  console.log(loggedIn);
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



    $('#bikebrand_id').change(function(){
    $('#bikemodel_id').empty();
    $.ajax({
        type: "GET",
        url: url + '/getbikebrand/'+$(this).val(),
        data:{},
        dataType: "JSON",
        success:function(data) {
           if(data){
                 
                    $.each(data, function(key, value){
                        $('#bikemodel_id').append('<option value="'+value._id+'">' + value.bikemodel + '</option>');

                    });
                }

            },
    });
    });
  

  




});


    </script>
@endsection