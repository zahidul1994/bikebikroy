<?php
namespace App\Http\Controllers\User;
use App\Http\Controllers\Controller;
use App\Models\Bikesale;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;

class BikesaleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('user.bikesale.bikesale');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd(CommonFx::make_slug($request->title.'-in-year-'.date('Y').'-for-sale-'.$request->cc.'cc-bike'));
        $this->validate($request, [
            'title' => 'required|min:3|max:190',
            'division_id' => 'required',
            'district_id' => 'required',
            'bikebrand_id' => 'required',
            'bikemodel_id' => 'required',
            'condition' => 'required|min:1|max:160',
            'edition' => 'required|min:1|max:198',
            'manufacture' => 'required|min:1|max:198',
            'kilometerrun' => 'required|min:1|max:198',
            'cc' => 'required|min:1|max:198',
            'price' => 'required|min:1|max:198',
                
      
          ]);

          $customerinfo = Bikesale::create(array(
            'title' => $request->title,
            'slug' =>CommonFx::bnslug(CommonFx::make_slug($request->title.'-in-year-'.date('Y').'-for-sale-'.$request->cc.'cc-bike')),
            'division_id' => $request->division_id,
            'district_id' => $request->district_id,
            'condition' => $request->condition,
            'biketype' => $request->biketype,
            'bikebrand_id' => $request->bikebrand_id,
            'bikemodel_id' => $request->bikemodel_id,
            'edition' => $request->edition,
            'manufacture' => $request->manufacture,
            'kilometerrun' => $request->kilometerrun,
            'cc' => $request->cc,
            'description' => $request->description,
            'price' => $request->price,
            'negotiable' => $request->negotiable,
            'phonenumber' => json_encode($request->phonenumber),
            
          ));


        //   if ($request->hasfile('photo')) {
      
        //     if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
        //       mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
        //     }
      
        //     $ex = $request->photo->extension();
        //     $rand = uniqid(CommonFx::make_slug(Str::limit($request->title, 40)));
        //     $name = $rand . "." . $ex;
      
        //     $top = $request->photo->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $name);
      
        //     $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $name)->resize(35, null, function ($constraint) {
        //       $constraint->aspectRatio();
        //     });
      
        //     $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $name, 60);
      
        //     // }
      
      
      
        //   } else {
        //     $name = 'not-found.jpg';
        //   };

          dd(1);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Bikesale  $bikesale
     * @return \Illuminate\Http\Response
     */
    public function show(Bikesale $bikesale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bikesale  $bikesale
     * @return \Illuminate\Http\Response
     */
    public function edit(Bikesale $bikesale)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bikesale  $bikesale
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bikesale $bikesale)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bikesale  $bikesale
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bikesale $bikesale)
    {
        //
    }
}
