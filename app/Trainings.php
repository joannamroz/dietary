<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Trainings extends Model
{
 
	// protected $guarded = [];
	
	public function exercises()
	{
		// return $this->belongsToMany('App\Exercises', 'exercise_training', 'training_id', 'exercise_id');
		
		return $this->belongsToMany('App\Exercises', 'exercise_training')
		->withPivot('num_of_exercises', 'num_of_series')
		->withTimestamps();
	}

 	
}