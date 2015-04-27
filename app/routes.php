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
#Route::get('/', 'DashboardController@index');

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
 * Profile Route
 * --------------
 */
Route::get('profile', 'CompanyProfileController@index');
Route::post('profile/update', array('before'=>'restrict:12', 'uses' => 'CompanyProfileController@update'));

/**
 * Exchange Route
 * --------------
 */
Route::get('exchange_rate', 'ExchangeRateController@index');
Route::post('exchange/save', 'ExchangeRateController@save');

/**
 * Membership
 * ----------
 */
Route::get('membership/','MembershipController@index');
Route::get('membership/json','MembershipController@getDataJson');
Route::get('membership/add','MembershipController@add');
Route::get('membership/edit/{membership_id}/{member_id}','MembershipController@edit');
Route::get('membership/cancel/{membership_id}','MembershipController@cancel');
Route::post('membership/cancel/submit','MembershipController@cancelSubmit');
Route::post('membership/save','MembershipController@save');

/**
 * Membership Payment
 * ------------------
 */
Route::get('membership/payment/{membership_id}','MembershipPaymentController@payment');
Route::post('membership/payment/save','MembershipPaymentController@payment_save');
/**
 * Package 
 * -------
 */
Route::get('package/','PackageController@index');
Route::get('package/json','PackageController@getDataJson');
Route::get('package/add','PackageController@add');
Route::get('package/edit/{package_id}','PackageController@edit');
Route::get('package/remove/{package_id}','PackageController@remove');
Route::post('package/remove/submit','PackageController@removeSubmit');
Route::post('package/save','PackageController@save');

/**
 * Member
 * ------
 */
Route::get('member/','MemberController@index');
Route::get('member/json','MemberController@getDataJson');
Route::get('member/add','MemberController@add');
Route::get('member/edit/{member_id}','MemberController@edit');
Route::get('member/remove/{member_id}','MemberController@remove');
Route::post('member/remove/submit','MemberController@removeSubmit');
Route::post('member/save','MemberController@save');

/**
 * Membership Freeze
 * ------------------
 */
Route::get('membership/freeze/{membership_id}','MembershipController@freeze');
Route::post('membership/freeze/submit', 'MembershipController@freeze_submit');
Route::get('membership/unfreeze/{membership_id}','MembershipController@unfreeze');
Route::post('membership/unfreeze/submit', 'MembershipController@unfreeze_submit');