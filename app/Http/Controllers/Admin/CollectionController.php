<?php

namespace App\Http\Controllers\Admin;
use Validator;
use datatables;
use App\Models\Area;
use App\Models\Bill;
use App\Models\Thana;
use App\Models\Paybill;
use App\Models\Customer;
use App\Helpers\CommonFx;
use App\Models\Collection;
use Illuminate\Http\Request;
use App\Notifications\Customernotification;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
//use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redirect;
 use Illuminate\Database\Eloquent\Builder;

class CollectionController extends Controller
{
    public function index(){
     
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
           
            return view('admin.collection.index')->with('pageConfigs',$pageConfigs);
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/createcollection", 'name' => "Collection"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.collection.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

       public function cancelcollection(){
     $breadcrumbs = [
            ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Cancel"], ['name' => "Collection"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
        
        return view('admin.collection.cancel', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }
      
      
      public function store(Request $request){
      //  return response($request->all());exit;
        $validator = Validator::make($request->all(),[
          'paid'=>'required|min:1', 'max:60',
          'billid'=>'required|min:1', 'max:160',
          'payby'=>'required|min:1', 'max:160',
          
       ]);
     
       if ($validator->fails()) {


        return response()->json
        (['success' =>false,
         'errors'=>$validator->errors()->all()]);
    }
        
           $info= Bill::find($request->billid);
            $info->paid+=$request->paid;
            $info->save();
          $pay= new Collection();
          $pay->paid =trim($request->paid);
         $pay->bill_id =trim($request->billid);
         $pay->payby_id =trim($request->payby);
         $pay->note =trim($request->note);
         $pay->invoice =trim($request->invoicesl);
         $pay->admin_id =Auth::id();
          $pay->save();
          $cus=Customer::find($info->customer_id);
           $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile,'id'=>$cus->loginid,'paid'=>$request->paid,'due'=>$info->total-$info->paid];
           CommonFx::sentsmscustomerbillpaid($smsinfo);
     if($cus){
      return response()->json([
        'suceess'=>true,
      ],201);
      }
      
         else{
          return response()->json([
            'success'=>false
          
          ],404 );
         
        } 
     
                  
    
          
      }


      public function edit($id){
        $breadcrumbs = [
               ['link' => "admin", 'name' => "Home"], ['link' => "admin/arealist", 'name' => "Area"], ['name' => "edit"],
           ];
           $thana=Thana::pluck('thana','id');
             $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
           $divisioninfo=Area::whereadmin_id(Auth::id())->find($id);
           return view('admin.area.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('countryinfo',$divisioninfo)->with('thana', $thana);
         
           }



           public function update(Request $request,$id){
            $validator = Validator::make($request->all(),[
              'paid'=>'required|min:1', 'max:60',
              
           ]);
           if ($validator->fails()) {


            return response()->json
            (['success' =>false,
             'errors'=>$validator->errors()->all()]);
        }
             $collectioninfo = Bill::find($id);
             if($collectioninfo->paid==null){

             
             if($collectioninfo->total<$request->paid){
                $advance=$request->paid-$collectioninfo->total;
                $due=0;
             }
             if($collectioninfo->total>=$request->paid){
               $due=$collectioninfo->total-$request->paid;
               $advance=0;
            }
               
        
         if($collectioninfo){
          return response()->json([
            'suceess'=>true
          
          ],201);
          }
          
             else{
              return response()->json([
                'success'=>false
              
              ],404 );
             
            } 
         }
                      
         else{
          return response()->json([
            'success'=>false
          
          ],404 );
         
        }  
         }



         public function destroy($id){
         
             $divisioninfo=Area::whereadmin_id(Auth::id())->findOrFail($id)->delete();
            if($divisioninfo){
              Toastr::success("Area Delete Successfully", "Well Done");
                   return Redirect::to('admin/arealist'); 
            }
            else{
              Toastr::warning("Area Delete Fail", "Sorry");
              return Redirect::to('admin/arealist'); 
            }
             }

             public function searchsinglecustomer(Request $request){
              if(! $request->id==null){
              $searchvalue = Customer::with('district','thana','area','bill.collection')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->first();
              
              if(!empty($searchvalue))
      {
      return response()->json([
        'result'=>$searchvalue
      
      ],200);
      }
              $searchvalue = Customer::with('district','thana','area','bill.collection')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('customermobile','LIKE','%'.$request->id."%")->first();
              
              if(!empty($searchvalue))
      {
      return response()->json([
        'result'=>$searchvalue
      
      ],200);
      }
      $searchvalue = Customer::with('district','thana','area','bill.collection')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('customername','LIKE','%'.$request->id."%")->first();
              
              if(!empty($searchvalue))
      {
      return response()->json([
        'result'=>$searchvalue
      
      ],200);
      }
      $searchvalue = Customer::with('district','thana','area','bill.collection')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('secretname','LIKE','%'.$request->id."%")->first();
              
              if(!empty($searchvalue))
      {
      return response()->json([
        'result'=>$searchvalue
      
      ],200);
      }
      }
         else{
          return response()->json([
            'success'=>false
          
          ],204 );
         }
          
            }
    





      
      public function singlecustomerbill(Request $request){
        if(! $request->id==null){
        $searchvalue = Customer::with('district','thana','area','bill.collection.admin','bill.collection.payby')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->Where('loginid','LIKE','%'.$request->id."%")->first();
        
        if(!empty($searchvalue))
{
return response()->json([
  'result'=>$searchvalue

],200);
}
        $searchvalue = Customer::with('district','thana','area','bill.collection.admin','bill.collection.payby')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('customermobile','LIKE','%'.$request->id."%")->first();
        
        if(!empty($searchvalue))
{
return response()->json([
  'result'=>$searchvalue

],200);
}
$searchvalue = Customer::with('district','thana','area','bill.collection.admin','bill.collection.payby')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('customername','LIKE','%'.$request->id."%")->first();
        
        if(!empty($searchvalue))
{
return response()->json([
  'result'=>$searchvalue

],200);
}
$searchvalue = Customer::with('district','thana','area','bill.collection.admin','bill.collection.payby')->whereIn('status',[1,3])->whereadmin_id(Auth::id())->where('secretname','LIKE','%'.$request->id."%")->first();
        
        if(!empty($searchvalue))
{
return response()->json([
  'result'=>$searchvalue

],200);
}
}
   else{
    return response()->json([
      'success'=>false
    
    ],204 );
   }
    
      }

   public function collectiondelete(Request $request,$id){
//$info=Collection::whereadmin_id(Auth::id())->find($id);
$info=Collection::find($id);
if($info){
  $pa=Bill::find($info->bill_id);
  $pa->paid-=$request->payamount;
   $pa->save();
}
$infos=Paybill::wherebill_id($info->bill_id)->first();
if($infos){
  $infos->status=0;
  $infos->save();
$data = [
            
  'customerdata' =>'<a class="black-text"  href="'. url('/customer/pyamentlist') . '">'. Auth::user()->name. ' Delete Your Payment </a>',
];

Customer::find($pa->customer_id)->notify(new Customernotification($data));
}  
$info->delete();
return response()->json([
  'success'=>true
],200);
      }



      public function paybillinfo(){
       // dd(Paybill::with('payby')->whereadmin_id(Auth::id())->latest()->get());
        if (request()->ajax()) {
          return datatables()->of(Paybill::with('customer','payby')->whereadmin_id(Auth::id())->whereMonth('created_at', date('m'))
          ->whereYear('created_at', date('Y'))->latest())
            
        ->addColumn('payby' ,function($data){
            return $data->payby->paybyname;
        }) 
      
            ->addColumn('status', function($data){
              if($data->status==0){
             $button = '<a href="#" rid="'.$data->id.'"  class="btn-sm Pending" title="Pending"><i class="material-icons">block</i></a>';
             $button .= '<a href="#"  rid="'.$data->id.'"  class="btn-sm Cancel" title="Cancel"><i class="material-icons">cancel</i></a>';
            return $button;
        }
        elseif($data->status==1){
          $button = '<a href="#"  rid="'.$data->id.'"  class="btn-sm Approved" title="Aprove"><i class="material-icons">done_all</i></a>';
         return $button;
     }
     
        
        else {
            $button = '<a href="#" disabled title="Payment Cancel" class=" btn-sm" ><i class="material-icons">cancel</i> </a>';
            return $button;
        }})
       
            ->addIndexColumn()
            ->rawColumns(['action','status','paybyname'])
            ->make(true);
        }
        $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
    
        return view('admin.collection.paybillinfo')->with('pageConfigs', $pageConfigs);
  
       
          }
        
          public function conframpayment($id){
            
           $infos=Paybill::find($id);
           $info= Bill::find($infos->bill_id);
           if($info->paid>0){
            return response()->json([
              'success'=>false
            
            ],404 );
           }
              
                
                  $info->paid=$info->total;
                  $info->save();
                $pay= new Collection();
                $pay->paid =trim($info->total);
               $pay->bill_id =trim($infos->bill_id);
               $pay->payby_id =trim($infos->payby_id);
               $pay->admin_id =Auth::id();
                $pay->save();
                $cus=Customer::find($infos->customer_id);
                 $smsinfo=['name'=>$cus->customername,'mobile'=>$cus->customermobile,'id'=>$cus->loginid,'paid'=>$infos->paid,'due'=>$info->total-$info->paid];
                 CommonFx::sentsmscustomerbillpaid($smsinfo);
                 $infos->status=1;
                 $infos->save();
           if($cus){
            return response()->json([
              'suceess'=>true,
            ],201);
            }
            
               else{
                return response()->json([
                  'success'=>false
                
                ],404 );
               
              } 
           
                        
          
                
            } 


            
          public function cancelpayment($id){
            
            $infos=Paybill::find($id);
               $infos->status=2;
                  $infos->save();
                   
       $data = [
            
        'customerdata' =>'<a class="black-text"  href="'. url('/customer/pyamentlist') . '">'. Auth::user()->name. ' Cancel Your Payment </a>',
];

Customer::find($infos->customer_id)->notify(new Customernotification($data));
          
      
            if($infos){

             return response()->json([
               'suceess'=>true,
             ],201);
             }
             
                else{
                 return response()->json([
                   'success'=>false
                 
                 ],404 );
                
               } 
            
                         
           
                 
             } 
  
}
