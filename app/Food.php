<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Food extends Model
{
 
	protected $guarded = [];
	
	public function ingredient()
	{
		return $this->hasMany('App\Ingredient');
	}


	public function brand()
	{
		return $this->hasOne('App\Brand','id', 'brand_id');
	}  	
	
}