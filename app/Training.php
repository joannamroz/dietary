<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;

/**
 * 
 */
class Training extends Model
{
 
	// protected $guarded = [];
	protected $table = 'trainings';

	public function exercises()
	{
		// return $this->belongsToMany('App\Exercises', 'exercise_training', 'training_id', 'exercise_id');
		
		return $this->belongsToMany('App\Exercise', 'exercise_trainings')
					->withPivot('reps', 'series', 'duration')
					->withTimestamps();
	}

 	
}