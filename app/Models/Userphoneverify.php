<?php

namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Userphoneverify extends Model
{

 protected $fillable = ['user_id',
 'username','phonenumber','otp','expiredate','status' ];

}
