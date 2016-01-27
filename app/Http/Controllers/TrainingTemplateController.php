<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Exercises;
use App\TrainingTemplates;
use App\ExerciseTraining;
use App\Activities;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingFormRequest;
use App\Http\Requests\ExerciseTrainingFormRequest;
use App\Http\Requests\ActivityFormRequest;


class TrainingTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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


       // var_dump('here'); die();
       //  $exercises = $request->get('exercise');
        $id = $request->get('id');
       // var_dump($id); die();
        
        // If id exists ( TrainingTemplate exists)
        if ($id) {
            $training_template =  TrainingTemplates::find($id); 
        } else {
            //If its first time its saved
            $training_template = new TrainingTemplates(); 
            $training_template->user_id = $request->user()->id;
        }

        $training_template->name = $request->get('name');
       
        $training_template->save();
        
      //  $message = "Training has been successfully added";
        

        $id = $training_template->id;
       //return redirect('/exercise/index')->withMessage($message);
       // var_dump($id); die();
        return response()->json(array('success' => true, 'id'=>$id));
    }

    public function storeExerciseTraining(ExerciseTrainingFormRequest $request)
    {
        $exercises = $request->get('exercise');
        $user_id = Auth::user()->id;

        foreach($exercises as $exercise) {
            
            $exercise_training = new ExerciseTraining();
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

        $activity = new Activities();
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
        $trainings = TrainingTemplates::where('user_id', $user_id)->orderBy('created_at', 'desc')->limit(3)->get();

        $activities = Activities::with('training')->where('user_id', $user_id)->get();
        // dd($activities);die();
    
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
        $training = TrainingTemplates::where('id', $id)->first();
        
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
        $training = TrainingTemplates::find($training_id);

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
        $training = TrainingTemplates::find($id);

        if ($training && ($training->user_id == $request->user()->id || $request->user()->is_admin())) {

          $training->delete();
          $data['message'] = 'Training deleted Successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/exercise/index')->with($data);
    }
}
