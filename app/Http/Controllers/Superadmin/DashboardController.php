<?php
namespace App\Http\Controllers\Superadmin;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Imports\CustomerImport;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Cache;
use Illuminate\Contracts\Cache\Factory;
use Illuminate\Support\Facades\Redirect;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
       
        $pageConfigs = ['navbarLarge' => false];

        $admin= Cache::remember('admincache', 22*60, function () {
           return Admin::select('id','status')->get(); 
        });

        
        $user= Cache::remember('usercache', 22*60, function () {
            return User::select('id','status')->get(); 
        });
      
       
        
    
        $breadcrumbs = [
            ['link' => "superadmin/dashboard", 'name' => "Superadmin"], ['name' => "Dashboard"]];
  

       return view('superadmin.dashboard',['breadcrumbs' => $breadcrumbs], compact('admin','user'));
    }

    public function deletenotification()
    {
        $notification=auth()->user()->notifications()->delete();
        if($notification){
          //  $notification->destroy();
            return response()->json(['success'=>true],201);
        }
        else{
            return response()->json(['success'=>false],404);
        }
    }
    public function seennotification(){
        auth()->user()->unreadNotifications->markAsRead();
      return response()->json(['success'=>true],201);
        
        
    }


    public function impotercustomer(){

        $pageConfigs = ['navbarLarge' => false];
        
        return view('superadmin.excel.customerimporter',['pageConfigs' => $pageConfigs]); 
    }
    public function customerimporter(Request $request){
// dd($request->file('customers'));
        Excel::import(new CustomerImport, request()->file('customers'));
        Toastr::success("Importe Create Successfully", "Well Done");
               return Redirect::to('superadmin/importcustomer'); 
              
    }

}
