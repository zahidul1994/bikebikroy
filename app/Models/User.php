<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent; //for use mongodb
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Jenssegers\Mongodb\Auth\User as Authenticatable;
class User extends Authenticatable 
{
    use Notifiable;
    use SoftDeletes;
    use HasRoles;
 
        protected $dates = ['deleted_at'];
       
		//   protected $guard_name = 'admin';
        protected $fillable = ['admin_id',
            'username','phone','email','image','remember_token','status','password','id' ];

        protected $hidden = [
            'password', 'remember_token',
        ];
        public function gender(){
            return $this->belongsTo('App\Gender');
        }
         public function admin(){
            return $this->belongsTo('App\Models\Admin','admin_id','id');
        }
        public function collection()
        {
            return $this->hasMany('App\Models\Collection');
        } 
     
     
        public function status(){
            return $this->belongsTo('App\Models\Status');
        }
        
        public function accounttype()
        {
            return $this->belongsTo('App\Models\Accounttype');
        }
     
        public function userreview(){
            return $this->hasOne('App\Models\Userreview');
            }
               public function todotaskuser(){
            return $this->hasOne('App\Models\Todotaskuser');
            }
        
        protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    
}