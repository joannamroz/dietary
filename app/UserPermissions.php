<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class UserPermissions extends Model {
 
	protected $guarded = [];
	
	public $timestamps = false;

	public function user() {

		return $this->belongsToMany('App\User','user_permissions', 'id', 'user_id');
	}

 	
}
