@extends('layouts.superadmin')
@section('title','Admin List')
@section('page-style')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

@endsection
@section('content')
<div class="cards">
    <div class="row">
     
        <div class="col-md-12">
            <div class="progress-main-box pb-3">
                <p class="progress-head mb-0">
                    <h1 class="text-center my-1">Create New Admin</h1>
                    <h5> @include('errors.formerror')</h5>
                </p>
                {!! Form::open(['url' => 'superadmin/createadmin',  'files'=>true]) !!}
                
                    <div class="mb-3">
                        {!! Form::label('adminname', 'Admin Name *') !!}
                        {!! Form::text('adminname',null,   array('id'=>'adminname','required','class'=>'form-control','placeholder'=>'Enter Admin Name')) !!}
                       </div>
                    <div class="mb-3">
                        {!! Form::label('phone', 'Phone  *') !!}
                        {!! Form::tel('phone',null,   array('id'=>'phone','required','class'=>'form-control','placeholder'=>'Enter A Phone Number')) !!}
                    </div>
                    <div class="mb-3">
                        {!! Form::label('email', 'Email  *') !!}
                        {!! Form::email('email',null,   array('id'=>'email','required','class'=>'form-control','placeholder'=>'Enter A Email Address')) !!}
                    </div>
                    <div class="mb-3">
                        {!! Form::label('password', 'Password  *') !!}
                        {!! Form::password('password',   ['id'=>'password','required','class'=>'form-control','placeholder'=>'Enter A Password']) !!}
                    </div>
                    <div class="mb-3 col-auto">
                        {!! Form::label('confirm', 'Password  *') !!}
                        {!! Form::password('confirm',   array('id'=>'confirm','required','class'=>'form-control','placeholder'=>'Re-Enter Same Password')) !!}
                    </div>
                  
                    <div class="mb-3">
                        {!! Form::label('roles', 'Role  *') !!}
                        {!! Form::select('roles[]', $roles, null, array('required','id'=>'roles', 'class'=>' form-control js-example-basic-single','multiple'=>true))!!}  
                    </div> 
                    <div class="mb-3">
                       {!! Form::label('admintype', 'Admin Type *') !!}
             {!!Form ::select('admintype',['salesmanager'=>'Sales Manager','qcmanager'=>'QC Manager','productmanager'=>',Product Manager','productaproved'=>'Product Aproved','moderationpanel'=>'Moderation Panel'], 'salesmanager', array('required','id'=>'admintype', 'class'=>'form-control'))!!}  
                    </div>
                    <div class="mb-3">
                        {!! Form::label('status', 'Account Type *') !!}
              {!!Form ::select('status',['0'=>'In-Active','1'=>'Active'], 1, array('required','id'=>'roles', 'class'=>'form-control'))!!}  
                     </div>
                     <div class="col-3">
                        <div class="form-group">
                            <input type="file" name="photo" required  id="image">
                             
                        </div>
                        <img id="preview" src="https://www.riobeauty.co.uk/images/product_image_not_found.gif"
                        alt="preview image" style="max-height: 250px;">
                    </div>
                     <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

        

@endsection

@section('page-script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
      $('.js-example-basic-single').select2();
    $(document).ready(function() {
        $('#image').change(function(){
            
            let reader = new FileReader();
         
            reader.onload = (e) => { 
         
              $('#preview').attr('src', e.target.result); 
            }
         
            reader.readAsDataURL(this.files[0]); 
            
           
           });
    
    });
</script>
@endsection