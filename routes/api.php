<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'projects'], function(){
    Route::get('/', 'ProjectsController@index')->name('projects.list');
    Route::post('/create', 'ProjectsController@create')->name('project.create');
    Route::put('/{id}', 'ProjectsController@update')->name('project.update');
    Route::get('/{id}', 'ProjectsController@show')->name('project.show');
    Route::delete('/{id}', 'ProjectsController@destroy')->name('project.destroy');
});


Route::group(['prefix'=>'clients'], function(){
    Route::get('/', 'ClientsController@index')->name('clients.list');
    Route::post('/create', 'ClientsController@create')->name('client.create');
    Route::get('/{id}', 'ClientsController@show')->name('client.show');
    Route::delete('/{id}', 'ClientsController@destroy')->name('client.destroy');
});
