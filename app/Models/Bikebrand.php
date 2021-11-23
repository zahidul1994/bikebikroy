<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Bikebrand extends Model
{
    use HasFactory;
    public function bikemodel()
    {
        return $this->hasMany('App\Models\Bikemodel');
    }
}
