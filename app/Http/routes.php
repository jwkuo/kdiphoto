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

$app->group(['prefix'=>'admin','namespace'=>'App\Http\Controllers'], function($app){
	//Login Routes
	$app->get('login', 'AdminController@login');
	$app->post('login', 'AdminController@login');
	$app->get('logout', 'AdminController@logout');
	//Home
	$app->get('/', 'AdminController@adminHome');
	//User routes
	$app->get('users', 'AdminController@manageUsers');
	$app->get('users/edit/{user_id}', 'AdminController@editUser');
	$app->post('users/edit/{user_id}', 'AdminController@editUser');
	$app->get('users/create', 'AdminController@createUser');
	$app->post('users/create', 'AdminController@createUser');
	$app->get('users/delete/{user_id}', 'AdminController@deleteUser');
	//Project routes
	$app->get('projects', 'AdminController@manageProjects');
	$app->get('projects/create', 'AdminController@createProject');
	$app->post('projects/create', 'AdminController@createProject');
	$app->get('projects/{project_id}', 'AdminController@editProject');
	$app->post('projects/{project_id}', 'AdminController@editProject');
	$app->get('projects/copy/{project_id}', 'AdminController@copyProject');
	$app->get('projects/delete/{project_id}', 'AdminController@deleteProject');
	//Package routes
	$app->get('projects/{project_id}/packages', function() {
		return redirect('projects/{project_id}');
	});
	$app->get('projects/{project_id}/packages/create', 'AdminController@createPackage');
	$app->post('projects/{project_id}/packages/create', 'AdminController@createPackage');
	$app->get('projects/{project_id}/packages/{package_id}', 'AdminController@editPackage');
	$app->post('projects/{project_id}/packages/{package_id}', 'AdminController@editPackage');
	$app->get('projects/{project_id}/packages/delete/{package_id}', 'AdminController@deletePackage');
	//Item routes
	$app->get('projects/{project_id}/items', function() {
		return redirect('projects/{project_id}');
	});
	$app->get('projects/{project_id}/items/create', 'AdminController@createItem');
	$app->post('projects/{project_id}/items/create', 'AdminController@createItem');
	$app->get('projects/{project_id}/items/{item_id}', 'AdminController@editItem');
	$app->post('projects/{project_id}/items/{item_id}', 'AdminController@editItem');
	$app->get('projects/{project_id}/items/delete/{item_id}', 'AdminController@deleteItem');
});

$app->group(["prefix"=>"api", "namespace" => "App\Http\Controllers"], function($app){
	$app->get("project/{id}", "ApiController@getProject");
	$app->get("packages", "ApiController@getAllPackages");
	$app->get("items", "ApiController@getAllItems");
});
