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
    Route::put('update/{id}', 'GoalController@update')->name('update');
    Route::delete('delete/{id}', 'GoalController@Delete')->name('delete');
    Route::get('{id}', 'GoalController@get')->name('get');
    Route::get('progress/{id}', 'GoalController@getProgress')->name('getProgress');
    Route::get('notes/{id}', 'GoalController@getNotes')->name('getNotes');
    Route::post('related/create', 'RelatedGoalController@createGoalRelation')->name('createGoalRelation');
    Route::get('related/{id}', 'RelatedGoalController@getRelatedGoals')->name('getRelatedGoals');
    Route::delete('related/delete/{id}', 'RelatedGoalController@deleteGoalRelation')->name('deleteGoalRelation');
});


Route::group(['prefix'=> 'progress/'], function () {
    Route::post('create', 'ProgressController@create')->name('create');
    Route::put('update/{id}', 'ProgressController@update')->name('update');
    Route::delete('delete/{id}', 'ProgressController@Delete')->name('delete');
    Route::get('{id}', 'ProgressController@get')->name('get');
    Route::get('steps/{id}', 'ProgressController@getSteps')->name('getSteps');
    Route::get('notes/{id}', 'ProgressController@getNotes')->name('getNotes');
});

Route::group(['prefix'=> 'step/'], function () {
    Route::post('create', 'StepController@create')->name('create');
    Route::put('update/{id}', 'StepController@update')->name('update');
    Route::delete('delete/{id}', 'StepController@Delete')->name('delete');
    Route::get('{id}', 'StepController@get')->name('get');
    Route::get('notes/{id}', 'StepController@getNotes')->name('getNotes');
});

Route::group(['prefix' => 'note/'], function () {
    Route::post('create', 'NoteController@create')->name('create');
    Route::put('update/{id}', 'NoteController@update')->name('update');
    Route::delete('delete/{id}', 'NoteController@Delete')->name('delete');
    Route::get('{id}', 'NoteController@get')->name('get');
});
