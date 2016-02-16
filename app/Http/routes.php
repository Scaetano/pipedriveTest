<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'api', 'middleware' => 'token_auth'], function(){

	Route::resource('organization', 'OrganizationController');

	Route::group(['middleware' => 'json_validation'], function(){
		
		Route::post('organizationRelationship', 'OrganizationRelationshipController@create');
	});

	Route::get('organizationRelationship/{name}','OrganizationRelationshipController@findByOrganizationName');

	Route::delete('organizationRelationship','OrganizationRelationshipController@deleteAll');

});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'HomeController@index');
});
