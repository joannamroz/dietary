<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;

/**
 * This class may be later used as Template for Trainings and Challanges
 */
class Template extends Model
{
 
	// protected $guarded = [];
	protected $table = 'training_templates';
	
	public function exercises()
	{
		// return $this->belongsToMany('App\Exercises', 'exercise_training', 'training_id', 'exercise_id');
		
		return $this->belongsToMany('App\Exercise', 'exercise_training_template', 'training_template_id')
		->withPivot('num_of_exercises', 'num_of_series')
		->withTimestamps();
	}

 	
}