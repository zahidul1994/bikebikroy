<?php
namespace App\Http\Controllers\user;
use App\Models\User;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\Foregatepasword;
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

    public function logout(Request $request){
         Auth::guard('api')->logout();
   
       return response()->json([
             'success' => true,
              'message'=>'logout success'
         ],201);
       
      
   }



   
    }
