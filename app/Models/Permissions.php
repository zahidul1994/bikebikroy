<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Permissions extends Model
{
    protected $fillable = [
      'guard_name',  'name', 
    ];
    
}
