<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Country extends Model
{
  protected $fillable=[
      'countryname'
  ];
  public function division()
  {
      return $this->hasMany('App\Models\Division');
  }
}
