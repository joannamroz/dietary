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
Route::get('/','MealController@index');
 
Route::get('/home',['as' => 'home', 'uses' => 'MealController@index']);
Route::get('/food',['as' => 'food', 'uses' => 'FoodController@index']);
Route::get('/brand',['as' => 'brand', 'uses' => 'BrandController@index']);
Route::get('/meal',['as' => 'meal', 'uses' => 'MealController@index']);
Route::get('/user',['as' => 'user', 'uses' => 'UserController@index']);
Route::get('/permission',['as' => 'permission', 'uses' => 'UserPermissionController@index']);





//authentication
Route::controllers([
 'auth' => 'Auth\AuthController',
 'password' => 'Auth\PasswordController',
]);
 
// check for logged in user
Route::group(['middleware' => ['auth']], function()
{

 Route::get('food/index', ['as' => 'food', 'uses' => 'FoodController@index']);
 Route::get('food/new-food', 'FoodController@create');
 Route::post('new-food', 'FoodController@store');
 Route::get('food/edit/{id}', 'FoodController@edit');
 Route::post('food/update', 'FoodController@update');
 Route::get('food/delete/{id}', 'FoodController@destroy');
 Route::get('food/show/{id}', 'FoodController@show');

 Route::get('brand/index', ['as' => 'brand', 'uses' => 'BrandController@index']);
 Route::get('brand/new-brand', 'BrandController@create');
 Route::post('new-brand', 'BrandController@store');
 Route::get('brand/edit/{id}', 'BrandController@edit');
 Route::post('brand/update', 'BrandController@update');
 Route::get('brand/delete/{id}', 'BrandController@destroy');

 Route::get('meal/index', ['as' => 'meal', 'uses' => 'MealController@index']);
 Route::get('meal/new-meal', 'MealController@create');
 Route::post('new-meal', 'MealController@store');
 Route::get('meal/edit/{id}', 'MealController@edit'); 
 Route::post('meal/update', 'MealController@update');
 Route::get('meal/delete/{id}', 'MealController@destroy');
 Route::get('meal/ajax_meal', 'MealController@ajax_meal');
 Route::get('meal/ajax_calendar', 'MealController@ajax_calendar');
 Route::get('meal/all', 'MealController@all');
 Route::post('meal/planed', 'MealController@planed');
 Route::get('meal/user_meal/{id}', 'MealController@user_meal');


 Route::get('measurement/new-measure', 'MeasurementController@create');
 Route::post('new-measure', 'MeasurementController@store');
 Route::get('measurement/delete/{id}', 'MeasurementController@destroy');

 // Authentication routes...
 Route::get('auth/login', 'Auth\AuthController@getLogin');
 Route::post('auth/login', 'Auth\AuthController@postLogin');
 Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
 Route::get('auth/register', 'Auth\AuthController@getRegister');
 Route::post('auth/register', 'Auth\AuthController@postRegister');
 Route::get('user/index', ['as' => 'user', 'uses' => 'UserController@index']);

 Route::get('permission/add-permission/{id}', 'UserPermissionController@create');
 Route::post('add-permission', 'UserPermissionController@store');

 Route::get('exercise/index', ['as' => 'exercise', 'uses' => 'ExerciseController@index']);
 Route::get('exercise/new-exercise', 'ExerciseController@create');
 Route::post('new-exercise', 'ExerciseController@store');
 Route::get('exercise/edit/{id}', 'ExerciseController@edit');
 Route::post('exercise/update', 'ExerciseController@update');
 Route::get('exercise/delete/{id}', 'ExerciseController@destroy');

Route::get('exercise/all', 'ExerciseController@all'); 
 
	/** Training related routes */

	Route::get('training', 'TrainingController@index');

	Route::get('training/new-training-template', 'TrainingTemplateController@create');
	Route::post('new-training-template', 'TrainingTemplateController@store');

 Route::get('training/edit/{id}', 'TrainingTemplateController@edit');
 Route::post('training/update', 'TrainingTemplateController@update');
 Route::get('training/delete/{id}', 'TrainingTemplateController@destroy');
 Route::get('training/userTraining', 'TrainingTemplateController@userTraining');

 Route::get('training/new-exercise-training', 'TrainingTemplateController@createExerciseTraining');
 Route::post('new-exercise-training', 'TrainingTemplateController@storeExerciseTraining');
 Route::get('training/future-training', 'TrainingTemplateController@futureTraining');
 Route::post('future-training', 'TrainingTemplateController@storefutureTraining');

});
 
//users profile
Route::get('user/profile/{id}','UserController@profile')->where('id', '[0-9]+');



//Tutaj wersja wymagajaca zalogowanego uzytkownika Route::group(['prefix' => 'api','middleware' => 'auth'], function () {
Route::group(['prefix' => 'api'], function () {

 	Route::get('foods', 'ApiController@getFoods');
	Route::get('foods/{id}/{secret}', 'ApiController@getFoodById');


 	//Route::get('foods/{$id}', 'ApiController@getFoodById');

 	Route::get('meals', 'ApiController@getMeals');
});


