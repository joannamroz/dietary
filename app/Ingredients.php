<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Ingredients extends Model
{
 
  //restricts columns from modifying
  protected $guarded = [];
 
  public function ingredient()
  {
    return $this->hasOne('App\Foods', 'id', 'ingredient_id');
  }  	
 	
}