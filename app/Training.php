<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Training extends Model
{
 
	// protected $guarded = [];
	
	public function exercises()
	{
		// return $this->belongsToMany('App\Exercises', 'exercise_training', 'training_id', 'exercise_id');
		
		return $this->belongsToMany('App\Exercises', 'exercise_training_template', 'training_template_id')
		->withPivot('num_of_exercises', 'num_of_series')
		->withTimestamps();
	}

 	
}