<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Training;
use App\Exercise;
use App\Activity;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingFormRequest;
use App\Http\Requests\ExerciseTrainingFormRequest;
use App\Http\Requests\ActivityFormRequest;

use Carbon\Carbon;
class TrainingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {

        $date = new Carbon();
       //$date->modify('-24 hours');
       // $formatted_date = $date->format('Y-m-d H:i:s');


        //$training_done = Training::where('finished_at','>=',$formatted_date)->where('user_id', Auth::user()->id)->get();
        $training_done = Training::getTrainingsForDate($date);
        // print_r($training_done);die();

        return view('trainings.index')->with('training_done', $training_done);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
       // if ($request->user()->is_user()) {

            return view('trainings.create');

       // } else {
            
       //   return redirect('/exercise/index')->withErrors('You have not sufficient permissions for adding new exercises.');
       // }
    }

    public function createExerciseTraining(Request $request)
    {
        if ($request->user()->is_user()) {

          return view('trainings.createExerciseTraining');

        } else {
            
          return redirect('/exercise/index')->withErrors('You have not sufficient permissions for adding new training.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TrainingFormRequest $request)
    {

        $id = $request->get('id');
        
       

        $exercise_fields = ['exercise_id', 'reps', 'series', 'duration'];
        $exercise_data = [];

        $training = new Training();
        $training->user_id = Auth::user()->id;
        $training->save();

        foreach($exercise_fields as $field) {

            $data = $request->input($field);

            foreach ($data as $key => $value ) {
                $exercise_data[$key][$field] = $value;
            }
        }
        
        
        //dump($exercise_data);

        $user_id = Auth::user()->id;
        //array_walk($exercise_data, 'array_push', $training->id);
        foreach ($exercise_data as &$exercise) {
            $exercise['user_id'] = $user_id;
        }



       //   dd($exercise_training); die();
        $training->exercises()->attach($exercise_data);

            
      //      dd($exercise_data); die();



        return response()->json(array('success' => true, 'id'=>$id));
    }

    public function storeExerciseTraining(ExerciseTrainingFormRequest $request)
    {
        $exercises = $request->get('exercise');
        $user_id = Auth::user()->id;

        foreach($exercises as $exercise) {
            
            $exercise_training = new ExerciseTrainingTemplate();
            $exercise_training->exercises_id = $exercise;
            $exercise_training->trainings_id = $request->get('training');
            $exercise_training->user_id = $user_id;
            $exercise_training->num_of_series = $request->get('num_of_series');
            $exercise_training->num_of_exercises = $request->get('num_of_exercises');
            $exercise_training->save();

        }

        $message = "Training has been successfully added";
       return redirect('/training/userTraining')->withMessage($message);
    }

    
    public function futureTraining(Request $request)
    {
        if ($request->user()->is_user()) {

          return view('trainings.futureTraining');

        } else {
            
          return redirect('/training/userTraining')->withErrors('You have not sufficient permissions planning new training.');
        }
    }

    public function storeFutureTraining(ActivityFormRequest $request)
    {
        $user_id = Auth::user()->id;

        $activity = new Activity();
        $activity->training_id = $request->get('training');
        $activity->date = $request->get('date');
        $activity->user_id = $user_id;

        if (null !== $request->get('done')) {
           
          $activity->done = 1;
          $message = "Great job for finishing this training on ".$activity->date. "!";
        } else {
            
          $activity->done = 0;
          $message = "You have planed new activity for: ".$activity->date. "! Good luck!";
        }

        $activity->save();

       return redirect('/training/userTraining')->withMessage($message);
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }
    public function userTraining() {

        $user_id = Auth::user()->id;

        $trainings = TrainingTemplate::where('user_id', $user_id)->orderBy('created_at', 'desc')->limit(3)->get();


       // $activities = Activities::with('training')->where('user_id', $user_id)->get();
        // dd($activities);die();
        $activities = array();
        return view('trainings.userTraining')->with('trainings', $trainings)->with('activities', $activities);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $training = TrainingTemplate::where('id', $id)->first();
        
        if ($training && ($request->user()->id == $training->user_id || $request->user()->is_admin()))
          return view('trainings.edit')->with('training', $training);
        return redirect('/exercise/index')->withErrors('You have not sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $training_id = $request->input('training_id');
        $training = TrainingTemplate::find($training_id);

        if ($training && ($training->user_id == $request->user()->id || $request->user()->is_admin())) {

            $training->name = $request->input('name');  

          if ($request->has('save')) {

            $message = 'Training saved successfully';
            $landing = 'exercise/index';  
          }         
          
          $training->save();
            return redirect($landing)->withMessage($message);
        } else {

          return redirect('/exercise/index')->withErrors('You have not sufficient permissions');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id)
    {
        $training = TrainingTemplate::find($id);

        if ($training && ($training->user_id == $request->user()->id || $request->user()->is_admin())) {

          $training->delete();
          $data['message'] = 'Training deleted Successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/exercise/index')->with($data);
    }
}
