<?php
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model; //for use mongodb

class Bikesale extends Model
{
  protected $fillable=['title','slug','user_id','price','negotiable','slider','topadd','urgentsale','biketype','bikebrand_id','bikemodel_id','admin_id','manager_id','division_id','district_id','thana_id','condition','edition','year','kilometerrun','manufacture','cc','description','photoone','phototwo','photothree','photofour','photofive','phonenumber','expiredate','topaddexpire','bumpaddexpire','urgentexpire','spotlightexpire','view','admincomment','managercomment','metadescription','screma','keyword','managersatus','status','path'];

	protected $casts = [
		'created_at' => 'datetime:M d Y',
	];
}
