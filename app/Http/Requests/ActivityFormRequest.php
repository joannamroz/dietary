<?php 
namespace App\Http\Requests;

use App\Http\Requests\Request;
use App\User;
use Auth;

class ActivityFormRequest extends Request
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
      'date' => 'required'              
    ];
  }	
}
