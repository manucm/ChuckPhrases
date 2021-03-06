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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/random', ['uses' => 'JokesController@randomApi']);

Route::post('/joke/markAsVisited', ['uses' => 'JokesController@markAsVisited']);

Route::get('/jokes', ['uses' => 'JokesController@listApi']);

Route::delete('/jokes/{slug}', ['uses' => 'JokesController@delete']);

