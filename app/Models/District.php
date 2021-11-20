<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class District extends Model
{
    protected $fillable = [
        'id','division_id','district','slug','bndistrict'
     ];
     
     public function division()
     {
         return $this->belongsTo('App\Models\Division');
     }
          public function thana()
    {
        return $this->hasMany('App\Models\Thana');
    }

    public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    }
}
