<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/**
 * Dashboard Route
 * ---------------
 */
Route::get('/', 'DashboardController@index');

/**
 * User Route
 * ----------
 */

Route::get('user/login', 'LoginController@login');
Route::post('user/login/submit', 'LoginController@submit');
Route::get('user/logout','UserController@logout');
Route::get('user/list', array('before'=>'restrict:3', 'uses' => 'UserController@userList'));

# User Json
Route::get('user/json/list' , array('before'=>'restrict:3', 'uses' => 'UserController@userListJson'));
Route::get('user/json/group' , 'UserController@userGroupJson');
Route::get('user/json/list/group/{user_group_id}' , array('before'=>'restrict:3', 'uses' => 'UserController@userListByGroupIdJson'));

# User form action
Route::get('user/form', array('before'=>'restrict:1', 'uses' => 'UserController@form'));
Route::post('user/form/submit', 'UserController@formSubmit');

# change password route
Route::get('user/changepassword/{user_id}', array('before'=>'restrict:4', 'uses' => 'UserController@changepassword'));
Route::post('user/changepassword/submit', array('before'=>'restrict:4', 'uses' => 'UserController@changepasswordSubmit'));

# change password route
Route::get('user/personal/change/password', 'UserController@personal_changepassword');
Route::post('user/personal/change/password/submit', 'UserController@personal_changepassword_submit');

# user remove route
Route::get('user/remove/{user_id}', array('before'=>'restrict:2', 'uses' => 'UserController@userRemove'));
Route::post('user/remove/submit', array('before'=>'restrict:2', 'uses' => 'UserController@userRemoveSubmit'));

# group permission route
Route::get('user/group/permission/{group_id}', array('before'=>'restrict:10', 'uses' => 'UserController@groupPermission'));
Route::post('user/group/permission/submit', array('before'=>'restrict:10', 'uses' => 'UserController@groupPermissionSubmit'));

# user permission route
Route::get('user/access/denied' , 'UserController@userAccessDenied');

/**
 * Exchange Route
 * --------------
 */
Route::get('exchange_rate', 'ExchangeRateController@index');
Route::post('exchange/save', 'ExchangeRateController@save');

/**
 * Package 
 * ------
 */
Route::get('package/','PackageController@index');
