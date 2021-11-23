<?php

namespace App\Http\Controllers\Auth;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Admin;
use App\Models\Superadmin;
use Illuminate\Http\Request;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Laravel\Socialite\Facades\Socialite;
use App\Notifications\Superadminnotification;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/admin/dashboard';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest:customer')->except('logout');
        $this->middleware('guest:superadmin')->except('logout');
        // $this->middleware('guest:user')->except('logout');
    }

    // Login
    public function showLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('/login/admin', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function showLoginuserForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.loginuser', [
            'pageConfigs' => $pageConfigs
        ]);
    }
  public function customloginForm()
    {
       
        return view('auth.frontendlogin');
    }
 public function customregisterForm()
    {
       
        return view('auth.register');
    }


    public function adminverifyemail(Request $request)
    {
        // dd($request->all());
        $check = Admin::where('email', $request->email)->wherestatus($request->code)->first();
        if ($check) {
            $check->update(array('email_verified_at' => Carbon::now(), 'status' => 1));
            return redirect('/login/admin')
                ->withErrors([
                    'status' => 'Your Email Verify Done Please Login'
                ]);

            $data = [
                'superadminboady' => $check['name'] . ' Verify Email Successfully With Code',
            ];


            Superadmin::first()->notify(new Superadminnotification($data));
        } else {
            return redirect()->back()
                ->withErrors([
                    'status' => 'Your Email Verify Code Invaild'
                ]);
        }
    }

    public function userotpverify(Request $request,FlasherInterface $flasher)
    {
       
        $check = User::wherephone($request->phone)->whereotp((int)$request->code)->first();
      //  dd($check);
        if ($check) {
            $check->update(array('email_verified_at' => Carbon::now(), 'status' => 1,'otp'=>null));
            $flasher->addSuccess('Phone Number Verified, Please Login');
            return redirect('/login');
               
           
        } else {
            return redirect()->back()
                ->withErrors([
                    'status' => 'Your Phone Verify Code Invaild'
                ]);
        }
    }
    public function showEmailveirfyForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.adminemailverify', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function showOTPveirfyForm()
    {
     
        return view('auth.otpverify');
    }
    public function logout(Request $request)
    {

        if ($request->user == 'superadmin') {
               $info = Superadmin::find(Auth::guard('superadmin')->user()->_id)->update(array('remember_token' => null));

            if ($info) {
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/superadmin');
            }
        } 
        elseif ($request->user == 'admin') {
            $info = Admin::find(Auth::guard('admin')->user()->id)->update(array('remember_token' => null));

            if ($info) {
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/admin');
            }
        } elseif ($request->user == 'user') {
           
                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('login');
            
        } elseif ($request->user == 'customer') {
            //$info = Customer::find(Auth::id())->update(array('remember_token' => null));

                $this->guard()->logout();

                $request->session()->invalidate();

                return $this->loggedOut($request) ?: redirect('/login/customer');
            }
         else {
            $this->guard()->logout();

            $request->session()->invalidate();

            return $this->loggedOut($request) ?: redirect('/');
        }
    }


    public function showAdminLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('auth.login', ['url' => 'admin', 'pageConfigs' => $pageConfigs]);
    }

    public function adminLogin(Request $request, FlasherInterface $flasher)
    {

        $this->validate($request, [
            'email'   => 'required|email|exists:admins,email',
            'password' => 'required|min:6'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password, 'status' => 1,], $remember)) {
            $data = [
                'superadminboady' => $request->email . ' Just Login',
            ];


            Superadmin::first()->notify(new Superadminnotification($data));
        }
        $flasher->addError('WelCome Administration Panel');
        
        return redirect()->intended('/admin/dashboard');


        if (!Admin::where('email', $request->email)->first()) {
            return redirect()->back()
                ->withErrors([
                    'email' => Lang::get('auth.email'),
                ]);
        }
        if (!Admin::where('email', $request->email)->where('status', '<>', 2)->first()) {
            return redirect()->back()
                ->withErrors([
                    'status' => Lang::get('auth.status'),
                ]);
        }
        if (!Admin::where('email', $request->email)->where('password', bcrypt($request->password))->first()) {
            return redirect()->back()
                ->withErrors([
                    'password' => Lang::get('auth.password'),
                ]);
        }
    }



    public function showSuperadminLoginForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];
        return view('auth.login', ['url' => 'superadmin', 'pageConfigs' => $pageConfigs]);
    }

    public function superadminLogin(Request $request, FlasherInterface $flasher)
    {
        // return $request->all();
        $this->validate($request, [
            'email'   => 'required|email|exists:superadmins,email',
            'password' => 'required|min:6'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('superadmin')->attempt(['email' => $request->email, 'password' => $request->password], $remember)) {
            $flasher->addSuccess('WelCome Administration Panel');
           
            return redirect()->intended('/superadmin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }


    public function showLogincustomerForm()
    {
        $pageConfigs = ['bodyCustomClass' => 'login-bg', 'isCustomizer' => false];

        return view('auth.logincustomer', [
            'pageConfigs' => $pageConfigs
        ]);
    }
    public function UserLogin(Request $request, FlasherInterface $flasher)
    {
       // dd($request->all());
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        $userinfo=User::where('phone', '=', $request->phoneemail)->first(); 
       // dd($userinfo);
        if($userinfo){
            $token =Auth::attempt(['phone' => $request->phoneemail, 'password' => $request->password,'status'=>1],$remember);
           // dd($token);    
         if ($token) {
              $flasher->addSuccess('Login Successfully');
              return redirect()->intended('/');
        }
        else{
           
            $flasher->addError('Login Fail');
            return back()->withErrors([
                'status' => 'Your Email Or Phone Or Password Invaild'
            ])->withInput($request->only('phoneemail', 'remember'));
        }
       
        }
        else{

            $token=Auth::attempt(['email' => $request->phoneemail, 'password' => $request->password,'status'=>1],$remember);
        if ($token) {
            $flasher->addSuccess('Login Successfully');
              return redirect()->intended('/');
        }
        else{
          
            $flasher->addError('Login Fail');
            return back()->withErrors([
                'status' => 'Your Email Or Phone Or Password Invaild'
            ])->withInput($request->only('phoneemail', 'remember'));
        }
        }
       
    }
    public function customerLogin(Request $request)
    {
        // return $request->all();
        $this->validate($request, [
            'loginid'   => 'required|exists:customers,loginid',
            'password' => 'required|min:2|max:198'
        ]);
        $remember = (!empty($request->remember)) ? TRUE : FALSE;
        if (Auth::guard('customer')->attempt(['loginid' => $request->loginid, 'password' => $request->password], $remember)) {

            Toastr::success("Welcome  Adminstration Panel");
            return redirect()->intended('/customer/dashboard');
        }
        return back()->withInput($request->only('loginid', 'remember'));
    }

    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $userSocial = Socialite::driver($social)->user();
        
        $user = User::where(['email' => $userSocial->getEmail()])->first();
        if($user){
            Auth::login($user);
            return redirect()->intended('/');
        }else{
           
          $user= User::create([
                'fullname' => $userSocial->getName(),
                'email' =>  $userSocial->getEmail(),
                 'status' =>1
            ]);
            Auth::login($user);
        }
    }



}
