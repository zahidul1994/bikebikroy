@extends('layouts.app')


@section('content')
<body style="background: #ddd;">
    

    <div class="main-user">
<div class="container">
      <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="user-card shadow-lg">
                    <h3 class="user-logo mb-0">
                        admin<span>devoid</span>
                    </h3>
                    <p class="mb-0 user-form-name">
                        User Login
                    </p>

                            <div class="login-with-facebook">
                      <a href="#">
                           <ul>
                           <li><i class="fab fa-facebook-square"></i> Continue with Facebook</li>
                       </ul>
                      </a>
                   </div>
                         <div class="login-with-google">
                      <a href="#">
                           <ul>
                           <li><i class="fab fa-google"></i> Continue with Google</li>
                       </ul>
                      </a>
                   </div>
                   
                  
                    
                    <form class="row g-3 needs-validation" novalidate>

 
  <div class="col-md-12">
  
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend"> <i class="far fa-user"></i></span>
      <input type="text" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a username.
      </div>
    </div>
  </div>
  
    <div class="col-md-12 mb-3">
  
    <div class="input-group has-validation">
      <span class="input-group-text" id="inputGroupPrepend"><i class="fas fa-key"></i></span>
      <input type="password" class="form-control" id="validationCustomUsername" aria-describedby="inputGroupPrepend" required>
      <div class="invalid-feedback">
        Please choose a password.
      </div>
    </div>
  </div>
 
</form>
                    
                    
                    
                    
                    <input type="checkbox"> Remember Me  <br>
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
</div>
      



    </div>




<div class="form-group">
    <label for="name" class="col-md-4 control-label">Login With</label>
    <div class="col-md-6">
        <a href="{{ url('login/facebook') }}" class="btn btn-social-icon btn-facebook"><i class="fa fa-facebook"></i>Facebook</a>
        <a href="{{ url('login/twitter') }}" class="btn btn-social-icon btn-twitter"><i class="fa fa-twitter"></i></a>
        <a href="{{ url('login/google') }}" class="btn btn-social-icon btn-google-plus"><i class="fa fa-google-plus">Google</i></a>
        <a href="{{ url('login/linkedin') }}" class="btn btn-social-icon btn-linkedin"><i class="fa fa-linkedin"></i></a>
        <a href="{{ url('login/github') }}" class="btn btn-social-icon btn-github"><i class="fa fa-github"></i></a>
        <a href="{{ url('login/bitbucket') }}" class="btn btn-social-icon btn-bitbucket"><i class="fa fa-bitbucket"></i></a>
    </div>
</div>
@endsection
