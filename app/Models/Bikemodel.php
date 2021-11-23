<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Bikemodel extends Model
{
    use HasFactory;
    public function bikebrand()
    {
        return $this->belongsTo('App\Models\Bikebrand');
    }
}
