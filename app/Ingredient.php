<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Ingredient extends Model
{
 
  //restricts columns from modifying
  protected $guarded = [];
 
  public function ingredient()
  {
    return $this->hasOne('App\Food', 'id', 'ingredient_id');
  }  	
 	
}