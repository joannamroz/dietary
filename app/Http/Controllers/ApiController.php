<?php

namespace App\Http\Controllers;

use Log;
use App\Food;
use App\Meal;
use App\Brand;
use App\User;

 
use Illuminate\Http\Request;

class ApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getFoods(Request $request) 
  {
      
    if ($request->input('q')) {
      $search_query = $request->input('q');
      $foods = Food::with('brand')->where('name', 'like',  '%'.$search_query.'%' )->get();
    } else {
       $foods = Food::with('brand')->get();
    }

   

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($foods);
  }

  public function getFoodById($id, $secret = null) 
  {
    if ($secret == '12345') {
      $foods = Food::find($id);
    } else {
      $foods = 'nope';
    }
    

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($foods);
  }

  public function getMeals() 
  {
      
    $meals = Meal::all();

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($meals);
  }

}
