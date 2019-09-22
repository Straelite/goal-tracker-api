<?php

use App\Http\Controllers\GoalController;
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
//TODO Add registration, login and other account junk/
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix'=> 'goal/'], function () {
    Route::post('create', 'GoalController@create')->name('create');
    Route::put('update', 'GoalController@update')->name('update');
    Route::delete('delete/{id}', 'GoalController@update')->name('delete');
    Route::get('get/{id}', 'GoalController@update')->name('get');
});
