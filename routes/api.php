<?php


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


Route::group(['middleware' => ['web','throttle:60,1','auth']], function () {});

Route::apiResources([
        'users' => 'Api\UserController',
    ]);

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');
    Route::get('todoImport', 'Api\TodoController@todo')->name('todo');
    Route::get('todoReport', 'Api\TodoReportController@todoReport')->name('todo');







