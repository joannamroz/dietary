<?php

namespace App\Http\Controllers;
use Log;
use App\Measurement;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MeasurementFormRequest;
 
use Illuminate\Http\Request;

class MeasurementsController extends Controller
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

    if ($request->user()->can_add_meal) {

      return view('user.profile');

    } else {

      return redirect('/food/index')->withErrors('You do not have sufficient permissions for adding new measure.');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(MeasurementFormRequest $request)
  {
  
    $measure = new Measurement();
    $measure->weight = $request->get('weight');
    $measure->date=$request->get('date');
    $measure->height = $request->get('height');
    $measure->body_fat = $request->get('body_fat');
    $measure->water = $request->get('water');
    $measure->muscle = $request->get('muscle');
    $measure->bmi = $request->get('bmi');
    $measure->internal_fat = $request->get('internal_fat');
    $measure->waist = $request->get('waist');
    $measure->chest = $request->get('chest');
    $measure->neck = $request->get('neck');
    $measure->hips = $request->get('hips');
    $measure->biceps = $request->get('biceps'); 
    $measure->bust = $request->get('bust');  
    $measure->thigh = $request->get('thigh');  
    $measure->upper_arm = $request->get('upper_arm');  
    $measure->comment = $request->get('comment');  
    $measure->user_id = $request->user()->id;

    $measure->save();
    $message = "Measure has been successfully added";
    
   return redirect('user/profile/'.$request->user()->id)->withMessage($message);
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
  public function edit($id)
  {
     
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update($id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function destroy(Request $request, $id)
  {
    $measure = Measurement::find($id);

    if ($measure && ($measure->user_id == $request->user()->id || $request->user()->is_admin())) {

      $measure->delete();
      $data['message'] = 'Deleted successfully';

    } else  {

      $data['errors'] = 'Invalid Operation. You do not have sufficient permissions';
    }
    
    return redirect('user/profile/'.$request->user()->id)->with($data);
  }
}
