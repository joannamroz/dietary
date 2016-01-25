<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Exercises;
use App\Trainings;
use App\ExerciseTraining;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\TrainingFormRequest;
use App\Http\Requests\ExerciseTrainingFormRequest;

class TrainingController extends Controller
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
        if ($request->user()->is_user()) {

          return view('trainings.create');

        } else {
            
          return redirect('/exercise/index')->withErrors('You have not sufficient permissions for adding new exercises.');
        }
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
        $exercises = $request->get('exercise');
    
        $training = new Trainings(); 
        $training->name = $request->get('name');
        $training->user_id = $request->user()->id;
        $training->save();
        
        $message = "Training has been successfully added";


       return redirect('/exercise/index')->withMessage($message);
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
            
          return redirect('/training/userTraining')->withErrors('You have not sufficient permissions for adding new training.');
        }
    }

    // public function storeFutureTraining(ExerciseTrainingFormRequest $request)
    // {
    //     $exercises = $request->get('exercise');
    //     $user_id = Auth::user()->id;

    //     foreach($exercises as $exercise) {
            
    //         $exercise_training = new ExerciseTraining();
    //         $exercise_training->exercises_id = $exercise;
    //         $exercise_training->trainings_id = $request->get('training');
    //         $exercise_training->user_id = $user_id;
    //         $exercise_training->num_of_series = $request->get('num_of_series');
    //         $exercise_training->num_of_exercises = $request->get('num_of_exercises');
    //         $exercise_training->save();

    //     }

    //     $message = "Training has been successfully added";
    //    return redirect('/training/userTraining')->withMessage($message);
    // }
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

        // $trainings = Trainings::find(1)->exercises()->get();
        // var_dump($trainings);die();

        $trainings = Trainings::where('user_id', $user_id)->get();
        // var_dump($trainings);die();
       //  foreach ($trainings as $training) {
       //      foreach ($training->exercises as $value) {
       //         var_dump($value->pivot->num_of_exercises);
       //      }
       //  }
       // die();
        return view('trainings.userTraining')->with('trainings', $trainings);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $training = Trainings::where('id', $id)->first();
        
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
        $training = Trainings::find($training_id);

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
        $training = Trainings::find($id);

        if ($training && ($training->user_id == $request->user()->id || $request->user()->is_admin())) {

          $training->delete();
          $data['message'] = 'Training deleted Successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/exercise/index')->with($data);
    }
}
