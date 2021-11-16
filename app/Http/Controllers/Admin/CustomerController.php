<?php

namespace App\Http\Controllers\Admin;
use App\Models\Bill;
use App\Models\Smssent;
use App\Mail\Custommail;
use App\Models\Customer;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use App\Events\SendsmsEvent;
use Illuminate\Http\Request;
use App\Jobs\Sendcustomersms;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;
use Kamaln7\Toastr\Facades\Toastr;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Event;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Pagination\LengthAwarePaginator;

class CustomerController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {

    if (request()->ajax()) {

     // return response($request->all());
     if(empty($request->collection) && empty($request->withoutcollection)){
      $info = DB::table('customers')
      ->join('bills', 'customers.id', '=', 'bills.customer_id')
     ->join('districts', 'districts.id', '=', 'customers.district_id')
     ->join('thanas', 'thanas.id', '=', 'customers.thana_id')
      ->leftjoin('areas', 'areas.id', '=', 'customers.area_id')
      ->whereMonth('bills.created_at', date('m'))
->whereYear('bills.created_at', date('Y'))
  ->where('customers.admin_id','=',Auth::guard('admin')->user()->id)->where('status','=',1)
     ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.addicrg','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
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
       ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.addicrg','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
  
     
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
     ->select('customers.id','customers.email','customers.status','customers.houseno','customers.floor','areas.areaname','districts.district','thanas.thana','customers.post','customers.loginid','customers.customername','customers.customermobile','customers.secretname','customers.id','bills.monthlyrent','bills.due','bills.addicrg','bills.advance','bills.discount','bills.advance','bills.vat','bills.total','bills.paid','bills.id as bill')->get();
   
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
     return datatables()->of($info)->addColumn('action', function ($data) {
          $button ='<button type="button" id="UpdateBillBtn" style="border:0; background: none; padding: 0 !important; margin: 0 !important" uid="' . $data->bill . '" class="invoice-action-view btn-sm" title="Update Bill"><i class="material-icons" style="font-size: 16px; color: #F77B00;">sync</i></button>'; 
          $button .= '&nbsp;&nbsp;';
          $button .= '<a title="Edit Customer" href="/admin/editcustomer/' . $data->id . '" class="btn-sm" style="border:0; background: none; padding: 0 !important"><i class="material-icons" style="font-size: 16px; color: #9B01BA;">edit</i></a>';
          $button .= '&nbsp;&nbsp;';
          $button .= '<a target="_blank" style="border:0; background: none; padding: 0 !important" href="' . url('admin/customerprofile', $data->id) . '" class="btn-sm" title="See Preview"><i class="material-icons " style="font-size: 16px; color: #16A66C;">remove_red_eye</i></a>';
          $button .= '<br/>';
           $button .= '<button type="button" title="Send Email Customer" style="border:0; background: none; padding: 0 !important"  cid="' . $data->id . '" email="' . $data->email . '" class="invoice-action-view btn-sm Sendemail"><i class="material-icons " style="font-size: 16px; color: #16A66C;">email</i></button>';
          return $button;
        })
        ->addColumn('status', function($data){
          if($data->status==1){
         $button = '<button type="button" rid="'.$data->id.'" class="btn-sm Approved" title="Update Status"><i class="material-icons">beenhere</i></button>';
        return $button;
    }
    
    else {
        $button = '<button type="button" title="Update Status" class=" btn-sm Notapproved" rid="'.$data->id.'"><i class="material-icons">block</i> </button>';
        return $button;
    }})
  
  ->addColumn('duetotal' ,function($data){
    return ((@$data->total)-($data->paid));
})
      ->addColumn('address' ,function($data){
        return 'House No- '. @$data->houseno.', '.@$data->floor.', <br/>'.@$data->areaname.', <br/>'. @$data->district.', <br/>'.@$data->thana.', <br/> Post # '.@$data->post;
    })
  
        ->addIndexColumn()
        ->rawColumns(['action','duetotal','status','address'])
        
        ->make(true);
    }
    
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.index')->with('pageConfigs', $pageConfigs);
  }
  public function pendingcustomer(Request $request)
  {
    if (request()->ajax()) {
      return datatables()->of(Customer::with('district','thana','area')->whereadmin_id(Auth::guard('admin')->user()->id)->wherestatus(2))
        ->addColumn('action', function ($data) {
          $button = '<a title="Edit Customer" href="/admin/editcustomer/' . $data->id . '" class="btn-sm" style="border:0; background: none; padding: 0 !important"><i class="material-icons" style="font-size: 16px; color: #9B01BA;">edit</i></a>';
          $button .= '&nbsp;&nbsp;';
          $button .= '<a target="_blank" style="border:0; background: none; padding: 0 !important" href="' . url('admin/customerprofile', $data->id) . '" class="btn-sm" title="See Preview"><i class="material-icons " style="font-size: 16px; color: #16A66C;">remove_red_eye</i></a>';

          // $button .= '&nbsp;&nbsp;';
          // $button .= '<button type="button" title="Inactive Customer"  id="deleteBtn" rid="' . $data->id . '" class="invoice-action-view btn-sm"><i class="material-icons ">https</i></button>';
          return $button;
        })
        ->addColumn('status', function($data){
          if($data->status==1){
         $button = '<button  style="border:0; background: none; padding: 0 !important" type="button" title="Update Status" rid="'.$data->id.'" class="btn-sm Approved"><i class="material-icons">beenhere</i></button>';
        return $button;
    }
    
    else {
        $button = '<button type="button"  style="border:0; background: none; padding: 0 !important" title="Update Status" class=" btn-sm Notapproved" rid="'.$data->id.'"><i class="material-icons">block</i> </button>';
        return $button;
    }})
       
      
    ->addColumn('address' ,function($data){
      return 'House No- '. @$data->houseno.', '.@$data->floor.', <br/>'.@$data->area->areaname.', <br/>'. @$data->district->district.', <br/>'.@$data->thana->thana.', <br/> Post # '.@$data->post;
  })
        ->addIndexColumn()
        ->rawColumns(['action','status','address'])
        ->make(true);
    }
    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.pendingcustomer')->with('pageConfigs', $pageConfigs);
  }
  public function create()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "Create"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }
  public function inactivecustomer()
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/inactivecustomer", 'name' => "Customer"], ['name' => "Inacitve"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];

    return view('admin.customer.inacitve', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
  }
   public function findinactivecustomer(Request $request)
  {
    if($request->to==!null && $request->from==null){
   
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereDate('created_at', '=', $request->to)->wherestatus(3)->get();
    }
    elseif($request->to==null && $request->from==!null){
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereDate('updated_at', '=', $request->from)->wherestatus(3)->get();
    }
     elseif($request->to==!null && $request->from==!null){
      $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->whereBetween('created_at', array($request->to, $request->from))->wherestatus(3)->get();
    }
    
 else{

  $info=Customer::whereadmin_id(Auth::id())->wherecountry_id($request->country_id)->wherestatus(3)->get();
 }

    $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];

    return view('admin.customer.inactivecustomerlist')->with('pageConfigs', $pageConfigs)->with('infos', $info);
  }
  public function restorecustomer($id){
    
    Customer::withTrashed()->find($id)->restore();
      
              return response()->json(['success' => true]);
        
  
  
  
  }
  public function store(Request $request)
  {
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
      'password' => 'required',
      'idnumbertype' => 'required',
      'total' => 'required',
      'repassword' => 'required|same:password',
      'monthlyrent' => 'required',
      // 'loginid' => ['required', 'min:1', 'max:60', Rule::unique('customers')->where(function ($query) {
      //   return $query->where('admin_id', Auth::user()->id);
      // })],



    ]);
    if ($request->hasfile('photo')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
      }

      $ex = $request->photo->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 40)));
      $name = $rand . "." . $ex;

      $top = $request->photo->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $name);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $name)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $name, 60);

      // }



    } else {
      $name = 'not-found.jpg';
    };
    if ($request->hasfile('infoimage')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
      }

      $ex = $request->infoimage->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 30)));
      $infoname = $rand . "." . $ex;

      $top = $request->infoimage->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $infoname);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $infoname)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $infoname, 60);

      // }



    } else {
      $infoname = 'not-found.jpg';
    };
    $prefix=Auth::guard('admin')->user()->customerprefix;
    $id = IdGenerator::generate(['table' => 'customers','field'=>'loginid', 'length' => 8, 'prefix' => $prefix,'reset_on_prefix_change'=>true]);
