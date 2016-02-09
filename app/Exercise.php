<?php 
namespace App;
 
use Illuminate\Database\Eloquent\Model;
 
class Exercise extends Model
{
 
 	// public $type = [
 	// 	0 = > 'Measured in reps',
 	// 	1  => 'Measured with time'
 	// ];
	// protected $guarded = [];
	protected $fillable = ['reps', 'series', 'duration'];	

	public function trainings()
	{
		return $this->belongsToMany('App\Training')
		->withPivot('description', 'reps', 'series')
		->withTimestamps();

	}

	public function training_templates()
	{
		return $this->belongsToMany('App\TrainingTemplates', 'exercise_trainingTemplate')
		->withPivot('description', 'num_of_exercises', 'series')
		->withTimestamps();

	}
}