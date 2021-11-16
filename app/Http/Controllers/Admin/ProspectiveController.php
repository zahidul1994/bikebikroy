<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Area;
use App\Models\Bill;
use App\Models\User;
use App\Models\Thana;
use App\Models\Complain;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Jobs\Sendsuersms;
use App\Models\Collection;
use App\Models\Complaintext;
use Illuminate\Http\Request;
use App\Models\Complaindetils;
use Illuminate\Validation\Rule;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use App\Models\Prospectivecustomer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Customernotification;
 use Illuminate\Database\Eloquent\Builder;
use Tymon\JWTAuth\Claims\Custom;

class ProspectiveController extends Controller
{
    public function index(){
     // dd(Prospectivecustomer::with('area')->whereadmin_id(Auth::id())->latest());
      if (request()->ajax()) {
        return datatables()->of(Prospectivecustomer::whereadmin_id(Auth::id())->latest())
          ->addColumn('action', function ($data) {
            $button = '<a title="Edit" style="border:0; background: none; padding: 0 !important"  href="/admin/editprospectivecustomer/' . $data->id . '" class="invoice-action-view"><i class="material-icons">edit</i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<button type="button" title="Send SMS" style="border:0; background: none; padding: 0 !important" rid="' . $data->id . '" class="invoice-action-view btn-sm Sendsms"><i class="material-icons ">sms
            </i></button>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<button type="button" title="Delete Complain" style="border:0; background: none; padding: 0 !important"  rid="' . $data->id . '" class="invoice-action-view btn-sm deleteBtn"><i class="material-icons ">delete_forever
            </i></button>';
            return $button;
          })
       ->addColumn('status', function($data){
            if($data->status==0){
           $button = '<a href="#" disabled  class="btn-sm " title="Not Customer"><i class="material-icons">block</i></a>';
          return $button;
      }
      elseif($data->status==1){
        $button = '<a href="#" disabled  class="btn-sm Approved" title="Customer"><i class="material-icons">beenhere</i></a>';
       return $button;
   }
   
      
      else {
          $button = '<a href="#" disabled title="Close" class=" btn-sm" ><i class="material-icons">done_all</i> </a>';
          return $button;
      }})
     
          ->addIndexColumn()
          ->rawColumns(['action','status'])
          ->make(true);
      }
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
  
      return view('admin.prospectivecustomer.index')->with('pageConfigs', $pageConfigs);

     
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/prospectivecustomerlist", 'name' => "Prospectivecustomer"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
   return view('admin.prospectivecustomer.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

       
            
      public function store(Request $request){
        // dd($request->all());exit;
        $this->validate($request,[
          
          'name' => 'required|min:1',
          'phone' => 'required|max:60',
           'comment' => 'max:198',
           'address' => 'max:498',
         ]);
         Prospectivecustomer::create($request->all()+['admin_id'=>Auth::id()]);
       
       Toastr::success("Prospective Customer Create Successfully", "Well Done");
       return Redirect::to('admin/prospectivecustomerlist'); 
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/prospectivecustomerlist", 'name' => "Prospectivecustomer"], ['name' => "edit"],
           ];
          
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $infos=Prospectivecustomer::whereadmin_id(Auth::id())->find($id);
           $thana=Thana::pluck('thana','id');
           return view('admin.prospectivecustomer.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('infos',$infos)->with('thana',$thana);
         
           }




public function show($id){
$info=Complain::with('customer','complaindetils')->whereadmin_id(Auth::id())->find($id);
if($info->status==0){
  $info->update(['admin_id'=>Auth::id(),'status'=>1]);
 return view('admin.complain.show')->with('infos',$info); 
}
else{
  return view('admin.complain.show')->with('infos',$info); 
}

}
public function update(Request $request,$id){
  // dd($request->all());exit;
  $this->validate($request,[
    'name' => 'required|min:1',
    'phone' => 'required|max:60',
     ]);
   Prospectivecustomer::find($id)->update($request->all()+['admin_id'=>Auth::id()]);
 
 Toastr::success("Prospective Customer Update Successfully", "Well Done");
 return Redirect::to('admin/prospectivecustomerlist'); 
}

         public function destroy($id){
         
             $divisioninfo=Prospectivecustomer::whereadmin_id(Auth::id())->findOrFail($id)->delete();
             return response()->json([
              'success'=>false
            
            ],201);
             }

public function prospectivecustomersms(Request $request){
  $cus=Prospectivecustomer::whereadmin_id(Auth::id())->findOrFail($request->id);
  $smsinfo=['name'=>$cus->name,'mobile'=>$cus->phone,'message'=>$request->message];
  CommonFx::Prospectivesms($smsinfo);
  return response()->json([
   'success'=>true,
    
 ],201);
}
   
}
