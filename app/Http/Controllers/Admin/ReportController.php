<?php

namespace App\Http\Controllers\Admin;
use Validator;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Thana;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Models\Collection;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
//use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
 use Illuminate\Database\Eloquent\Builder;
 use Yajra\DataTables\Contracts\DataTable;
class ReportController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
           
            return view('admin.report.customerreport')->with('pageConfigs',$pageConfigs);
        }
      
      
        public function findcustomer(Request $request){
          if(! $request->id==null){
          $searchvalue = Customer::with('district','thana','area')->wherestatus(1)->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->first();
          
          if(!empty($searchvalue))
  {
    $bill=Bill::with('collection.admin','collection.payby')->wherecustomer_id($searchvalue->id)->get();
return response()->json([
  'result'=>$searchvalue,
  'bill'=>$bill,
  
  ],200);
  }
          $searchvalue = Customer::with('district','thana','area')->wherestatus(1)->whereadmin_id(Auth::id())->where('customermobile','LIKE','%'.$request->id."%")->first();
          
          if(!empty($searchvalue))
  {
    $bill=Bill::with('collection.admin','collection.payby')->wherecustomer_id($searchvalue->id)->get();
return response()->json([
  'result'=>$searchvalue,
  'bill'=>$bill,
  
  ],200);
  }
  $searchvalue = Customer::with('collection.admin','district','thana','area')->wherestatus(1)->whereadmin_id(Auth::id())->where('customername','LIKE','%'.$request->id."%")->first();
          
          if(!empty($searchvalue))
  {
    $bill=Bill::with('collection.admin','collection.payby')->wherecustomer_id($searchvalue->id)->get();
return response()->json([
  'result'=>$searchvalue,
  'bill'=>$bill,
  
  ],200);
  }
  $searchvalue = Customer::with('district','thana','area')->wherestatus(1)->whereadmin_id(Auth::id())->where('secretname','LIKE','%'.$request->id."%")->first();
          
          if(!empty($searchvalue))
  {
    $bill=Bill::with('collection.admin','collection.payby')->wherecustomer_id($searchvalue->id)->get();
    return response()->json([
      'result'=>$searchvalue,
      'bill'=>$bill,
  ],200);
  }
  }
     else{
      return response()->json([
        'success'=>false
      
      ],204 );
     }
      
        }

        public function collectionreport(Request $request){
  //         $info=  DB::table('customers')
  //         ->join('bills', 'customers.id', '=', 'bills.customer_id')
  //         ->join('collections', 'bills.id', '=', 'collections.bill_id')
  //        ->join('districts', 'districts.id', '=', 'customers.district_id')
  //        ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
  //         ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
  //         ->leftjoin('admins', 'admins.id', '=', 'customers.admin_id')
  //         ->leftjoin('users', 'users.id', '=', 'collections.user_id')
  //         ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)
  //         ->where('customers.status','=',1)
  //       // ->whereBetween('collections.created_at', array($request->to,$request->form))
  //  ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.id as bill','collections.created_at','admins.name','users.username','collections.*')->get()->dd();
          if (request()->ajax()) {

         //  return response($request->form);
            if(empty($request->userid)){
              $info=  DB::table('customers')
          ->join('bills', 'customers.id', '=', 'bills.customer_id')
          ->join('collections', 'bills.id', '=', 'collections.bill_id')
         ->join('districts', 'districts.id', '=', 'customers.district_id')
         ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
          ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
          ->leftjoin('admins', 'admins.id', '=', 'customers.admin_id')
          ->leftjoin('users', 'users.id', '=', 'collections.user_id')
          ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)
          ->where('customers.status','=',1)
         ->whereBetween('collections.created_at', array($request->form,$request->to))
   ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.id as bill','collections.created_at','admins.name','users.username','collections.*')->get();
           }
           
            else{
            
              $info=  DB::table('customers')
              ->join('bills', 'customers.id', '=', 'bills.customer_id')
              ->join('collections', 'bills.id', '=', 'collections.bill_id')
             ->join('districts', 'districts.id', '=', 'customers.district_id')
             ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
              ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
              ->leftjoin('admins', 'admins.id', '=', 'customers.admin_id')
              ->leftjoin('users', 'users.id', '=', 'collections.user_id')
              ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)
               ->where('customers.status','=',1)
              ->where('collections.user_id','=',$request->userid)
         ->whereBetween('collections.created_at', [$request->form,$request->to])
                 ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.id as bill','collections.*','admins.name','users.username')->get();
            }
            return datatables()->of($info)->addColumn('address' ,function($data){
               return 'House No- '. @$data->houseno.', '.@$data->floor.', <br/>'.@$data->areaname.', <br/>'. @$data->district.', <br/>'.@$data->thana.', <br/> Post # '.@$data->post;
           })
           ->addColumn('collectorname' ,function($data){
            if(empty(@$data->user_id)){ @$name=$data->name;}else{
              @$name=$data->username;
            };
            return  @$name ;
        })
          ->rawColumns(['address','collectorname'])
               
               ->make(true);
           }
           
          $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
             
              return view('admin.report.collectionreport')->with('pageConfigs',$pageConfigs);
          }
     
          public function oldcollectionreport(Request $request){
        
            if (request()->ajax()) {
  
              // return response($request->all());
              if(empty($request->collection) && empty($request->withoutcollection)){
               $info = DB::table('customers')
               ->join('bills', 'customers.id', '=', 'bills.customer_id')
              ->join('districts', 'districts.id', '=', 'customers.district_id')
              ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
               ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
               ->where('bills.paid','>',0)
               ->whereMonth('bills.created_at', date('m'))
         ->whereYear('bills.created_at', date('Y'))
           ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)->where('status','=',1)
              ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
             }
              elseif(!empty($request->collection) && empty($request->withoutcollection)){
              
                 $info = DB::table('customers')
                 ->join('bills', 'customers.id', '=', 'bills.customer_id')
                ->join('districts', 'districts.id', '=', 'customers.district_id')
                ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
                 ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
                 ->whereMonth('bills.created_at', date('m'))
          ->whereYear('bills.created_at', date('Y'))
                ->where('bills.paid','>',0)
                ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)->where('status','=',1)
                ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
           
              
              }
              elseif(empty($request->collection) && !empty($request->withoutcollection)){
              
               $info = DB::table('customers')
               ->join('bills', 'customers.id', '=', 'bills.customer_id')
              ->join('districts', 'districts.id', '=', 'customers.district_id')
              ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
               ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
               ->whereMonth('bills.created_at', date('m'))
         ->whereYear('bills.created_at', date('Y'))
              ->where('bills.paid','<=',0)
              ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)->where('status','=',1)
              ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
         
            
            }
              else{
              
               $info = DB::table('customers')
               ->join('bills', 'customers.id', '=', 'bills.customer_id')
              ->join('districts', 'districts.id', '=', 'customers.district_id')
              ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
               ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
               ->whereMonth('bills.created_at', date('m'))
         ->whereYear('bills.created_at', date('Y'))
           ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)->where('status','=',1)
              ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
              }
              return datatables()->of($info)->addColumn('address' ,function($data){
                 return 'House No- '. @$data->houseno.', '.@$data->floor.', <br/>'.@$data->areaname.', <br/>'. @$data->district.', <br/>'.@$data->thana.', <br/> Post # '.@$data->post;
             })
             ->addColumn('collectioninfo' ,function($data){
              $infos=Collection::with('admin','payby')->wherebill_id($data->bill)->get();
              $info=[];
                  foreach(@$infos as  $v)
                  {
                    if(empty($v->user_id)){
                      $name=@$v->admin['name'];
                    }
                    else{
                      $name=@$v->user['name'];
                    }
                  
                     $info[]= ('<pre>Date: '.$v['created_at'].'<br> Received: '.$name.'<br> Amount: '.@$v->paid.'<br> Collected By: '.   @$v->payby['paybyname'] . 
                     '<br/></pre>');
                  }
                  return  $info;
                ;
            }) 
            ->rawColumns(['address','collectioninfo'])
                 
                 ->make(true);
             }
             
            $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
               
                return view('admin.report.collectionreport')->with('pageConfigs',$pageConfigs);
            }
          
     

  
}
