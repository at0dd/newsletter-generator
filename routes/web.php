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

Route::group(['middleware' => 'web'], function () {
Route::get('/', 'MainController@Index');
Route::get('/archives', 'MainController@Archives');
Route::get('/guidelines', 'MainController@Guidelines');
Route::get('/mail', 'MainController@Mail');

Route::group(['middleware' => 'cas'], function () {
  Route::get('/contribute', ['uses' => 'MainController@Contribute', 'middleware' => 'roles', 'roles' => ['User']]);
  Route::post('/contribute', ['uses' => 'MainController@ContributeSubmit', 'middleware' => 'roles', 'roles' => ['User']]);
  Route::get('/profile', ['uses' => 'MainController@Profile', 'middleware' => 'roles', 'roles' => ['User']]);
  Route::post('/profile', ['uses' => 'MainController@UpdateProfile', 'middleware' => 'roles', 'roles' => ['User']]);
  Route::get('/administration', ['uses' => 'MainController@Administration', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::get('/administration/archive', ['uses' => 'MainController@ArchiveAll', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::get('/administration/users', ['uses' => 'MainController@Users', 'middleware' => 'roles', 'roles' => ['Administrator']]);
});

Route::get('/login', 'Auth\AuthController@CASLogin');
Route::get('auth/login', 'Auth\AuthController@CASLogin');
Route::get('auth/logout', 'Auth\AuthController@Logout');
Route::get('auth/caslogout', 'Auth\AuthController@CASLogout');
});
