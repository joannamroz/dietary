<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Exercises extends Model
{
 
	// protected $guarded = [];
	
	public function trainings()
	{
		return $this->belongsToMany('App\Trainings', 'exercise_training')
		->withPivot('description', 'num_of_exercises', 'num_of_series')
		->withTimestamps();

	}

 	
}