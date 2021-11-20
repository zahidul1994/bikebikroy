<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Payby extends Model
{
    protected $fillable=[
        'admin_id',
        'user_id',
        'paybyname',
        'description'
        
    ];

    public function collection()
    {
        return $this->hasOne('App\Models\Collection');
    }
    public function paybill()
    {
        return $this->hasOne('App\Models\Paybill');
    }
}
