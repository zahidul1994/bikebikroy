<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Country;
use App\Models\Division;
use App\Helpers\CommonFx;
use App\Models\Bikemodel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\Contracts\DataTable;
use Illuminate\Pagination\LengthAwarePaginator;

class BikemodelController extends Controller
{
    public function index(){
      // dd(Bikemodel::with('bikebrand')->latest()->get());
      if (request()->ajax()) {
        return datatables()->of(Bikemodel::with('bikebrand')->latest()->get())
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
        ['link' => "superadmin/dashboard", 'name' => "Dashboard"], ['link' => "superadmin/bikemodellist", 'name' => "Bikemodel"],
    ];
    
      return view('superadmin.bike.bikemodel')->with('breadcrumbs', $breadcrumbs);
     
                   }
      
                   public function store(Request $request)
                   {
                     $validator = Validator::make($request->all(), [
                      'bikemodel' => 'required|min:3|max:190|unique:bikemodels',
                       'bnbikemodel' => 'required',
                       'bikebrand_id' => 'required',
                      ]);
                          if ($validator->fails()) {
                 
                 
                           return response()->json([
                                   'success' => false,
                 
                 
                                   'errors' => $validator->errors()->all()
                               ]);
                       } else {
                 
                 
                     $div = new Bikemodel();
                     $div->superadmin_id = Auth::id();
                     $div->bikebrand_id = trim($request->bikebrand_id);
                     $div->bikemodel = trim($request->bikemodel);
                     $div->bnbikemodel = trim($request->bnbikemodel);
                     $div->slug = CommonFx::make_slug($request->bikemodel);
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
                     $info = Bikemodel::find($id);
                 return response()->json($info);
                   }
     




           public function update(Request $request,$id){
         
           $validator = Validator::make($request->all(), [
            'bikemodel' => 'required|min:3|max:190|unique:bikemodels,ikemodel,'.$id,'_id',
             'bnbikemodel' => 'required',
             'bikebrand_id' => 'required',
            ]);
                if ($validator->fails()) {
       
                 return response()->json([
                         'success' => false,
            'errors' => $validator->errors()->all()
                     ]);
             } else {
       
       
           $div = Bikemodel::find($id);
           $div->superadmin_id = Auth::id();
          $div->bikebrand_id = trim($request->bikebrand_id);
          $div->bikemodel = trim($request->bikemodel);
          $div->bnbikemodel = trim($request->bnbikemodel);
          $div->slug = CommonFx::make_slug($request->bikemodel);
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
           
               $divisioninfo = Bikemodel::findOrFail($id)->delete();
               if ($divisioninfo) {
                     
                 return response()->json(['success' => true]);
               } else {
              
             
                   return response()->json(['success' => false]);
               }
             }
  
}
