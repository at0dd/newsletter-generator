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

Route::get('/articles', 'APIController@Articles');

Route::group(['middleware' => 'cas'], function () {
  Route::post('/administration/approve/{id}', ['uses' => 'APIController@Approve', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::post('/administration/deny/{id}', ['uses' => 'APIController@Deny', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::post('/administration/users/{id}/{role}', ['uses' => 'APIController@Role', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::post('/administration/archive/{id}', ['uses' => 'APIController@Archive', 'middleware' => 'roles', 'roles' => ['Administrator']]);
  Route::post('/administration/send', ['uses' => 'APIController@SendNewsletter', 'middleware' => 'roles', 'roles' => ['Administrator']]);
});
