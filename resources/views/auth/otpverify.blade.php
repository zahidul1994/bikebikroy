@extends('layouts.app')
@section('title', "Register")

@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="user-card shadow-lg">
            <h3 class="user-logo mb-0">
               Otp Verify
            </h3>
            <h6 >@if ($errors->has('status'))
                   
                <strong class="text-danger text-center">{{ $errors->first('status') }}</strong>
                @endif</h6>
            
<form class="login-form"   method="POST" action='{{ url("userotpverify") }}'>

@csrf

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">
        <i class="far fa-user"></i>
    </span>
    <input id="code" type="number" class="form-control @error('code') is-invalid @enderror" name="code"
  value="{{ old('code') }}" required autocomplete="code" autofocus  placeholder="Otp Code">
@error('code')
<div class="invalid-feedback">
    <small  role="alert">
        {{ $message }}
      </small>
  </div>

@enderror
  
</div>
<input type="hidden" name="phone" value="{{ Request::segment(2) }}">
           
            <button class="user-btn mt-2">
                Verify
            </button>
          
        </div>
    </div>
    <div class="col-md-4"></div>
</div>
@endsection
