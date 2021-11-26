<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use UniSharp\LaravelFilemanager\Lfm;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LanguageController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::group(['prefix'=> 'filemanager', 'middleware'=> ['auth:superadmin,admin']], function () {
    \UniSharp\LaravelFilemanager\Lfm::routes();
}

);

Route::get('/', function () {
    return view('welcome');
});
Route::get('/login/{social}','Auth\LoginController@socialLogin')->where('social','twitter|facebook|linkedin|google|github|bitbucket');

Route::get('/login/{social}/callback','Auth\LoginController@handleProviderCallback')->where('social','twitter|facebook|linkedin|google|github|bitbucket');
//gobal location 
Route::get('/location', 'OnchangeController@index');
Route::get('getdistrict/{id}', 'OnchangeController@district');
Route::get('getthana/{id}', 'OnchangeController@thana');
Route::get('getarea/{id}', 'OnchangeController@area');
Route::get('gettpackageinfo/{id}', 'OnchangeController@package');
Route::get('getbikebrand/{id}', 'OnchangeController@getbikebrand');
Route::get('getcustomerinfo', 'OnchangeController@customerinfo');
Route::get('gettsmstypeinfo/{id}', 'OnchangeController@smstype');
Route::get('getpaymentmessage/{id}', 'OnchangeController@payment');
Route::get('getadminpaybyinfo/{id}', 'OnchangeController@adminpaybyinfo');

Route::get('/login/admin', 'Auth\LoginController@showAdminLoginForm');
Route::get('/admin/verificationlink/{id}', 'Auth\LoginController@showEmailveirfyForm');
Route::get('/admin/verificationphone/{id}', 'Auth\LoginController@showOTPveirfyForm');
Route::post('/admin/adminverifyphone', 'Auth\LoginController@adminverifyphone');
Route::post('/admin/adminverifyemail', 'Auth\LoginController@adminverifyemail');

Route::get('/login/superadmin', 'Auth\LoginController@showSuperadminLoginForm');
Route::get('/register/admin', 'Auth\RegisterController@showAdminRegisterForm');


Route::post('/login/admin', 'Auth\LoginController@adminLogin');
Route::get('/login/user', 'Auth\LoginController@showLoginuserForm');
Route::post('/login/user', 'Auth\LoginController@UserLogin');
Route::post('/login/superadmin', 'Auth\LoginController@superadminLogin');
Route::post('/register/admin', 'Auth\RegisterController@createAdmin');



