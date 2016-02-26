<?php
namespace App\Http\Controllers;
use Log;
use Auth;
use App\User;
use App\Food;
use App\Brand;
use App\Task;
use App\UserPermission;
use App\Measurement;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
use App\Http\Requests\TaskFormRequest;
use Carbon\Carbon;
 
use Illuminate\Http\Request;

class UsersController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */

  public function __construct()
  {

    $this->middleware('auth');
  }

 
  public function profile(Request $request)
  {

    $sessionId = $request->user()->id ;
    $userData = User::where('id', $sessionId)->first();
    $title = 'Your profile';
    $userMeasure = Measurement::where('user_id', $sessionId)->orderBy('date', 'desc')->get();
    $age = $userData->getUserAge();   
    $tasks = Task::where('user_id', $sessionId)->orderBy('created_at', 'desc')->get();
    $now = $now = Carbon::now();
    // var_dump($tasks);die();

    if (!$userMeasure->count()) {

      return view('users.profile')->with('userData', $userData)->with('title', $title)->with('age', $age);
    }

    $userMeasureData = $userMeasure->toArray();

    $numberOfMeasurements = count($userMeasureData);

    for ($i = 0; $i < $numberOfMeasurements-1; $i++) {
 
      foreach($userMeasureData[$i] as $key => $value) {
    
        if($value > $userMeasureData[$i+1][$key ]) {
          $userMeasureData[$i][$key.'_class'] = 'up';
        } elseif ($value == $userMeasureData[$i+1][$key ]) {
           $userMeasureData[$i][$key.'_class'] = 'same';
        } else {
           $userMeasureData[$i][$key.'_class'] = 'down';
        }

      }

    }
 
    $currentMeasurements = User::getCurrentMeasurements();  

    $userWeight = $currentMeasurements[0]['weight'];
    $userHeight = $currentMeasurements[0]['height'];
    $userBodyFat = $currentMeasurements[0]['body_fat'];

    $userBMI = $userWeight / (($userHeight / 100) * ($userHeight / 100));
    $userBMI = number_format($userBMI,2);
    $userBMIrange = User:: getUserBMIrange($userBMI);//function from User Model
   
   
   
    if ($userData) 
      return view('users.profile')->with(compact(array('userData', 'title', 'userWeight', 'userHeight', 'userMeasure',  'userMeasureData', 'userBodyFat', 'userBMI', 'userBMIrange', 'age', 'tasks', 'now')));

    return redirect('/food/index')->withErrors('You do not have sufficient permissions');
    
  }
  
  public function index()
  { 
    $user_id = Auth::user()->id; 
    $users = User:: where('id', '!=', $user_id)->get();
    $title = "All users";
    

    if ($users)
      return view('users.index')->with('users', $users)->with('title', $title);

    return redirect('/food/index')->withErrors('You do not have sufficient permissions');
  }


  public function store_todo(TaskFormRequest $request)
  {
  
    $task = new Task();
    $task->name = $request->get('name');
    $task->date_to_do = $request->get('date_to_do');
    $user_id = $request->user()->id;

    if ($request->get('user_id')) {
      $task->user_id = $request->get('user_id');
    } else {
      $task->user_id = $user_id;
    }

    $task->save();
    
    return response()->json(array('success' => true, 'task'=>$task));
  }
    
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create()
  {
      //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store()
  {
      //
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function show($id)
  {
    return view('users.show');
  }
  
  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return Response
   */
  public function edit($id)
  {
      //
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
  public function destroy(Request $request)
  {
      $id =  $request->get('id');
      $task = Task::find($id);
      $user_id = Auth::user()->id;


      if ($task && ($task->user_id == $user_id ||  $user_id->is_admin())) {

        $task->delete();
        return response()->json(array('success' => true));

      } else  {

        $data['errors'] = 'Invalid Operation. You do not have sufficient permissions';
        return response()->json(array('success' => true, 'errors'=>$data['errors']));
      }
    }
}
