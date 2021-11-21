@extends('layouts.frontend')

@section('page-style')
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
                                <div class="col-12">
                                    <div class="form-check ps-0">
                                        <label for="formFile" class="form-label">Email</label>
                                        <p class="mb-0"><b>tomal@gmail.com</b></p>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="edition" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="edition" placeholder="Auto-fill">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Select Division</label>
                                    <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="inputState" class="form-label">Select District</label>
                                    <select id="inputState" class="form-select">
                                        <option selected>Choose...</option>
                                        <option>...</option>
                                    </select>
                                </div>




                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Update Details</button>
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
                                    <label for="edition" class="form-label">Current password</label>
                                    <input type="password" class="form-control" id="edition" placeholder="Type current password">
                                </div>
                                   <div class="col-12">
                                    <label for="edition" class="form-label">New password</label>
                                    <input type="password" class="form-control" id="edition" placeholder="Type new password">
                                </div>
                                   <div class="col-12">
                                    <label for="edition" class="form-label">Confirm new password</label>
                                    <input type="password" class="form-control" id="edition" placeholder="Type confirm new password">
                                </div>
                                


                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Change Password</button>
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