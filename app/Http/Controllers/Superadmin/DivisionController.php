<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Country;
use App\Models\Division;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Validator;
class DivisionController extends Controller
{
    public function index(){
      if (request()->ajax()) {
        return datatables()->of(Division::latest()->get())
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
        ['link' => "superadmin/dashboard", 'name' => "Dashboard"], ['link' => "superadmin/divisionlist", 'name' => "Division"],
    ];
    
      return view('superadmin.location.division')->with('breadcrumbs', $breadcrumbs);
     
                   }
      
                   public function store(Request $request)
                   {
                     $validator = Validator::make($request->all(), [
                      'division' => 'required|min:3|max:190|unique:divisions',
                       'bndivision' => 'required',
                      ]);
                          if ($validator->fails()) {
                 
                 
                           return response()->json([
                                   'success' => false,
                 
                 
                                   'errors' => $validator->errors()->all()
                               ]);
                       } else {
                 
                 
                     $div = new Division;
                     $div->superadmin_id = Auth::id();
                     $div->division = trim($request->division);
                     $div->bndivision = trim($request->bndivision);
                     $div->country_id = '61988ae26e6b0000eb0040e2';
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
                     $info = Division::find($id);
                 return response()->json($info);
                   }
     




           public function update(Request $request,$id){
         
           $validator = Validator::make($request->all(), [
            'division' => 'required|min:3|max:190|unique:divisions,division,'.$id,
             'bndivision' => 'required',
            ]);
                if ($validator->fails()) {
       
                 return response()->json([
                         'success' => false,
            'errors' => $validator->errors()->all()
                     ]);
             } else {
       
       
           $div = Division::find($id);
           $div->superadmin_id = Auth::id();
           $div->division = trim($request->division);
           $div->bndivision = trim($request->bndivision);
           $div->country_id = '61988ae26e6b0000eb0040e2';
           $div->save();
       
           if ($div->save()) {
                 
           return response()->json(['success' => true]);
         } else {
        
       
             return response()->json(['success' => false]);
         }
       }
             }


             public function destroy($id)
             {
           
               $divisioninfo = Division::findOrFail($id)->delete();
               if ($divisioninfo) {
                     
                 return response()->json(['success' => true]);
               } else {
              
             
                   return response()->json(['success' => false]);
               }
             }
  
}
