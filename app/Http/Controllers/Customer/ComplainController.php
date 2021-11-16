<?php

namespace App\Http\Controllers\Customer;
use Validator;
use App\Models\Area;
use App\Models\Bill;
use App\Models\User;
use App\Models\Admin;
use App\Models\Thana;
use App\Models\Complain;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Jobs\Sendsuersms;
use App\Models\Collection;
use App\Models\Complaintext;
use Illuminate\Http\Request;
use App\Models\Complaindetils;
//use Illuminate\Database\Query\Builder;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Customernotification;
use App\Notifications\Adminupdatenotification;
 use Illuminate\Database\Eloquent\Builder;

class ComplainController extends Controller
{
    public function index(){
      // dd(Complain::with('admin','customer')->get());
      if (request()->ajax()) {
        return datatables()->of(Complain::with('admin','customer')->wherecustomer_id(Auth::id())->latest())
          ->addColumn('action', function ($data) {
            $button = '<a title="Edit Or Aprove Complain" href="/customer/editcomplain/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<a title="Add Message" href="/customer/replycomplain/' . $data->id . '" class="iinvoice-action-view btn-sm"><i class="material-icons">reply_all</i></a>';
            return $button;
          })
          ->addColumn('customerid' ,function($data){
            return $data->customer->loginid;
        }) 
        ->addColumn('phone' ,function($data){
          return $data->customer->customermobile;
      }) 
           ->addColumn('name' ,function($data){
          return $data->customer->customername;
      })
      ->addColumn('adminname' ,function($data){
          return $data->admin->name;
      })  ->addColumn('complaintitle' ,function($data){
        
            foreach(json_decode($data->complainheding) as  $v)
            {
              return ($v.' ...');
            }
          ;
      }) 
          ->addColumn('status', function($data){
            if($data->status==0){
           $button = '<a href="#" disabled  class="btn-sm " title="Not Open"><i class="material-icons">block</i></a>';
          return $button;
      }
      elseif($data->status==1){
        $button = '<a href="#" disabled  class="btn-sm Approved" title="Pending"><i class="material-icons">comment</i></a>';
       return $button;
   }
   
      
      else {
          $button = '<a href="#" disabled title="Close" class=" btn-sm" ><i class="material-icons">done_all</i> </a>';
          return $button;
      }})
     
          ->addIndexColumn()
          ->rawColumns(['action','status','customerid','phone','name','adminname','complaintitle',''])
          ->make(true);
      }
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
  
      return view('customer.complain.index')->with('pageConfigs', $pageConfigs);

     
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "customer/dashboard", 'name' => "Home"], ['link' => "customer/complainlist", 'name' => "Complain"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('customer.complain.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

 
      
      
      
      public function store(Request $request){
       $this->validate($request,[
          'complainmessage' => 'max:198',
           'complainheding' => 'required',
         ]);
          $pay= new Complain();
          $pay->customer_id =Auth::guard('customer')->user()->id;
         $pay->admin_id =Auth::guard('customer')->user()->admin_id;
         $pay->complainmessage =trim($request->complainmessage);
         $pay->status =trim(0);
         $pay->complainheding =json_encode($request->complainheding, JSON_FORCE_OBJECT);
         $pay->save();
          
       if($pay){
      
       
        $info= new Complaindetils();
        $info->complain_id =trim($pay->id);
       $info->messageby =Auth::guard('customer')->user()->customername;
       $info->userseen =1;
       $info->message =trim($request->complainmessage?:'No Comversation text');
       $info->save();
       }
      
       $data = [
            
        'admindata' =>'<a class="black-text"  href="'. url('/admin/replycomplain/'.$pay->id) . '">'. Auth::guard('customer')->user()->customername. 'Create A Complain For You </a>',
];

Admin::find(Auth::guard('customer')->user()->admin_id)->notify(new Adminupdatenotification($data));

       Toastr::success("Complate Create Successfully", "Well Done");
       return Redirect::to('customer/complainlist'); 
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "customer/dashboard", 'name' => "Home"], ['link' => "customer/complainlist", 'name' => "Complain"], ['name' => "edit"],
           ];
          
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $complain=Complain::wherecustomer_id(Auth::guard('customer')->user()->id)->find($id);
        
           if($complain->status==0){

           $compiainin=json_decode($complain->complainheding,TRUE);
           return view('customer.complain.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info',$complain)->with('complaininfo',$compiainin);
          }
          else{
            Toastr::info("You Canot Edit This Complain", "Sorry");
            return Redirect::to('customer/complainlist'); 
          }
         
           }




public function show($id){
$info=Complain::with('customer','complaindetils','admin')->wherecustomer_id(Auth::guard('customer')->user()->id)->find($id);

 return view('customer.complain.show')->with('infos',$info); 


}

         public function destroy($id){
         
             $divisioninfo=Complain::whereadmin_id(Auth::id())->findOrFail($id)->delete();
             return response()->json([
              'success'=>false
            
            ],201);
             }




      public function update(Request $request,$id){
        // dd($request->all());exit;
        $this->validate($request,[
          'complainmessage' => 'max:198',
           'complainheding' => 'required',
         ]);
          $pay=Complain::find($id);
         $pay->complainmessage =trim($request->complainmessage);
        $pay->complainheding =json_encode($request->complainheding, JSON_FORCE_OBJECT);
         $pay->save();
       
       Toastr::success("Complan Update Successfully", "Well Done");
       return Redirect::to('customer/complainlist'); 
          
      }

   public function replycomplain(Request $request){
$info=Complaindetils::find($request->id);
$info->replymessage=$request->replymessage;
  $info->userseen=1;
  $info->save();

return response()->json([
  'success'=>true
],200);
      }
   public function addcomplaintext(Request $request){
$info=new Complaindetils;
$info->message=$request->replysms;
$info->complain_id=$request->id;
  $info->userseen=1;
  $info->save();
  $data = [
            
    'admindata' =>'<a class="black-text"  href="'. url('/admin/replycomplain/'.$request->id) . '">'. Auth::guard('customer')->user()->customername. 'Write A message </a>',
];

Admin::find(Auth::guard('customer')->user()->admin_id)->notify(new Adminupdatenotification($data));
return response()->json([
  'success'=>true
  ],200);
      }
      public function closecomplain($id){
        $complain=Complain::find($id);
         $complain->status=2;
          $complain->save();
         
          $data = [
                    
            'customerdata' =>'<a class="black-text"  href="'. url('/customer/complaindetails/'.$complain->id) . '">'. Auth::user()->name. ' Close Your Complain  </a>',
        ];
        
        Customer::find($complain->customer_id)->notify(new Customernotification($data));
        $cus=Customer::find($complain->customer_id);
        
           $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile];
           CommonFx::Sendsmsopencomplainclose($smsinfo);
        
        return response()->json([
          'success'=>true
        ],200);
              }
}
