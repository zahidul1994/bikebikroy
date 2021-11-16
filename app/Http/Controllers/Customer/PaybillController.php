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
use App\Models\Paybill;
use App\Models\Payby;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Customernotification;
use App\Notifications\Adminupdatenotification;
 use Illuminate\Database\Eloquent\Builder;

class PaybillController extends Controller
{
    public function index(){
      // dd(Complain::with('admin','customer')->get());
      if (request()->ajax()) {
        return datatables()->of(Paybill::with('payby')->wherecustomer_id(Auth::id())->latest())
          ->addColumn('action', function ($data) {
            $button = '<a title="Edit Or Aprove Complain" href="/customer/editbillpay/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
                       
            return $button;
          })
         
      ->addColumn('payby' ,function($data){
          return $data->payby->paybyname;
      }) 
    
          ->addColumn('status', function($data){
            if($data->status==0){
           $button = '<a href="#" disabled  class="btn-sm " title="Pending"><i class="material-icons">block</i></a>';
          return $button;
      }
      elseif($data->status==1){
        $button = '<a href="#" disabled  class="btn-sm Approved" title="Aprove"><i class="material-icons">done_all</i></a>';
       return $button;
   }
   
      
      else {
          $button = '<a href="#" disabled title="Payent cancel" class=" btn-sm" ><i class="material-icons">cancel</i> </a>';
          return $button;
      }})
     
          ->addIndexColumn()
          ->rawColumns(['action','status','paybyname'])
          ->make(true);
      }
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
  
      return view('customer.paybill.index')->with('pageConfigs', $pageConfigs);

     
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "customer/dashboard", 'name' => "Home"], ['link' => "customer/pyamentlist", 'name' => "Paybill"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        $payby=Payby::whereadmin_id(Auth::guard('customer')->user()->admin_id)->pluck('paybyname','id');
        $bill=Bill::wherecustomer_id(Auth::guard('customer')->user()->id)->latest()->first();
        if($bill->paid>0){
        Toastr::success("Bill Alredy Paid Or Update", "Sorry");
       return Redirect::to('customer/pyamentlist'); 
        }
        return view('customer.paybill.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('payby',$payby)->with('Bill',$bill);
      
        }

 
      
      
      
      public function store(Request $request){
       // dd($request->all());
        $info=Paybill::wherecustomer_id(Auth::guard('customer')->user()->id)->wherebill_id($request->bill_id)->first();
        if($info){
          Toastr::success("Bill Alredy Paid Or Update", "Sorry");
       return Redirect::to('customer/pyamentlist'); 
        }
       $this->validate($request,[
          'paymentnumber' => 'required|max:198',
           'transection' => 'required|max:198',
           'payby' => 'required',
         ]);
          $pay= new Paybill();
          $pay->customer_id =Auth::guard('customer')->user()->id;
         $pay->admin_id =Auth::guard('customer')->user()->admin_id;
         $pay->paymentnumber =$request->paymentnumber;
         $pay->transection =$request->transection;
         $pay->bill_id =$request->bill_id;
         $pay->paid =$request->paid;
         $pay->payby_id =$request->payby;
         $pay->save();
          
       if($pay){
      
       
      
       $data = [
            
        'admindata' =>'<a class="black-text"  href="'. url('/admin/paybillinfo') . '">'. Auth::guard('customer')->user()->customername. ' Sent a Payment request </a>',
];

Admin::find(Auth::guard('customer')->user()->admin_id)->notify(new Adminupdatenotification($data));

       Toastr::success("Bill Create Successfully", "Well Done");
       return Redirect::to('customer/pyamentlist'); 
          
      }
   }


      public function edit($id){
       // dd($id);
        $breadcrumbs = [
               ['link' => "customer/dashboard", 'name' => "Home"], ['link' => "customer/pyamentlist", 'name' => "Billpay"], ['name' => "edit"],
           ];
          
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $bill=Paybill::wherecustomer_id(Auth::guard('customer')->user()->id)->find($id);
        
           if($bill->status==0){
            $payby=Payby::whereadmin_id(Auth::guard('customer')->user()->admin_id)->pluck('paybyname','id');
            
           return view('customer.paybill.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('payby',$payby)->with('Bill',$bill);
          }
          else{
            Toastr::info("You Can not, Edit This Bill", "Sorry");
            return Redirect::to('customer/pyamentlist'); 
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
