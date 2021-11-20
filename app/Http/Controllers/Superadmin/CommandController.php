<?php

namespace App\Http\Controllers\Superadmin;

use config;
use App\Models\Blog;
use App\Models\Thana;
use App\Models\Country;
use App\Models\District;
use App\Models\Division;
use App\Models\Medicine;
use App\Helpers\CommonFx;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Medicineinformation;
use Flasher\Prime\FlasherInterface;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Database\Seeders\PermissionSeeder;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;
use Spatie\Backup\BackupDestination\BackupCollection;



class CommandController extends Controller
{
    public function index(){
        $pageConfigs = ['navbarLarge' => false];
        
       return view('superadmin.command.index',['pageConfigs' => $pageConfigs]);
    }
public function cacheclear (FlasherInterface $flasher) {
            
        Artisan::call('view:clear');
        Artisan::call('cache:clear');
       
        $flasher->addSuccess('All Cache Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function databasecacheclear (FlasherInterface $flasher) {
   
    Cache::flush();
       
        $flasher->addSuccess('All Database Cache Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function databasebackupclear (FlasherInterface $flasher) {
    Artisan::call('backup:clean');
      
        $flasher->addSuccess('All Backup Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function routerclear (FlasherInterface $flasher) {
    Artisan::call('route:clear');
      
        $flasher->addSuccess('All Router Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function queueclear (FlasherInterface $flasher) {
    Artisan::call('queue:clear');
     
        $flasher->addSuccess('All Queue Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function eventclear (FlasherInterface $flasher) {
    Artisan::call('event:clear');
     
        $flasher->addSuccess('All Event Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function telescopeclear (FlasherInterface $flasher) {
   // Artisan::call('sitemonitor:clear');
 
   DB::table('telescope_entries')->delete();
      DB::table('telescope_entries_tags')->delete();
        DB::table('telescope_monitoring')->delete();
   
     
        $flasher->addSuccess('All Telescope Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function configclear (FlasherInterface $flasher) {
    Artisan::call('config:clear');
    $flasher->addSuccess('All Config Data Clear');
        return Redirect::to('superadmin/commandlist');
       
}
public function cacheall (FlasherInterface $flasher) {
    Artisan::call('view:cache');
  Artisan::call('config:cache');
       Artisan::call('event:cache');
     Artisan::call('route:cache');
 
    $flasher->addError('All Cache');
    return Redirect::to('superadmin/commandlist');
   
}

public function databckup (FlasherInterface $flasher) {
      Artisan::call('backup:run --only-db');
    $flasher->addSuccess('All Databckup');
    return Redirect::to('superadmin/commandlist');
   

}
public function queuework (FlasherInterface $flasher) {
      Artisan::call('queue:work');
 
   $flasher->addSuccess('All Queuework Start');
    return Redirect::to('superadmin/commandlist');
   
}

public function migratedata (FlasherInterface $flasher) {
    Artisan::call('migrate',
 array(
   '--path' => 'database/migrations',
   '--database' => 'mysql',
   '--force' => true));

 $flasher->addSuccess('All Migrate Work');
  return Redirect::to('superadmin/commandlist');
 
}
public function dbseeder(FlasherInterface $flasher){
    Artisan::call('db:seed', [
        '--class' => PermissionSeeder::class
    ]);
   
    $flasher->addSuccess('All Seeding Work');
  return Redirect::to('superadmin/commandlist');
}


public function addcountry(FlasherInterface $flasher){
    $country=CommonFx::Country();
  
    foreach( $country as $can ){
      $list = new Country();
            $list->countryname =$can;
             $list->save();
        

    }
    $flasher->addSuccess('All Country Create Successfully');
  return Redirect::to('superadmin/autolocation');
}
public function adddivision(FlasherInterface $flasher){
    $info = Http::get('https://bdapis.herokuapp.com/api/v1.1/divisions');
    $datas = $info->json();
foreach (($datas['data']) as $user) {
        // dd( $user['_id']);
           Division::create(['division' => $user['division'],
           'slug' => $user['_id'],
           'country_id' => '61988ae26e6b0000eb0040e2',
            'bndivision' => $user['divisionbn'],
                    
        ]);
            } 
      
    $flasher->addSuccess('All Division Create Successfully');
  return Redirect::to('superadmin/autolocation');
}

public function adddistrict($id,FlasherInterface $flasher){
    $info = Http::get('https://bdapis.herokuapp.com/api/v1.1/division/'.$id);
    $getdivision=Division::whereslug($id)->first();
    if($getdivision){

 
    $datas = $info->json();
   // dd($datas['data']);
   
foreach (($datas['data']) as $user) {
        // dd( $user['_id']);
         $district=  District::create(['division_id' => $getdivision['_id'],
           'slug' => CommonFx::make_slug($user['district']),
           'district' =>$user['district'],
           'bndistrict' => CommonFx::make_slug($user['district']),
          
        ]);
if($district){

    foreach (($user['upazilla']) as $u) {
    Thana::create(['district_id' => $district['_id'],
    'slug' => CommonFx::make_slug($u),
    'thana' =>$u,
    'bnthana' => CommonFx::make_slug($u),
]);
}
}
            } 
      
    $flasher->addSuccess('Division District Area Create Successfully');
  return Redirect::to('superadmin/autolocation');
}
else{
    $flasher->addSuccess('Sorry  Divison Info Not found');
    return Redirect::to('superadmin/autolocation');
}
}
public function dropalldata(FlasherInterface $flasher){
 Country::truncate();
 Division::truncate();
 District::truncate();
 Thana::truncate();
      

  
  $flasher->addSuccess('All Location Data Delete  Successfully');
return Redirect::to('superadmin/autolocation');
}
}
