<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'MainController@Index');
Route::get('/archives', 'MainController@Archives');
Route::get('/guidelines', 'MainController@Guidelines');

Route::group(['middleware' => 'cas'], function () {
  Route::get('/contribute', ['uses' => 'MainController@Contribute', 'roles' => ['User']]);
  Route::post('/contribute', ['uses' => 'MainController@ContributeSubmit', 'roles' => ['User']]);
  Route::get('/profile', ['uses' => 'MainController@Profile', 'roles' => ['User']]);
  Route::post('/profile', ['uses' => 'MainController@UpdateProfile', 'roles' => ['User']]);
  Route::get('/administration', ['uses' => 'MainController@Administration', 'roles' => ['Administrator']]);
});

Route::get('/login', 'Auth\AuthController@CASLogin');
Route::get('auth/login', 'Auth\AuthController@CASLogin');
Route::get('auth/logout', 'Auth\AuthController@Logout');
Route::get('auth/caslogout', 'Auth\AuthController@CASLogout');
