<?php

use Illuminate\Http\Request;

// Auth routes
Route::group(['prefix' => 'auth', 'namespace' => 'Auth'], function (){
    Route::post('signin', 'SignInController');
    Route::post('signout', 'SignOutController');
    Route::get('me', 'MeController');
    Route::get('login', [ 'as' => 'login', 'uses' => 'SignInController']);
});
// Cars routes
Route::get('cars', 'CarController@index');
Route::get('cars/available', 'CarController@available');
Route::get('car/{id}', 'CarController@show');
Route::post('car', 'CarController@store');
Route::put('car', 'CarController@store');
Route::post('car/{id}/rent', 'CarController@rent');
Route::delete('car/{id}', 'CarController@destroy');

// Users
Route::get('user/{id}/cars', 'UserController@show');
Route::post('register', 'UserController@store');
Route::put('user', 'UserController@update');




