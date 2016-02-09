<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
/**
 * This class probably does not make sense, should be just exercise
 */
class Activity extends Model
{
 
 
  protected $guarded = [];

  public function training()
	{
		
		return $this->belongsTo('App\TrainingTemplates','training_id', 'id');

	}

}