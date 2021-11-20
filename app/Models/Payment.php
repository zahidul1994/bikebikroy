<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Payment extends Model
{
  protected $fillable=['paymentname','note','status'];
  
  public function buysms()
    {
        return $this->hasMany('App\Models\Buysms');
    }
}
