<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class FoodFormRequest extends Request {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {    

    if($this->user()->can_add_food()) {

      return true;
    }

    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules() {
    
    return [
      'name' => 'required|unique:foods|max:255',
      //'name' => array('Regex:/^[A-Za-z0-9 ]+$/'),
      'kcal' => 'required',
      'proteins' => 'required',
      'carbs' => 'required',
      'fats' => 'required',
      'fibre' => 'required',                        
    ];
  }	
}