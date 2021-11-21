<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Thana;
use App\Helpers\CommonFx;
use App\Models\District; 
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;

class ThanaController extends Controller
{

  public function index(){
// dd(Thana::with('district')->latest()->get());
    if (request()->ajax()) {
      return datatables()->of(Thana::with('district')->latest()->get())
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
      ['link' => "superadmin/dashboard", 'name' => "Dashboard"], ['link' => "superadmin/districtlist", 'name' => "Thana"],
  ];
  
    return view('superadmin.location.thana')->with('breadcrumbs', $breadcrumbs);
   
    
  
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
     'district_id' => 'required',
     'thana' => 'required|min:3|max:190|unique:thanas',
      'bnthana' => 'required',
      ]);
         if ($validator->fails()) {


          return response()->json([
                  'success' => false,
              'errors' => $validator->errors()->all()
              ]);
      } else {


    $div = new Thana;
    $div->superadmin_id = Auth::id();
    $div->district_id = trim($request->district_id);
    $div->bnthana = trim($request->bnthana);
    $div->slug = CommonFx::make_slug($request->thana);
    $div->thana = trim($request->thana);
    $div->save();

    if ($div->save()) {
          
    return response()->json(['success' => true]);
  } else {
 

      return response()->json(['success' => false]);
  }
}
  }

  public function edit($id)
  {
    $info = Thana::find($id);
return response()->json($info);
  }

  
      public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
          'district_id' => 'required',
          'thana' => 'required|min:3|max:190|unique:thanas,thana,'.$id,
           'bnthana' => 'required',
           ]);
              if ($validator->fails()) {
     
     
               return response()->json([
                       'success' => false,
                   'errors' => $validator->errors()->all()
                   ]);
           } else {
     
     
         $div =Thana::find($id);
         $div->superadmin_id = Auth::id();
         $div->district_id = trim($request->district_id);
         $div->bnthana = trim($request->bnthana);
         $div->slug = CommonFx::make_slug($request->thana);
         $div->thana = trim($request->thana);
         $div->save();
     
         if ($div->save()) {
               
         return response()->json(['success' => true]);
       } else {
      
     
           return response()->json(['success' => false]);
       }
     }





        
           
       }
  
  
  
       public function destroy($id){
       
           $divisioninfo=Thana::destroy($id);
          if($divisioninfo){
                  
         return response()->json(['success' => true]);
          }
          else{
                  
         return response()->json(['success' => false]);
          }
           }
  
  
    public function search(Request $request){
      $output="";
      $searchvalue = Thana::Where('thana','LIKE','%%%'.$request->id."%%%")->orwhere('id','LIKE','%'.$request->id."%")->latest()->get();
      if(count($searchvalue))
  {
  foreach ($searchvalue as $key => $searchval) {
  $output.='<tr>'.
  '<td>'.$searchval->id.'</td>'.
  '<td>'.$searchval->thana.'</td>'.
  '<td>'.'<a target="_blank" href="'.url('superadmin/editthana/'.$searchval->id).'" class="btn-floating mb-1 waves-effect waves-light"> <i class="material-icons">edit</i></a>'.'</td>'.
  '</tr>';
  }
  return Response($output);
  }
  else{
  $output.='<tr>'
  .'<td><h1>Sorry</h1></td>'.
  '<td><h1>NO </h1></td>'.
  '<td><h1>Data</h1></td>'.
  '<td><h1> Found</h1></td>'.
  '<td><h1>Type</h1></td>'.
  '<td><h1> Another</h1></td>'.
  '<td><h1>Info</h1></td>'.
  '</tr>';
  return Response( $output);
  
  }
    }

}
