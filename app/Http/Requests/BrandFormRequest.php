<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class BrandFormRequest extends Request
{

  /**
   * Determine if the user is authorized to make this request.
   *
   * @return bool
   */
  public function authorize()
  {  

    if ($this->user()->is_admin() || $this->user()->is_user()) {
      return true;
    }
    return false;
  }

  /**
   * Get the validation rules that apply to the request.
   *
   * @return array
   */
  public function rules()
  {
    return [
      'name' => 'required|unique:brands|max:255'
     // 'name' => array('Regex:/^[A-Za-z0-9 ]+$/'),                      
    ];
  }	
}
