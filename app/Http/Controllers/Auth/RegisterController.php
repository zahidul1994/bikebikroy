<?php

namespace App\Http\Controllers\Auth;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'fullname' => ['required', 'string', 'max:198'],
            'email' => ['max:198', 'unique:users'],
            'phone' => ['required', 'digits:11', 'unique:users'],
             'password' => ['required', 'string', 'min:8', 'max:40','confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request, FlasherInterface $flasher)
    {
        
        $this->validator($request->all())->validate();
    $info= User::create([
            'fullname' => $request['fullname'],
            'email' => strtolower(trim($request['email'])),
            'phone' => $request['phone'],
            'otp' =>mt_rand(10000, 99999) ,
            'status' =>2,
            'password' => Hash::make($request['password']),
        ]);
        if($info){
            $flasher->addSuccess('Registion Successfully Done, Please Verify With OPT');
        return Redirect::to('otpverify/'.$request->phone);
        
    }
}
}
