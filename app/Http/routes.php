<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

// basic version
// Route::get('/', function () {
//     return view('welcome');
// });

//Following tutorial
Route::get('/','MealsController@index');
 
Route::get('/home',['as' => 'home', 'uses' => 'MealsController@index']);
Route::get('/food',['as' => 'food', 'uses' => 'FoodsController@index']);
Route::get('/brand',['as' => 'brand', 'uses' => 'BrandsController@index']);
Route::get('/meal',['as' => 'meal', 'uses' => 'MealsController@index']);
Route::get('/user',['as' => 'user', 'uses' => 'UsersController@index']);
Route::get('/permission',['as' => 'permission', 'uses' => 'UserPermissionsController@index']);


//authentication
Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);
 
// check for logged in user
Route::group(['middleware' => ['auth']], function()
{

	 Route::get('food/index', ['as' => 'food', 'uses' => 'FoodsController@index']);
	 Route::get('food/new-food', 'FoodsController@create');
	 Route::post('new-food', 'FoodsController@store');
	 Route::get('food/edit/{id}', 'FoodsController@edit');
	 Route::post('food/update', 'FoodsController@update');
	 Route::get('food/delete/{id}', 'FoodsController@destroy');
	 Route::get('food/show/{id}', 'FoodsController@show');

	 Route::get('brand/index', ['as' => 'brand', 'uses' => 'BrandsController@index']);
	 Route::get('brand/new-brand', 'BrandsController@create');
	 Route::post('new-brand', 'BrandsController@store');
	 Route::get('brand/edit/{id}', 'BrandsController@edit');
	 Route::post('brand/update', 'BrandsController@update');
	 Route::get('brand/delete/{id}', 'BrandsController@destroy');
	 Route::get('brand/show/{id}', 'BrandsController@show');

	 Route::get('meal/index', ['as' => 'meal', 'uses' => 'MealsController@index']);
	 Route::get('meal/new-meal', 'MealsController@create');
	 Route::post('new-meal', 'MealsController@store');
	 Route::get('meal/edit/{id}', 'MealsController@edit'); 
	 Route::post('meal/update', 'MealsController@update');
	 Route::get('meal/delete/{id}', 'MealsController@destroy');
	 Route::get('meal/ajax_meal', 'MealsController@ajax_meal');
	 Route::get('meal/ajax_calendar', 'MealsController@ajax_calendar');
	 Route::get('meal/all', 'MealsController@all');
	 Route::post('meal/planed', 'MealsController@planed');
	 Route::get('meal/user_meal/{id}', 'MealsController@user_meal');


	 Route::get('measurement/new-measure', 'MeasurementsController@create');
	 Route::post('new-measure', 'MeasurementsController@store');
	 Route::get('measurement/delete/{id}', 'MeasurementsController@destroy');

	 // Authentication routes...
	 Route::get('auth/login', 'Auth\AuthController@getLogin');
	 Route::post('auth/login', 'Auth\AuthController@postLogin');
	 Route::get('auth/logout', 'Auth\AuthController@getLogout');

	// Registration routes...
	 Route::get('auth/register', 'Auth\AuthController@getRegister');
	 Route::post('auth/register', 'Auth\AuthController@postRegister');
	 Route::get('user/index', ['as' => 'user', 'uses' => 'UsersController@index']);

	 Route::get('permission/add-permission/{id}', 'UserPermissionsController@create');
	 Route::post('add-permission', 'UserPermissionsController@store');

	 Route::get('exercise/index', ['as' => 'exercise', 'uses' => 'ExercisesController@index']);
	 Route::get('exercise/new-exercise', 'ExercisesController@create');
	 Route::post('new-exercise', 'ExercisesController@store');
	 Route::get('exercise/edit/{id}', 'ExercisesController@edit');
	 Route::post('exercise/update', 'ExercisesController@update');
	 Route::get('exercise/delete/{id}', 'ExercisesController@destroy');

	Route::get('exercise/all', 'ExercisesController@all'); 
 
	/** Training related routes */

	Route::get('training', 'TrainingsController@index');

	Route::get('new-training', 'TrainingsController@create');
	Route::post('new-training', 'TrainingsController@store');

	Route::get('training/edit/{id}', 'TrainingsController@edit');
	Route::get('training/show/{id}', 'TrainingsController@show');


});
 
//users profile
Route::get('user/profile/{id}','UsersController@profile')->where('id', '[0-9]+');
Route::post('new-todo', 'UsersController@store_todo');
Route::post('delete-todo', 'UsersController@destroy');


//Tutaj wersja wymagajaca zalogowanego uzytkownika Route::group(['prefix' => 'api','middleware' => 'auth'], function () {
Route::group(['prefix' => 'api'], function () {

	Route::get('foods', 'ApiController@getFoods');
	Route::get('brands', 'ApiController@getBrands');
	Route::get('foods/{id}/{secret}', 'ApiController@getFoodById');

	//Route::get('foods/{$id}', 'ApiController@getFoodById');

	Route::get('meals', 'ApiController@getMeals');
});


