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
          'Customer-List',
          'Customer-Create',
          'Customer-Edit',
          'Customer-Delete', 
        'Collection-List',
        'Collection-Create',
        'Collection-Edit',
        'Collection-Delete', 
          'SMS-List',
          'SMS-Create',
          'SMS-Edit',
          'SMS-Delete', 
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
            $newlist->guard_name ='admin';
            $newlist->name =$v;
            $newlist->save();
        }
    }
}