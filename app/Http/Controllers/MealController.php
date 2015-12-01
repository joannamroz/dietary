<?php

namespace App\Http\Controllers;
use Auth;
use Log;
use App\Foods;
use App\Meals;
use App\Brands;
use App\User;
use App\UserPermissions;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\MealFormRequest;
 
use Illuminate\Http\Request;

use Carbon\Carbon;

class MealController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function index()
  {

    if (!Auth::check()) {
      // The user is logged in...
      return redirect('auth/login');
    }
    //data for old function draw_calendar
    // $now = new \DateTime();
    // $today = $now->format('Y-m-d');
    // $month = $now->format('m');
    // $year = $now->format('Y'); 
    // $calendar = User::draw_calendar($month, $year);

    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    $day = $now->day;
    $today = $now->toDateString(); // we receive only date without hour
  
    
    $calendar = User::calendar($year, $month);



    $foods = Foods::all();


    $user_id = Auth::user()->id;

    $meals_with_totals = Meals::getMealsWithTotals($today, $user_id);
    $meals =  $meals_with_totals['meals'];
    $meals_planed = $meals_with_totals['meals_planed'];
    $totals =  $meals_with_totals['totals'];
    $totals_planed =  $meals_with_totals['totals_planed'];

    $permissions = UserPermissions::with('user')->where('authorized_user_id', $user_id)->where('write_permission', 1)->get();
    
    //page heading
    $title = 'Meals added at '.$today;

    return view('meals.index')->withMeals($meals)->with('meals_planed', $meals_planed)->withTitle($title)->with('foods', $foods)->withCalendar($calendar)->with('today', $today)->with('now', $now)->with('totals', $totals)->with('totals_planed', $totals_planed)->with('permissions', $permissions);

  }

  public function user_meal($id)
  {

    $user_id = $id;
    $sessionId = Auth::user()->id;
    $user = User::find($user_id);
    $userName = $user->name;
    $title = ucfirst($userName).'\'s meals';

    $permissionsForLoggedUser = UserPermissions::where('authorized_user_id', $sessionId)->where('user_id', $user_id)->where('read_permission', 1);

    if ( !$permissionsForLoggedUser->count()) {

      $message = "You don't have permission to view ".$userName."'s meals";

      return redirect('user/index')->withMessage($message);
    }


    $now = Carbon::now();
    $year = $now->year;
    $month = $now->month;
    $day = $now->day;
    $today = $now->toDateString();
    $calendar = User::calendar($year, $month);
   

    $foods = Foods::all();

    $meals_with_totals = Meals::getMealsWithTotals($today, $user_id);

    $meals =  $meals_with_totals['meals'];
    $meals_planed = $meals_with_totals['meals_planed'];
    $totals =  $meals_with_totals['totals'];
    $totals_planed =  $meals_with_totals['totals_planed'];


    return view('meals.user_meal')->withMeals($meals)->with('meals_planed', $meals_planed)->withTitle($title)->with('foods', $foods)->withCalendar($calendar)->with('now', $now)->with('totals', $totals)->with('totals_planed', $totals_planed)->with('today', $today)->with('user_id', $user_id)->with('permissionsForLoggedUser', $permissionsForLoggedUser)->with('title', $title);

  }
  /**
   * Show the form for creating a new resource.
   *
   * @return Response
   */
  public function create(Request $request)
  {

    $foods = Foods::all();

    if ($request->user()->can_add_meal()) {

      return view('meals.create')->withFoods($foods);

    } else {

      return redirect('/meals/index')->withErrors('You have not sufficient permissions for adding new meal.');
    }
  }

  /**
   * Store a newly created resource in storage.
   *
   * @return Response
   */
  public function store(MealFormRequest $request)
  {
      
    $meal = new Meals();
    $meal->food_id = $request->get('food_id');
    $meal->weight = $request->get('weight');

    if ($request->get('user_id')) {
      $meal->user_id = $request->get('user_id');
    } else {
      $meal->user_id = $request->user()->id;
    }
    
   
    if (null !== $request->get('planed_food')) {
       
      $meal->planed_food = $request->get('planed_food');
    } else {
        
      $meal->planed_food = 0;
    }
      

    $meal->date = $request->get('date');

    $day = $request->get('day'); 
    $month = $request->get('month'); 
    $year = $request->get('year'); 

    $date =Carbon::create( $year ,$month, $day);
    $meal->date = $date;

    $meal->comment = $request->get('comment');
  
    $meal->save();
    $message = "Your meal has been successfully added";

   return redirect('meal/index')->withMessage($message);
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

    $foods = Foods::all();
    $meal = Meals::where('id', $id)->first();

    if ($meal && ($request->user()->id == $meal->user_id || $request->user()->is_admin()))

      return view('meals.edit')->with('meal', $meal)->withFoods($foods);

    return redirect('/meal/index')->withErrors('You do not have sufficient permissions');
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  int  $id
   * @return Response
   */
  public function update(Request $request)
  {
    $meal_id = $request->input('meal_id');
    $meal = Meals::find($meal_id);

    if ($meal && ($meal->user_id == $request->user()->id || $request->user()->is_admin())) {

      $meal->food_id = $request->input('food_id');
      $meal->planed_food = $request->input('planed_food');
      $meal->weight = $request->input('weight');
      $meal->date = $request->input('date');
      $meal->comment = $request->input('comment');

      if ($request->has('save')) {

        $message = 'Meal saved successfully';
        $landing = 'meal/index';  
      }         

      $meal->save();

      return redirect($landing)->withMessage($message);

    } else {

      return redirect('/meal/index')->withErrors('You do not have sufficient permissions');
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

    $meal = Meals::find($id);

    if ($meal && ($meal->user_id == $request->user()->id || $request->user()->is_admin())) {

      $meal->delete();
      $data['message'] = 'Meal deleted Successfully';

    } else  {

      $data['errors'] = 'Invalid Operation. You do not have sufficient permissions';
    }
    
    return redirect('/meal/index')->with($data);
  }

  public function ajax_meal(Request $request)
  {

   if ($request->ajax()) {

      $day =  $request->input('day');
      $year =  $request->input('year');
      $month =  $request->input('month');
      $date =Carbon::create( $year ,$month, $day);
  
      $selectedDate = $date->toDateString();//without a hour
      $user_id = Auth::user()->id;
      
      $meals_with_totals = Meals::getMealsWithTotals($selectedDate, $user_id);

      $title = 'Meals added at '.$selectedDate;

      $returnHTML = view('meals.ajax_meal')->withMeals($meals_with_totals['meals'])->withMealsPlaned($meals_with_totals['meals_planed'])->withTitle($title)->with('selectedDate', $selectedDate)->withTotals($meals_with_totals['totals'])->withTotalsPlaned($meals_with_totals['totals_planed'])->render();
      return response()->json(array('success' => true, 'html'=>$returnHTML));

    } else { 

      echo 'Error';
    }
      
  }

  public function all()
  {

    if (!Auth::check()) {
      // The user is logged in...
      return redirect('auth/login');
    }

    $foods = Foods::all();
    return response()->json(array('success' => true, 'data'=>$foods));
    
  }

  public function planed(Request $request)
  {

    $meal_id = $request->id;
    $meal = Meals::find($meal_id);

    if ($meal && ($meal->user_id == $request->user()->id || $request->user()->is_admin())) {

      $meal->planed_food = 0; 
      $meal->id = $meal_id;
      $meal->save();    
      return redirect('/meal/index');

    } else {

      return redirect('/meal/index')->withErrors('You do not have sufficient permissions');
    }

  }
  public function ajax_calendar(Request $request)
  {
    if ($request->ajax()) {
      $month =  $request->input('month');
      $year =  $request->input('year');

      $date = Carbon::create($year,$month,1);
      $monthName = $date->format('F Y');

      $returnHTML = User::draw_calendar($month, $year);

      return response()->json(array('success' => true, 'html' => $returnHTML, 'monthName' => $monthName));

    } else { 

      echo 'Error';
    }
  }
}
