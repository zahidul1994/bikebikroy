<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\District;
use App\Models\Division;
use App\Helpers\CommonFx;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;

class DistrictController extends Controller
{

  public function index(){

    if (request()->ajax()) {
      return datatables()->of(District::with('division')->latest()->get())
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
      ['link' => "superadmin/dashboard", 'name' => "Dashboard"], ['link' => "superadmin/districtlist", 'name' => "District"],
  ];
  
    return view('superadmin.location.district')->with('breadcrumbs', $breadcrumbs);
   
                 }
  
                 public function store(Request $request)
                 {
                   $validator = Validator::make($request->all(), [
                    'district' => 'required|min:3|max:190|unique:districts',
                     'bndistrict' => 'required',
                     'division_id' => 'required',
                    ]);
                        if ($validator->fails()) {
               
               
                         return response()->json([
                                 'success' => false,
                             
                                 'errors' => $validator->errors()->all()
                             ]);
                     } else {
               
               
                   $div = new District;
                   $div->superadmin_id = Auth::id();
                   $div->division_id = trim($request->division_id);
                   $div->slug = CommonFx::make_slug($request->district);
                   $div->bndistrict = trim($request->bndistrict);
                   $div->district = trim($request->district);
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
                   $info = District::find($id);
               return response()->json($info);
                 }
   



    public function update(Request $request,$id){
    

       $validator = Validator::make($request->all(), [
        'district' => 'required|min:3|max:190|unique:districts,district,'.$id,
         'bndistrict' => 'required',
         'division_id' => 'required',
        ]);
            if ($validator->fails()) {
   
   
             return response()->json([
                     'success' => false,
   
   
                     'errors' => $validator->errors()->all()
                 ]);
         } else {
   
   
       $div =District::find($id);
       $div->superadmin_id = Auth::id();
       $div->division_id = trim($request->division_id);
       $div->bndistrict = trim($request->bndistrict);
       $div->slug = CommonFx::make_slug($request->district);
       $div->district = trim($request->district);
       $div->save();
   
       if ($div->save()) {
             
       return response()->json(['success' => true]);
     } else {
    
   
         return response()->json(['success' => false]);
     }
   }
         
     }



     public function destroy($id){
     
         $divisioninfo=District::destroy($id);
        if($divisioninfo){
          return response()->json(['success' => true]);
        }
        else{
          return response()->json(['success' => false]);
        }
         }


}
