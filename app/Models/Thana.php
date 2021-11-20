<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Thana extends Model
{
    protected $fillable = [
        'id','district_id','thana','created_at','bnthana','slug'
     ];
     
     
     
          public function district()
    {
        return $this->belongsTo('App\Models\District');
    }
    
    public function area()
    {
        return $this->hasMany('App\Models\Area');
    }
    public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    }
    
}
