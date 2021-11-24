<?php

namespace App\Http\Controllers\User;
use notifications;
use App\Models\User;
use App\Models\Admin;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Smssent;
use App\Models\Bikesale;
use Illuminate\Http\Request;
use App\Models\Medicineinformation;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;

class DashboardController extends Controller
{
 public function __construct()
    {
       
        $this->middleware('auth');
    }
    
    public function index()
    { 
   
      // dd(Setting::value('defaultuserpackage_id'));
      if (request()->ajax()) {
        return datatables()->of(Bikesale::whereuser_id(Auth::id())->latest()->get())
          ->addColumn('action', function ($data) {
            $button = '<button title="Edit Division" id="editBtn" style="border:0; background: none; padding: 0 !important"   rid="' . $data->_id . '" class="btn-md"><i class="far fa-edit"></i></button>';
            $button .= '&nbsp;&nbsp;';
           $button .= '<button type="button" style="border:0; background: none; padding: 0 !important"  title="Delete"   id="deleteBtn" rid="' . $data->_id . '" class="btn-sm btn-warning"><i class="fas fa-trash"></i></button>';
            return $button;
          })
       
      ->addIndexColumn()
          ->rawColumns(['action'])
          ->make(true);
      }

      $breadcrumbs = [
        ['link' => "user/dashboard", 'name' => "Dashboard"],
    ];
 
      return view('user.dashboard')->with('breadcrumbs', $breadcrumbs);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
      public function addpostingview(){
   if(Auth::user()->username==null){
    return redirect()->intended('/user/profile');
 
   }
   else{
    return view('user.dashboard');
   }
        
    }
    
}
