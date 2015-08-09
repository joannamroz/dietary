<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class MealFormRequest extends Request {

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize() {    

    return true; // for now everyone can add meal

    if ($this->user()->can_add_meal()) {
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
      'food_id' => 'required',
      'weight' => 'required',
      'date' => 'required',
      'comment' =>'required'                   
    ];
  }	
}