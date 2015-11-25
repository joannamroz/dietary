<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Foods extends Model
{
 
	protected $guarded = [];
	
	public function ingredient()
	{
		return $this->hasMany('App\Ingredients');
	}


	public function brand()
	{
		return $this->hasOne('App\Brands','id', 'brand_id');
	}  	
 	
}