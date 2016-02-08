<?php

namespace App\Http\Controllers;


use Auth;
use Log;
use App\Exercises;
use App\TrainingTemplates;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ExerciseFormRequest;

class ExerciseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $exercises = Exercises::all();
        $trainings = TrainingTemplates::all();
        
        return view('exercises.index')->with('exercises', $exercises)->with('trainings', $trainings);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        if ($request->user()->is_user()) {

          return view('exercises.create');

        } else {
            
          return redirect('/exercise/index')->withErrors('You have not sufficient permissions for adding new exercises.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(ExerciseFormRequest $request)
    {
        $exercise = new Exercises(); 
        $exercise->name = $request->get('name');
        $exercise->description = $request->get('description');
        if (null !== $request->get('time')) {
           
          $exercise->time = 1;
        } else {
            
           $exercise->time = 0;
        }
        $exercise->user_id = $request->user()->id;
        $exercise->save();
        $message = "Exercise has been successfully added";

       return redirect('/exercise/index')->withMessage($message);
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id)
    {
        $exercise = Exercises::where('id', $id)->first();
        if ($exercise && ($request->user()->id == $exercise->user_id || $request->user()->is_admin()))
          return view('exercises.edit')->with('exercise', $exercise);
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
        $exercise_id = $request->input('exercise_id');
        $exercise = Exercises::find($exercise_id);
        if ($exercise && ($exercise->user_id == $request->user()->id || $request->user()->is_admin())) {

            $exercise->name = $request->input('name'); 
            $exercise->description = $request->input('description');   

          if ($request->has('save')) {

            $message = 'Exercise saved successfully';
            $landing = 'exercise/index';  
          }         
          
          $exercise->save();
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
        $exercise = Exercises::find($id);

        if ($exercise && ($exercise->user_id == $request->user()->id || $request->user()->is_admin())) {

          $exercise->delete();
          $data['message'] = 'Exercise deleted Successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/exercise/index')->with($data);
    }

    public function all()
    {

        if (!Auth::check()) {
            // The user is logged in...
            return redirect('auth/login');
        }

            $exercises = Exercises::all();
    
        return response()->json(array('success' => true, 'data'=> $exercises));

    }

}
