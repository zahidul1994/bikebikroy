<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Setting extends Model
{
    protected $fillable = ['defaultuserpackage_id',
 'defaultpostnumber','','','','' ];
}
