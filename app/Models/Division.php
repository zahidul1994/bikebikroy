<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Division extends Model
{
    protected $fillable = [
       'slug','division','bndivision','country_id'
    ];
    public function country()
    {
        return $this->belongsTo('App\Models\Country');
    }
    public function district()
    {
        return $this->hasMany('App\Models\District');
    }
}
