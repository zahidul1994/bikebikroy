<?php
namespace Database\Seeders;
use App\Models\Permissions;
use Illuminate\Database\Seeder;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permission=array(
          'Register-List',
          'Register-Create',
          'Register-Edit',
          'Register-Delete', 
          'Bikesale-List',
          'Bikesale-Create',
          'Bikesale-Edit',
          'Bikesale-Delete', 
          'Bikebuy-List',
          'Bikebuy-Create',
          'Bikebuy-Edit',
          'Bikebuy-Delete', 
          'Print-List',
        'Print-Create',
        'Print-Edit',
        'Print-Delete', 
         'Complain-List',
        'Complain-Create',
        'Complain-Edit',
        'Complain-Delete',  

        
        );
        foreach($permission as $v) {
            $newlist  = new Permissions();
              $newlist->guard_name ='superadmin';
            $newlist->name =$v;
            $newlist->save();
        }
    }
}