//output: A00001,A00002,B00001,B00002
    $customerinfo = Customer::create(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson,
      'loginid' => $id,
      'email' => $request->email,
      'password' =>  Hash::make($request->password),
      'customermobile' => $request->customermobile,
      'customeraltmobile' => $request->customeraltmobile,
      'customerprofession' => $request->customerprofession,
      'customerprofession' => $request->customerprofession,
      'country_id' => $request->country_id,
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'idnumber' => $request->idnumber,
      'idnumbertype' => $request->idnumbertype,
      'otheridtype' => $request->otheridtype,
      'thana_id' => $request->thana_id,
      'area_id' => $request->area_id,
      'buildingname' => $request->buildingname,
      'houseno' => $request->houseno,
      'floor' => $request->floor,
      'post' => $request->post,
      'apt' => $request->apt,
      'connectiondate' => $request->connectiondate,
      'mikrotic_id' => $request->mikrotic_id,
      'ip' => $request->ip,
      'type_id' => $request->type_id,
      'profile_id' => $request->profile_id,
      'sqn' => $request->sqn,
      'interfacename' => $request->interfacename,
      'mac' => $request->mac,
      'secretname' => $request->secretname,
      'scrtnamepass' => $request->scrtnamepass,
      'bandwidth' => $request->bandwidth,
      'ppcomment' => $request->ppcomment,
      'atd_day' => $request->atd_day,
      'atd_month' => $request->atd_month,
      'remoteaddress' => $request->remoteaddress,
      'comment' => $request->comment,
      'package_id' => $request->package_id,
      'monthlyrent' => $request->monthlyrent?:0,
      'due' => $request->due?:0,
      'addicrg' => $request->addicrg?:0,
      'discount' => $request->discount?:0,
      'advance' => $request->advance?:0,
      'vat' => $request->vat?:0,
      'total' => $request->total?:0,
      'prepaidpostpaid' => $request->prepaidpostpaid,
      'connection' => $request->connection,
      'connectivity' => $request->connectivity,
      'clienttype' => $request->clienttype,
      'dlp' => $request->dlp,
      'admin_id' => Auth::guard('admin')->user()->id,
      'description' => $request->description,
      'note' => $request->note,
      'status' => $request->status,
      'connectedby' => $request->connectedby,
      'sdeposite' => $request->sdeposite,
      'path' => date('Y/m'),
      'photo' => $name,
      'infoimage' => $infoname,
    ));

    if ($customerinfo) {
     if($request->status==1){
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
     }
     else{
      Toastr::success("Customer Create Successfully", "Well Done");
      return Redirect::to('admin/pendingcustomerlist');
     }
      
    } else {
      Toastr::warning("Customer Create Fail", "Sorry");
      return Redirect::to('admin/customerlist');
    }
  }

  public function edit($id)
  {
    //dd($id);
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $infos = Customer::whereadmin_id(Auth::id())->find($id);
    return view('admin.customer.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('info', $infos);
  } 
  public function show($id)
  {
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/customerlist", 'name' => "Customer"], ['name' => "Show"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
    $infos = Customer::whereadmin_id(Auth::id())->find($id);
    return view('admin.customer.show', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('customer', $infos);
  }

  public function update(Request $request, $id)
  {
    //dd($request->all());
    $customer = Customer::whereadmin_id(Auth::id())->find($id);
    if ($request->hasfile('photo')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/". $customer->path ."thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/". $customer->path."thumbs/", 0777, true);
      }

      $ex = $request->photo->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 40)));
      $name = $rand . "." . $ex;

      $top = $request->photo->move(storage_path('/app/files/shares/uploads/'.$customer->path.'/'), $name);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/'.$customer->path.'/'.$name)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path.'/thumbs/' . $name, 60);

      // }



    } else {
      $name = 'not-found.jpg';
    };
    if ($request->hasfile('infoimage')) {

      if (!is_dir(storage_path() . "/app/files/shares/uploads/" .$customer->path . "/thumbs/")) {
        mkdir(storage_path() .  "/app/files/shares/uploads/" .$customer->path . "/thumbs/", 0777, true);
      }

      $ex = $request->infoimage->extension();
      $rand = uniqid(CommonFx::make_slug(Str::limit($request->customername, 30)));
      $infoname = $rand . "." . $ex;

      $top = $request->infoimage->move(storage_path('/app/files/shares/uploads/' . $customer->path.'/'), $infoname);

      $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . $customer->path.'/'. $infoname)->resize(35, null, function ($constraint) {
        $constraint->aspectRatio();
      });

      $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . $customer->path . '/thumbs/' . $infoname, 60);

      // }



    } else {
      $infoname = 'not-found.jpg';
    };
    if($request->oldpassword==null){
     $password=$customer->password;
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
       'monthlyrent' => 'required',
       'loginid' => 'required|min:3|max:60|unique:customers,loginid,'.$id,
      

    ]);
  }
  else{
    $this->validate($request, [
      'customername' => 'required|min:3|max:190',
      'customermobile' => 'required|min:10|max:30',
      'houseno' => 'required|min:1|max:160',
      'floor' => 'required|min:1|max:160',
      'district_id' => 'required',
      'thana_id' => 'required',
      'area_id' => 'required',
      'package_id' => 'required',
       'monthlyrent' => 'required',
       'loginid' => 'required|min:3|max:60|unique:customers,loginid,'.$id,
       'oldpassword' => 'required',
       'repassword' => 'required|same:oldpassword',

    ]);
    $password=Hash::make($request->oldpassword);
  }
    $info = Customer::whereadmin_id(Auth::id())->find($id)->update(array(
      'customername' => $request->customername,
      'contactperson' => $request->contactperson,
      'email' => $request->email,
      'password' =>  $password,
      'loginid' =>  $request->loginid,
     'customermobile' => $request->customermobile,
      'customeraltmobile' => $request->customeraltmobile,
      'customerprofession' => $request->customerprofession,
      'customerprofession' => $request->customerprofession,
      'country_id' => $request->country_id,
      'division_id' => $request->division_id,
      'district_id' => $request->district_id,
      'idnumber' => $request->idnumber,
      'idnumbertype' => $request->idnumbertype,
      'otheridtype' => $request->otheridtype,
      'thana_id' => $request->thana_id,
      'area_id' => $request->area_id,
      'buildingname' => $request->buildingname,
      'houseno' => $request->houseno,
      'floor' => $request->floor,
      'post' => $request->post,
      'apt' => $request->apt,
      'connectiondate' => $request->connectiondate,
      'mikrotic_id' => $request->mikrotic_id,
      'ip' => $request->ip,
      'type_id' => $request->type_id,
      'profile_id' => $request->profile_id,
      'sqn' => $request->sqn,
      'interfacename' => $request->interfacename,
      'mac' => $request->mac,
      'secretname' => $request->secretname,
      'scrtnamepass' => $request->scrtnamepass,
      'bandwidth' => $request->bandwidth,
      'ppcomment' => $request->ppcomment,
      'atd_day' => $request->atd_day,
      'atd_month' => $request->atd_month,
      'remoteaddress' => $request->remoteaddress,
      'comment' => $request->comment,
      'package_id' => $request->package_id,
      'monthlyrent' => $request->monthlyrent,
      'due' => $request->due,
      'addicrg' => $request->addicrg,
      'discount' => $request->discount,
      'advance' => $request->advance,
      'vat' => $request->vat,
      'total' => $request->total,
      'prepaidpostpaid' => $request->prepaidpostpaid,
      'connection' => $request->connection,
      'connectivity' => $request->connectivity,
      'clienttype' => $request->clienttype,
      'dlp' => $request->dlp,
      'admin_id' => Auth::guard('admin')->user()->id,
      'description' => $request->description,
      'note' => $request->note,
      'status' => $request->status,
      'connectedby' => $request->connectedby,
      'sdeposite' => $request->sdeposite,
      'path' => $customer->path,
      'photo' => $name,
      'infoimage' => $infoname,
    ));
    if ($info) {
		 if($request->status==1){
      Toastr::success("Customer Update Successfully", "Well Done");
      return Redirect::to('admin/customerlist');
     }
     elseif($request->status==2){
      Toastr::success("Customer Update Successfully", "Well Done");
      return Redirect::to('admin/pendingcustomerlist');
     }
	 else{
      
 Toastr::success("Customer Update Successfully", "Well Done");
        return Redirect::to('admin/customerlist');
	}
	}
  }

  public function destroy($id)
  {
   $info= Customer::whereadmin_id(Auth::id())->find($id);
$info->status=3;
$info->save();
    return response($info) ; 
   
  } 
   public function findbill($id)
  {
   
    $info=Bill::findOrFail($id);
    $customer=Customer::find($info->customer_id);
    return response()->json([
      'suceess'=>true,
    'info'=>$info,
    'customer'=>$customer,
    ],201);
   
   
  }
   public function updatebillcustomer(Request $request)
  {
// return response($request->all());
     $info=Bill::findOrFail($request->billid)->update(
      [
      'monthlyrent' => $request->monthlyrent,
       'due' => $request->due,
       'addicrg' => $request->addicrg,
       'discount' => $request->discount,
       'advance' => $request->advance,
        'vat' => $request->vat,
       'total' => $request->total
    
  ]);
  //return response($info);
  if($info){
   $infos= Customer::find($request->customerid);
        $infos->monthlyrent= $request->monthlyrent;
    $infos->total = (($request->monthlyrent+$infos->due+$infos->addicrg)-($infos->advance+$infos->discount))+((($request->monthlyrent+$infos->addicrg))*($infos->vat)) / 100;
    $infos->save();
  return response()->json([
      'suceess'=>true,
    ],201);
   
  }
  }



  public function setapproval(Request $request){
    $id =$request->id;
    $roomapproval = Customer::find($id);
    if($request->action=="allow"){
        $roomapproval->status=2;
    }
    if($request->action=="deny"){
        $roomapproval->status=1;
        $smsinfo=['name'=>$roomapproval->customername,'mobile'=>$roomapproval->customermobile,'id'=>$roomapproval->loginid,'ip'=>$roomapproval->ip,'oppusername'=>$roomapproval->secretname,'opppassword'=>$roomapproval->scrtnamepass,'monthlypayment'=>$roomapproval->monthlyrent];
         CommonFx::sentsmscustomer($smsinfo);

    }
        $roomapproval->update();
        if($roomapproval->update()==true){
            return response()->json(['success' => true, 'message' =>'Customer Approved Updated!']);
        }



} 
public function sendsmscustomer(Request $request){
  //return response($request->all());
 $customers=Customer::with('bill')->whereadmin_id(Auth::id())->whereloginid($request->loginid)->get();
foreach($customers as $customer){

$data = [
  'admin_id'=>Auth::id(),
  'message' =>$request->smsmessage,
  'name'=>$customer->customername,
  'number'=>$customer->customermobile,
  'id'=>$customer->loginid,
  'ip'=>$customer->ip,
  'opppassword'=>$customer->opppasswordip,
  'oppusername'=>$customer->oppusername,
  'companyname'=>Auth::user()->company,
  'companynumber'=>Auth::user()->phone,
  'billamount'=>$customer->bill[0]->total,
  'expeirydate'=>$customer->atd_day,
  'exmonth'=>$customer->atd_month
 
];

Sendcustomersms::dispatch($data);
}

 return response()->json(['success' => true]);

  }

public function customeremail(Request $request){
  $info=Customer::select('id','customername','loginid')->find($request->id);
  $data= array(
    'loginid'=> $info->loginid,
   'name'=> $info->customername,
   'email'=> $request->email,
   'subject'=> $request->subject,
   'message'=> $request->message,
    );

Mail::to($request->email)->send(new Custommail($data));
return response()->json(['success' => true]);

}

public function deletedara(){
   $info=Bill::with('collection')->whereDate('created_at', '2021-11-02')->select('id','created_at')->delete();
  
}

  }

  
