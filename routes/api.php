<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Orion\Facades\Orion;

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

Route::group(['as' => 'api.'], function () {
    Orion::resource('resources', \App\Http\Controllers\Api\ResourcesController::class);
    Orion::resource('workshops', \App\Http\Controllers\Api\WorkshopsController::class);
    Orion::resource('recipes', \App\Http\Controllers\Api\RecipesController::class);
    Route::post('processes', '\App\Http\Controllers\Api\ProcessesController@create');
});
