<?php
namespace App\Http\Controllers\User;
use App\Models\Bikesale;
use App\Helpers\CommonFx;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Flasher\Prime\FlasherInterface;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;

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
    public function store(Request $request, FlasherInterface $flasher)
    {
        // dd($request->all());
        // dd(CommonFx::make_slug($request->title.'-in-year-'.date('Y').'-for-sale-'.$request->cc.'cc-bike'));
        if(@Auth::user()->salepost<=0){
          $flasher->addSuccess('Please Upgrate your Package Successfully');
           return redirect()->back(); 
        }
        $this->validate($request, [
            'title' => 'required|min:3|max:190|unique:bikesales',
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
            'description' => 'required|min:1|max:500',
            'imageone' => 'mimes:jpeg,jpg,png|required|max:500',   
      
          ]);

      


          if ($request->hasfile('imageone')) {
      
            if (!is_dir(storage_path() . "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/")) {
              mkdir(storage_path() .  "/app/files/shares/uploads/" . date('Y/m/') . "thumbs/", 0777, true);
            }
      
            // $ex = $request->imageone->extension();
            $rand = uniqid(CommonFx::make_slug(Str::limit($request->title, 40)));
            $nameone = $rand . "." . 'webp';
            // $name = $rand . "." . $ex;
      
            $top = $request->imageone->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $nameone);
      
            $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $nameone)->resize(35, null, function ($constraint) {
              $constraint->aspectRatio();
            });
      
            $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $nameone, 60);
      
            }
            if ($request->hasfile('imagetwo')) {
      
                $rand = uniqid(CommonFx::make_slug(Str::limit($request->title, 40)));
                $nametwo = $rand . "." . 'webp';
                $top = $request->imagetwo->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $nametwo);
          
                $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $nametwo)->resize(35, null, function ($constraint) {
                  $constraint->aspectRatio();
                });
          
                $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $nametwo, 60);
          
                }
                else{
                    $nametwo='not-found.webp';
                }
                if ($request->hasfile('imagethree')) {
      
                    $rand = uniqid(CommonFx::make_slug(Str::limit($request->title, 40)));
                    $namethree = $rand . "." . 'webp';
                    $top = $request->imagethree->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $namethree);
              
                    $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $namethree)->resize(35, null, function ($constraint) {
                      $constraint->aspectRatio();
                    });
              
                    $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $namethree, 60);
              
                    }
                    else{
                        $namethree='not-found.webp';
                    }
                    if ($request->hasfile('imagefour')) {
      
                        $rand = uniqid(CommonFx::make_slug(Str::limit($request->title, 40)));
                        $namefour = $rand . "." . 'webp';
                        $top = $request->imagefour->move(storage_path('/app/files/shares/uploads/' . date('Y/m')), $namefour);
                  
                        $resizedImage_thumbs = Image::make(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . $namefour)->resize(35, null, function ($constraint) {
                          $constraint->aspectRatio();
                        });
                  
                        $resizedImage_thumbs->save(storage_path() . '/app/files/shares/uploads/' . date('Y/m/') . 'thumbs/' . $namefour, 60);
                  
                        }
                        else{
                            $namefour='not-found.webp';
                        }
            $customerinfo = Bikesale::create(array(
                'title' => $request->title,
                'slug' =>CommonFx::bnslug(CommonFx::make_slug($request->title.'-in-year-'.date('Y').'-for-sale-'.$request->cc.'cc-bike')),
                'user_id' => Auth::id(),
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
                'photoone' => $nameone,
                'phototwo' => $nametwo,
                'photothree' => $namethree,
                'photofour' => $namefour,
                 'status' => 'Pending',
                // 'photofive' => $nameone,
                'path' => date('Y/m'),
                
              ));
      
              if($customerinfo){
                $flasher->addSuccess('Post Create Successfully');
                return Redirect::to('user/dashboard'); 
              }

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
