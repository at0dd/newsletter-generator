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

Route::group(['middleware' => 'cas'], function () {
  Route::post('/administration/approve/{id}', ['uses' => 'MainController@Approve', 'roles' => ['Administrator']]);
  Route::post('/administration/deny/{id}', ['uses' => 'MainController@Deny', 'roles' => ['Administrator']]);
  Route::post('/administration/users/{id}/{role}', ['uses' => 'MainController@Role', 'roles' => ['Administrator']]);
});
