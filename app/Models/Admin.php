<?php
namespace App\Models;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
use App\Notifications\AdminResetPasswordNotification;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //for use mongodb
class Admin extends  Authenticatable implements MustVerifyEmail
{
 use Notifiable;
     
     use SoftDeletes;
     protected $guard = 'admin';
   
    protected $dates = ['deleted_at'];
    // protected $connection = 'mongodb';

    protected $fillable = [
      'email_verified_at', 'superadmin_id','phone','name','image', 'email', 'password','status','gender','remember_token','company','package','web','otp','country','address','actype','customerprefix','id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    public function user()
    {
        return $this->hasMany('App\Models\User');
    } 
   
    public function complain()
    {
        return $this->hasMany('App\Models\Complain');
    }
     public function medicineinformation()
    {
        return $this->hasMany('App\Models\Medicineinformation');
    }
    public function collection()
    {
        return $this->hasMany('App\Models\Collection');
    } 
      public function customer()
    {
        return $this->hasMany('App\Models\Customer');
    } 
     public function smssent()
    {
        return $this->hasMany('App\Models\Smssent');
    }
    public function buysms()
    {
        return $this->hasMany('App\Models\Buysms');
    }
    public function paybill()
{
	return $this->hasMany('App\Models\Paybill');
}
      protected $casts = [
        'email_verified_at' => 'datetime',
    ];
        public function sendPasswordResetNotification($token)
        {
            $this->notify(new AdminResetPasswordNotification($token));
        }
       
    }