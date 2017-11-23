<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:api');
// // get list of tasks
// Route::get('tasks','TaskController@index');
// // get specific task
// Route::get('task/{id}','TaskController@show');
// // delete a task
// Route::delete('task/{id}','TaskController@destroy');
// // update existing task
// Route::put('task','TaskController@store');
// // create new task
// Route::post('task','TaskController@store');

Route::post('login', 'AuthenticateController@login');
Route::post('register', 'AuthenticateController@register');

Route::group(['prefix'=>'v1', 'middleware'=>['jwt.auth']], function(){
	Route::resource('user', 'UserController');
});