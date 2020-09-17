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
Route::get('car/{id}', 'CarController@show');
Route::post('car', 'CarController@store');
Route::put('car', 'CarController@store');
Route::delete('car/{id}', 'CarController@destroy');



