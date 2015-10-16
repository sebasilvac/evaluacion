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


Route::get('prueba', 'ComercialPerformanceController@index');

//Route::group(['middleware' => 'auth'], function () {


    Route::get('/', function () {
	    return view('index');
	});


	Route::get('comercial/performance', [
		'as' => 'show_comercial_performance', 
		'uses' => 'ComercialPerformanceController@index'
	]);

	// AJAX

	Route::post('opcion_uno', 'ComercialPerformanceController@getOp1');
	Route::post('opcion_dos', 'ComercialPerformanceController@getOp2');
	Route::post('opcion_tres', 'ComercialPerformanceController@getOp3');

	// Logout
	Route::get('logout', 'Auth\AuthController@getLogout');

//});





// Login routes
Route::get('login', [
    'as' => 'show_login_form', 'uses' => 'Auth\AuthController@getLogin'
]);

Route::post('login', [
    'as' => 'login_post', 'uses' => 'Auth\AuthController@postLogin'
]);





// Registration routes...
Route::get('register', [
    'as' => 'show_register_form', 'uses' => 'Auth\AuthController@getRegister'
]);

Route::post('register', [
    'as' => 'register_post', 'uses' => 'Auth\AuthController@postRegister'
]);