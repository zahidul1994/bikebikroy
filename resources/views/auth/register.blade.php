@extends('layouts.app')
@section('title', "Register")

<style>
    .login-with-facebook a{
    padding: 5px 10px;
    background: #3b5999;
    color: #fff;
    display: block;
    border-radius: 4px;
}
.login-with-facebook{
    padding: 0 0 20px 0;
}
.login-with-facebook a li{
    font-weight: 700;
}
.login-with-facebook a li i{
    margin-right: 10px;
}

.login-with-google a{
    padding: 5px 10px;
    background: transparant;
    color: #000;
    display: block;
    border-radius: 4px;
    border: 1px solid #ddd;
}
.login-with-google{
    padding: 0 0 20px 0;
}
.login-with-google a li{
    font-weight: 700;
}
.login-with-google a li i{
    margin-right: 10px;
}
</style>
@section('content')
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="user-card shadow-lg">
            <h3 class="user-logo mb-0">
                Bike  Bikroy 
            </h3>
            <div class="login-with-facebook">
                <a href="{{ url('login/facebook') }}">
                     <ul>
                     <li><i class="fab fa-facebook-square"></i> Continue with Facebook</li>
                 </ul>
                </a>
             </div>
                   <div class="login-with-google">
                <a href="{{ url('login/google') }}">
                     <ul>
                     <li><i class="fab fa-google"></i> Continue with Google</li>
                 </ul>
                </a>
             </div>
            @if ($errors->has('status'))
                                                           
            <strong>{{ $errors->first('status') }}</strong>
        
    @endif
<form class="login-form"   method="POST" action='{{ url("userregister") }}' aria-label="{{ __('Register') }}">

@csrf

<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">
        <i class="far fa-user"></i>
    </span>
    <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="fullname"
  value="{{ old('fullname') }}" required autocomplete="fullname" autofocus  placeholder="Your Full Name">
@error('fullname')
<div class="invalid-feedback">
    <small  role="alert">
        {{ $message }}
      </small>
  </div>

@enderror
  
</div>
<div class="input-group mb-3">
    <span class="input-group-text" id="basic-addon1">
       <i class="far fa-phone-square-alt"></i>
    </span>
    <input id="phone" type="tel" class="form-control @error('phone') is-invalid @enderror" name="phone"
  value="{{ old('phone') }}" required autocomplete="phone" autofocus  placeholder="Your Phone Number">
@error('phone')
<div class="invalid-feedback">
    <small  role="alert">
        {{ $message }}
      </small>
  </div>

@enderror
  
</div>
            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">
                    <i class="far fa-envelope"></i>
                </span>
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email"
              value="{{ old('email') }}" autocomplete="email" autofocus  placeholder="Your Email Address">
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
                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                value="{{ old('password') }}" required autocomplete="password" autofocus  placeholder="Password">
              @error('password')
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
                <input id="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" name="password_confirmation"
                value="{{ old('password_confirmation') }}" required autocomplete="password_confirmation" autofocus  placeholder="Confirm Password">
              @error('password_confirmation')
              <div class="invalid-feedback">
                <small  role="alert">
                    {{ $message }}
                  </small>
              </div>
              @enderror
               
            </div>
          
                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox"  id="invalidCheck" required>
                    <label class="form-check-label" for="invalidCheck">
                        Agree to terms and conditions
                    </label>
                    <div class="invalid-feedback">
                        You must agree before submitting.
                    </div>
                </div>
           
            <button class="user-btn mt-2">
                Registration
            </button>
            <div class="row mt-5">
                <div class="col-md-6">
                    <a href="{{url('login')}}">Log Up</a>
                </div>
                <div class="col-md-6">
                    <a href="{{url('/')}}" class="text-danger">Home </a>
                </div>
            </div>







        </div>
    </div>
    <div class="col-md-4"></div>
</div>
@endsection
