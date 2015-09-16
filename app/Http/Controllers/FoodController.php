<?php

namespace App\Http\Controllers;
use Log;
use Auth;
use App\Foods;
use App\Ingredients;
use App\Brands;
use App\User;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\FoodFormRequest;
 
use Illuminate\Http\Request;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {

        //fetch 20 foods from database which are latest
        $foods = Foods::with('brand')->orderBy('created_at','desc')->paginate(20);
                                                    
        //page heading
        $title = 'Food list';
        //return foods.blade.php template from resources/views folder
        return view('foods.index')->withFoods($foods)->withTitle($title);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request) {

        $brands = Brands::orderBy('name','asc')->get();

        if ($request->user()->is_user() || $request->user()->is_admin()) {

          return view('foods.create')->withBrands($brands);

        } else {

          return redirect('/food/index')->withErrors('You have not sufficient permissions for adding new food.');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(FoodFormRequest $request) {

        $data = $request->all();
        $user_id = Auth::user()->id;

        $food = new Foods();
        $food->name = $request->get('name');

        if (isset($data['compound_food'])) {

            $food->brand_id = 23; //brand name 'Homemade'

        } else {

            $food->brand_id = $request->get('brand');
        }

        $food->kcal = $request->get('kcal');
        $food->proteins = $request->get('proteins');
        $food->carbs = $request->get('carbs');
        $food->fats = $request->get('fats');
        $food->fibre = $request->get('fibre');  
        $food->user_id = $request->user()->id;
        $food->save();


        if (isset($data['compound_food']) && $data['compound_food']) {

            $last_inserted_id = $food->id;

            $ingredientsInArray = array();
            $arrayId = $data['ingredient'];
            $arrayWeight = $data['ingredient-weight'];

            for ($i = 0; $i < count($arrayId); $i++) {

                $ingredientsInArray[$i]["ingredient_id"] = $arrayId[$i];
                $ingredientsInArray[$i]["ingredient_weight"] = $arrayWeight[$i];
            }           
          
            foreach ($ingredientsInArray as $smallArray) {

                $ingredient = new Ingredients();
                $ingredient->food_id = $last_inserted_id;
                $ingredient->ingredient_id = $smallArray['ingredient_id'];
                $ingredient->weight = $smallArray["ingredient_weight"];
                $ingredient->user_id = $user_id;
                $ingredient->save();
                
            }
        }

        $message = "Food has been successfully added";

        return redirect('food/index')->withMessage($message);
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show(Request $request, $id) {

        $food = Foods::where('id', $id)->first();
        $food_ingredient = Ingredients::where('food_id', $id)->get();

        return view('foods.show')->with('food', $food)->with('food_ingredient',  $food_ingredient);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit(Request $request, $id) {

        $food = Foods::where('id',$id)->first();
        $brands = Brands::orderBy('name','asc')->get();

        if ($food && ($request->user()->id == $food->user_id || $request->user()->is_admin()))

          return view('foods.edit')->with('food', $food)->withBrands($brands);

        return redirect('/food/index')->withErrors('you have not sufficient permissions');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request) {

        $food_id = $request->input('food_id');
        $food = Foods::find($food_id);

        if ($food && ($food->user_id == $request->user()->id || $request->user()->is_admin())) {

          $food->name = $request->input('name');
          $food->brand_id = $request->input('brand');
          $food->kcal = $request->input('kcal');
          $food->proteins = $request->input('proteins');
          $food->carbs = $request->input('carbs');
          $food->fats = $request->input('fats');
          $food->fibre = $request->input('fibre');
          
          if ($request->has('save')) {

            $message = 'Food saved successfully';
            $landing = 'food/index';  
          }         
          
          $food->save();

          return redirect($landing)->withMessage($message);

        } else {

          return redirect('/food/index')->withErrors('You have not sufficient permissions');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy(Request $request, $id) {
        
        $food = Foods::find($id);

        if ($food && ($food->user_id == $request->user()->id || $request->user()->is_admin())) {

          $food->delete();
          $data['message'] = 'Food deleted successfully';

        } else  {

          $data['errors'] = 'Invalid Operation. You have not sufficient permissions';
        }
        
        return redirect('/food/index')->with($data);
    }
}
