<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Training;
use App\Exercise;
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
    
        $training_done = Training::getTrainingsForDate($date);

        return view('trainings.index')->with('training_done', $training_done);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
     
        return view('trainings.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(TrainingFormRequest $request)
    {


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
      

        $user_id = Auth::user()->id;
       
        foreach ($exercise_data as &$exercise) {
            $exercise['user_id'] = $user_id;
        }

        $training->exercises()->attach($exercise_data);

        return response()->json(array('success' => true));
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id)
    {
        $training = Training::where('id', $id)->first();
        // print_r($training);die();
        return view('exercises.show')->with('training', $training);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $training = Training::where('id', $id)->first();
        
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
        $training = Training::find($training_id);

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
    // public function destroy(Request $request, $id)
    // {
    //     $training = TrainingTemplate::find($id);

    //     if ($training && ($training->user_id == $request->user()->id || $request->user()->is_admin())) {

    //       $training->delete();
    //       $data['message'] = 'Training deleted Successfully';

    //     } else  {

    //       $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
    //     }
        
    //     return redirect('/exercise/index')->with($data);
    // }
}
