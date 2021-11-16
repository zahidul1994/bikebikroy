<?php

namespace App\Http\Controllers\Admin;
use datatables;
use App\Models\User;
use App\Models\Thana;
use App\Models\Complain;
use App\Models\Todotask;
use App\Helpers\CommonFx;
use App\Models\Todotaskuser;
use Illuminate\Http\Request;
use App\Models\Todotaskdetails;
use Kamaln7\Toastr\Facades\Toastr;
use App\Models\Prospectivecustomer;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\Usernotification;
use Illuminate\Support\Facades\Redirect;
use App\Notifications\Customernotification;


class TodolistController extends Controller
{
    public function index(){
    // dd(Todotask::with('todotaskuser.user')->whereadmin_id(Auth::id())->get());
      if (request()->ajax()) {
        return datatables()->of(Todotask::with('todotaskuser.user')->whereadmin_id(Auth::id())->latest())
          ->addColumn('action', function ($data) {
            $button = '<button type="button" title="See Details" style="border:0; background: none; padding: 0 !important" rid="' . $data->id . '" class="invoice-action-view btn-sm UpdateTodoList"><i class="material-icons" style="font-size: 16px; color: #9B01BA;">wc
            </i></button>';
            $button .= '&nbsp;&nbsp;';
          $button .= '<a title="Edit Todolist" href="/admin/edittodolist/'.$data->id . '" class="btn-sm" style="border:0; background: none; padding: 0 !important"><i class="material-icons" style="font-size: 16px; color: #9B01BA;">edit</i></a>';
            $button .= '&nbsp;&nbsp;';
            $button .= '<button type="button" title="Delete Complain" style="border:0; background: none; padding: 0 !important" rid="' . $data->id . '" class="invoice-action-view btn-sm deleteBtn"><i class="material-icons" style="font-size: 16px; color: #9B01BA;" >delete_forever
            </i></button>';
            return $button;
          })
          ->addColumn('status', function($data){
            if($data->status==2){
           $button = '<button  style="border:0; background: none; padding: 0 !important" type="button" title="Todo Task Complete"  class="btn-sm Approved"><i class="material-icons">beenhere</i></button>';
          return $button;
      }
      
      else {
          $button = '<button type="button"  style="border:0; background: none; padding: 0 !important" title="Pending Todolist" class=" btn-sm Notapproved" rid="'.$data->id.'"><i class="material-icons">block</i> </button>';
          return $button;
      }})
      ->addColumn('users' ,function($data){
        $info=[];
        foreach($data->todotaskuser as  $v)
            {
              $info[]=$v->user->username.' ';
              
            }
         return  $info;
  })  
     
          ->addIndexColumn()
          ->rawColumns(['action','status','users'])
          ->make(true);
      }
      $pageConfigs = ['pageHeader' => false, 'isFabButton' => false];
  
      return view('admin.todolist.index')->with('pageConfigs', $pageConfigs);

     
        }
      
      
       public function create(){
     $breadcrumbs = [
            ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/todolist", 'name' => "Todolist"], ['name' => "Create"],
        ];
      
          $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
   return view('admin.todolist.create', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs]);
      
        }

       
            
      public function store(Request $request){
       // dd($requestuser= $request->users);
        $this->validate($request,[
          
          'title' => 'required|min:1|max:198',
           'comment' => 'max:198',
           'description' => 'max:498',
         ]);
         $info=Todotask::create([
        'admin_id'=>Auth::id(),
        'title'=>$request->title,
        
         ]);
       if($info){
        $infos=Todotaskdetails::create([
          'todotask_id'=>$info['id'],
          'description'=>$request->description,
          'comment'=>$request->comment,
          
           ]);
          }
if($request->has('users')){

  $requestuser= $request->users;

  for ($i = 0; $i < count($requestuser); $i++) {
  
    $user=Todotaskuser::create([
      'user_id'=>$requestuser[$i],
      'todotask_id'=>$info['id'],
     
       ]);
  
       $data = [
            
        'userdata' =>'<a class="black-text"  href="'. url('/user/todolist') . '">'. $request->title. ' Update Task For You </a>',
];

User::find($requestuser[$i])->notify(new Usernotification($data));
      }


  

       }

       return response()->json([
        'success'=>true,
         
      ],201);
          
      }


      public function edit($id){
        $infos=Todotask::with('todotaskdetails','todotaskuser')->whereadmin_id(Auth::id())->find($id);
       
        return response()->json([
            'success'=>true,
             'infos'=>$infos,
             
          ],201);

         
           } 
              public function edittodolist($id){
        $infos=Todotask::whereadmin_id(Auth::id())->find($id);
        $userinfo=Todotaskuser::wheretodotask_id($id)->pluck('user_id','user_id')->all();
    $breadcrumbs = [
      ['link' => "admin/dashboard", 'name' => "Home"], ['link' => "admin/todolist", 'name' => "Todolist"], ['name' => "edit"],
    ];

    $pageConfigs = ['pageHeader' => true, 'isFabButton' => false];
   
    return view('admin.todolist.edit', ['pageConfigs' => $pageConfigs], ['breadcrumbs' => $breadcrumbs])->with('infos', $infos)->with('userinfo', $userinfo);

         
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
    'title' => 'required|min:1',
    'users' => 'required|max:60',
    'comment' => 'max:198',
   'description' => 'max:498',
   ]);
   Todotask::find($id)->update(['title'=>$request->title,'status'=>$request->status]);
 if((!empty($request->comment))||(!empty($request->comment))){


 Todotaskdetails::create([
  'todotask_id'=>$id,
  'description'=>$request->description,
  'comment'=>$request->comment,
  
   ]);
  }
  Todotaskuser::wheretodotask_id($id)->delete();
  for ($i = 0; $i < count($request->users); $i++) {

    Todotaskuser::create([
      'user_id'=>$request->users[$i],
      'todotask_id'=>$id,
     
       ]);
  
       $data = [
            
        'userdata' =>'<a class="black-text"  href="'. url('/user/todolist') . '">'. $request->title. 'Task For You </a>',
];

User::find($request->users[$i])->notify(new Usernotification($data));
      }
    

 Toastr::success("Todolist Update Successfully", "Well Done");
 return Redirect::to('admin/todolist'); 
}

         public function destroy($id){
         Todotask::whereadmin_id(Auth::id())->findOrFail($id)->delete();
             return response()->json([
              'success'=>true
            
            ],201);
             }


   
}
