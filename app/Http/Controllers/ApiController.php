<?php

namespace App\Http\Controllers;

use Log;
use App\Foods;
use App\Meals;
use App\Brands;
use App\User;

 
use Illuminate\Http\Request;

class ApiController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return Response
   */
  public function getFoods() 
  {
      
    $foods = Foods::all();

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($foods);
  }

  public function getFoodById($id, $secret = null) 
  {
    if ($secret == '12345') {
      $foods = Foods::find($id);
    } else {
      $foods = 'fuckk off';
    }
    

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($foods);
  }

  public function getMeals() 
  {
      
    $meals = Meals::all();

    //return home.blade.php template from resources/views folder
   /// return view('brands.index')->withBrands($brands)->withTitle($title);

    return response()->json($meals);
  }

}
