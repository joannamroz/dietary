<?php 
namespace App;
 
use Auth;

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

	public static function getTrainingsForDate($date) {

		$start = $date->startOfDay()->toDateTimeString();
		$end = $date->endOfDay()->toDateTimeString();
		
		$trainings = Training::where('finished_at','>=', $start )
						->where('finished_at', '<=', $end )
						->where('user_id', Auth::user()->id)->get();


		return $trainings;
	}

 	
}