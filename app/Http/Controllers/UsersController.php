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

    $sessionId = $request->user()->id;
    $now = Carbon::now();
    $now = $now->format('Y-m-d');
    $userData = User::where('id', $sessionId)->first();
    $userMeasure = Measurement::where('user_id', $sessionId)->orderBy('date', 'desc')->get();
    $lastMeasure = json_encode($userMeasure);
    $age = $userData->getUserAge();   
    $today_tasks = Task::where('user_id', $sessionId)->where('date_to_do', $now)->orderBy('created_at', 'desc')->get();
    $not_done_tasks = Task::where('user_id', $sessionId)->where('date_to_do', '!=', $now)->get();
    
    $measurment_available = ($userMeasure->count() > 0 );

    if ($measurment_available) {
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
   
      $currentMeasurements = User::getCurMeasurements();  
      $userWeight = $currentMeasurements['weight'];
      $userHeight = $currentMeasurements['height'];
      $userBodyFat = $currentMeasurements['body_fat'];

      $userBMI = $userWeight / (($userHeight / 100) * ($userHeight / 100));
      $userBMI = number_format($userBMI,2);
      $userBMIrange = User:: getUserBMIrange($userBMI);//function from User Model

      $userData->userWeight = $userWeight;
      $userData->userHeight = $userHeight;
      $userData->userMeasure = $userMeasure;
      $userData->userMeasureData = $userMeasureData;
      $userData->userBodyFat = $userBodyFat;
      $userData->userBMI = $userBMI;
      $userData->userBMIrange = $userBMIrange;
      $userData->lastMeasure = $lastMeasure;

    }

  
    if ($userData) {
      // 'userWeight', 'userHeight', 'userMeasure',  'userMeasureData', 'userBodyFat', 'userBMI', 'userBMIrange','lastMeasure'
      return view('users.profile')->with(compact(array('userData', 'age', 'today_tasks','not_done_tasks', 'now', 'measurment_available')));
    }

    return redirect('/food/index')->withErrors('You do not have sufficient permissions');
    
  }
  
  public function index()
  { 
    $user_id = Auth::user()->id; 
    $users = User:: where('id', '!=', $user_id)->get();
    
    if ($users)
      return view('users.index')->with('users', $users);

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
    
    return response()->json(array('success' => true, 'task' => $task));
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
        return response()->json(array('success' => true, 'errors' => $data['errors']));
      }
    }
}
