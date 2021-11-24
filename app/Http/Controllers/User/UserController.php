<?php
namespace App\Http\Controllers\user;
use App\Models\User;
use App\Models\Setting;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Foregatepasword;
use App\Models\Userphoneverify;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpKernel\Event\RequestEvent;

class UserController extends Controller
{
    public function index()
    { 
       
          return view('user.profile');
    }
    public function updateemail(Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|min:3|max:198|unique:users',
                ]);
                if ($validator->fails()) {
       return response()->json([
                         'success' => false,
                     'errors' => $validator->errors()->all()
                     ]);
             } else {
       $user=User::find(Auth::id())->update(['email'=>$request->email]);
         
           return response()->json([
                    'success' => true,
                     ], 201);
              }
       
       
        
    }  
    
  
    public function updateprofileinfo(Request $request){
        //return response($request->all());
        $validator = Validator::make($request->all(), [
            'fullname' => 'required|min:3|max:198',
            'division' => 'required',
            'district' => 'required',
            'thana' => 'required',
                ]);
                if ($validator->fails()) {
       return response()->json([
                         'success' => false,
                     'errors' => $validator->errors()->all()
                     ]);
             } else {
       User::find(Auth::id())->update([
           'fullname'=>$request->fullname,
           'username'=>CommonFx::make_slug($request->fullname.Auth::id()),
           'division_id'=>$request->division,
           'thana_id'=>$request->thana,
           'district_id'=>$request->district,
           'package_id' =>Setting::value('defaultuserpackage_id'),
           'salepost' =>Setting::value('defaultpostnumber'),
       ]);
         
           return response()->json([
                    'success' => true,
                     ], 201);
              }
       
       
        
    }  
    
    public function me(){
       $user=Auth::guard('api')->user();
          if($user){
           return response()->json([
                    'success' => true,
                    'user'=>$user,
                     ], 201);
              }
              
       else {
                  return response()->json([
                      'success' => false,

                  ],404);
              }
       
        
    }

    public function searchphonenumber(Request $request){
        $info=Userphoneverify::whereuser_id(Auth::id())->wherephonenumber($request->number)->wherestatus(1)->first();
        if($info){
            return response()->json([
                'success' => true,
                 'message'=>'Verify Number'
            ],201);
        }
      else{
       $user= Userphoneverify::create([
            'user_id'=>Auth::id(),
             'status'=>0,
             'phonenumber'=>$request->phone,
             'otp'=>mt_rand(10000, 99999),
             'expiredate'=>Date('y:m:d', strtotime('+60 days'))
    ]);
        $url = "http://66.45.237.70/api.php";
        $number=$request->number;
        $text=("Dear ". Auth::user()->fullname .','." Bikebikroy verify OTP ".$user->otp);
       // dd($text);
        $data= array(
            'username'=>"bikebd",
            'password'=>"QKR2SPFN",
            'number'=>$number,
            'message'=>$text
            );
        $ch = curl_init(); // Initialize cURL
        curl_setopt($ch, CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $smsresult = curl_exec($ch);
        $p = explode("|",$smsresult);
        $sendstatus = $p[0];
        return response()->json([
            'success' => false,
             'message'=>'Univerify Number'
        ],401);
      }
       
      
   }



   
    }
