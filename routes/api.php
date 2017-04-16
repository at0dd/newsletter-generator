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
Route::get('/articles/daily/{day}', 'APIController@ArticlesByDay');
Route::get('/articles/clubs', 'APIController@ClubArticles');

Route::group(['middleware' => 'auth:api'], function () {
  Route::post('/administration/approve/{id}', 'APIController@Approve');
  Route::post('/administration/deny/{id}', 'APIController@Deny');
  Route::post('/administration/users/{id}/{role}', 'APIController@Role');
  Route::post('/administration/archive/{id}', 'APIController@Archive');
  Route::post('/administration/send', 'APIController@SendNewsletter');
});