Route::group([ 'prefix'=>'superadmin',
    'namespace'=>'Superadmin',
    'middleware'=> 'auth:superadmin'

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('importcustomer', 'DashboardController@impotercustomer');
        Route::post('impotercustomer', 'DashboardController@customerimporter');
        Route::post('deletenotification', 'DashboardController@deletenotification');
        Route::post('seennotification', 'DashboardController@seennotification');
        Route::get('autolocation','DashboardController@autolocation');


  //package  Start
  Route::get('packagelist','PackageController@index');
   Route::post('createpackage','PackageController@store');
  Route::get('editpackage/{id}','PackageController@edit');
  Route::put('updatepackage/{id}','PackageController@update');
  Route::delete('deletepackage/{id}','PackageController@destroy');
  //package End


  //AccountPermission Start
  Route::get('permissionlist','PermissionController@index');
  Route::post('permissionsearch','PermissionController@permissionsearch');
  Route::get('createpermission','PermissionController@create');
  Route::post('createpermission','PermissionController@store');
  Route::get('editpermission/{id}','PermissionController@edit');
  Route::patch('updatepermission/{id}','PermissionController@update');
  Route::delete('deletepermission/{id}','PermissionController@destroy');
  //AccountPermission End

   //AccountRole Start
   Route::get('rolelist','RoleController@index');
   Route::get('rolesearch','RoleController@rolesearch');
    Route::post('createtrole','RoleController@store');
   Route::post('allpermissionlist','RoleController@allpermissionlist');
   Route::get('editaccountrole/{id}','RoleController@edit');
   Route::get('showrolepermission/{id}','RoleController@show');
   Route::put('updateaccountrole/{id}','RoleController@update');
   Route::delete('deleterole/{id}','RoleController@destroy');
   //AccountRole End

  
   //Accountcreate Start
   Route::get('adminlist','AdminController@index');
   Route::post('searchadmin','AdminController@adminsearch');
   Route::post('allrolename','AdminController@allrolename');
   Route::get('createadmin','AdminController@create');
   Route::post('createadmin','AdminController@store');
   Route::get('editadmin/{id}','AdminController@edit');
   Route::put('updateadmin/{id}','AdminController@update');
  Route::delete('deleteadmin/{id}','AdminController@destroy');
  Route::post('adminstatus', 'AdminController@setapproval'); 
   //Accountcreate  End


//smssettinglist Start 

Route::get('smssettinglist','SmsController@index');
Route::get('editsmssetting/{id}','SmsController@edit');
 Route::patch('updatesmssetting/{id}','SmsController@update');
Route::post('searchsmssetting', 'SmsController@searchmedicine');
Route::get('smstypelist', 'SmsController@smstype');
Route::get('createsmstype', 'SmsController@createsmstype');
Route::post('createsmstype', 'SmsController@smstypestore');
Route::get('editsmstype/{id}', 'SmsController@editsmstype');
Route::patch('updatesmstype/{id}', 'SmsController@smstypeupdate');

//smssettinglist  End

//salesms Start 

Route::get('salesmslist','BuysmsController@index');
Route::get('createsalesms','BuysmsController@create');
Route::post('createsalesms','BuysmsController@store');
Route::get('editsalesms/{id}','BuysmsController@edit');
Route::patch('updatesalesms/{id}','BuysmsController@update');
Route::post('searchsalesms', 'BuysmsController@searchmedicine');
Route::post('aprovesalesms/{id}', 'BuysmsController@setapproval');
Route::delete('deletesalesms/{id}','BuysmsController@destroy');
//smssettinglist  End

//payment Start 

Route::get('paymentlist','PaymentController@index');
Route::get('createpayment','PaymentController@create');
Route::post('createpayment','PaymentController@store');
Route::get('editpayment/{id}','PaymentController@edit');
 Route::patch('updatepayment/{id}','PaymentController@update');
 Route::delete('deletepayment/{id}','PaymentController@destroy');

//payment  End


//countryy
Route::get('countrylist','CountryController@index');
Route::post('searchcountry','CountryController@search');
Route::get('createcountry','CountryController@create');
Route::post('createcountry','CountryController@store');
Route::get('editcountry/{id}','CountryController@edit');
 Route::patch('updatecountry/{id}','CountryController@update');
 Route::delete('deletecountry/{id}','CountryController@destroy');
//Division Start 

 
 
 Route::get('divisionlist','DivisionController@index');
 Route::post('createdivision','DivisionController@store');
Route::get('editdivision/{id}','DivisionController@edit');
 Route::put('updatedivision/{id}','DivisionController@update');
 Route::delete('deletedivision/{id}','DivisionController@destroy');


//Division  End

//district Start 

Route::get('districtlist','DistrictController@index');
Route::post('searchdistrict','DistrictController@search');
Route::get('createdistrict','DistrictController@create');
Route::post('createdistrict','DistrictController@store');
Route::get('editdistrict/{id}','DistrictController@edit');
 Route::patch('updatedistrict/{id}','DistrictController@update');
 Route::delete('deletedistrict/{id}','DistrictController@destroy');


//district  End


//Thana Start 

Route::get('thanalist','ThanaController@index');
Route::post('createthana','ThanaController@store');
Route::get('editthana/{id}','ThanaController@edit');
 Route::patch('updatethana/{id}','ThanaController@update');
 Route::delete('deletethana/{id}','ThanaController@destroy');


//Thana  End

//bikebrandlist Start 

Route::get('bikebrandlist','BikebrandController@index');
Route::post('createbikebrand','BikebrandController@store');
Route::get('editbikebrand/{id}','BikebrandController@edit');
 Route::patch('updatebikebrand/{id}','BikebrandController@update');
 Route::delete('deletebikebrand/{id}','BikebrandController@destroy');


//bikebrandlist  End


//bikemodellist Start 

Route::get('bikemodellist','BikemodelController@index');
Route::post('createbikemodel','BikemodelController@store');
Route::get('editbikemodel/{id}','BikemodelController@edit');
 Route::patch('updatebikemodel/{id}','BikemodelController@update');
 Route::delete('deletebikemodel/{id}','BikemodelController@destroy');


//bikemodel  End

//Sitemap Start 

 
 Route::get('addcountry','CommandController@addcountry');
 Route::get('adddivision','CommandController@adddivision');
 Route::get('adddistrict/{id}','CommandController@adddistrict');
 Route::get('dropalldata','CommandController@dropalldata');
 Route::get('commandlist','CommandController@index');
 Route::get('cacheclear','CommandController@cacheclear');
 Route::get('databasebackupclear','CommandController@databasebackupclear');
 Route::get('routerclear','CommandController@routerclear');
 Route::get('queueclear','CommandController@queueclear');
 Route::get('eventclear','CommandController@eventclear');
 Route::get('telescopeclear','CommandController@telescopeclear');
 Route::get('configclear','CommandController@configclear');
 Route::get('cache','CommandController@cacheall');
  Route::get('databasecacheclear','CommandController@databasecacheclear');
 Route::get('dbseeder','CommandController@dbseeder');
 Route::get('databckup','CommandController@databckup');
 Route::get('queuework','CommandController@queuework');
 Route::get('migratedata','CommandController@migratedata');
 Route::get('blogsitemap','SitemapController@blogsitemapgenerate');
 Route::get('allsitemap','SitemapController@allsitemap');


//Sitemap  End

//Contact Start 


// Route::get('emaillist','ContactController@index');
// Route::get('createemail','ContactController@create');
// Route::post('fdgfcreateblog','ContactController@store');
// Route::get('replymail/{id}','ContactController@edit');
// Route::post('replyemail','ContactController@store');


//Contact  End



//Customer Start
Route::get('customerlist','CustomerController@index');
Route::get('pendingcustomerlist','CustomerController@pendingcustomer');
Route::get('createcustomer','CustomerController@create');
Route::post('createcustomer','CustomerController@store');
Route::get('editcustomer/{id}','CustomerController@edit');
Route::get('customerprofile/{id}','CustomerController@show');
 Route::patch('updatecustomer/{id}','CustomerController@update');
 Route::delete('deletecustomer/{id}','CustomerController@destroy');
Route::post('customerstatus', 'CustomerController@setapproval');
Route::post('searchcustomer', 'CustomerController@searchmedicine');
Route::get('findbill/{id}','CustomerController@findbill');
Route::post('updatebillcustomer','CustomerController@updatebillcustomer');
Route::get('inactivecustomer','CustomerController@inactivecustomer');
Route::get('inactivecustomerfind','CustomerController@findinactivecustomer');
Route::get('restorecustomer/{id}','CustomerController@restorecustomer');
Route::post('sendsmscustomer','CustomerController@sendsmscustomer');

//Customer  End

    }

);
Route::group([ 'prefix'=>'admin',
    'namespace'=>'Admin',
    'middleware'=> 'auth:admin'

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('addposting', 'DashboardController@addpostingview');
        Route::get('profile', 'UserController@index');
        Route::post('searchphonenumber', 'UserController@searchphonenumber');
        Route::put('updateemail', 'UserController@updateemail');
        Route::patch('updateprofileinfo', 'UserController@updateprofileinfo');
        Route::post('deletenotification', 'DashboardController@deletenotification');
        Route::post('seennotification', 'DashboardController@seennotification');
        Route::get('autolocation','DashboardController@autolocation');
        //add sale
        Route::resource('bikesale', 'BikesaleController');

    }

);
Route::get('login','Auth\Lof@index');
Route::post('login', 'Auth\LoginController@UserLogin');
Route::get('login', 'Auth\LoginController@customloginForm');
Route::get('register', 'Auth\LoginController@customregisterForm');
Route::post('userregister', 'Auth\RegisterController@create');
Route::get('otpverify/{id}', 'Auth\LoginController@showOTPveirfyForm');
Route::post('userotpverify', 'Auth\LoginController@userotpverify');
Route::group([ 'prefix'=>'user',
    'namespace'=>'User',
    'middleware'=> 'auth'

    ], function() {
        Route::get('dashboard', 'DashboardController@index');
        Route::get('addposting', 'DashboardController@addpostingview');
        Route::get('profile', 'UserController@index');
        Route::post('searchphonenumber', 'UserController@searchphonenumber');
        Route::put('updateemail', 'UserController@updateemail');
        Route::patch('updateprofileinfo', 'UserController@updateprofileinfo');
        Route::post('deletenotification', 'DashboardController@deletenotification');
        Route::post('seennotification', 'DashboardController@seennotification');
        Route::get('autolocation','DashboardController@autolocation');
        //add sale
        Route::resource('bikesale', 'BikesaleController');

    }

);
