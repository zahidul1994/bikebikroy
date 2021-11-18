<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb
class Package extends Model
{
  
    protected $fillable=[
        'superadmin_id',
        'packagename',
        'packageprice',
        'expiryday',
        'description',
         'status',
    ];

    
    public function customer()
    {
        return $this->hasOne('App\Models\Customer');
    }
}
