<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;

class Activities extends Model
{
 
 
  protected $guarded = [];

  public function training()
	{
		
		return $this->belongsTo('App\TrainingTemplates','training_id', 'id');

	}

}