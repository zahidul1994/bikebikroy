@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="user-card shadow-lg">
            <h3 class="user-logo mb-0">
                Bike  Bikroy 
            </h3>
            <p class="mb-0 user-form-name">
                User Login
            </p>
            @if ($errors->has('status'))
                                                           
            <strong>{{ $errors->first('status') }}</strong>
        
    @endif
<form class="login-form"   method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">

@csrf
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-user"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              value="{{ old('email') }}" required autocomplete="email" autofocus  placeholder="Email Address">
            @error('email')
            <div class="invalid-feedback">
                <small  role="alert">
                    {{ $message }}
                  </small>
              </div>
            
            @enderror
              
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="fas fa-key"></i>
                </span>
                <input id="email" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                value="{{ old('password') }}" required autocomplete="password" autofocus  placeholder="Password">
              @error('password')
              <div class="invalid-feedback">
                <small  role="alert">
                    {{ $message }}
                  </small>
              </div>
              @enderror
               
            </div>
            <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            Remember Me  <br>
            <button class="user-btn mt-2">
                Login
            </button>
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="#">Sign Up</a>
                </div>
                <div class="col-md-6">
                    <a href="#" class="text-danger">Forgot password? </a>
                </div>
            </div>







        </div>
    </div>
    <div class="col-md-4"></div>
</div>
@endsection
