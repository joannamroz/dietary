<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\UserPermissions;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserPermissionFormRequest;
 
use Illuminate\Http\Request;

class UserPermissionController extends Controller
{	
	public function index() {
        
    }

	public function create(Request $request, $id) {

        
        $user_id = Auth::user()->id;
        $userData = User::find($id);

        $userPermissions = UserPermissions::where('authorized_user_id', $id)->where('user_id', $user_id)->get();
        $userWritePermission='';
        $userReadPermission='';
        foreach ($userPermissions as $permission) {

            $userWritePermission = $permission['write_permission'];
            $userReadPermission = $permission['read_permission'];
        }
        
        if ($request->user()->is_user() || $request->user()->is_admin() ) {
   	
          return view('permissions.create')->with('user_id', $id)->with('userWritePermission', $userWritePermission)->with('userReadPermission', $userReadPermission)->with('userData', $userData);

        } else {

          return redirect('/user/index')->withErrors('You have not sufficient permissions.');
        }
    }

    public function store(UserPermissionFormRequest $request) {
        
    	$user_id = Auth::user()->id;
        $authorized_user_id = $request->get('user_id');

        $userPermissions = UserPermissions::where('authorized_user_id',  $authorized_user_id)->where('user_id', $user_id);
        if ($userPermissions) {

            $userPermissions ->delete();
        } 
        //var_dump($userPermissions)
    	$permission = new UserPermissions();
    	$permission->user_id = $user_id ;
        $permission->authorized_user_id = $authorized_user_id;

        $arrayPermission = $request->get('check_list');

        if (in_array("write_permission", $arrayPermission)) {

        	$permission->write_permission = 1;
        }

        if (in_array("read_permission", $arrayPermission)) {

        	$permission->read_permission = 1;
        }
        $permission->save();
        $message = "Your permission is added";

       return redirect('user/index')->withMessage($message);
    }
    


}
