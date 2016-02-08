<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Exercises extends Model
{
 
 	// public $type = [
 	// 	0 = > 'Measured in reps',
 	// 	1  => 'Measured with time'
 	// ];
	// protected $guarded = [];
	
	public function trainings()
	{
		return $this->belongsToMany('App\TrainingTemplates', 'exercise_trainingTemplate')
		->withPivot('description', 'num_of_exercises', 'num_of_series')
		->withTimestamps();

	}

 	
}