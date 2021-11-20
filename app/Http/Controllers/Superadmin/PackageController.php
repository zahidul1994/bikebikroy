<?php

namespace App\Http\Controllers\Superadmin;
use App\Models\Package;
use App\Models\Merchant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Contracts\DataTable;
use Flasher\Prime\FlasherInterface;
class PackageController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  public function index()
    {
       // dd(Package::latest());
      
            if (request()->ajax()) {
              return datatables()->of(Package::latest()->get())
                ->addColumn('action', function ($data) {
                  $button = '<button title="Edit Package" id="editBtn" style="border:0; background: none; padding: 0 !important"   rid="' . $data->_id . '" class="btn-md"><i class="far fa-edit"></i></button>';
                  $button .= '&nbsp;&nbsp;';
                 $button .= '<button type="button" style="border:0; background: none; padding: 0 !important"  title="Delete"   id="deleteBtn" rid="' . $data->_id . '" class="btn-sm btn-warning"><i class="fas fa-trash"></i></button>';
                  return $button;
                })
                ->addColumn('status', function($data){
                  if($data->status==0){
                 $button = '<button type="button" rid="'.$data->_id.'" class="btn-sm Approved" title="Click for Aprove Status"><i class="material-icons">block</i></button>';
                return $button;
            }
            
            else {
                $button = '<button type="button" title="Aprove  Payment" class=" btn-sm" ><i class="material-icons">beenhere</i> </button>';
                return $button;
            }})
         
            ->addIndexColumn()
                ->rawColumns(['action','status'])
                ->make(true);
            }
            $breadcrumbs = [
              ['link' => "superadmin/dashboard", 'name' => "Superadmin"], ['link' => "superadmin/packagelist", 'name' => "Packagelist"]];
    
          
            return view('superadmin.package.index')->with('breadcrumbs', $breadcrumbs);
    
    }

  public function create()
  {
  }

  public function store(Request $request)
  {
    $validator = Validator::make($request->all(), [
      'packagename' => 'required|min:1|max:190|unique:packagename',
      'packageprice' => 'required',
      'expiryday' => 'required'
         ]);
         if ($validator->fails()) {


          return response()->json([
                  'success' => false,


                  'errors' => $validator->errors()->all()
              ]);
      } else {


    $div = new Package;
    $div->superadmin_id = Auth::id();
    $div->packagename = trim($request->packagename);
    $div->packageprice = trim($request->packageprice);
    $div->expiryday = trim($request->expiryday);
    $div->description = trim($request->description);
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
    $info = Package::find($id);
return response()->json($info);
  }

  public function update(Request $request, $id)
  {
    $validator = Validator::make($request->all(), [
      'packagename' => 'required|min:1|max:190|unique:packagename,' . $id,
      'packageprice' => 'required',
      'expiryday' => 'required'
         ]);
         if ($validator->fails()) {


          return response()->json([
                  'success' => false,


                  'errors' => $validator->errors()->all()
              ]);
      } else {


    $div =Package::find($id);
    $div->superadmin_id = Auth::id();
    $div->packagename = trim($request->packagename);
    $div->packageprice = trim($request->packageprice);
    $div->expiryday = trim($request->expiryday);
    $div->description = trim($request->description);
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

    $divisioninfo = Package::findOrFail($id)->delete();
    if ($divisioninfo) {
          
      return response()->json(['success' => true]);
    } else {
   
  
        return response()->json(['success' => false]);
    }
  }
    

}
