<?php
namespace App\Http\Controllers;
use Log;
use Auth;
use App\User;
use App\Foods;
use App\Brands;
use App\Permissions;
use App\Measurements;
use Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandFormRequest;
 
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */

    public function __construct() {

        $this->middleware('auth');
    }

    public function profile(Request $request) {

        $sessionId = $request->user()->id ;
        $userData = User::all()->where('id', $sessionId);
        $title = 'Your profile';
        $userMeasure = Measurements::where('user_id', $sessionId)->orderBy('date', 'desc')->get();
        // foreach ( $userMeasure as $userDate) {
        //     var_dump (date("d/m/Y", strtotime($userDate->date)));
        // }
        // die();
        
        $userMeasureForBmi = Measurements::where('user_id', $sessionId)->orderBy('date','desc')->first();
        $userWeight = $userMeasureForBmi->weight;
        $userHeight = $userMeasureForBmi->height;
        $userBodyFat = $userMeasureForBmi->body_fat;
        $userBMI = $userWeight / (($userHeight / 100) * ($userHeight / 100));
        $userBMI = number_format($userBMI,2); //change to float(2)
        $userBMIrange =User:: getUserBMIrange($userBMI);//function from User Model
        
        if ($userData) 

          return view('users.profile')->with('userData', $userData)->with('title', $title)->with('userMeasure', $userMeasure)->with('userWeight', $userWeight)->with('userHeight', $userHeight)->with('userBodyFat', $userBodyFat)->with('userBMI', $userBMI)->with('userBMIrange', $userBMIrange);

        return redirect('/food/index')->withErrors('You do not have sufficient permissions');

        
    }

    
    public function index()
    {
        $users = User:: all();
        $title = "All users";
        

        if( $users)
            return view('users.index')->with('users', $users)->with('title', $title);

        return redirect('/food/index')->withErrors('You do not have sufficient permissions');
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
        return view('users.show');
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
    public function destroy($id)
    {
        //
    }
}