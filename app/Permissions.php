<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Permissions extends Model {
 
	protected $guarded = [];
	public $timestamps = false;

	public function user() {

		return $this->belongsToMany('App\User','permissions', 'id', 'user_id');
	}

 	
}
